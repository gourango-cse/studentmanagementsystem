<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * Note: This is the main user control class. 
 */

class SMS {

    /**
     * The CodeIgniter object variable
     * @access public
     * @var object
     */
    public $CI;

    /**
     * Variable for loading the config array into
     * @access public
     * @var array
     */
    public $config_vars;

    /**
     * Array to store error messages
     * @access public
     * @var array
     */
    public $errors = array();

    /**
     * Array to store info messages
     * @access public
     * @var array
     */
    public $infos = array();

    /**
     * Local temporary storage for current flash errors
     *
     * Used to update current flash data list since flash data is only available on the next page refresh
     * @access public
     * var array
     */
    public $flash_errors = array();

    /**
     * Local temporary storage for current flash infos
     *
     * Used to update current flash data list since flash data is only available on the next page refresh
     * @access public
     * var array
     */
    public $flash_infos = array();

    /**
     * The CodeIgniter object variable
     * @access public
     * @var object
     */
    public $sms_db;

    ########################
    # Base Functions
    ########################

    /**
     * Constructor
     */
    public function __construct() {

        // get main CI object
        $this->CI = & get_instance();

        // Dependancies
        if (CI_VERSION >= 2.2) {
            $this->CI->load->library('driver');
        }
        $this->CI->load->library('session');
        $this->CI->load->library('email');
        $this->CI->load->helper('url');
        $this->CI->load->helper('string');
        $this->CI->load->helper('email');
        $this->CI->load->helper('language');
        $this->CI->load->helper('recaptchalib');
        $this->CI->load->helper('googleauthenticator_helper');
        $this->CI->lang->load('sms');

        // config/sms.php
        $this->CI->config->load('sms');
        $this->config_vars = $this->CI->config->item('sms');

        $this->sms_db = $this->CI->load->database($this->config_vars['db_profile'], TRUE);

        // load error and info messages from flashdata (but don't store back in flashdata)
        $this->errors = $this->CI->session->flashdata('errors') ? : array();
        $this->infos = $this->CI->session->flashdata('infos') ? : array();
    }

    ########################
    # Login Functions
    ########################
    //tested
    /**
     * Login user
     * Check provided details against the database. Add items to error array on fail, create session if success
     * @param string $email
     * @param string $pass
     * @param bool $remember
     * @return bool Indicates successful login.
     */
    public function login($identifier, $pass, $remember = FALSE, $totp_code = NULL) {

        if ($this->config_vars['use_cookies'] == TRUE) {
            // Remove cookies first
            $cookie = array(
                'name' => 'user',
                'value' => '',
                'expire' => -3600,
                'path' => '/',
            );
            $this->CI->input->set_cookie($cookie);
        }


        if ($this->config_vars['login_with_name'] == TRUE) {

            if (!$identifier OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max']) {
                $this->error($this->CI->lang->line('sms_error_login_failed_name'));
                return FALSE;
            }
            $db_identifier = 'name';
        } else {
            if (!valid_email($identifier) OR strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max']) {
                $this->error($this->CI->lang->line('sms_error_login_failed_email'));
                return FALSE;
            }
            $db_identifier = 'email';
        }
        /*
         *
         * User Verification
         *
         * Removed or !ctype_alnum($pass) from the IF statement
         * It was causing issues with special characters in passwords
         * and returning FALSE even if the password matches.
         */

        $query = null;
        $query = $this->sms_db->where($db_identifier, $identifier);
        $query = $this->sms_db->get($this->config_vars['users']);
        $row = $query->row();

        // only email found and login attempts exceeded
        if ($query->num_rows() > 0 && $this->config_vars['ddos_protection'] && !$this->update_login_attempts($row->email)) {

            $this->error($this->CI->lang->line('sms_error_login_attempts_exceeded'));
            return FALSE;
        }

        //recaptcha login_attempts check
        $query = null;
        $query = $this->sms_db->where($db_identifier, $identifier);
        $query = $this->sms_db->get($this->config_vars['users']);
        $row = $query->row();
        if ($query->num_rows() > 0 && $this->config_vars['ddos_protection'] && $this->config_vars['recaptcha_active'] && $row->login_attempts >= $this->config_vars['recaptcha_login_attempts']) {
            if ($this->config_vars['use_cookies'] == TRUE) {
                $reCAPTCHA_cookie = array(
                    'name' => 'reCAPTCHA',
                    'value' => 'true',
                    'expire' => 7200,
                    'path' => '/',
                );
                $this->CI->input->set_cookie($reCAPTCHA_cookie);
            } else {
                $this->CI->session->set_tempdata('reCAPTCHA', 'true', 7200);
            }
        }

        // if user is not verified
        $query = null;
        $query = $this->sms_db->where($db_identifier, $identifier);
        $query = $this->sms_db->where('banned', 1);
        $query = $this->sms_db->where('verification_code !=', '');
        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0) {
           
                    // $this->error(' Your account is suspended! Contact to administration in an office hour.');
            $this->error($this->CI->lang->line('sms_error_account_not_verified'));
            return FALSE;
        }

