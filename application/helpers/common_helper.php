<?php

function upload_image($random_id,$image_path)
{
		
	$deal_img_data=file_get_contents($image_path);


	$file_name="./uploads/".$random_id.".jpg"; 
	
	if(!file_exists($file_name))
	{
		$file=fopen($file_name,"w+");
	
		fwrite($file,$deal_img_data);
	}

	
	return true;
	
}
	
function dropdown_box($table_name,$value_field,$disp_field,$where=array(),$order_by=array())
{
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
	$table_data_query=$ci->common_model->getTableData($table_name,$where,NULL,NULL,NULL,NULL,NULL,$order_by);
	
	$table_datas=$table_data_query->result();
	
	$output="";
	
	foreach($table_datas as $table_data)
	{
		$output.='<option value="'.$table_data->$value_field.'">'.ucfirst($table_data->$disp_field).'</option>';
	}
	
	return $output;
	
}



function get_single_row($table_name,$where=array())
{
	if($table_name=='' and count($where)==0)
		return '';
		
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
		
	$table_data_query=$ci->common_model->getTableData($table_name,$where);
	
	$table_datas=$table_data_query->result();
	
	return $table_datas;
		
}

function sendMail($from,$to,$subject,$message)
{
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
	//$ci->load->config('config_data');
	
	$ci->load->library('email');
	
	$config['mailtype'] = 'html';
	
	$config['wordwrap'] = TRUE;
	
	$where=array("id"=>1);
	
	$mail_settings=$ci->common_model->getTableData("mail_settings",$where)->result();
	
	if(count($mail_settings)!=0)
	{
		if($mail_settings[0]->mailer=="smtp")
		{
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = $mail_settings[0]->smtp_server;//'ssl://smtp.gmail.com';
			$config['smtp_port']    = $mail_settings[0]->smtp_port;
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = $mail_settings[0]->smtp_username;
			$config['smtp_pass']    = $mail_settings[0]->smtp_password;
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			
			if($mail_settings[0]->smtp_auth)
				$config['validation'] = TRUE; // bool whether to validate email or not
			else
				$config['validation'] = FALSE; // bool whether to validate email or not
			
		}
	}
	
	$ci->email->initialize($config);
	
	$ci->email->from($from);
	
	$ci->email->to($to);

	$ci->email->subject($subject);
	
	$ci->email->message($message);
	
	if($ci->email->send())
	{
		return $result=true; 
	}
        else
        {
         // var_dump($this->email->print_debugger());
        }


}

function get_users_detail($field)
{
	$ci =& get_instance();
	$ci->load->model('user_model');
        $userinfo=$ci->session->userdata('session_current_user');
	
       echo '<pre>';print_r($userinfo); exit;
	if($user_id!="")
	{ 
		$conditions=array("id"=>$user_id);
	
		$user_detail_query=$ci->user_model->getUsers($conditions);
		
		$user_detail=$user_detail_query->result();
                
                print_r($user_detail); exit('xxx');
                
		return $user_detail[0]->$field;
	}
}

function get_date_diff($date1, $date2) {
  $holidays = 0;
  for ($day = $date2; $day < $date1; $day += 24 * 3600) {
    $day_of_week = date('N', $day);
    if($day_of_week > 5) {
      $holidays++;
    }
  }
  return $date1 - $date2 - $holidays * 24 * 3600;
} 

function ago( $dt )
{
//$interval = date_parse('now')->diff( $datetime );
//var_dump($dt);
$dt = date_parse($dt);

$now = date_parse(date("Y-m-d h:i:s"));
 
$suffix = " ago";

$day_intreval=$now['day'] - $dt['day'];

$hour_intreval= $now['hour']  - $dt['hour'];

$minute_intreval=$now['minute'] - $dt['minute'];

$second_intreval=$now['second'] - $dt['second'];

//var_dump("(".$day_intreval.")d +".$hour_intreval."h +".$minute_intreval."m +".$second_intreval."s");
return "+(".$day_intreval.")d +".$hour_intreval."h +".$minute_intreval."m +".$second_intreval."s";

}

function ago1( $datetime )
{
    $interval = date_create('now')->diff( date_create($datetime) );

	return "(".$interval->d.")d +".$interval->h."h +".$interval->m."m +".$interval->s."s";
	
    /*if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'year' ) . $suffix;
    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'month' ) . $suffix;
    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'day' ) . $suffix;
    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hour' ) . $suffix;
    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minute' ) . $suffix;
    return pluralize( $interval->s, 'second' ) . $suffix;*/
}

function getHtmlCodeViaFopen($url){
		$returnStr="";
        $fp=fopen($url, "r") or die("ERROR: Failed to open $url for reading via this script.");
        while (!feof($fp)) {
            $returnStr.=fgetc($fp);
        }
        fclose($fp);
        return $returnStr;
}

