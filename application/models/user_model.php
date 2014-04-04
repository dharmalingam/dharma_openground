<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User_Model extends CI_Model {
    var $id               = '';
    var $name             = '';
    var $email            = '';
    var $password         = '';
    var $usertype         = '';
    var $block            = 0; 
    var $activation_code  = '';
    var $activation       = 0;
    var $registerDate     = '';
    var $lastvisitDate    = '';
   
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
    } 
    function register($insertData=array())
    {
        return $this->db->insert('fqfm_user', $insertData);
    }
    function accountActivate()
    {
        
    }  
    function login($email,$password)
    {
        $user_credentials=$this->common_model->getTableData("fqfm_user",array("email"=>$email))->row();
        print_r($user_credentials);
        exit('xxxx');
        
//        $conditions = array('role_name'=> $role_name);
//        $this->db->where($conditions);
//        $this->db->select('id');
//        $query = $this->db->get('roles');		
//        $row   = $query->row();
        
    } 
    function resetPassword()
    {
        
    }
    function addProfile()
    {
        
    }
    function editProfile()
    {
        
    }
    function emailSubcription()
    {
        
    }
    function accountDeactivate()
    {
        
    }
    /**
    * Get Users details
    */
    function getUsers($conditions=array(),$fields='')
    {
           if(count($conditions)>0)		
               $this->db->where($conditions);
           $this->db->from('fqfm_user');
           if($fields!='')
               $this->db->select($fields);
           $result = $this->db->get();
           return $result->first_row();

    }
    
    /**
    * Update users
    */
    function updateUser($conditions=array(),$updateData=array())
    {
       return $this->db->update('fqfm_user',$updateData,$conditions);

    }  
}
/* End of file user_model.php */ 
/* Location: ../model/user_model.php */