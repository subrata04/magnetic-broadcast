<h2>Add Lead</h2>
<h3>User details</h3>
<?php 
    echo validation_errors('<div id="error">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div id="error">'.$s_msg.'</div>';
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

    <label>Gender <span class="req">*</span></label>
    <select name="gender" id="gender">
        <?php echo get_dd(array('Male'=>'Male', 'Female'=>'Female'), set_value('gender')); ?>
    </select>

    <label>User Role </label>
    <?php 
        //$m_roles  = explode(",",$m_send_data['m_user_role']);
        //pr($m_user_role);
        $m_urole = get_user_role_dataset();
        foreach($m_urole as $m_role) {
        ?>
        <label><input type="checkbox" <?php echo (in_array(strEncode($m_role['id']), $m_user_role))?'checked="checked"':""; ?> name="user_role[]" value="<?php echo strEncode($m_role['id']) ?>" /> <?php echo ucwords($m_role['s_role_name']) ?></label>
        <?php
        }
    ?>
    <?php /* <select name="user_role" id="user_role">
        <?php echo get_user_role_dd(set_value('user_role')); ?>
    </select> */ ?>

    <!-- Added By Samsuj[start] -->


    <label>Parent User <span class="req">*</span></label>
    <select name="parent_id" id="parent_id">
        <?php echo get_parent_list(intval(get_ses_data('i_user_id'))); ?>
    </select> 

    <!-- Added By Samsuj[end] -->

    
    
    <label>Email Address </label>
    <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" class="input-medium"/>

    <label>Phone Number </label>
    <input type="text" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" class="input-medium"/>

    <label>Address </label>
    <textarea cols="10" rows="3" name="address" id="address" ><?php echo set_value('address'); ?></textarea>
    
    <label>Access to user (Promoters List)<span class="req">*</span></label>
    <select multiple="multiple" name="access_ids[]" size="8">
        <?php echo get_user_dd(array('i_user_role'=>PROMOTER_ROLE)); ?>
    </select>
    
    
    <h3>Login details</h3>

    <label>Username </label>
    <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" class="input-medium"/>

    <label>Password </label>
    <input type="password" id="password" name="password" value="" class="input-medium"/>

    <label>Confirm Password </label>
    <input type="password" id="repassword" name="repassword" value="" class="input-medium"/>
    
    

    <br />
    <label><input type="checkbox" name="reminder"> Send Email Notification About the Account Information To This User</label>
    <input type="submit" value="Submit" name="submit" class="button">                                   

</form>