        // to find user id, create sessions and cookies
        $query = $this->sms_db->where($db_identifier, $identifier);
        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() == 0) {
            $this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }

        $user_id = $query->row()->id;
        if ($this->config_vars['recaptcha_active']) {
            if (($this->config_vars['use_cookies'] == TRUE && $this->CI->input->cookie('reCAPTCHA', TRUE) == 'true') || ($this->config_vars['use_cookies'] == FALSE && $this->CI->session->tempdata('reCAPTCHA') == 'true')) {
                $reCaptcha = new ReCaptcha($this->config_vars['recaptcha_secret']);
                $resp = $reCaptcha->verifyResponse($this->CI->input->server("REMOTE_ADDR"), $this->CI->input->post("g-recaptcha-response"));

                if (!$resp->success) {
                    $this->error($this->CI->lang->line('sms_error_recaptcha_not_correct'));
                    return FALSE;
                }
            }
        }

        if ($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == FALSE) {
            $query = null;
            $query = $this->sms_db->where($db_identifier, $identifier);
            $query = $this->sms_db->get($this->config_vars['users']);
            $totp_secret = $query->row()->totp_secret;
            if ($query->num_rows() > 0 AND ! $totp_code) {
                $this->error($this->CI->lang->line('sms_error_totp_code_required'));
                return FALSE;
            } else {
                if (!empty($totp_secret)) {
                    $ga = new PHPGangsta_GoogleAuthenticator();
                    $checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
                    if (!$checkResult) {
                        $this->error($this->CI->lang->line('sms_error_totp_code_invalid'));
                        return FALSE;
                    }
                }
            }
        }

        if ($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_only_on_ip_change'] == TRUE) {
            $query = null;
            $query = $this->sms_db->where($db_identifier, $identifier);
            $query = $this->sms_db->get($this->config_vars['users']);
            $totp_secret = $query->row()->totp_secret;
            $ip_address = $query->row()->ip_address;
            $current_ip_address = $this->CI->input->ip_address();
            if ($query->num_rows() > 0 AND ! $totp_code) {
                if ($ip_address != $current_ip_address) {
                    $this->error($this->CI->lang->line('sms_error_totp_code_required'));
                    return FALSE;
                }
            } else {
                if (!empty($totp_secret)) {
                    if ($ip_address != $current_ip_address) {
                        $ga = new PHPGangsta_GoogleAuthenticator();
                        $checkResult = $ga->verifyCode($totp_secret, $totp_code, 0);
                        if (!$checkResult) {
                            $this->error($this->CI->lang->line('sms_error_totp_code_invalid'));
                            return FALSE;
                        }
                    }
                }
            }
        }

        $query = null;
        $query = $this->sms_db->where($db_identifier, $identifier);

        // Database stores pasword hashed password
        $query = $this->sms_db->where('pass', $this->hash_password($pass, $user_id));
        $query = $this->sms_db->where('banned', 0);

        $query = $this->sms_db->get($this->config_vars['users']);

        $row = $query->row();

        // if email and pass matches and not banned
        if ($query->num_rows() != 0) {

            // If email and pass matches
            // create session
         $log = $this->sms_security($row->id);

            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
                'full_name' => $row->full_name,
                'contact' => $row->contact,
                'address' => $row->address,
                'pro_pic' => $row->pro_pic,
                'role' => $row->role,
                'dob' => $row->dob,
                'last_login' => $row->last_login,
                'running_session_id' => $this->running_session()->id,
               
                'loggedin' => TRUE
            );

            $this->CI->session->set_userdata($data);
            
            // if remember selected
            if ($remember) {
                $expire = $this->config_vars['remember'];
                $today = date("Y-m-d");
                $remember_date = date("Y-m-d", strtotime($today . $expire));
                $random_string = random_string('alnum', 16);
                $this->update_remember($row->id, $random_string, $remember_date);

                if ($this->config_vars['use_cookies'] == TRUE) {
                    $cookie = array(
                        'name' => 'user',
                        'value' => $row->id . "-" . $random_string,
                        'expire' => 99 * 999 * 999,
                        'path' => '/',
                    );

                    $this->CI->input->set_cookie($cookie);
                } else {
                    $this->CI->session->set_userdata('remember', $row->id . "-" . $random_string);
                }
            }

            if ($this->config_vars['recaptcha_active']) {
                if ($this->config_vars['use_cookies'] == TRUE) {
                    $reCAPTCHA_cookie = array(
                        'name' => 'reCAPTCHA',
                        'value' => 'false',
                        'expire' => -3600,
                        'path' => '/',
                    );
                    $this->CI->input->set_cookie($reCAPTCHA_cookie);
                } else {
                    $this->CI->session->unset_tempdata('reCAPTCHA');
                }
            }

            // update last login
            $this->update_last_login($row->id);
            $this->update_activity();
            $this->reset_login_attempts($row->id);

            return TRUE;
        }
        // if not matches
        else {

            $this->error($this->CI->lang->line('sms_error_login_failed_all'));
            return FALSE;
        }
    }

    //tested
    /**
     * Check user login
     * Checks if user logged in, also checks remember.
     * @return bool
     */
    public function is_loggedin() {

        if ($this->CI->session->userdata('loggedin')) {
            return TRUE;
        }

        // cookie control
        else {
            if ($this->config_vars['use_cookies'] == TRUE) {
                if (!$this->CI->input->cookie('user', TRUE)) {
                    return FALSE;
                } else {
                    $cookie = explode('-', $this->CI->input->cookie('user', TRUE));
                    if (!is_numeric($cookie[0]) OR strlen($cookie[1]) < 13) {
                        return FALSE;
                    } else {
                        $query = $this->sms_db->where('id', $cookie[0]);
                        $query = $this->sms_db->where('remember_exp', $cookie[1]);
                        $query = $this->sms_db->get($this->config_vars['users']);

                        $row = $query->row();

                        if ($query->num_rows() < 1) {
                            $this->update_remember($cookie[0]);
                            return FALSE;
                        } else {

                            if (strtotime($row->remember_time) > strtotime("now")) {
                                $this->login_fast($cookie[0]);
                                return TRUE;
                            }
                            // if time is expired
                            else {
                                return FALSE;
                            }
                        }
                    }
                }
            } else {
                if (!isset($_SESSION['remember'])) {
                    return FALSE;
                } else {
                    $session = explode('-', $this->CI->session->userdata('remember'));
                    if (!is_numeric($session[0]) OR strlen($session[1]) < 13) {
                        return FALSE;
                    } else {
                        $query = $this->sms_db->where('id', $session[0]);
                        $query = $this->sms_db->where('remember_exp', $session[1]);
                        $query = $this->sms_db->get($this->config_vars['users']);

                        $row = $query->row();

                        if ($query->num_rows() < 1) {
                            $this->update_remember($session[0]);
                            return FALSE;
                        } else {

                            if (strtotime($row->remember_time) > strtotime("now")) {
                                $this->login_fast($session[0]);
                                return TRUE;
                            }
                            // if time is expired
                            else {
                                return FALSE;
                            }
                        }
                    }
                }
            }
        }
        return FALSE;
    }

    /*
     * Sms academic session
     * return row value
     */

    public function list_session() {

        $query = $this->sms_db->get($this->config_vars['tbl_session']);
       if ($query->num_rows() <= 0){
			//$this->error($this->CI->lang->line('sms_error_no_user'));
			return FALSE;
		}

        return $query->result();
    }
    public function running_session() {

        $query = $this->sms_db->where('active', 1);


        $query = $this->sms_db->get($this->config_vars['tbl_session']);
        if ($query->num_rows() <= 0) {
            //$this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }
        $result = $query->row();
        // $this->view_session= $result->id;
        return $result;
    }

    public function next_session() {

        $next = $this->running_session()->id + 1;

        $query = $this->sms_db->where('id', $next);


        $query = $this->sms_db->get($this->config_vars['tbl_session']);
        if ($query->num_rows() <= 0) {
            //$this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }

        return $query->row();
    }
   
    public function get_running_session_by_id($id){
       $query = $this->sms_db->where('id', $id);


        $query = $this->sms_db->get($this->config_vars['tbl_session']); 
        return $query->row()->session;
    }

    public function set_active($id) {
        if ($this->unset_session()) {
            $data = array(
                'active' => 1,
            );
            $this->sms_db->where('id', $id);
            $this->sms_db->update($this->config_vars['tbl_session'], $data);
            return true;
        }
        return false;
    }

    function unset_session() {


        $data = array(
            'active' => 0,
        );
        $this->db->update($this->config_vars['tbl_session'], $data);
        return true;
    }

    /**
     * Controls if a logged or public user has permission
     * 
     * If user does not have permission to access page, it stops script and gives
     * error message, unless 'no_permission' value is set in config.  If 'no_permission' is
     * set in config it redirects user to the set url and passes the 'no_access' error message.
     * It also updates last activity every time function called.
     *
     * @param bool $perm_par If not given just control user logged in or not
     */
    public function control($perm_par = FALSE) {

        $perm_id = $this->get_perm_id($perm_par);
        $this->update_activity();

        // if user or user's group not allowed
        if (!$this->is_allowed($perm_id) OR ! $this->is_group_allowed($perm_id)) {
            if ($this->config_vars['no_permission']) {
                $this->error($this->CI->lang->line('sms_error_no_access'));
                redirect($this->config_vars['no_permission']);
            }
//			else {
////				echo $this->CI->lang->line('sms_error_no_access');
////				
////                             die();
//                show_error($this->CI->lang->line('sms_error_no_access'), 403, "SMS");
//                die();
//                               
        }
    }

    //tested
    /**
     * Logout user
     * Destroys the CodeIgniter session and remove cookies to log out user.
     * @return bool If session destroy successful
     */
    public function logout() {
        $query = $this->sms_db->set('warning', 0);
         $query = $this->sms_db->where('user_id', $this->CI->session->userdata('id'));
         $query = $this->sms_db->update('sms_security');
         
        if ($this->config_vars['use_cookies'] == TRUE) {
            $cookie = array(
                'name' => 'user',
                'value' => '',
                'expire' => -3600,
                'path' => '/',
            );
            $this->CI->input->set_cookie($cookie);
        }
        
        return $this->CI->session->sess_destroy();
    }

    //tested
    /**
     * Fast login
     * Login with just a user id
     * @param int $user_id User id to log in
     * @return bool TRUE if login successful.
     */
    public function login_fast($user_id) {

        $query = $this->sms_db->where('id', $user_id);
        $query = $this->sms_db->where('banned', 0);
        $query = $this->sms_db->get($this->config_vars['users']);

        $row = $query->row();

        if ($query->num_rows() > 0) {

            // if id matches
            // create session
            $this->sms_security($row->id);
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
                'full_name' => $row->full_name,
                'contact' => $row->contact,
                'address' => $row->address,
                'pro_pic' => $row->pro_pic,
                'role' => $row->role,
                'dob' => $row->dob,
                'last_login' => $row->last_login,
                'running_session_id' => $this->running_session()->id,
               
                'loggedin' => TRUE
            );

            $this->CI->session->set_userdata($data);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Reset last login attempts
     * Sets a users 'last login attempts' to null
     * @param int $user_id User id to reset
     * @return bool Reset fails/succeeds
     */
    public function reset_login_attempts($user_id) {

        $data['login_attempts'] = null;
        $this->sms_db->where('id', $user_id);
        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    /**
     * Remind password
     * Emails user with link to reset password
     * @param string $email Email for account to remind
     * @return bool Remind fails/succeeds
     */
    public function remind_password($email) {

        $query = $this->sms_db->where('email', $email);
        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0) {
            $row = $query->row();

            $ver_code = random_string('alnum', 16);

            $data['verification_code'] = $ver_code;

            $this->sms_db->where('email', $email);
            $this->sms_db->update($this->config_vars['users'], $data);

            $this->CI->email->from($this->config_vars['email'], $this->config_vars['name']);
            $this->CI->email->to($row->email);
            $this->CI->email->subject($this->CI->lang->line('sms_email_reset_subject'));
            $this->CI->email->message($this->CI->lang->line('sms_email_reset_text') . site_url() . $this->config_vars['reset_password_link'] . $row->id . '/' . $ver_code);
            if($this->CI->email->send()){
                return true;
            }else{
                return false;
            }

           
        }
        return FALSE;
    }

    /**
     * Reset password
     * Generate new password and email it to the user
     * @param int $user_id User id to reset password for
     * @param string $ver_code Verification code for account
     * @return bool Password reset fails/succeeds
     */
    public function reset_password($user_id, $ver_code) {

        $query = $this->sms_db->where('id', $user_id);
        $query = $this->sms_db->where('verification_code', $ver_code);
        $query = $this->sms_db->get($this->config_vars['users']);

        $pass = random_string('alnum', 8);

        if ($query->num_rows() > 0) {

            $data = array(
                'verification_code' => '',
                'pass' => $this->hash_password($pass, $user_id)
            );

            if ($this->config_vars['totp_active'] == TRUE AND $this->config_vars['totp_reset_over_reset_password'] == TRUE) {
                $data['totp_secret'] = NULL;
            }

            $row = $query->row();
            $email = $row->email;

            $this->sms_db->where('id', $user_id);
            $this->sms_db->update($this->config_vars['users'], $data);

            $this->CI->email->from($this->config_vars['email'], $this->config_vars['name']);
            $this->CI->email->to($email);
            $this->CI->email->subject($this->CI->lang->line('sms_email_reset_success_subject'));
            $this->CI->email->message($this->CI->lang->line('sms_email_reset_success_new_password') . $pass);
            $this->CI->email->send();

            return TRUE;
        }

        return FALSE;
    }

    //tested
    /**
     * Update last login
     * Update user's last login date
     * @param int|bool $user_id User id to update or FALSE for current user
     * @return bool Update fails/succeeds
     */
    public function update_last_login($user_id = FALSE) {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata('id');

        $data['last_login'] = date("Y-m-d H:i:s");
        $data['ip_address'] = $this->CI->input->ip_address();

        $this->sms_db->where('id', $user_id);
        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Update login attempt and if exceeds return FALSE
     * Update user's last login attemp date and number date
     * @param string $email User email
     * @return bool
     */
    public function update_login_attempts($email) {

        $user_id = $this->get_user_id($email);

        $query = $this->sms_db->where('id', $user_id);
        $query = $this->sms_db->get($this->config_vars['users']);
        $row = $query->row();


        $data = array();

        if (strtotime($row->last_login_attempt) == strtotime(date("Y-m-d H:0:0"))) {
            $data['login_attempts'] = $row->login_attempts + 1;

            $query = $this->sms_db->where('id', $user_id);
            $this->sms_db->update($this->config_vars['users'], $data);
        } else {

            $data['last_login_attempt'] = date("Y-m-d H:0:0");
            $data['login_attempts'] = 1;

            $this->sms_db->where('id', $user_id);
            $this->sms_db->update($this->config_vars['users'], $data);
        }

        if ($data['login_attempts'] > $this->config_vars['max_login_attempt']) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Update remember
     * Update amount of time a user is remembered for
     * @param int $user_id User id to update 
     * @param int $expression
     * @param int $expire 
     * @return bool Update fails/succeeds
     */
    public function update_remember($user_id, $expression = null, $expire = null) {

        $data['remember_time'] = $expire;
        $data['remember_exp'] = $expression;

        $query = $this->sms_db->where('id', $user_id);
        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    ########################
    # User Functions
    ########################
    //tested
    /**
     * Create user
     * Creates a new user
     * @param string $email User's email address
     * @param string $pass User's password
     * @param string $name User's name
     * @return int|bool False if ce fails or returns user id if successful
     */
    public function create_user($email, $pass, $name = FALSE, $full_name, $gender, $role, $dob, $address, $contact, $image) {

        $valid = TRUE;

        if ($this->config_vars['login_with_name'] == TRUE) {
            if (empty($name)) {
                $this->error($this->CI->lang->line('sms_error_username_required'));
                $valid = FALSE;
            }
        }
        if ($this->user_exist_by_name($name) && $name != FALSE) {
            $this->error($this->CI->lang->line('sms_error_username_exists'));
            $valid = FALSE;
        }

        if ($this->user_exist_by_email($email)) {
            $this->error($this->CI->lang->line('sms_error_email_exists'));
            $valid = FALSE;
        }
        $valid_email = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$valid_email) {
            $this->error($this->CI->lang->line('sms_error_email_invalid'));
            $valid = FALSE;
        }
        if (strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max']) {
            $this->error($this->CI->lang->line('sms_error_password_invalid'));
            $valid = FALSE;
        }
        if ($name != FALSE && !ctype_alnum(str_replace($this->config_vars['additional_valid_chars'], '', $name))) {
            $this->error($this->CI->lang->line('sms_error_username_invalid'));
            $valid = FALSE;
        }
        if ($full_name == NULL && $role == NULL && $gender == NULL && $address == NULL && $contact == NULL && $image == NULL) {
            $this->error($this->CI->lang->line('sms_empty_feilds'));

            $valid = FALSE;
        }
        if (!$valid) {
            return FALSE;
        }

        $data = array(
            'email' => $email,
            'pass' => $this->hash_password($pass, 0), // Password cannot be blank but user_id required for salt, setting bad password for now
            'name' => (!$name) ? '' : $name,
            'full_name' => $full_name,
            'role' => $role,
            'gender' => $gender,
            'dob' => $dob,
            'address' => $address,
            'contact' => $contact,
            'pro_pic' => $image
        );

        if ($this->sms_db->insert($this->config_vars['users'], $data)) {

            $user_id = $this->sms_db->insert_id();
             // sms_security
             $this->sms_db->set('user_id', $user_id);
             $this->sms_db->insert($this->config_vars['tbl_sms_security']);

            //permission and role
            $this->add_member($user_id, $role);
            $this->allow_user($user_id, $role);
                $data = null;
                $data['banned'] = 1;

                $this->sms_db->where('id', $user_id);
                $this->sms_db->update($this->config_vars['users'], $data);

                // sends verifition ( !! e-mail settings must be set)
                if(!$this->send_verification($user_id, $name, $pass)){
                    $this->send_verification($user_id, $name, $pass);
                }
            

            // Update to correct salted password
            $data = null;
            $data['pass'] = $this->hash_password($pass, $user_id);
            $this->sms_db->where('id', $user_id);
            $this->sms_db->update($this->config_vars['users'], $data);
            
           
            return $user_id;
        } else {
            return FALSE;
        }
    }

    
    //tested
    /**
     * Update user
     * Updates existing user details
     * @param int $user_id User id to update
     * @param string|bool $email User's email address, or FALSE if not to be updated
     * @param string|bool $pass User's password, or FALSE if not to be updated
     * @param string|bool $name User's name, or FALSE if not to be updated
     * @return bool Update fails/succeeds
     */
    public function sms_security($user_id=NULL){
        if($user_id!=NULL){
       $query =  $this->sms_db->where('user_id', $user_id);
        }else{
             $query =  $this->sms_db->where('user_id', $this->session->userdata('id'));
        }
          $query =   $this->sms_db->get($this->config_vars['tbl_sms_security']);
        if($query->num_rows()>0){
          
            return $query->row();
        }else{
            $query =  $this->sms_db->set('user_id', $user_id);
             $query =   $this->sms_db->insert($this->config_vars['tbl_sms_security']);
        }
    }
    public function update_user($user_id, $email =NULL, $pass = NULL, $name = NULL ,$contact = NULL, $address=NULL) {

        $data = array();
        $valid = TRUE;
        $user = $this->get_user($user_id);

        if ($user->email == $email) {
            $email = FALSE;
        }

        if ($email != NULL) {
            if ($this->user_exist_by_email($email)) {
                $this->error($this->CI->lang->line('sms_error_update_email_exists'));
                $valid = FALSE;
            }
            $valid_email = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$valid_email) {
                $this->error($this->CI->lang->line('sms_error_email_invalid'));
                $valid = FALSE;
            }
            $data['email'] = $email;
        }

        if ($pass != NULL) {
            if (strlen($pass) < $this->config_vars['min'] OR strlen($pass) > $this->config_vars['max']) {
                $this->error($this->CI->lang->line('sms_error_password_invalid'));
                $valid = FALSE;
            }
            $data['pass'] = $this->hash_password($pass, $user_id);
        }

        if ($user->name == $name) {
            $name = NULL;
        }

        if ($name != NULL) {
            if ($this->user_exist_by_name($name)) {
                $this->error($this->CI->lang->line('sms_error_update_username_exists'));
                $valid = FALSE;
            }
            if ($name != '' && !ctype_alnum(str_replace($this->config_vars['additional_valid_chars'], '', $name))) {
                $this->error($this->CI->lang->line('sms_error_username_invalid'));
                $valid = FALSE;
            }
            $data['name'] = $name;
        }
         if ($contact != NULL) {
          
            $data['contact'] = $contact;
        }
        if ($address != NULL) {
          
            $data['address'] = $address;
        }


        if (!$valid || empty($data)) {
            return FALSE;
        }

        $this->sms_db->where('id', $user_id);
        $this->sms_db->update($this->config_vars['users'], $data);
        return true;
    }

    //tested
    /**
     * List users
     * Return users as an object array
     * @param bool|int $group_par Specify group id to list group or FALSE for all users
     * @param string $limit Limit of users to be returned
     * @param bool $offset Offset for limited number of users
     * @param bool $include_banneds Include banned users
     * @return array Array of users
     */
    public function list_users($group_par = FALSE, $limit = FALSE, $offset = FALSE, $include_banneds = FALSE) {

        // if group_par is given
        if ($group_par != FALSE) {

            //$group_par = $this->get_group_id($group_par);

            $this->sms_db->select('*')
                    ->from($this->config_vars['users'])
                    //->join($this->config_vars['user_to_group'], $this->config_vars['users'] . ".id = " . $this->config_vars['user_to_group'] . ".user_id")
                    ->where("role", $group_par);

            // if group_par is not given, lists all users
        } else {

            $this->sms_db->select('*')
                    ->from($this->config_vars['users']);
        }

        // banneds
        if (!$include_banneds) {
            $this->sms_db->where('banned != ', 1);
        }

        // limit
        if ($limit) {

            if ($offset == FALSE)
                $this->sms_db->limit($limit);
            else
                $this->sms_db->limit($limit, $offset);
        }

        $query = $this->sms_db->get();

        return $query->result();
    }

    //tested
    /**
     * Get user
     * Get user information
     * @param int|bool $user_id User id to get or FALSE for current user
     * @return object User information
     */
    public function get_user($user_id = FALSE, $role=FALSE) {

        if ($user_id == FALSE){
            $user = $this->CI->session->userdata('id');
         $query = $this->sms_db->where('id', $user);
        }
        if($user_id!=FALSE){
            if(is_numeric($user_id)){
                $query = $this->sms_db->where('id', $user_id); 
            }else{
              $query = $this->sms_db->where('name', $user_id);   
            }
        }
       if($role!=FALSE){
          $query = $this->sms_db->where('role', $role);      
       }
        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() <= 0) {
            $this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }
        return $query->row();
    }

    /**
     * Verify user
     * Activates user account based on verification code
     * @param int $user_id User id to activate
     * @param string $ver_code Code to validate against
     * @return bool Activation fails/succeeds
     */
    public function verify_user($user_id, $ver_code) {

        $query = $this->sms_db->where('id', $user_id);
        $query = $this->sms_db->where('verification_code', $ver_code);
        $query = $this->sms_db->get($this->config_vars['users']);

        // if ver code is TRUE
        if ($query->num_rows() > 0) {

            $data = array(
                'verification_code' => '',
                'banned' => 0
            );

            $this->sms_db->where('id', $user_id);
            $this->sms_db->update($this->config_vars['users'], $data);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Send verification email
     * Sends a verification email based on user id
     * @param int $user_id User id to send verification email to
     * @todo return success indicator
     */
    public function send_verification($user_id, $usrname=NULL, $password=NULL) {

        $query = $this->sms_db->where('id', $user_id);
        $query = $this->sms_db->get($this->config_vars['users']);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if($password!=NULL){
            $pass = $password;
          
        }else{
            $pass =' **********';
           
        }
           $username = $row->name;
            $ver_code = random_string('alnum', 16);
            
            
            $data['verification_code'] = $ver_code;

            $this->sms_db->where('id', $user_id);
            $this->sms_db->update($this->config_vars['users'], $data);

            $this->CI->email->from($this->config_vars['email'], $this->config_vars['name']);
            $this->CI->email->to($row->email);
            $this->CI->email->subject($this->CI->lang->line('sms_email_verification_subject'));
            $dataa['row']=$row;
            $dataa['username']= $username;
            $dataa['password'] = $pass;
            $dataa['ver_code'] = $ver_code;
            $dataa['link'] = site_url() . $this->config_vars['verification_link'] . $user_id . '/' . $ver_code;
            $body = $this->CI->load->view("email/verification", $dataa, TRUE);
            $this->CI->email->message($body);
            if($this->CI->email->send()){
                if($this->config_vars['register_user_data_log']==TRUE){
                    $write = 'username:' . $row->name . " Password: " . $password." user_id: ".$row->id." Verification Code: ".$ver_code; // delete on live 

             write_file('./data/userlog/'.$row->name.'_register_log.txt', $write); //delete on live
            
                }
                 
                return TRUE;
            }else{
                if($this->config_vars['register_user_data_log']==TRUE){
                    $write = 'username:' . $row->name . " Password: " . $password." user_id: ".$row->id." Verification Code: ".$ver_code; // delete on live 

             write_file('./data/userlog/'.$row->name.'_register_log.txt', $write); //delete on live
            
                }
                return FALSE;
            }
           
        }
    }

    //not tested excatly
    /**
     * Delete user
     * Delete a user from database. WARNING Can't be undone
     * @param int $user_id User id to delete
     * @return bool Delete fails/succeeds
     */
    public function delete_user($user_id) {

        // delete from perm_to_user
        $this->sms_db->where('user_id', $user_id);
        $this->sms_db->delete($this->config_vars['perm_to_user']);

        // delete from user_to_group
        $this->sms_db->where('user_id', $user_id);
        $this->sms_db->delete($this->config_vars['user_to_group']);

        // delete user vars
        $this->sms_db->where('user_id', $user_id);
        $this->sms_db->delete($this->config_vars['user_variables']);

        // delete user
        $this->sms_db->where('id', $user_id);
        return $this->sms_db->delete($this->config_vars['users']);
    }

    //tested
    /**
     * Ban user
     * Bans a user account
     * @param int $user_id User id to ban
     * @return bool Ban fails/succeeds
     */
    public function ban_user($user_id) {

        $data = array(
            'banned' => 1,
            'verification_code' => ''
        );

        $this->sms_db->where('id', $user_id);

        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Unban user
     * Activates user account
     * Same with unlock_user()
     * @param int $user_id User id to activate
     * @return bool Activation fails/succeeds
     */
    public function unban_user($user_id) {

        $data = array(
            'banned' => 0
        );

        $this->sms_db->where('id', $user_id);

        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Check user banned
     * Checks if a user is banned
     * @param int $user_id User id to check
     * @return bool False if banned, True if not
     */
    public function is_banned($user_id) {

        $query = $this->sms_db->where('id', $user_id);
        $query = $this->sms_db->where('banned', 1);

        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * user_exist_by_name
     * Check if user exist by name
     * @param $user_id
     *
     * @return bool
     */
    public function user_exist_by_name($name) {
        $query = $this->sms_db->where('name', $name);

        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * user_exist_by_email
     * Check if user exist by user email
     * @param $user_email
     *
     * @return bool
     */
    public function user_exist_by_email($user_email) {
        $query = $this->sms_db->where('email', $user_email);

        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Get user id
     * Get user id from email address, if par. not given, return current user's id
     * @param string|bool $email Email address for user
     * @return int User id
     */
    public function get_user_id($email = FALSE) {

        if (!$email) {
            $query = $this->sms_db->where('id', $this->CI->session->userdata('id'));
        } else {
            $query = $this->sms_db->where('email', $email);
        }

        $query = $this->sms_db->get($this->config_vars['users']);

        if ($query->num_rows() <= 0) {
            $this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }
        return $query->row()->id;
        
    }

    /**
     * Get user groups
     * Get groups a user is in
     * @param int|bool $user_id User id to get or FALSE for current user
     * @return array Groups
     */
    public function get_user_groups($user_id = FALSE) {

        if ($user_id == FALSE) {
            $user_id = $this->CI->session->userdata('id');
        }

        $this->sms_db->select('*');
        $this->sms_db->from($this->config_vars['user_to_group']);
        $this->sms_db->join($this->config_vars['groups'], "id = group_id");
        $this->sms_db->where('user_id', $user_id);

        return $query = $this->sms_db->get()->result();
    }

    //tested
    /**
     * Update activity
     * Update user's last activity date
     * @param int|bool $user_id User id to update or FALSE for current user
     * @return bool Update fails/succeeds
     */
    public function update_activity($user_id = FALSE) {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata('id');

        if ($user_id == FALSE) {
            return FALSE;
        }

        $data['last_activity'] = date("Y-m-d H:i:s");

        $query = $this->sms_db->where('id', $user_id);
        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    //tested
    /**
     * Hash password
     * Hash the password for storage in the database
     * (thanks to Jacob Tomlinson for contribution)
     * @param string $pass Password to hash
     * @param $userid
     * @return string Hashed password
     */
    function hash_password($pass, $userid) {

        $salt = md5($userid);
        return hash($this->config_vars['hash'], $salt . $pass);
    }

    ########################
    # Group Functions
    ########################
    //tested
    /**
     * Create group
     * Creates a new group
     * @param string $group_name New group name
     * @param string $definition Description of the group
     * @return int|bool Group id or FALSE on fail
     */
    public function create_group($group_name, $definition = '') {

        $query = $this->sms_db->get_where($this->config_vars['groups'], array('name' => $group_name));

        if ($query->num_rows() < 1) {

            $data = array(
                'name' => $group_name,
                'definition' => $definition
            );
            $this->sms_db->insert($this->config_vars['groups'], $data);
            return $this->sms_db->insert_id();
        }

        $this->info($this->CI->lang->line('sms_info_group_exists'));
        return FALSE;
    }

    //tested
    /**
     * Update group
     * Change a groups name
     * @param int $group_id Group id to update
     * @param string $group_name New group name
     * @return bool Update success/failure
     */
    public function update_group($group_par, $group_name = FALSE, $definition = FALSE) {

        $group_id = $this->get_group_id($group_par);

        if ($group_name != FALSE) {
            $data['name'] = $group_name;
        }

        if ($definition != FALSE) {
            $data['definition'] = $definition;
        }


        $this->sms_db->where('id', $group_id);
        return $this->sms_db->update($this->config_vars['groups'], $data);
    }

    //tested
    /**
     * Delete group
     * Delete a group from database. WARNING Can't be undone
     * @param int $group_id User id to delete
     * @return bool Delete success/failure
     */
    public function delete_group($group_par) {

        $group_id = $this->get_group_id($group_par);

        $this->sms_db->where('id', $group_id);
        $query = $this->sms_db->get($this->config_vars['groups']);
        if ($query->num_rows() == 0) {
            return FALSE;
        }

        // bug fixed
        // now users are deleted from user_to_group table
        $this->sms_db->where('group_id', $group_id);
        $this->sms_db->delete($this->config_vars['user_to_group']);

        $this->sms_db->where('group_id', $group_id);
        $this->sms_db->delete($this->config_vars['perm_to_group']);

        $this->sms_db->where('group_id', $group_id);
        $this->sms_db->delete($this->config_vars['group_to_group']);

        $this->sms_db->where('subgroup_id', $group_id);
        $this->sms_db->delete($this->config_vars['group_to_group']);

        $this->sms_db->where('id', $group_id);
        return $this->sms_db->delete($this->config_vars['groups']);
    }

    //tested
    /**
     * Add member
     * Add a user to a group
     * @param int $user_id User id to add to group
     * @param int|string $group_par Group id or name to add user to
     * @return bool Add success/failure
     */
    public function add_member($user_id, $group_par) {

        $group_id = $this->get_group_id($group_par);

        if (!$group_id) {

            $this->error($this->CI->lang->line('sms_error_no_group'));
            return FALSE;
        }

        $query = $this->sms_db->where('user_id', $user_id);
        $query = $this->sms_db->where('group_id', $group_id);
        $query = $this->sms_db->get($this->config_vars['user_to_group']);

        if ($query->num_rows() < 1) {
            $data = array(
                'user_id' => $user_id,
                'group_id' => $group_id
            );

            return $this->sms_db->insert($this->config_vars['user_to_group'], $data);
        }
        $this->info($this->CI->lang->line('sms_info_already_member'));
        return TRUE;
    }

    //tested
    /**
     * Remove member
     * Remove a user from a group
     * @param int $user_id User id to remove from group
     * @param int|string $group_par Group id or name to remove user from
     * @return bool Remove success/failure
     */
    public function remove_member($user_id, $group_par) {

        $group_par = $this->get_group_id($group_par);
        $this->sms_db->where('user_id', $user_id);
        $this->sms_db->where('group_id', $group_par);
        return $this->sms_db->delete($this->config_vars['user_to_group']);
    }

    /**
     * Add subgroup
     * Add a subgroup to a group
     * @param int $user_id User id to add to group
     * @param int|string $group_par Group id or name to add user to
     * @return bool Add success/failure
     */
    public function add_subgroup($group_par, $subgroup_par) {

        $group_id = $this->get_group_id($group_par);
        $subgroup_id = $this->get_group_id($subgroup_par);

        if (!$group_id) {
            $this->error($this->CI->lang->line('sms_error_no_group'));
            return FALSE;
        }

        if (!$subgroup_id) {
            $this->error($this->CI->lang->line('sms_error_no_subgroup'));
            return FALSE;
        }

        $query = $this->sms_db->where('group_id', $group_id);
        $query = $this->sms_db->where('subgroup_id', $subgroup_id);
        $query = $this->sms_db->get($this->config_vars['group_to_group']);

        if ($query->num_rows() < 1) {
            $data = array(
                'group_id' => $group_id,
                'subgroup_id' => $subgroup_id,
            );

            return $this->sms_db->insert($this->config_vars['group_to_group'], $data);
        }
        $this->info($this->CI->lang->line('sms_info_already_subgroup'));
        return TRUE;
    }

    /**
     * Remove subgroup
     * Remove a subgroup from a group
     * @param int|string $group_par Group id or name to remove 
     * @param int|string $subgroup_par Sub-Group id or name to remove
     * @return bool Remove success/failure
     */
    public function remove_subgroup($group_par, $subgroup_par) {

        $group_par = $this->get_group_id($group_par);
        $subgroup_par = $this->get_group_id($subgroup_par);
        $this->sms_db->where('group_id', $group_par);
        $this->sms_db->where('subgroup_id', $subgroup_par);
        return $this->sms_db->delete($this->config_vars['group_to_group']);
    }

    //tested
    /**
     * Remove member
     * Remove a user from all groups
     * @param int $user_id User id to remove from all groups
     * @return bool Remove success/failure
     */
    public function remove_member_from_all($user_id) {

        $this->sms_db->where('user_id', $user_id);
        return $this->sms_db->delete($this->config_vars['user_to_group']);
    }

    //tested
    /**
     * Is member
     * Check if current user is a member of a group
     * @param int|string $group_par Group id or name to check
     * @param int|bool $user_id User id, if not given current user
     * @return bool
     */
    public function is_member($group_par, $user_id = FALSE) {

        // if user_id FALSE (not given), current user
        if (!$user_id) {
            $user_id = $this->CI->session->userdata('id');
        }

        $group_id = $this->get_group_id($group_par);

        $query = $this->sms_db->where('user_id', $user_id);
        $query = $this->sms_db->where('group_id', $group_id);
        $query = $this->sms_db->get($this->config_vars['user_to_group']);

        $row = $query->row();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //tested
    /**
     * Is admin
     * Check if current user is a member of the admin group
     * @param int $user_id User id to check, if it is not given checks current user
     * @return bool
     */
    public function is_admin($user_id = FALSE) {

        return $this->is_member($this->config_vars['admin_group'], $user_id);
    }

    //tested
    /**
     * List groups
     * List all groups
     * @return object Array of groups
     */
    public function list_groups() {

        $query = $this->sms_db->get($this->config_vars['groups']);
        return $query->result();
    }

    //tested
    /**
     * Get group name
     * Get group name from group id
     * @param int $group_id Group id to get
     * @return string Group name
     */
    public function get_group_name($group_id) {

        $query = $this->sms_db->where('id', $group_id);
        $query = $this->sms_db->get($this->config_vars['groups']);

        if ($query->num_rows() == 0)
            return FALSE;

        $row = $query->row();
        return $row->name;
    }

    //tested
    /**
     * Get group id
     * Get group id from group name or id ( ! Case sensitive)
     * @param int|string $group_par Group id or name to get
     * @return int Group id
     */
    public function get_group_id($group_par) {

        if (is_numeric($group_par)) {
            return $group_par;
        }

        $query = $this->sms_db->where('name', $group_par);
        $query = $this->sms_db->get($this->config_vars['groups']);

        if ($query->num_rows() == 0)
            return FALSE;

        $row = $query->row();
        return $row->id;
    }

    /**
     * Get subgroups
     * Get subgroups from group name or id ( ! Case sensitive)
     * @param int|string $group_par Group id or name to get
     * @return object Array of subgroup_id's
     */
    public function get_subgroups($group_par) {

        $group_id = $this->get_group_id($group_par);

        $query = $this->sms_db->where('group_id', $group_id);
        $query = $this->sms_db->select('subgroup_id');
        $query = $this->sms_db->get($this->config_vars['group_to_group']);

        if ($query->num_rows() == 0)
            return FALSE;

        return $query->result();
    }

    ########################
    # Permission Functions
    ########################
    //tested
    /**
     * Create permission
     * Creates a new permission type
     * @param string $perm_name New permission name
     * @param string $definition Permission description
     * @return int|bool Permission id or FALSE on fail
     */
    public function create_perm($perm_name, $definition = '') {

        $query = $this->sms_db->get_where($this->config_vars['perms'], array('name' => $perm_name));

        if ($query->num_rows() < 1) {

            $data = array(
                'name' => $perm_name,
                'definition' => $definition
            );
            $this->sms_db->insert($this->config_vars['perms'], $data);
            return $this->sms_db->insert_id();
        }
        $this->info($this->CI->lang->line('sms_info_perm_exists'));
        return FALSE;
    }

    //tested
    /**
     * Update permission
     * Updates permission name and description
     * @param int|string $perm_par Permission id or permission name
     * @param string $perm_name New permission name
     * @param string $definition Permission description
     * @return bool Update success/failure
     */
    public function update_perm($perm_par, $perm_name = FALSE, $definition = FALSE) {

        $perm_id = $this->get_perm_id($perm_par);

        if ($perm_name != FALSE)
            $data['name'] = $perm_name;

        if ($definition != FALSE)
            $data['definition'] = $definition;

        $this->sms_db->where('id', $perm_id);
        return $this->sms_db->update($this->config_vars['perms'], $data);
    }

    //not ok
    /**
     * Delete permission
     * Delete a permission from database. WARNING Can't be undone
     * @param int|string $perm_par Permission id or perm name to delete
     * @return bool Delete success/failure
     */
    public function delete_perm($perm_par) {

        $perm_id = $this->get_perm_id($perm_par);

        // deletes from perm_to_gropup table
        $this->sms_db->where('perm_id', $perm_id);
        $this->sms_db->delete($this->config_vars['perm_to_group']);

        // deletes from perm_to_user table
        $this->sms_db->where('perm_id', $perm_id);
        $this->sms_db->delete($this->config_vars['perm_to_user']);

        // deletes from permission table
        $this->sms_db->where('id', $perm_id);
        return $this->sms_db->delete($this->config_vars['perms']);
    }

    /**
     * Is user allowed
     * Check if user allowed to do specified action, admin always allowed
     * first checks user permissions then check group permissions
     * @param int $perm_par Permission id or name to check
     * @param int|bool $user_id User id to check, or if FALSE checks current user
     * @return bool
     */
    public function is_allowed($perm_par, $user_id = FALSE) {

        if ($user_id == FALSE) {
            $user_id = $this->CI->session->userdata('id');
        }

        if ($this->is_admin($user_id)) {
            return true;
        }

        $perm_id = $this->get_perm_id($perm_par);

        $query = $this->sms_db->where('perm_id', $perm_id);
        $query = $this->sms_db->where('user_id', $user_id);
        $query = $this->sms_db->get($this->config_vars['perm_to_user']);

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            if ($user_id === FALSE) {
                return $this->is_group_allowed($perm_id);
            } else {
                $g_allowed = FALSE;
                foreach ($this->get_user_groups($user_id) as $group) {
                    if ($this->is_group_allowed($perm_id, $group->id)) {
                        $g_allowed = TRUE;
                    }
                }
                return $g_allowed;
            }
        }
    }

    /**
     * Is Group allowed
     * Check if group is allowed to do specified action, admin always allowed
     * @param int $perm_par Permission id or name to check
     * @param int|string|bool $group_par Group id or name to check, or if FALSE checks all user groups
     * @return bool
     */
    public function is_group_allowed($perm_par, $group_par = FALSE) {

        $perm_id = $this->get_perm_id($perm_par);

        // if group par is given
        if ($group_par != FALSE) {

            $subgroup_ids = $this->get_subgroups($group_par);
            $group_par = $this->get_group_id($group_par);
            $query = $this->sms_db->where('perm_id', $perm_id);
            $query = $this->sms_db->where('group_id', $group_par);
            $query = $this->sms_db->get($this->config_vars['perm_to_group']);

            $g_allowed = FALSE;
            if (is_array($subgroup_ids)) {
                foreach ($subgroup_ids as $g) {
                    if ($this->is_group_allowed($perm_id, $g->subgroup_id)) {
                        $g_allowed = TRUE;
                    }
                }
            }

            if ($query->num_rows() > 0) {
                $g_allowed = TRUE;
            }
            return $g_allowed;
        }
        // if group par is not given
        // checks current user's all groups
        else {
            // if public is allowed or he is admin
            if ($this->is_admin($this->CI->session->userdata('id')) OR
                    $this->is_group_allowed($perm_id, $this->config_vars['public_group'])) {
                return TRUE;
            }

            // if is not login
            if (!$this->is_loggedin()) {
                return FALSE;
            }

            $group_pars = $this->get_user_groups();
            foreach ($group_pars as $g) {
                if ($this->is_group_allowed($perm_id, $g->id)) {
                    return TRUE;
                }
            }
            return FALSE;
        }
    }

    //tested
    /**
     * Allow User
     * Add User to permission
     * @param int $user_id User id to deny
     * @param int $perm_par Permission id or name to allow
     * @return bool Allow success/failure
     */
    public function allow_user($user_id, $perm_par) {

        $perm_id = $this->get_perm_id($perm_par);

        if (!$perm_id) {
            return FALSE;
        }

        $query = $this->sms_db->where('user_id', $user_id);
        $query = $this->sms_db->where('perm_id', $perm_id);
        $query = $this->sms_db->get($this->config_vars['perm_to_user']);

        // if not inserted before
        if ($query->num_rows() < 1) {

            $data = array(
                'user_id' => $user_id,
                'perm_id' => $perm_id
            );

            return $this->sms_db->insert($this->config_vars['perm_to_user'], $data);
        }
        return TRUE;
    }

    //tested
    /**
     * Deny User
     * Remove user from permission
     * @param int $user_id User id to deny
     * @param int $perm_par Permission id or name to deny
     * @return bool Deny success/failure
     */
    public function deny_user($user_id, $perm_par) {

        $perm_id = $this->get_perm_id($perm_par);

        $this->sms_db->where('user_id', $user_id);
        $this->sms_db->where('perm_id', $perm_id);

        return $this->sms_db->delete($this->config_vars['perm_to_user']);
    }

    //tested
    /**
     * Allow Group
     * Add group to permission
     * @param int|string|bool $group_par Group id or name to allow
     * @param int $perm_par Permission id or name to allow
     * @return bool Allow success/failure
     */
    public function allow_group($group_par, $perm_par) {

        $perm_id = $this->get_perm_id($perm_par);

        if (!$perm_id) {
            return FALSE;
        }

        $group_id = $this->get_group_id($group_par);

        if (!$group_id) {
            return FALSE;
        }

        $query = $this->sms_db->where('group_id', $group_id);
        $query = $this->sms_db->where('perm_id', $perm_id);
        $query = $this->sms_db->get($this->config_vars['perm_to_group']);

        if ($query->num_rows() < 1) {

            $data = array(
                'group_id' => $group_id,
                'perm_id' => $perm_id
            );

            return $this->sms_db->insert($this->config_vars['perm_to_group'], $data);
        }

        return TRUE;
    }

    //tested
    /**
     * Deny Group
     * Remove group from permission
     * @param int|string|bool $group_par Group id or name to deny
     * @param int $perm_par Permission id or name to deny
     * @return bool Deny success/failure
     */
    public function deny_group($group_par, $perm_par) {

        $perm_id = $this->get_perm_id($perm_par);
        $group_id = $this->get_group_id($group_par);

        $this->sms_db->where('group_id', $group_id);
        $this->sms_db->where('perm_id', $perm_id);

        return $this->sms_db->delete($this->config_vars['perm_to_group']);
    }

    //tested
    /**
     * List Permissions
     * List all permissions
     * @return object Array of permissions
     */
    public function list_perms() {

        $query = $this->sms_db->get($this->config_vars['perms']);
        return $query->result();
    }

    //tested
    /**
     * Get permission id
     * Get permission id from permisison name or id
     * @param int|string $perm_par Permission id or name to get
     * @return int Permission id or NULL if perm does not exist
     */
    public function get_perm_id($perm_par) {

        if (is_numeric($perm_par)) {
            return $perm_par;
        }

        $query = $this->sms_db->where('name', $perm_par);
        $query = $this->sms_db->get($this->config_vars['perms']);

        if ($query->num_rows() == 0)
            return FALSE;

        $row = $query->row();
        return $row->id;
    }

    ########################
    # Private Message Functions
    ########################
    //tested
    /**
     * Send Private Message
     * Send a private message to another user
     * @param int $sender_id User id of private message sender
     * @param int $receiver_id User id of private message receiver
     * @param string $title Message title/subject
     * @param string $message Message body/content
     * @return bool Send successful/failed
     */
    public function send_pm($sender_id, $receiver_id, $title, $message) {

        if (!is_numeric($receiver_id) OR $sender_id == $receiver_id) {
            $this->error($this->CI->lang->line('sms_error_self_pm'));
            return FALSE;
        }

        $query = $this->sms_db->where('id', $receiver_id);
        $query = $this->sms_db->where('banned', 0);

        $query = $this->sms_db->get($this->config_vars['users']);

        // if user not exist or banned
        if ($query->num_rows() < 1) {
            $this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }

        $query = $this->sms_db->where('id', $sender_id);
        $query = $this->sms_db->where('banned', 0);

        $query = $this->sms_db->get($this->config_vars['users']);

        // if user not exist or banned
        if ($query->num_rows() < 1) {
            $this->error($this->CI->lang->line('sms_error_no_user'));
            return FALSE;
        }


        $data = array(
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id,
            'title' => $title,
            'message' => $message,
            'date_sent' => date('Y-m-d H:i:s')
        );

        return $query = $this->sms_db->insert($this->config_vars['pms'], $data);
    }

    //tested
    /**
     * List Private Messages
     * If receiver id not given retruns current user's pms, if sender_id given, it returns only pms from given sender
     * @param int $limit Number of private messages to be returned
     * @param int $offset Offset for private messages to be returned (for pagination)
     * @param int $sender_id User id of private message sender
     * @param int $receiver_id User id of private message receiver
     * @return object Array of private messages
     */
    public function list_pms($limit = 5, $offset = 0, $receiver_id = FALSE, $sender_id = FALSE) {

        $query = '';

        if ($receiver_id != FALSE) {
            $query = $this->sms_db->where('receiver_id', $receiver_id);
        }

        if ($sender_id != FALSE) {
            $query = $this->sms_db->where('sender_id', $sender_id);
        }

        $query = $this->sms_db->order_by('id', 'DESC');
        $query = $this->sms_db->get($this->config_vars['pms'], $limit, $offset);
        return $query->result();
    }

    //tested
    /**
     * Get Private Message
     * Get private message by id
     * @param int $pm_id Private message id to be returned
     * @param bool $set_as_read Whether or not to mark message as read
     * @return object Private message
     */
    public function get_pm($pm_id, $set_as_read = TRUE) {

        $query = $this->sms_db->where('id', $pm_id);
        $query = $this->sms_db->get($this->config_vars['pms']);

        if ($query->num_rows() < 1) {
            $this->error($this->CI->lang->line('sms_error_no_pm'));
            return FALSE;
        }

        if ($set_as_read){
            $this->set_as_read_pm($pm_id);
        }
        return $query->row();
    }

    //tested
    /**
     * Delete Private Message
     * Delete private message by id
     * @param int $pm_id Private message id to be deleted
     * @return bool Delete success/failure
     */
    public function delete_pm($pm_id) {

        return $this->sms_db->delete($this->config_vars['pms'], array('id' => $pm_id));
    }

    //tested
    /**
     * Count unread Private Message
     * Count number of unread private messages
     * @param int|bool $receiver_id User id for message receiver, if FALSE returns for current user
     * @return int Number of unread messages
     */
    public function count_unread_pms($receiver_id = FALSE) {

        if (!$receiver_id) {
            $receiver_id = $this->CI->session->userdata('id');
        }

        $query = $this->sms_db->where('receiver_id', $receiver_id);
        $query = $this->sms_db->where('date_read', NULL);
        $query = $this->sms_db->get($this->config_vars['pms']);

        return $query->num_rows();
    }

    //tested
    /**
     * Set Private Message as read
     * Set private message as read
     * @param int $pm_id Private message id to mark as read
     */
    public function set_as_read_pm($pm_id) {

        $data = array(
            'date_read' => date('Y-m-d H:i:s')
        );

        $this->sms_db->update($this->config_vars['pms'], $data, "id = $pm_id");
    }

    ########################
    # Error / Info Functions
    ########################

    /**
     * Error
     * Add message to error array and set flash data
     * @param string $message Message to add to array
     * @param boolean $flashdata if TRUE add $message to CI flashdata (deflault: FALSE)
     */
    public function error($message = '', $flashdata = FALSE) {
        $this->errors[] = $message;
        if ($flashdata) {
            $this->flash_errors[] = $message;
            $this->CI->session->set_flashdata('errors', $this->flash_errors);
        }
    }

    /**
     * Keep Errors
     *
     * Keeps the flashdata errors for one more page refresh.  Optionally adds the default errors into the
     * flashdata list.  This should be called last in your controller, and with care as it could continue
     * to revive all errors and not let them expire as intended.
     * Benefitial when using Ajax Requests
     * @see http://ellislab.com/codeigniter/user-guide/libraries/sessions.html
     * @param boolean $include_non_flash TRUE if it should stow basic errors as flashdata (default = FALSE)
     */
    public function keep_errors($include_non_flash = FALSE) {
        // NOTE: keep_flashdata() overwrites anything new that has been added to flashdata so we are manually reviving flash data
        // $this->CI->session->keep_flashdata('errors');

        if ($include_non_flash) {
            $this->flash_errors = array_merge($this->flash_errors, $this->errors);
        }
        $this->flash_errors = array_merge($this->flash_errors, (array) $this->CI->session->flashdata('errors'));
        $this->CI->session->set_flashdata('errors', $this->flash_errors);
    }

    //tested
    /**
     * Get Errors Array
     * Return array of errors
     * @return array Array of messages, empty array if no errors
     */
    public function get_errors_array() {
        return $this->errors;
    }

    /**
     * Print Errors
     * 
     * Prints string of errors separated by delimiter
     * @param string $divider Separator for errors
     */
    public function print_errors($divider = '<br />') {
        $msg = '';
        $msg_num = count($this->errors);
        $i = 1;
        foreach ($this->errors as $e) {
            $msg .= $e;

            if ($i != $msg_num) {
                $msg .= $divider;
            }
            $i++;
        }


        echo $msg;
    }

    /**
     * Clear Errors
     * 
     * Removes errors from error list and clears all associated flashdata
     */
    public function clear_errors() {
        $this->errors = array();
        $this->CI->session->set_flashdata('errors', $this->errors);
    }

    /**
     * Info
     *
     * Add message to info array and set flash data
     * 
     * @param string $message Message to add to infos array
     * @param boolean $flashdata if TRUE add $message to CI flashdata (deflault: FALSE)
     */
    public function info($message = '', $flashdata = FALSE) {
        $this->infos[] = $message;
        if ($flashdata) {
            $this->flash_infos[] = $message;
            $this->CI->session->set_flashdata('infos', $this->flash_infos);
        }
    }

    /**
     * Keep Infos
     *
     * Keeps the flashdata infos for one more page refresh.  Optionally adds the default infos into the
     * flashdata list.  This should be called last in your controller, and with care as it could continue
     * to revive all infos and not let them expire as intended.
     * Benefitial by using Ajax Requests
     * @see http://ellislab.com/codeigniter/user-guide/libraries/sessions.html
     * @param boolean $include_non_flash TRUE if it should stow basic infos as flashdata (default = FALSE)
     */
    public function keep_infos($include_non_flash = FALSE) {
        // NOTE: keep_flashdata() overwrites anything new that has been added to flashdata so we are manually reviving flash data
        // $this->CI->session->keep_flashdata('infos');

        if ($include_non_flash) {
            $this->flash_infos = array_merge($this->flash_infos, $this->infos);
        }
        $this->flash_infos = array_merge($this->flash_infos, (array) $this->CI->session->flashdata('infos'));
        $this->CI->session->set_flashdata('infos', $this->flash_infos);
    }

    /**
     * Get Info Array
     *
     * Return array of infos
     * @return array Array of messages, empty array if no errors
     */
    public function get_infos_array() {
        return $this->infos;
    }

    /**
     * Print Info
     *
     * Print string of info separated by delimiter
     * @param string $divider Separator for info
     *
     */
    public function print_infos($divider = '<br />') {

        $msg = '';
        $msg_num = count($this->infos);
        $i = 1;
        foreach ($this->infos as $e) {
            $msg .= $e;

            if ($i != $msg_num) {
                $msg .= $divider;
            }
            $i++;
        }
        echo $msg;
    }

    /**
     * Clear Info List
     * 
     * Removes info messages from info list and clears all associated flashdata
     */
    public function clear_infos() {
        $this->infos = array();
        $this->CI->session->set_flashdata('infos', $this->infos);
    }

    ########################
    # User Variables
    ########################
    //tested
    /**
     * Set User Variable as key value
     * if variable not set before, it will ve set
     * if set, overwrites the value
     * @param string $key
     * @param string $value
     * @param int $user_id ; if not given current user
     * @return bool
     */
    public function set_user_var($key, $value, $user_id = FALSE) {

        if (!$user_id) {
            $user_id = $this->CI->session->userdata('id');
        }

        // if specified user is not found
        if (!$this->get_user($user_id)) {
            return FALSE;
        }

        // if var not set, set
        if ($this->get_user_var($key, $user_id) === FALSE) {

            $data = array(
                'data_key' => $key,
                'value' => $value,
                'user_id' => $user_id
            );

            return $this->sms_db->insert($this->config_vars['user_variables'], $data);
        }
        // if var already set, overwrite
        else {

            $data = array(
                'data_key' => $key,
                'value' => $value,
                'user_id' => $user_id
            );

            $this->sms_db->where('data_key', $key);
            $this->sms_db->where('user_id', $user_id);

            return $this->sms_db->update($this->config_vars['user_variables'], $data);
        }
    }

    //tested
    /**
     * Unset User Variable as key value
     * @param string $key
     * @param int $user_id ; if not given current user
     * @return bool
     */
    public function unset_user_var($key, $user_id = FALSE) {

        if (!$user_id) {
            $user_id = $this->CI->session->userdata('id');
        }

        // if specified user is not found
        if (!$this->get_user($user_id)) {
            return FALSE;
        }

        $this->sms_db->where('data_key', $key);
        $this->sms_db->where('user_id', $user_id);

        return $this->sms_db->delete($this->config_vars['user_variables']);
    }

    //tested
    /**
     * Get User Variable by key
     * Return string of variable value or FALSE
     * @param string $key
     * @param int $user_id ; if not given current user
     * @return bool|string , FALSE if var is not set, the value of var if set
     */
    public function get_user_var($key, $user_id = FALSE) {

        if (!$user_id) {
            $user_id = $this->CI->session->userdata('id');
        }

        // if specified user is not found
        if (!$this->get_user($user_id)) {
            return FALSE;
        }

        $query = $this->sms_db->where('user_id', $user_id);
        $query = $this->sms_db->where('data_key', $key);

        $query = $this->sms_db->get($this->config_vars['user_variables']);

        // if variable not set
        if ($query->num_rows() < 1) {
            return FALSE;
        } else {

            $row = $query->row();
            return $row->value;
        }
    }

    /**
     * Get User Variables by user id
     * Return array with all user keys & variables
     * @param int $user_id ; if not given current user
     * @return bool|array , FALSE if var is not set, the value of var if set
     */
    public function get_user_vars($user_id = FALSE) {

        if (!$user_id) {
            $user_id = $this->CI->session->userdata('id');
        }

        // if specified user is not found
        if (!$this->get_user($user_id)) {
            return FALSE;
        }

        $query = $this->sms_db->select('data_key, value');

        $query = $this->sms_db->where('user_id', $user_id);

        $query = $this->sms_db->get($this->config_vars['user_variables']);

        return $query->result();
    }

    /**
     * List User Variable Keys by UserID
     * Return array of variable keys or FALSE
     * @param int $user_id ; if not given current user
     * @return bool|array, FALSE if no user vars, otherwise array
     */
    public function list_user_var_keys($user_id = FALSE) {

        if (!$user_id) {
            $user_id = $this->CI->session->userdata('id');
        }

        // if specified user is not found
        if (!$this->get_user($user_id)) {
            return FALSE;
        }
        $query = $this->sms_db->select('data_key');

        $query = $this->sms_db->where('user_id', $user_id);

        $query = $this->sms_db->get($this->config_vars['user_variables']);

        // if variable not set
        if ($query->num_rows() < 1) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    ########################
    # SMS System Variables
    ########################
    //tested
    /**
     * Set SMS System Variable as key value
     * if variable not set before, it will be set
     * if set, overwrites the value
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set_system_var($key, $value) {

        // if var not set, set
        if ($this->get_system_var($key) === FALSE) {

            $data = array(
                'data_key' => $key,
                'value' => $value,
            );

            return $this->sms_db->insert($this->config_vars['system_variables'], $data);
        }
        // if var already set, overwrite
        else {

            $data = array(
                'data_key' => $key,
                'value' => $value,
            );

            $this->sms_db->where('data_key', $key);
            return $this->sms_db->update($this->config_vars['system_variables'], $data);
        }
    }

    //tested
    /**
     * Unset SMS System Variable as key value
     * @param string $key
     * @return bool
     */
    public function unset_system_var($key) {

        $this->sms_db->where('data_key', $key);

        return $this->sms_db->delete($this->config_vars['system_variables']);
    }

    //tested
    /**
     * Get SMS System Variable by key
     * Return string of variable value or FALSE
     * @param string $key
     * @return bool|string , FALSE if var is not set, the value of var if set
     */
    public function get_system_var($key) {

        $query = $this->sms_db->where('data_key', $key);

        $query = $this->sms_db->get($this->config_vars['system_variables']);

        // if variable not set
        if ($query->num_rows() < 1) {
            return FALSE;
        } else {

            $row = $query->row();
            return $row->value;
        }
    }

    /**
     * List System Variable Keys
     * Return array of variable keys or FALSE
     * @return bool|array , FALSE if var is not set, the value of var if set
     */
    public function list_system_var_keys() {
        $query = $this->sms_db->select('data_key');
        $query = $this->sms_db->get($this->config_vars['system_variables']);
        // if variable not set
        if ($query->num_rows() < 1) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    public function generate_recaptcha_field() {
        $content = '';
        if ($this->config_vars['ddos_protection'] && $this->config_vars['recaptcha_active']) {
            if (($this->config_vars['use_cookies'] == TRUE && $this->CI->input->cookie('reCAPTCHA', TRUE) == 'true') || ($this->config_vars['use_cookies'] == FALSE && $this->CI->session->tempdata('reCAPTCHA') == 'true')) {
                $content .= "<script type='text/javascript' src='https://www.google.com/recaptcha/api.js'></script>";
                $siteKey = $this->config_vars['recaptcha_siteKey'];
                $content .= "<div class='g-recaptcha' data-sitekey='{$siteKey}'></div>";
            }
        }
        return $content;
    }

    public function update_user_totp_secret($user_id = FALSE, $secret) {

        if ($user_id == FALSE)
            $user_id = $this->CI->session->userdata('id');

        $data['totp_secret'] = $secret;

        $this->sms_db->where('id', $user_id);
        return $this->sms_db->update($this->config_vars['users'], $data);
    }

    public function generate_unique_totp_secret() {
        $ga = new PHPGangsta_GoogleAuthenticator();
        $stop = false;
        while (!$stop) {
            $secret = $ga->createSecret();
            $query = $this->sms_db->where('totp_secret', $secret);
            $query = $this->sms_db->get($this->config_vars['users']);
            if ($query->num_rows() == 0) {
                return $secret;
                $stop = true;
            }
        }
    }

    public function generate_totp_qrcode($secret) {
        $ga = new PHPGangsta_GoogleAuthenticator();
        return $ga->getQRCodeGoogleUrl($this->config_vars['name'], $secret);
    }
    
      public function list_month(){
        
        $query = $this->sms_db->get('sms_account_month');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;
    }

}

// end class

// $this->CI->session->userdata('id')


/*
 * unban_user() added // unlock_user
 * remove member added // fire_member
 * allow() changed to allow_group
 * deny() changed to deny_group
 * is member a yeni parametre eklendi
 * allow_user() added
 * deny_user() added
 * keep_infos() added
 * kepp_errors() added
 * get_errors() changed to print_errors()
 * get_infos() changed to print_infos()
 * User and SMS System Variables.
set_user_var( $key, $value, $user_id = FALSE )
get_user_var( $key, $user_id = FALSE)
unset
set_system_var( $key, $value, $user_id = FALSE )
get_system_var( $key, $user_id = FALSE)

 */



/* End of file SMS.php */
/* Location: ./application/libraries/SMS.php */
