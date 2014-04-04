<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(0);

class  Projects extends CI_Controller { 
 
	 function Projects()
	{
	   
		parent::__construct();

		$this->load->database();
		
		$this->config_data->db_config_fetch();
		
		
		
	}
	
	
	 function index()
	{
		$data['body_content']='projects';
		$this->load->view('template',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */