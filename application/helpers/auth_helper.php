<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// ------------------------------------------------------------------------

/**
 * Check Whether the user is an admi
 * @return	boolean
 */
	 function isAdmin()
	{
		$CI 	=& get_instance();
		return $CI->session->userdata('usertype') == 'admin'? TRUE: FALSE;
	}

// ------------------------------------------------------------------------

/**
 * Check Whether the user is regular user
 * @return	boolean
 */
	 function isUser()
	{
		$CI 	=& get_instance();
		return $CI->session->userdata('usertype') == 'user'? TRUE: FALSE;
	}
// ------------------------------------------------------------------------

/**
 * Check Whether the user is a programmer
 * @return	boolean
 */
	 function isProgrammer()
	{
		$CI 	=& get_instance();
		return  $CI->session->userdata('usertype') == 'programmer'?TRUE:FALSE;
	}
	
// ------------------------------------------------------------------------

/**
 * Check Whether the user is logged in
 * @return	boolean
 */
	 function isLoggedIn()
	{
		$CI =& get_instance();
		return  $CI->session->userdata('logged_in') == '1'?TRUE:FALSE;
	}
	
// ------------------------------------------------------------------------

/**
 * To get the current logged in user's name
 * @return	string
 */
	 function currentUserName()
	{
		$CI 	=& get_instance();
		return $CI->session->userdata('username');
	}
	

/* End of file MY_url_helper.php */
/* Location: ./app/helpers/auth_helper.php */