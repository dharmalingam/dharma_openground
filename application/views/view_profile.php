<h4>Profile</h4>
<?php //echo "<pre>";print_r($userinfo);?>
        <fieldset>
            <div class="control-group">
                <div class="controls">
                    <a id="profileBtnEdit">Edit Profile</a>
                    <a href="team" class="btn btn-small btn-primary">Create Team >></a>
                </div>
            </div>
        </fieldset>

<div id="profile_container" style="display:none;">
<form class="form-horizontal" id="formProfile" name="formProfile"  method="post">

        <fieldset>
            <legend><small>Basic Info</small></legend>

            <div class="control-group">
                <div class="controls">
                    <input type="text" id="profileFirstName" name="firstname" class="input-medium" placeholder="First Name" value="<?php echo $userinfo->firstname;?>">
                    <input type="text" id="profileLastName"  name="lastname" class="input-medium" placeholder="Last Name" value="<?php echo $userinfo->lastname;?>">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="text" id="profileDOB" name="dob" class="input-medium" placeholder="DOB" value="<?php echo $userinfo->dob;?>">
                    <select class="input-small" id="profileGender" name='gender'> 
                        <option value="">Gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>


                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend><small>Contact Info</small></legend>
            <div class="control-group">
                <div class="controls">
                    <input type="text" id="profileEmail"name="email" class="input-medium" placeholder="Email" value="<?php echo $userinfo->email;?>">
                    <input type="text" id="profilePhone" name="phone" class="input-medium" placeholder="Mobile Phone" value="<?php echo $userinfo->phone;?>">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
    <!--                <select class="input-small" name='country'> 
                        <option value=''>Country</option>
                        <option value='IN'>India</option>
                        <option value='AS'>Asteralia</option>
                        <option value='ING'>Ingland</option>
                        <option value=''>America</option>
                    </select>-->
                    <select class="input-medium" id="profileState" name="state"> 
                        <option value="">State</option>
                        <option value="">Indoor</option>
                        <option value="">Outdoor</option>
                        <option value="">Riding</option>
                        <option value="">Autheletics</option>
                    </select>
                    <select class="input-medium" id="profileDistrict" name="district"> 
                        <option value="">District</option>
                        <option value="">Cricket</option>
                        <option value="">Hockey</option>
                        <option value="">Tennies</option>
                        <option value="">America</option>
                    </select>
                    <select class="input-medium" id="profileCity" name="city"> 
                        <option value="">City</option>
                        <option value="">Cricket</option>
                        <option value="">Hockey</option>
                        <option value="">Tennies</option>
                        <option value="">America</option>
                    </select>
                    <input type="text" id="profileLocality" name="locality" value="" placeholder="Locality">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input class="btn" type="submit" value="Submit">
                </div>   
            </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript"> 
    $(function(){
        //call auto search function for add team player
        
        $("#profileBtnEdit").click(function(){
           $("#profile_container").toggle(); 
           
        });
    });
</script>
