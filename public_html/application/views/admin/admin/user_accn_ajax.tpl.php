<div id="fbcontent" class="fb_div" style="width: 400px;text-align: left;">
    <h2><?php echo $m_send_data['s_firstname'].'\'s Account Details'; ?></h2>
    <div class="clear"></div>
    <div id="show_msg"></div>  
    <?php
        if(count($m_send_data)>0){
            // pr($m_send_data);
        ?>  
        <label>
            <span style="border-bottom: none;">Email : </span><input type="text" id="edit_email" class="input-medium" value="<?php echo $m_send_data['s_email']; ?>" name="email" />
        </label>
        <label>
            <span style="border-bottom: none;">Username : </span><input type="text" id="edit_username" class="input-medium" value="<?php echo $m_send_data['s_username']; ?>" name="username" />
        </label>
        <label>
            <span style="border-bottom: none;">Old Password : </span><input type="password" id="edit_oldpass" class="input-medium" value="" name="password" />
        </label>
        <label>
            <span style="border-bottom: none;">New Password : </span><input type="password" id="edit_pass" class="input-medium" value="" name="pass" />
        </label>
        <label>
            <span style="border-bottom: none;">Confirm Password : </span><input type="password" id="edit_repass" class="input-medium" value="" name="repass" />
        </label>      
        <div class="clear"></div>
        <div style="text-align: center;">     
            <input type="hidden" name="uid" id="edit_uid" value="<?php echo strEncode($m_send_data['id']); ?>"> 
            <input type="button" value="Save" name="submit" class="button" onclick="submit_val();" />
            <input type="button" value="Close" name="button" class="button" onclick="closeFbDiv()" />     
        </div>
        <?php
        }else{
            echo "<label>No user information</label>";
        }
    ?>              
    <div class="clear"></div>
</div>

