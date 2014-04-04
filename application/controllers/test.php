<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(1);
/**
 * User controle will manipulate all user related function
 * 
 */
class  Test extends Appcontroller { 
 
    function __construct() {
        parent::__construct();
    }
    
    function samp()
    {
        
        echo "Test test";
        exit;
    }
    
}
    