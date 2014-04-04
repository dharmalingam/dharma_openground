<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(1);
/**
 * User controle will manipulate all user related function
 * 
 */
class Appcontroller  extends CI_Controller { 
 
    function __construct()
    {
        parent::__construct();
        //$this->load->libraries('');
    }
    
    public function view($page = 'home')
    {
        if ( ! file_exists('application/views/'.$page.'.php'))
            {
                    // Whoops, we don't have a page for that!
                    show_404();
            }

            $data['title'] = ucfirst($page); // Capitalize the first letter
            $this->load->view('templates/header', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer', $data);

    }
}