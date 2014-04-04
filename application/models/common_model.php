<?php 
/**
 * Reverse bidding system Common_model Class
 *
 * helps to achieve common tasks related to the site like flash message formats,pagination variables.
 *
 */	 

class Common_model extends CI_Model {
	 
	/**
	 * Constructor 
	 *
	 */
	  function Common_model() 
	  {
		parent::__construct();
		
				
      }
	  
	// --------------------------------------------------------------------
	
	/**
	 * Set Style for the flash messages
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function flash_message($type,$message)
	 {
	 
	 	switch($type)
		{
			case 'muted':
					$data = '<div class="row-fluid" style="background-color:#DDDDDD;color:#0000"><p>'.$message.'</p></div>';
					break;
			case 'warning':
					$data = '<div class="row-fluid" style="background-color:#FAA732;color:#0000"><p>'.$merssage.'</p></div>';
					break;
			case 'error':
					$data = '<div class="row-fluid" style="background-color:#DA4F49;color:#0000"><p>'.$message.'</p></div>';
					break;
                       case 'info':
					$data = '<div class="row-fluid" style="background-color:#49AFCD;color:#0000"><p>'.$message.'</p></div>';
					break;
                       case 'success':
					$data = '<div class="row-fluid" style="background-color:#5BB75B;color:#0000"><p>'.$message.'</p></div>';
					break;
                       
							
		}
	
		return $data;
	 
	 }//End of flash_message Function
	 
	 	 
 	 	// --------------------------------------------------------------------
	
	/**
	 * Set Style for the flash messages in admin section
	 *
	 * @access	public
	 * @param	string	the type of the flash message
	 * @param	string  flash message 
	 * @return	string	flash message with proper style
	 */
	 function admin_flash_message($type,$message)
	 {
	 	switch($type)
		{
			case 'success':
					$data = '<div class="message"><div class="success">'.$message.'</div></div>';
					break;
			case 'error':
					$data = '<div class="message"><div class="error">'.$message.'</div></div>';
					break;		
		}
		return $data;
	 }//End of flash_message Function
	 
	// --------------------------------------------------------------------
	
	/**
	 * Set page Title And Meta Tags For The Entire Site
	 *
	 * @access	public
	 * @param	nil
	 * @return	array	page title and meta tags content
	 */
	 function getPageTitleAndMetaData()
	 {
	 	$data['page_title'] 			= $this->config->item('site_title');
		$data['meta_keywords']			= 'Outsource your projects to freelance programmers and designers at cheap prices. ';
		$data['meta_description']		= 'Outsource your projects to freelance programmers and designers at cheap prices. Freelancers will compete for your business. Get programming done for your site in php, mysql, xml, perl/cgi, javascript, asp, plus web design, search engine optimization, marketing, writing, job listings and so much more.';	
		
		return $data;
	 }//End of getPageTitleAndMetaData Function
	 
	// --------------------------------------------------------------------
	
	
	/**
	 * Set page Title And Meta Tags For The Entire Site
	 *
	 * @access	public
	 * @param	nil
	 * @return	array	page title and meta tags content
	 */
	 function getPageTitle($condition)
	 {
	 			
		if(count($condition) > 0)		
	 		$this->db->where($condition);
		
		$this->db->from('categories');
	 	$this->db->select('categories.page_title,categories.meta_keywords,categories.meta_description');
		$result = $this->db->get();
		
		return $result;
	 }//End of getPageTitleAndMetaData Function
	 
	// --------------------------------------------------------------------
	
		
	/**
	 * Get Countries
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getCountries($conditions=array())
	 {
	 	if(count($conditions)>0)		
	 		$this->db->where($conditions);
		
		$this->db->from('country');
	 	$this->db->select('country.id,country.country_symbol,country.country_name');
		$result = $this->db->get();
		return $result;
	 }//End of getCountries Function
	 
	// --------------------------------------------------------------------
	
	
		
	/**
	 * Get getEncryptedString
	 *
	 * @access	private
	 * @param	string 
	 * @return	object	object with result set
	 */
	 function getEncryptedString($string='')
	 {
		
		if($string!='')
			$string_hash = $this->encrypt->encode($string);	
				
		else 
			$string_hash = '';	
			
		return $string_hash;
	 }//End of getEncryptedString Function	
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get DecryptedString
	 *
	 * @access	private
	 * @param	string	conditions to fetch data
	 * @return	object	object with result set
	 */
	  function getDecryptedString($string='')
	 {
		
		
		if($string!='')
		{
			$string_hash = $this->encrypt->decode($string);	
			//echo $string_hash;exit;
		}	
		else 
			$string_hash = '';	
		return $string_hash;
	 }//End of getDecryptedString Function
	 
	// --------------------------------------------------------------------
		
