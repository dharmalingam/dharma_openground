<?php echo form_open("user/register",array('name'=>'registration','id'=>'registration','class'=>'form-register'));?>
    <h2 class="form-register-heading">Registration</h2>
    <input type="text"  id="user_full_name inputError" name="username" class="input-block-level" placeholder="Your Full Name" value="<?php echo set_value('username'); ?>">
    <?php echo form_error('username','<p class= "text-error">','</p>');?>
    <input type="text" id="user_email"  name="useremail" class="input-block-level" placeholder="Your Email address" value="<?php echo set_value('useremail'); ?>">
    <?php echo form_error('useremail','<p class= "text-error">','</p>');?> 
    <input type="password" id="user_password" name ="userpassowrd"class="input-block-level" placeholder="Your Password" value="<?php echo set_value('userpassowrd'); ?>">
    <?php echo form_error('userpassowrd','<p class= "text-error">','</p>');?> 
    <label class="checkbox">
        <input type="checkbox" id="user_confirmpassword" name="confirmpassword"  value="confirmpassword"> Check password<span class="text-error">*</span>
      <?php echo form_error('confirmpassword','<p class= "text-error">','</p>');?> 
    </label>
    <p class="muted">
        <small>By clicking Creat my account, you agree to our <a href=''>Terms</a> and that you have read our <a href=''>Data Use Policy</a>, including our <a href=''>Cookie Use</a>.</small>    
    </p>
    <button class="btn btn-large btn-primary" id="submit_registration" name="submit" type="submit">Create my account</button>  
<?php echo form_close();?> 