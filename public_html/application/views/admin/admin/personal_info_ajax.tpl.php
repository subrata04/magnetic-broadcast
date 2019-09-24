<?php
    if($m_send_data['s_image_name']!=""){
        $image_file=config_item("thumb_user_image_url").$m_send_data['s_image_name'];
    }
    else{
        if($m_send_data['s_gender']=="Male"){
            $image_file=config_item("user_noimage_url")."noimagemale.png";
        }
        else{
            $image_file=config_item("user_noimage_url")."noimagefemale.png";
        }

    }
?>
<div id="fbcontent" class="fb_div" style="width: 600px;text-align: left;">
    <h2>My Personal Information</h2>   
    <div class="clear"></div>
    <?php
        if(count($m_send_data)>0){
            // pr($m_send_data);
        ?>
        <table class="show">
            <tr>
                <td align="center" width="30%">
                    <?php if($m_send_data['s_image_name']!=""){ ?>
                        <img src="<?php echo $image_file;?>" alt="" id="user_image" />
                        <?php }else{ ?>
                        <img src="<?php echo $image_file;?>" alt="" id="user_image" />
                        <?php } ?><br />
                    <div style="padding: 5px 0px;">
                        <strong style="line-height: 10px"><?php echo put_safe($m_send_data['s_username']); ?> (<?php echo put_safe($m_send_data['s_gender']); ?>)</strong><br />
                        <?php echo put_safe($m_send_data['s_firstname']).' '.put_safe($m_send_data['s_lastname']); ?>
                    </div>
                </td>
                <td valign="top"  width="70%">
                    <strong> Email : <?php echo put_safe($m_send_data['s_email']); ?></strong> <br />
                    Phone : <?php echo put_safe($m_send_data['s_phone']); ?><br />
                    <span>User Role : </span><?php echo put_safe($m_send_data['s_roles']); ?><br />
                    <?php if($m_send_data['i_user_role']==USER_ROLE) { ?>
                        <strong> Address :</strong> 
                        <p>
                            <?php echo put_safe($m_send_data['s_address']); ?><br />

                            <?php echo put_safe($m_send_data['s_city']); ?>,
                            <?php echo getState($m_send_data['i_state']); ?>,<br />
                            <?php echo getCountry($m_send_data['i_country']); ?>, 
                            <?php echo $m_send_data['s_zip']; ?>
                            <span>Subscribed for : </span><?php echo put_safe($m_send_data['i_day_of_sub']); ?> Days<br />
                            <strong>
                                <?php echo empty($m_send_data['s_verification_id'])?"Verified Account":"Account is not verified"; ?>
                            </strong>
                        </p>
                        <?php } ?>

                </td>
            </tr>
        </table>

        <div class="clear"></div>
        <div style="text-align: center;">
            <?php  if($m_send_data['i_user_role']!=USER_ROLE){  ?>
                <input type="button" value="Edit" name="submit" class="button" onclick="window.location.href='<?php echo admin_url().'user/'.strEncode($m_send_data['id']).'/edit.html'?>'"> 
                <?php } ?>  

            <input type="button" value="Close" name="button" class="button" onclick="jQuery(document).trigger('close.facebox')" />
        </div>
        <?php
        }else{
            echo "<label>No user information</label>";
        }
    ?>
    <div class="clear"></div>
</div>
