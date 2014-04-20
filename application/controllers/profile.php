<?php 
class Profile extends CI_Controller 
{
        public $userinfo='';
        public $id='';
        public $password='';
        public $usertype='';
        public $block='';
        public $activation_code='';
        public $activation='';
        public $register_date='';
        public $lastvisited_date='';
        public $firstname='';
        public $lastname='';
        public $dob='';
        public $profile_img='';
        public $cover_img='';
        public $gender='';
        public $country='IN';
        public $state='';
        public $district='';
        public $city='';
        public $locality='';
    
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
                $this->load->model('User_model');
                //If  user does not logged in redirect to login page
                if(!isLoggedIn())
		{
			redirect('user/login'); exit;
		}
                 
                $this->userinfo=$this->session->userdata('session_current_user');
                
                
	}
	
	public function index()
	{
		
		$this->profile();	
		
	}	

	
	public function profile()
 	{ 
            //When  profile sumitted for update
            if($this->input->post()){ 
                $update_profile=$this->edit($this->input->post());
            }
            
            $data=array();
            $data['userinfo']=$this->userinfo;
            $data['page_title']='profile';
            $data['body_content']='view_profile';
            $this->load->view('temp/template',$data);
	}
        
	
	public function edit($profile)
	{
            $updateProfile=$this->common_model->updateTableData("fqfm_user",$profile,array("id"=>$this->userinfo->id));
            $this->session->set_flashdata('flash_message', $this->common_model->flash_message('success','Profile has been updated successfully'));
            redirect("profile");
	}
	
	
	function upload()
	{
	
		if($this->input->post('image_url'))
		{
			
			$random_img_id=$username."_".generateInt(3);
			
		    $img_url=$this->input->post('image_url');
			
			$board_id=$this->input->post('user_id');
			
			$this->common_model->updateTableData("pin_profile",$id,$profile,array("user_id"=>$id));
						
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
