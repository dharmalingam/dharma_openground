<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(1);

class  Home extends CI_Controller { 
 
	 function Home()
	{
	   
		parent::__construct();

		//If  user does not logged in redirect to login page
                if(!isLoggedIn())
                {
                        redirect('user/login'); exit;
                }
		
	}
	
	function index()
	{
                $data['display_name']=$this->session->userdata('display_name');
		$data['page_title']='femqueen';
		$data['body_content']='home';
		$this->load->view('temp/template',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */