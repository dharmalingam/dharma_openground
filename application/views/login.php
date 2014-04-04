<?php   
    if($msg = $this->session->flashdata('flash_message')){      
        echo $msg;
    }
    ?>
<form class="form-login" id="form_login" name="form_login" action="" method="post">
    <h2 class="form-register-heading">Please sign in</h2>
    <input type="text" id="user_email"  name="useremail"  class="input-block-level" placeholder="Your Email address" value="<?php echo set_value('useremail'); ?>">
     <?php echo form_error('useremail','<p class= "text-error">','</p>');?> 
    <input type="password" id="user_password"  name="userpassword" class="input-block-level" placeholder="Your Password">
    <?php echo form_error('userpassword','<p class= "text-error">','</p>');?>
    <p class="muted">
        <small><a href='' >Can't access your account?</a></small>    
    </p>
    <button class="btn btn-large btn-primary" id="submit_login" name="submit" type="submit">Sign in</button>
</form>