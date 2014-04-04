<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(0);

class  Blog extends CI_Controller { 
 
	 function Blog()
	{
	   
		parent::__construct();

		$this->load->database();
		
		$this->config_data->db_config_fetch();
		
		
		
	}
	
	
	 function index()
	{
		
		$this->load->view('blog/home');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */