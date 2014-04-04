<?php 
class Profile extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
                
	}
	
	public function index()
	{
		
		$this->profile();	
		
	}	

	
	public function profile()
 	{ 
            
            $userinfo=$this->session->userdata('session_current_user');

            $data=array();
            if(count($userinfo)>0){
                $data['userinfo']=$userinfo;
            }
            
            $data['page_title']='profile';
            $data['body_content']='view_profile';
            $this->load->view('temp/template',$data);
	}
	
	public function edit()
	{
		if(!isLoggedIn())
		{
			redirect('login'); exit;
		}
			
		$get_current_user=currentUser();
	    $cur_username=$get_current_user->username; 
		if($this->uri->segment(3)!="")
		{
		
			$id=$this->uri->segment(3);	
			$user=$this->common_model->getTableData("pin_users",array("id"=>$id))->row();
			
			if(count($user)==0)
			{
				redirect('404');
				exit;
			}
			
			$cur_username=$user->username;
		}
		else
		{
			
		
			$id=$get_current_user->id;
		
	    	
		}
		
		
		
		if($this->input->post('submit'))
		{	
		
			
			//$profile_info=$this->input->post();
			extract($this->input->post());
			
			//upload profile image
			$config['upload_path'] = './uploads/profile/';
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$config['file_name']=$cur_username;
			
			$config['max_width'] = '250';
			
			$config['max_height'] = '250';
			

		    $this->upload->initialize($config);
			
			
			if($_FILES["image"]["name"]!="")
			{ 
				
				if (!$this->upload->do_upload("image"))
				{
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('flash_message', $this->common_model->flash_message('error',$error["error"]));
					redirect("profile/edit");
				}
				else
				{
					
					$img_data=$this->upload->data();
					
					$profile_details["firstname"]=$firstname;
					$profile_details["lastname"]=$lastname;
					$profile_details["email"]=$email;
					$profile_details["username"]=$username;
					$profile_details["description"]=$description;
					$profile_details["image"]=$img_data["file_name"];
					$profile_details["location"]=$location;
					$profile_details["website"]=$website;
					$profile_details["user_id"]=$id;
					
					$this->common_model->updateTableData("pin_profile",$id,$profile_details,array("user_id"=>$id));


					//reszieing image
					$thumblocation='./uploads/profile/thumbnill/'.$cur_username.'.jpg';
					
					$fileSavePath=base_url()."uploads/profile".$cur_username.".jpg"; 
					
					$resizeObj = new Image_resize();
					
					$resizeObj -> resizeImage($fileSavePath,100,100,'exact');
					
					$resizeObj -> saveImage($thumblocation,75);
					
					
				}
				
			}
			
			$profile_details=array();
			
			$update_data=array();
			
				
			
			
			$update_data["firstname"]=$firstname;
			$update_data["lastname"]=$lastname; 
			
			$update_data["description"]=$description; 
			$update_data["location"]=$location;  
			
			
			$curuser_email=$this->common_model->getTableData('pin_users',array('email'=>$email))->row();
			
			
			
			if(!valid_mail($email))
			{
				$this->session->set_flashdata('message','Please enter the valid email');
				redirect("profile/edit");
			}
			
			
			$update_data["email"]=$email; 

           	if($username=="")
			{
				$username=$cur_username;
			}
			
			if($cur_username!=$username)
			{	
				if(usernamExists($username))
				{
					$this->session->set_flashdata('message','Username Already exists. Please choose another one and try again');
					 redirect("profile/edit");
					
				}
						
				$user_data = array('username'  	=> $username);
				$this->session->set_userdata($user_data);
										
										
				$update_data["username"]=$username;	
			}
			else
			{
			  $update_data["username"]=$username;	
			}
			
			
			if($website!="")
			{
				if(!isValidURL($website))
				{
					$this->session->set_flashdata('flash_message',  $this->common_model->flash_message('error','Please enter the valid website URL'));
					redirect("profile/edit");

				}
			}
		
			$update_data["website"]=$website;  		
			
			$update_data["user_id"]=$id;
			
			

			$this->common_model->updateTableData("pin_users",$id,array("email"=>$email,'username'=>$username),array("id"=>$id));
			
			$this->common_model->updateTableData("pin_profile",'',$update_data,array("user_id"=>$id));
                     $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Profile has been updated successfully'));
			
			redirect("profile/edit");
			
			
		}
		
		
		
		$data=$this->common_model->getTableData("pin_profile",array("user_id"=>$id))->row_array();
		
/*        $data["email"]=$get_current_user->email;
		$data["name"]=$get_current_user->name;
		$data["username"]=$get_current_user->username;
*/		  
		$data['body_content']="view_profile_edit";
		
		
		
		$this->load->view('template',$data);
	}
	
	
	function upload()
	{
	
		if($this->input->post('image_url'))
		{
			
			$random_img_id=$username."_".generateInt(3);
			
		    $img_url=$this->input->post('image_url');
			
			$board_id=$this->input->post('user_id');
			
			$this->common_model->updateTableData("pin_profile",$id,$profile_details,array("user_id"=>$id));
						
			$image_url=$this->input->post('image_url');
			
			$result=upload_image($random_img_id,$image_url);
			
			echo  $result;
		}
		

	}
	
	function pin()
	{
		$cur_user=currentUser();	
		
		$uid=$this->uri->segment(3);
			 
		$count_boards=$this->common_model->count_result('pin_board',array('user_id'=>$uid));
		$countlikes=$this->common_model->count_result('pin_uploads',array('user_id'=>$uid,'like !='=>0));
		$countpins=$this->common_model->count_result('pin_uploads',array('user_id'=>$uid,'image_id !='=>'','image_id !='=>0));
  		$countfollowers=$this->common_model->count_result('pin_follow',array('created_by'=>$uid,'followed_by !='=>'','followed_by !='=>0));
		
		$countfollowings=$this->common_model->count_result('pin_follow',array('created_by !='=>$uid,'followed_by ='=> $uid,'followed_by !='=>0));
		
		$getpin_imgs=$this->common_model->getTableData("pin_uploads",array("user_id"=>$uid))->result();
		
		$cur_user_boards=$this->common_model->getTableData("pin_board",array("user_id"=>$uid))->result();
		
				
		$data=$this->common_model->getTableData("pin_profile",array("user_id"=>$uid))->row_array();
		
		if($data['image']=="")
		   $profileimg="default.jpeg";
	    else
			$profileimg=$data['image'];
		
		//$data["boards"]=$board_array;
		$data['like_count']=$countlikes;
		$data['pin_count']=$countpins;
		$data['board_count']=$count_boards;
		$data['count_followers']=$countfollowers;
		$data['count_followings']=$countfollowings;
		$data["pin_images"]=$getpin_imgs; 
		$data['current_userprofile']=$profileimg;
		$data['profileimg'] = $profileimg;
		$data['body_content']="view_profile_pin";
				
		$this->load->view('template',$data);
	}
	
	function likes()
	{
		$cur_user=currentUser();
		
		$uid=$this->uri->segment(3);
			 
		$count_boards=$this->common_model->count_result('pin_board',array('user_id'=>$uid));
		$countlikes=$this->common_model->count_result('pin_uploads',array('user_id'=>$uid,'like !='=>0));
		$countpins=$this->common_model->count_result('pin_uploads',array('user_id'=>$uid,'image_id !='=>'','image_id !='=>0));
  		$countfollowers=$this->common_model->count_result('pin_follow',array('created_by'=>$uid,'followed_by !='=>'','followed_by !='=>0));
		
		$countfollowings=$this->common_model->count_result('pin_follow',array('created_by !='=>$uid,'followed_by ='=> $uid,'followed_by !='=>0));
		
		$getlike_imgs=$this->common_model->getTableData("pin_uploads",array("user_id"=>$uid,'like !='=>0))->result();
		
		$cur_user_boards=$this->common_model->getTableData("pin_board",array("user_id"=>$uid))->result();
		
				
		$data=$this->common_model->getTableData("pin_profile",array("user_id"=>$uid))->row_array();
		
		if($data['image']=="")
		   $profileimg="default.jpeg";
	    else
			$profileimg=$data['image'];

		
		//$data["boards"]=$board_array;
		$data['like_count']=$countlikes;
		$data['pin_count']=$countpins;
		$data['board_count']=$count_boards;
		$data['count_followers']=$countfollowers;
		$data['count_followings']=$countfollowings;
		$data["like_images"]=$getlike_imgs; 
		$data['current_userprofile']=$profileimg;
		$data['profileimg'] = $profileimg;
		
		$data['body_content']="view_profile_likes";
				
		$this->load->view('template',$data);
	}
	
	
}
