<?php

/*
 *  Author: Ronash Dhakal
 *  Project: School Managment System
 *  Team: Amrit, Prayash, Ronash, Saroj
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$config_sms = array();

$config_sms["default"] = array(
    'jsencrypt'                                 =>                              '198',
    'current_session'                           =>                              '',
    'current_session_id'                        =>                              '',
    'tbl_student'                               =>                              'sms_student',
    'tbl_session'                               =>                              'running_session',
    'tbl_class'                                 =>                              'sms_class',
    'tbl_class_section'                         =>                              'sms_class_section',
    'tbl_sms_security'                          =>                              'sms_security',
    'tbl_subject'                               =>                              'sms_subject',
    'no_permission'                            =>                              'permission',
    'admin_group'                               =>                              'Admin',
    'student_group'                             =>                              'Student',
    'parent_group'                              =>                              'Parent',
    'teacher_group'                             =>                              'Teacher',
    'db_profile'                                =>                              'default',
    'users'                                     =>                              'sms_users',
    'class'                                     =>                              'sms_class',
    'section_student_limit'                     =>                              40,
    'section' => 'sms_section',
    'syllabus' => 'sms_syllabus',
    'groups' => 'sms_groups',
    'group_to_group' => 'sms_group_to_group',
    'user_to_group' => 'sms_user_to_group',
    'perms' => 'sms_perms',
    'perm_to_group' => 'sms_perm_to_group',
    'perm_to_user' => 'sms_perm_to_user',
    'pms' => 'sms_pms',
    'system_variables' => 'sms_system_variables',
    'user_variables' => 'sms_user_variables',
    'remember' => ' +3 days',
    'max' => 13,
    'min' => 5,
    'additional_valid_chars' => array(),
    'ddos_protection' => true,
    'recaptcha_active' => false,
    'recaptcha_login_attempts' => 4,
    'recaptcha_siteKey' => '',
    'recaptcha_secret' => '',
    'totp_active' => false,
    'totp_only_on_ip_change' => false,
    'totp_reset_over_reset_password' => false,
    'max_login_attempt' => 3,
    'login_with_name' => TRUE,
    'use_cookies' => true,
    'email' => 'test@mail.com',
    'name' => 'CodeAstro',
    'verification' => TRUE,
    'verification_link' => 'account/verification/',
    'reset_password_link' => 'account/reset_password/',
    'hash' => 'sha256',
    'register_user_data_log' => TRUE
);

$config['sms'] = $config_sms['default'];

/* End of file sms.php */
/* Location: ./application/config/sms.php */