function get_links($deal_id)
{
	$ci =& get_instance();
	
	$ci->load->model('common_model');
	
	$where=array("id"=>$deal_id);
		
	$deals_details=$ci->common_model->getTableData("deals",$where)->result();
	
	$return_Url='';
	
	if(count($deals_details)!="")
	{
		$side_id=$deals_details[0]->site_id;
		
		$web_sites_array=array("id"=>$side_id);
		
		$side_detail=get_single_row("web_sites",$web_sites_array);
		
		if($side_detail[0]->affliates_option=="cj")
		{
			$aff_url=$side_detail[0]->affliates_value;
			
			if(stristr($aff_url,"(deal_id)"))
			{
				$return_Url=str_replace("(deal_id)",$deals_details[0]->deal_id,$aff_url);
				
				return $return_Url;
			}
			elseif(stristr($aff_url,"(deal_url)"))
			{
				$return_Url=str_replace("(deal_url)",$deals_details[0]->deal_link,$aff_url);
				
				return $return_Url;
			}
			
		}
	}
}
	
function rezize_image($image_name)
{
	//echo $image_name;
	
	if(!file_exists('./uploads/profile/thumb/'.$image_name.'jpg'))
	{
		$ci =& get_instance();		
		
		$config['image_library'] = 'gd2';		
		
		$config['source_image'] = './uploads/profile/'.$image_name.'.jpg';
		
		$config['create_thumb'] = TRUE;
		
		$config['new_image'] = './uploads/profile/cache/'.$image_name.'jpg';
		
		$config['maintain_ratio'] = TRUE;
		
		$config['width'] = 50;
		
		$config['height'] = 50	;
		
		$ci->load->library('image_lib', $config);
		
		if(!$ci->image_lib->resize())
		{
    		echo $ci->image_lib->display_errors();
			exit;
		}
	}	
	//exit;
}

function image_thumb($image_path, $height, $width)
{
    // Get the CodeIgniter super object
    $CI =& get_instance();

    // Path to image thumbnail
    $image_thumb = dirname("./".$image_path) . '/' . $height . '_' . $width . '.jpg';
	
	var_dump($image_thumb);
	
	

    if( ! file_exists($image_thumb))
    {
        // LOAD LIBRARY
        $CI->load->library('image_lib');

        // CONFIGURE IMAGE LIBRARY
        $config['image_library']    = 'gd2';
        $config['source_image']     = "./".$image_path;
        $config['new_image']        = $image_thumb;
        $config['maintain_ratio']   = TRUE;
        $config['height']           = $height;
        $config['width']            = $width;
        $CI->image_lib->initialize($config);
		
        if(!$CI->image_lib->resize())
		{
			echo $CI->image_lib->display_errors();
			exit;		
		}
        //$CI->image_lib->clear();
    }

    return '<img src="' . dirname($_SERVER['SCRIPT_NAME']) . '/' . $image_thumb . '" />';
}


//Check the given usernname exists or not
	
 	function usernamExists($username)
	{
	
		$ci =& get_instance();
	
		$ci->load->model('common_model');
				
		//$username=$ci->session->userdata('username');
		
		$result=$ci->common_model->getTableData("pin_users",array("username"=>$username))->row();
		
		if(count($result)!="")
		{
			return TRUE;
		}
		else
		{
			return FALSE;	
			
	}
	}
	
	
	
//Check the given usernname exists or not
	
 	function emailExists($email)
	{
	
		$ci =& get_instance();
	
		$ci->load->model('common_model');
				
		//$username=$ci->session->userdata('username');
		
		$result=$ci->common_model->getTableData("pin_users",array("email"=>$email))->row();
		
		if(count($result)!="")
		{
			return TRUE;
		}
		else
		{
			return FALSE;	
			
	}
	}
		
	
 //Check the given password is exists or not
 
 	function passwordExists($password)
	{
	
		$ci =& get_instance();
	
		$ci->load->model('common_model');
		
		$result=$ci->common_model->getTableData("pin_users",array("password "=>sha1($password)))->row();
		
		if(count($result)!="")
		{
			return TRUE;
		}
		else
		{
			return FALSE;	
		}
		
	}
		

	//To get the current logged in user's details
	
 	function currentUser()
	{
	
		$ci =& get_instance();
	
		$ci->load->model('common_model');
				
		$username=$ci->session->userdata('username');
		
		$result=$ci->common_model->getTableData("fqfm_user",array("username"=>$username))->row();
		
		return $result;
		
	}
	
	
	
	
    function valid_mail($email)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
	}
	
	function random_string($length)
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
	

	
	

?>