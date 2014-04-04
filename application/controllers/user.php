<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');error_reporting(1);
/**
 * User controle will manipulate all user related function
 * 
 */
class  User extends CI_Controller { 
 
    function User()
    {	   
           parent::__construct();
           $this->load->database();
           //$this->config_data->db_config_fetch();
           $this->load->model('User_model');
    }
    function index()
    {
      $this->register();
    }
     function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email|is_unique[fqfm_user.email]');
        $this->form_validation->set_rules('userpassowrd', 'Password', 'required');
        $this->form_validation->set_rules('confirmpassword', ' Check Password', 'required');
         if ($this->form_validation->run() == FALSE){
            $registerdata=array();
            $registerdata['page_title']='Create new femqueen account';
            $registerdata['body_content']='register';
            $this->load->view('temp/template',$registerdata); 
        }
        else{
            $data=array();
            extract($this->input->post());
            $accesscode=$this->randon_string(9);
            $data['name']=trim($username);
            $data['email']=trim($useremail);
            $data['password']=sha1(trim($password));
            $data['usertype']="user";
            $data['block']=0;
            $data['activation_code']=trim($accesscode);
            $data['activation']=0;
            $data['registerDate']=date('Y-m-d h:i:s');
            $this->User_model->register($data);
            //Send activation link to user
//            $headers  = 'MIME-Version: 1.0' . "\r\n";
//            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//            $headers .= 'From: Cogzidel Technologies <"dharmalingam@cogzidel.com">' . "\r\n";
//            mail($cur_registered_user->email,"Photosharing - Registration Confirmation",$message,$headers);	
            $this->register_success();
        }
       
    }
    
     function login()
    {   
         
          if(isLoggedIn())
	   {
	   	 redirect('home');
		 exit;
	   }

        $this->form_validation->set_rules('useremail', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('userpassword', 'Password', 'required');
         if ($this->form_validation->run() == FALSE){
            $data=array();
            $data['page_title']='Loin into femqueen';
            $data['body_content']='login';
            $this->load->view('temp/template',$data);
        }
        else {extract($this->input->post());
                                     
                $condition=array('email'=>$useremail);
                //$fields='email,password,usertype,block,activation_code,activation';
                $user_info=$this->User_model->getUsers($condition);  
                if($useremail==$user_info->email){
                    if($user_info->block==1){
                        $msg="Your account has been blocked tempararlly for security reason. please email to  support.femqueen.com to unlock it.";
                        $this->session->set_flashdata('flash_message',$this->common_model->flash_message('error',$msg));
                        redirect('user/login');
                     }
                    
                    if($user_info->password==sha1($password)){
                        if(!$user_info->activation==0){
                           $usetype=($user_info->usertype=="admin")?"admin":"user";
                           //$displayname=($user_info->firstname)
                           $user_data = array( 'usertype'  => $user_info->usertype,
                                               'display_name'=>ucfirst($user_info->firstname).' '.ucfirst($user_info->lastname),
                                               'session_current_user'=>$user_info,
                                               'logged_in' => TRUE
                                             );

                            $this->session->set_userdata($user_data);
                            $updateData['lastvisitDate'] = date('Y-m-d
                                h:i:s');
                            $this->User_model->updateUser(array('email'=>$user_info->email),$updateData);
                            redirect('home');

                        }else {
                            $this->session->set_flashdata('flash_message',  $this->common_model->flash_message('info','Activation Email Already Sent.Please'.anchor("user/registre_resent/".$user_info->activation_code,"Click here").' to Resend!'));
                            redirect('user/login');
                        }
                    }else{
                        $this->session->set_flashdata('flash_message',  $this->common_model->flash_message('error','Password Does not match'));
                        redirect('user/login');
                    }
                            
                }else{
                    $this->session->set_flashdata('flash_message',  $this->common_model->flash_message('error','User does not exist for the email specified.'));
                    
                    redirect('user/login');
                }
        }

    }  
    function register_success()
    {
       $data['page_title']='Create new femqueen account success';
       $data['body_content']='register_success';
       $this->load->view('temp/template',$data);
    }
    
    function isemail_exists($email)
    {
            $result=$this->common_model->getTableData("fqfm_user",array("email"=>$email))->result();
            if(count($result)!="")
                 return TRUE;
            else
                 return FALSE;
    }
    
    function randon_string($length)
	{
		
		$len=$length;
		
		$base='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
		
		$max=strlen($base)-1;
		
		$activatecode='';
		
		mt_srand((double)microtime()*1000000);
		
		while(strlen($activatecode)<$len+1)
			$activatecode.=$base{mt_rand(0,$max)}; 
		
		return $activatecode;
	}
        
	function privacy()
	{
            $data['body_content']="view_privacy";
            $this->load->view("template",$data);
	}
        
        function email_temp($accesscode,$username)
	{
			$temp='
		<html>
<body>
        <table width="742" height="299" border="0">
  <tr>
            <td height="60" bgcolor="#003148"><h3 style="color:#CAE4FF">PhotoSharing</h3></td>
          </tr>
  <tr>
            <td height="187" align="left" valign="top" bgcolor="#CAE4FF" style="color:#003148"><p>
      <h4>Dear '.ucfirst($username).',
                </p>
                <br>
                Thank you for registering in p-interest. Please click this link to confirm your registration';
                
                $temp.=' <a href="'.base_url().'index.php/user/registre_confirm/'.$accesscode.'">Confirm Registration</a></h4>
      '	;								
      
      //$message.=$accesscode.'>Confirm Registration</a>';
      
      $temp.='</td>
          </tr>
  <tr>
            <td height="23" bgcolor="#003148">&nbsp;</td>
          </tr>
</table>
        </body>
</html>
		';
		
		return  $temp;
	}
	function email_signup($accesscode,$username)
	{
		$temp='
		<html>
                    <body>
                            <table width="742" height="299" border="0">
                      <tr>
                                <td height="60" bgcolor="#003148"><h3 style="color:#CAE4FF">PhotoSharing</h3></td>
                              </tr>
                      <tr>
                                <td height="187" align="left" valign="top" bgcolor="#CAE4FF" style="color:#003148"><p>
                          <h4>
                          Hi!,
                          </p>
                          <br>
                          <p>Thanks for joining the 									Photosharing waiting list. We will be sure to send you an invite soon.</p>
                          <p>In the meantime, you can follow us on Twitter. You can also explore a few pins.</P>
                          <p>We are excited to get you pinning soon!</P>
                          <p>- Photosharing Team</P>
                          ';
                //$message.=$accesscode.'>Confirm Registration</a>';
                $temp.='</td>
                    </tr>
            <tr>
                      <td height="23" bgcolor="#003148">&nbsp;</td>
                    </tr>
          </table>
                  </body>
          </html>';		
		return  $temp;	
	}
        
   function check_activationcode($activationcode)
	{
		
		$result=$this->common_model->getTableData("fqfm_user",array("activation_code"=>$activationcode))->result();
		
		
		if(count($result)!="")
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	
	function is_activated($activationcode)
	{
	 
		$result=$this->common_model->getTableData("fqfm_user",array("activation"=>"1"))->result();
		
		if(count($result)!="")
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
        
    public function logout()
    { 
                   
        $session_userinfo = array('usertype' => '', 'display_name' => '','session_current_user'=>'','logged_in'=>'');
        $this->session->unset_userdata($session_userinfo);
        redirect('home'); 	
    }
    
    function user_already_exists($username)
    {
        $result=$this->common_model->getTableData("fqfm_user",array("username"=>$username))->result();
        if(count($result)!="")
            return TRUE;
        else
            return FALSE;
                
    }
    
    	function registre_confirm()
	{
	  $registration_code=$this->uri->segment(3); 	
	   		
		if($registration_code=="")
		{
			//if no activation code in the URL will redirect to 404 page
			redirect("con_home/404");
		}
		else
		{
			$iscode_exists=$this->check_activationcode($registration_code);
			
			if($iscode_exists)
			{
				$is_activated=$this->is_activated($registration_code);
				
				if($is_activated)
				{
					
					$this->session->set_flashdata('message', 'Account has been already activated. Please enter the login details');
				   
				    redirect("user/login");
				}
				else
				{
				   $getuser=$this->common_model->getTableData("fqfm_user",array("activation_code "=>$registration_code))->row();
                    
					$insertdata=array();
					
					$updateData['activation']=1;
					$id=$getuser->id;
				   
				   $this->common_model->updateTableData('fqfm_user',$id,$updateData,array("activation_code "=>$registration_code));	
				   
				   $this->session->set_flashdata('message', 'Your account has been activated successfully. Please Enter login details below');
				   
				   redirect("user/login");
				   		
				}

			}
			else
			{
			
				$this->session->set_flashdata('message','Invalided activation code. Please register to get new activation code');
				redirect("user/register");
			}
				
		}
		
	}
} 
/* End of file welcome.php */
/* Location: ./application/controllers/user.php */