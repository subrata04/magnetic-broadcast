<script type="text/javascript">
    $(function(){
        //  $(".my_check:first").trigger("click");

        <?php 

            if(set_value('country')!=""){
            ?>
            fetchState($("#country"), 'state', '<?php echo set_value('state',$state_id)?>');
            <?php
            }
        ?>
    });
</script>
<h2>Add Admin</h2>
<h3>Admin details</h3>
<?php 
    echo validation_errors('<div class="error closeable">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div class="error closeable">'.$s_msg.'</div>';
    }
?>
<?php
    // Message showing from controller
    echo show_msg();
?>
<span class="small req">[ * marked field are mandatory ]</span>
<form action="" enctype="multipart/form-data" method="post">
    <input type="hidden" name="user_type" value="2">

    <label>First Name <span class="req">*</span></label>
    <input type="text" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" class="input-medium"/>

    <label>Last Name <span class="req">*</span></label>
    <input type="text" id="lname" name="lname" value="<?php echo set_value('lname'); ?>" class="input-medium"/>

    <label>Gender</label>
    <select name="gender" id="gender">
        <?php echo get_dd(array('Male'=>'Male','Female'=>'Female'), set_value('gender')); ?>
    </select>
        
    

    <label>Email Address <span class="req">*</span></label>
    <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" class="input-medium"/>

    <label>Phone Number </label>
    <input type="text" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" class="input-medium"/>

    <label>Upload an image </label>
    <input type="file" id="imgfile" name="imgfile"  class="input-medium"/>

    <label>Address </label>
    <?php /*<textarea cols="10" rows="3" name="address" id="address" ><?php echo set_value('address'); ?></textarea>*/ ?>
    <input type="text" id="address" name="address" value="<?php echo set_value('address'); ?>" class="input-big"/> 
    
    <label>Country</label>
    <select class="input-medium" name="country" id="country" onchange="fetchState(this,'state')">
        <option value="">Select Country</option>
        <?php echo get_country_dd(set_value('country')); ?>
    </select>
    
    <label>State</label>
    <select class="input-medium" name="state" id="state">
        <option value="">Select Country First</option>  
    </select> 
    
    <label>City </label>
    <input type="text" id="city" name="city" value="<?php echo set_value('city'); ?>" class="input-medium"/>
    
    <label>Zip Code </label>
    <input type="text" id="zip" name="zip" value="<?php echo set_value('zip'); ?>" class="input-medium"/>

    <h3>Login details</h3>

    <label>Username <span class="req">*</span></label>
    <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" class="input-medium"/>

    <label>Password <span class="req">*</span></label>
    <input type="password" id="password" name="password" value="" class="input-medium"/>

    <label>Confirm Password <span class="req">*</span></label>
    <input type="password" id="repassword" name="repassword" value="" class="input-medium"/>

    <br />
    <?php /*   <label><input type="checkbox" name="reminder">Send Notification To This User</label> */ ?>
    <input type="submit" value="Submit" name="submit" class="button">                                   

</form>