	/**
	 * Get getLoggedInUser
	 *
	 * @access	private
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	  function getLoggedInUser()
	 {

	 	$user = '';

		if($this->session->userdata('id'))
		{
			$condition = array('id'=>$this->session->userdata('id'));
			
			$query = $this->user_model->getUsers($condition);
			
			if($query->num_rows()>0)
			{
				$user = $query->row();				
			}			
		} //Switch End
		
		return $user;
	 }//End of getDecryptedString Function
	 // --------------------------------------------------------------------
	
		
	/**
	 * Get getPages
	 *
	 * @access	public
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getPages()
	 {
	   $conditions = array('page.is_active'=> 1);
	   $pages                      = array();
       $pages['staticPages']       =$this->page_model->getPages($conditions);
	   return $pages['staticPages'];
	   
	 }
	 
	 /**
	 * Get getPages
	 *
	 * @access	public
	 * @param	array	conditions to fetch data
	 * @return	object	object with result set
	 */
	 function getSitelogo()
	 {
	   $conditions = array('settings.code'=>'SITE_LOGO');
	   $data                      = array();
	   $this->db->where($conditions);
	   $this->db->from('settings');
	   $this->db->select('settings.string_value');
	   $result = $this->db->get();
       $data['site_logo']         =	$result->result();
	   return $data;
	   
	 }
	 	 
	 
	  function getTableData($table='',$conditions=array(),$fields='',$like=array(),$limit=array(),$orderby = array(),$like1=array(),$order = array(),$conditions1=array())
	 {	 	
	 	//Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		
		//Check For Conditions
	 	if(is_array($conditions1) and count($conditions1)>0)		
	 		$this->db->or_where($conditions1);	
			
		//Check For like statement
	 	if(is_array($like) and count($like)>0)		
	 		$this->db->like($like);	
		

		if(is_array($like1) and count($like1)>0)

			$this->db->or_like($like1);	
			
		//Check For Limit	
		if(is_array($limit))		
		{
			if(count($limit)==1)
	 			$this->db->limit($limit[0]);
			else if(count($limit)==2)
				$this->db->limit($limit[0],$limit[1]);
		}	
		
		
		//Check for Order by
		if(is_array($orderby) and count($orderby)>0)
		{
					
			$this->db->order_by('id', 'asc');
		}
		//Check for Order by
		if(is_array($order) and count($order)>0)
			$this->db->order_by($order[0], $order[1]);	
			
		$this->db->from($table);
		
		//Check For Fields	 
		if($fields!='')
		 
				$this->db->select($fields);
		
		else 		
	 		$this->db->select();
			
		$result = $this->db->get();
		
	//pr($result->result());
		return $result;
	 }	 
	 
	  function deleteTableData($table='',$conditions=array())
	 {
	    //Check For Conditions
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
			
		$this->db->delete($table);
		return $this->db->affected_rows(); 
		 
 	 }//End of deleteTableData Function
	 
	 
	   function insertData($table='',$insertData=array())
	 {
	 	return $this->db->insert($table,$insertData);
	 }//End of insertData Function
	 
	 
	  function updateTableData($table='',$id=0,$updateData=array(),$conditions=array())
	 {
	 	
	 	if(is_array($conditions) and count($conditions)>0)		
	 		$this->db->where($conditions);
		else	
		    $this->db->where('id', $id);
	 	return $this->db->update($table,$updateData);
		 
	 }//End of updateTableData Function
	 
	 function get_social_data($field_value)
	 {
	 	$social_site_settings=$this->getTableData("social_site_settings")->result_array();
		if(isset($social_site_settings[0]["facebook_api_key"]))
			return $social_site_settings[0][$field_value];
		else
			return '';
	 }
	 
	function create_unique_slug($string, $table)
	{
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params['slug'] = $slug;
		
		if ($this->input->post('id')) {
			$params['id !='] = $this->input->post('id');
		}
		
		while ($this->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
				$slug .= '-' . ++$i;
			} else {
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			}
			$params ['slug'] = $slug;
			}
		return $slug;
	} 
	
	
	//Count All Result
	
	function count_result($table='',$conditions=array())
	{
		$this->db->where($conditions);
		
		$result =$this->db->count_all_results($table);
		
		return $result;
	}
	

   function user_boards($board_id)
   {
   
   	
	 $userboards=$this->db->query('SELECT `pin_uploads`.image_id,`pin_uploads`.`board_id`, `pin_board`.`name` as board_name  FROM `pin_uploads` LEFT JOIN `pin_board` ON `pin_uploads` .`board_id`=`pin_board`.id WHERE `pin_uploads` .`board_id`='.$board_id.'  ORDER BY `board_id` limit 9
	');
	 
	return $userboards->result();
	 
	 
	 
   }
   
   function userProfile($id)
   {
		$this->db->select('pin_users.*,
						   pin_profile.firstname,
						   pin_profile.image,
						   pin_profile.description,
						   pin_profile.location,
						   pin_profile.website'
						   );
						   
		$this->db->from('pin_users');
		$this->db->join('pin_profile', 'pin_users.id= pin_profile.user_id');
		$this->db->where('pin_users.id', $id);
		$result = $this->db->get()->row();
		return $result;
   }


	function getLimitedData($tablename,$ofset,$limit)
	{
	   
		//$condition=array("board_id"=>$board_id);
		
		$this->db->select('*');
						   
		$this->db->from($tablename);
		
		//$this->db->where($condition);
		
	    $this->db->order_by('id','desc');
		
	
		if($limit!="" && $limit!="" && $ofset!="" && $ofset!="")
		{
			$this->db->limit($limit,$ofset);
		}
	    else if($limit!="" && $limit!="")
		{
			$this->db->limit($limit);
		}
			
		
		
		$result = $this->db->get()->result();
	
		return $result;		
	
	}
   
  	
		 
}


// End Common_model Class
   
/* End of file Common_model.php */ 
/* Location: ./app/models/Common_model.php */
?>