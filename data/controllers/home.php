<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Visit "codeastro.com" for more projects!
class Home extends CI_Controller {

public function __construct() {
    parent::__construct();
if(!$this->sms->is_loggedin()){
            redirect("login");
        }
        
        $this->load->model('teacher');
        
    
}	
    
	public function index()
	{   
             $prefs = array (
               'start_day'    => 'saturday',
               'month_type'   => 'long',
               'day_type'     => 'short',
                   'show_next_prev'  => TRUE,
               'next_prev_url'   => base_url("calender/show/")
             );
             $prefs['template'] = '

   {table_open}<table class="table table-hover" border="0" cellpadding="0" cellspacing="0">{/table_open}

   {heading_row_start}<tr>{/heading_row_start}

   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr>{/week_row_start}
   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr>{/cal_row_start}
   {cal_cell_start}<td>{/cal_cell_start}

   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
   {cal_cell_content_today}<div class="highlight active"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

   {cal_cell_no_content}{day}{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="highlight active">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';
            $this->load->library('calendar',$prefs);
           
            $config = array(
                
            );
            $data['calender'] = $this->calendar->generate();
            $data['page_title']= "Home";
        $data['page_slogan']= "School Management System";
               $data['main_content'] = "pages/dashboard";
                $data['list_sessions'] = $this->sms->list_session();
                $data['running_session'] = $this->sms->get_running_session_by_id($this->session->userdata('running_session_id'));
               
		$this->load->view('layout/main', $data);
	}
}
//Visit "codeastro.com" for more projects!
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */