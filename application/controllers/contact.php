<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(0);

class  Contact extends CI_Controller { 
 
	 function Contact()
	{
	   
		parent::__construct();

		$this->load->database();
		
		$this->config_data->db_config_fetch();
		
		
		
	}
	
	
	 function index()
	{
		$data['body_content']='contact_us';
		$this->load->view('template',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */