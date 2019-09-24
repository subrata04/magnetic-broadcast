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
<h2>Edit Admin</h2>
<h3>Admin details</h3>
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
    <input type="text" id="fname" name="fname" value="<?php echo set_value('fname', put_safe($m_send_data['s_firstname'])); ?>" class="input-medium"/>

    <label>Last Name <span class="req">*</span></label>
    <input type="text" id="lname" name="lname" value="<?php echo set_value('lname', put_safe($m_send_data['s_lastname'])); ?>" class="input-medium"/>

    <label>Gender <span class="req">*</span></label>
    <select name="gender" id="gender">
        <?php echo get_dd(array('Male'=>'Male', 'Female'=>'Female'), put_safe($m_send_data['s_gender'])); ?>
    </select>



    <?php 
        /*  <label>User Role <span class="req">*</span></label>
        <?php if($m_send_data['id']!=1){
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
        }else{
        ?>
        <label>Admin<input type="hidden" name="user_role[]" value="<?php echo strEncode(1) ?>" /> </label>
        <?php
        }
        ?> */
    ?>
    <?php /* <select name="user_role" id="user_role">
        <?php echo get_user_role_dd($m_send_data['i_user_role']); ?>
    </select> */ ?>
    <!-- Added By Samsuj[start] -->
    <?php /*  <?php if($m_send_data['id']!=1){ ?>
        <label>Parent User <span class="req">*</span></label>
        <select name="parent_id" id="parent_id">
        <?php echo get_parent_list($m_send_data['i_parent_id']); ?>
        </select> 
        <?php }else{
        ?>
        <input type="hidden" name="parent_id" value="0" /> 
        <?php
        } 
        ?> */
    ?>
    <!-- Added By Samsuj[end] -->

    <label>Email Address <span class="req">*</span></label>
    <input type="text" id="email" name="email" value="<?php echo set_value('email', put_safe($m_send_data['s_email'])); ?>" class="input-medium"/>

    <label>Phone Number <span class="req">*</span></label>
    <input type="text" id="phone" name="phone" value="<?php echo set_value('phone', put_safe($m_send_data['s_phone'])); ?>" class="input-medium"/>

    <label>Upload an image </label>
    <?php
        if($m_send_data['s_image_name']!=""){
        ?>
        <a rel="facebox" href="<?php echo config_item("user_image_url").$m_send_data['s_image_name']; ?>"  title="show Image" class="link_show"><img src="<?php echo config_item("thumb_user_image_url").$m_send_data['s_image_name']; ?>" alt=""></a>
        <?php }else{ ?>
        <a rel="tip" title="show Image" href="javascript:showFBMsg('No Image Available')" class="link_show"><img src="<?php echo ($m_send_data['s_gender']=="Male")?config_item("user_noimage_url")."noimagemale.png":config_item("user_noimage_url")."noimagefemale.png"; ?>" alt=""></a> 
        <?php } ?>
    <br><br> 
    <input type="file" id="imgfile" name="imgfile" class="input-medium"/>

    <label>Address <span class="req">*</span></label>
    <?php /*<textarea cols="10" rows="3" name="address" id="address" ><?php echo set_value('address', put_safe($m_send_data['s_address'])); ?></textarea>*/ ?>
        <input type="text" id="address" name="address" value="<?php echo set_value('address',put_safe($m_send_data['s_address'])); ?>" class="input-big"/> 
    <label>Country</label>
    <select class="input-medium" name="country" id="country" onchange="fetchState(this,'state',<?php echo set_value('state',$m_send_data['i_state'])?>)">
        <option value="">Select Country</option>
        <?php echo get_country_dd(set_value('country',$m_send_data['i_country'])); ?>
    </select>

    <label>State</label>
    <select class="input-medium" name="state" id="state">
        <option value="">Select Country First</option>
        <?php echo get_state_dd(set_value('country',$m_send_data['i_country']),set_value('state',$m_send_data['i_state'])); ?>
    </select> 

    <label>City </label>
    <input type="text" id="city" name="city" value="<?php echo set_value('city',$m_send_data['s_city']); ?>" class="input-medium"/>

    <label>Zip Code </label>
    <input type="text" id="zip" name="zip" value="<?php echo set_value('zip',$m_send_data['s_zip']); ?>" class="input-medium"/>



    <br />
    <?php /*<label><input type="checkbox" name="reminder">Send Notification To This User</label>*/ ?>
    <br />
    <input type="submit" value="Submit" name="submit" class="button">                                   

</form>

<?php /*

    /usr/local/apache/conf/includes/pre_main_global.conf
    /usr/local/apache/conf/includes/pre_main_2.conf
    /usr/local/apache/conf/modsec2.conf

*/ ?>