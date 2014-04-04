<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(0);

class  About extends CI_Controller { 
 
	 function About()
	{
	   
		parent::__construct();

		//$this->load->database();
		
		//$this->config_data->db_config_fetch();
		
		
		
	}
	
	
	 function index()
	{
		$data['body_content']='about_us';
		$this->load->view('template',$data);
	}
	
	function history()
	{
	
		$data['body_content']='history';
		$this->load->view('template',$data);
		
	}
	
	function privacy()
	{
		$data['body_content']='privacy';
		$this->load->view('template',$data);
	}
	
	function terms()
	{
		$data['body_content']='terms_of_use';
		$this->load->view('template',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */