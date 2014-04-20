<?php echo $this->load->view('temp/header');?>

    <?php
        $isLoggedIn=isLoggedIn();
    //echo $this->session->userdata('display_name');
    ?>
<!-- Part 1: Wrap all page content here -->
 <div id="wrap">
    
    <div class="container">
        
    <div id="tab-panel" style="display: none;">
     Logo and  content need to past here.  
    </div>
        <!--Show hide team-->
<!--    <div id="tophead" style="float: right;">
     <a id="tab" href="javascript:;" class="btn-mini Tab-opened">Click Here</a>
     <br/><br/>
    </div> -->
        <div class="masthead">
            <ul class="nav nav-pills pull-right">
             <?php if(!$isLoggedIn){?>   
              <li><a class="btn-mini" href="user/login">Login</a></li>
              <li><a  class="btn-mini" href="user/register">Register</a></li>
              
             <?php }else{?>
              <li><a  class="btn-mini" href="user/logout">Logout</a></li>
             <?php }?>
             <!--Logout-->
             <?php if($isLoggedIn){?><li><a class="btn-mini" href="profile"><?php echo $this->session->userdata('display_name');?></a></li><?php }?>
             
             <li><a class="btn-mini" href="#">About</a></li>
             <li><a class="btn-mini" href="#">Contact</a></li>
            </ul>               
             <a class="btn-mini" href="<?php echo base_url();?>"><img src="<?php echo base_url()?>/assets/logo/femqueen.png"/></a>

        </div>
      <hr>
       <!-- Begin page content -->
	<?php  echo $this->load->view($body_content);?>
    </div>
    <div id="push"></div>
     
 </div>     

<?php  echo $this->load->view('temp/footer');?>
