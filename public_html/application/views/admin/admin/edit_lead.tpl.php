<h2>Edit Lead</h2>
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
    // pr($m_send_data);
?>
<span class="small req">[ * marked field are mandatory ]</span>
<form action="" enctype="multipart/form-data" method="post">

<input type="hidden" name="user_type" value="2">


    <label>First Name <span class="req">*</span></label>
    <input type="text" id="fname" name="fname" value="<?php echo set_value('fname', $m_send_data['s_firstname']); ?>" class="input-medium"/>

    <label>Last Name <span class="req">*</span></label>
    <input type="text" id="lname" name="lname" value="<?php echo set_value('lname', $m_send_data['s_lastname']); ?>" class="input-medium"/>

    <label>Gender <span class="req">*</span></label>
    <select name="gender" id="gender">
        <?php echo get_dd(array('Male'=>'Male', 'Female'=>'Female'), $m_send_data['s_gender']); ?>
    </select>

    <label>User Role <span class="req">*</span></label>
    <?php 
        $m_roles  = explode(",",$m_send_data['i_roles']);
        $m_urole = get_user_role_dataset();
        foreach($m_urole as $m_role){
        ?>
        <label>
            <input type="checkbox" name="user_role[]" <?php echo (in_array($m_role['id'],$m_roles))?'checked="checked"':""; ?> value="<?php echo strEncode($m_role['id']) ?>" /> 
            <?php echo ucwords($m_role['s_role_name']) ?>
        </label>
        <?php
        }
    ?>
    <!--<select name="user_role" id="user_role">
    <?php echo get_user_role_dd($m_send_data['i_user_role']); ?>
    </select>-->
    
        <!-- Added By Samsuj[start] -->

    

    <label>Parent User <span class="req">*</span></label>
    <select name="parent_id" id="parent_id">
        <?php echo get_parent_list($m_send_data['i_parent_id']); ?>
    </select> 
    
    
        <!-- Added By Samsuj[end] -->



    <label>Email Address </label>
    <input type="text" id="email" name="email" value="<?php echo set_value('email', $m_send_data['s_email']); ?>" class="input-medium"/>

    <label>Phone Number </label>
    <input type="text" id="phone" name="phone" value="<?php echo set_value('phone', $m_send_data['s_phone']); ?>" class="input-medium"/>

    <label>Address </label>
    <textarea cols="10" rows="3" name="address" id="address" ><?php echo set_value('address', $m_send_data['s_address']); ?></textarea>
    
    <label>Access to user (Promoters List)<span class="req">*</span></label>
    <select multiple="multiple" name="access_ids[]" size="8" >
        <?php echo get_user_dd(array('i_user_role'=>PROMOTER_ROLE), strtoarray($m_send_data['s_access_ids'])); ?>
    </select>

    <br />
    <label><input type="checkbox" name="reminder"> Send Email Notification About the Account Information To This User</label>
    <br />
    <input type="submit" value="Submit" name="submit" class="button">                                   

</form>

<?php /*

/usr/local/apache/conf/includes/pre_main_global.conf
/usr/local/apache/conf/includes/pre_main_2.conf
/usr/local/apache/conf/modsec2.conf

*/ ?>