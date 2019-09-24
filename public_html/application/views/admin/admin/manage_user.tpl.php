<?php
    if(in_array(ADMIN_ROLE, get_ses_data('i_roles'))){
    ?>
    <div class="addbutton" onclick="window.location='<?php echo admin_url()?>user/unassigned-members-listing.html'">
        <input type="button" value="Unassigned Members" name="submit" class="button">
    </div>
    <?php
    }
?>
<h2>User Listing </h2>
<?php 
    echo validation_errors('<div id="error">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div id="error">'.$s_msg.'</div>';
    }
?>

<div class="">
    <!--- Search By Role: 
    <select name="user_role" id="user_role" onchange="javascript:list_particular(this)" >
    <option value="" selected="selected">All</option>
    <?php //echo get_user_role_dd($i_user_role); ?>
    </select> -->

    <h3>Search from the list</h3>
    <form action="<?php echo admin_url()."user/search-user-all.html" ?>" method="post">
        <table table width="80%">
            <tr>
                <td width="20%">Name/User Name</td> 
                <td width="30%"><input class="input-small" type="text" name="search_name" value="<?php echo $s_search_name; ?>" ></td>
                <td>
                    Gender: 
                </td>
                <td>
                    <select id='gender' name="gender">
                        <?php
                            echo get_dd(array(''=>'Select Gender','Male'=>'Male','Female'=>'Female'),set_value('gender',$s_gender));
                        ?>
                    </select>
                </td>
            </tr>    
            <tr>
                <td>Start Date:</td>
                <td><input class="input-small flexy_datepicker_input" id="txtInp1" type="text" name="start_date" value="<?php echo $s_start_date; ?>" ></td>
                <td>Finish Date:</td>
                <td><input class="input-small flexy_datepicker_input" id="txtInp2" type="text" name="finish_date" value="<?php echo $s_finish_date; ?>" ></td>
            </tr>
            <tr>
                <td>
                    Payment option: 
                </td>
                <td>
                    <select class="input-small" id='payment_opt' name="payment_opt">
                        <option value="">Select option</option>
                        <?php
                            echo get_payment_option(set_value('payment_opt',$s_payment_opt));
                        ?>
                    </select>
                </td>
                <td width="20%">Verification Status</td> 
                <td width="30%">
                    <select id='verify_stat' name="verify_stat">
                        <?php echo get_dd(array(''=>'Select option','1'=>'Verified','2'=>'Non-verified'),set_value('verify_stat',$s_verify_stat)); ?> 
                    </select>
                </td>
                
            </tr>
            
            <tr>
                <td colspan="2" align="right"><input type="submit" value="SEARCH" class="button" style=" margin-left: 5px; padding: 3px 5px;"></td>
                <td colspan="2" ><input type="button" value="SHOW ALL"  onclick="location = '<?php echo admin_url()?>user/search-user-all/all.html'" class="button" style=" margin-left: 5px; padding: 3px 5px;"></td>
            </tr>
        </table>
    </form>



</div>
<br><br>
<div class="clear"></div>
<div class="">
    <h3>Select Action from the list</h3>
    <select id="act_type" name="act_type">
        <?php echo get_dd(array('Select action', 'Delete User','Block User','Unblock User')) ?>
    </select>
    <input type="button" value="Apply" name="apply" onclick="apply_action(<?php echo USER_ROLE; ?>)" class="button">
    <div class="clear"></div>
    <div id="show_err_js_msg">
    </div>
    <div id="messege_portion">
        <?php
            // Message showing from controller
            echo show_msg();
        ?>
    </div>
</div>

<table class="details">
    <caption>&nbsp;</caption>
    <?php
         //pr($m_dataset);
    ?>
    <tr>
        <th style="width:2px;"><a rel="tip" title="check all"><input type="checkbox" id="chk_all"></a></th>
        <th width="8%">Images</th>
        
       
        <th width="10%">User ID</th>
        <th width="18%">Full name</th>  
        <th width="15%">User name</th>
        <th width="14%">Join Date</th>
        <th width="10%">Verified</th>      
        <th width="15%">Subscription for</th> 
        <th width="10%" colspan="3">Action</th>
    </tr>
    <?php if(count($m_dataset)>0){?>
        <?php 
            foreach($m_dataset as $m_row){
                if($m_row['id']!=1){
                    $s_email = strlen($m_row['s_email'])>17?substr_replace($m_row['s_email'],'...',15):$m_row['s_email'];
                    $s_phone = strlen($m_row['s_phone'])>12?substr_replace($m_row['s_phone'],'...',10):$m_row['s_phone'];
                    $s_roles = strlen($m_row['s_roles'])>12?substr_replace($m_row['s_roles'],'...',10):$m_row['s_roles'];

                    if($m_row['s_image_name']!=""){
                        $image_file=config_item("thumb_user_image_url").$m_row['s_image_name'];
                    }
                    else{
                        if($m_row['s_gender']=="Male"){
                            $image_file=config_item("user_noimage_url")."noimagemale.png";
                        }
                        else{
                            $image_file=config_item("user_noimage_url")."noimagefemale.png";
                        }

                    }
                ?>
                <tr>
                    <td><a rel="tip" title="check this user"><input type="checkbox" class="chk_admin" name="chkadmin[]" value="<?php echo strEncode($m_row['id']); ?>"></a></td>
                    <td align="center">
                        <?php if($m_row['s_image_name']!=""){ ?>
                            <a rel="facebox" title="show Image" href="<?php echo $image_file; ?>" class="link_show"><img src="<?php echo $image_file;?>" height="50px" width="50px"></a>
                            <?php } else { ?>      
                            <a rel="tip" title="show Image" href="javascript:showFBMsg('No Image Available')" class="link_show"><img src="<?php echo $image_file;?>" height="50px" width="50px"></a>
                            <?php } ?>
                    </td>
                    <td align="left">
                        <a rel="tip" title="View user details" href="javascript:open_user_info('<?php echo strEncode($m_row['id']);?>')" class="link_show">
                            <?php echo $m_row['s_user_id']; ?>
                        </a>
                    </td>
                    <td align="left">
                        
                            <?php echo put_safe($m_row['s_firstname'])." ".put_safe($m_row['s_lastname']);?>
                        
                    </td>
                    <td align="left">                        
                        <?php echo put_safe($m_row['s_username']);?>                        
                    </td>
                    <td align="left">
                        <?php echo date(config_item('date_format'),$m_row['i_join_date']);?>
                    </td>
                    <td align="left">
                        <?php echo empty($m_row['s_verification_id'])?"YES":"NO";?>
                    </td>     
                    <td align="left">
                        <?php echo ($m_row['i_day_of_sub']>1)?$m_row['i_day_of_sub']." Days":$m_row['i_day_of_sub']." Day";?>
                    </td>                    
                    <td align="center"> 
                        <a rel="tip" title="Delete user details" href="javascript:delete_confirmation('<?php echo admin_url().'user/del/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>');">
                            <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                        </a>
                    </td>
                    <td align="center"> 
                        <?php if($m_row['i_is_active']==1) { ?>
                            <a rel="tip" title="Block User" href="javascript:ban_confirmation(2,'<?php echo strEncode($m_row['id']); ?>');">
                                <img 
                                    width="14" height="14" border="0" style="margin-right:5px;" 
                                    alt="Edit" src="<?php echo base_url()?>images/admin/unban.png">
                            </a>                  
                            <?php }else{ ?> 
                            <a rel="tip" title="Unblock User" href="javascript:unban_confirmation('<?php echo admin_url().'user/change_state/allow/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>')">
                                <img 
                                    width="14" height="14" border="0" style="margin-right:5px;" 
                                    alt="Edit" src="<?php echo base_url()?>images/admin/ban.png">
                            </a>
                            <?php } ?>   

                    </td>

                </tr>
                <?php } ?>
            <?php } ?>
        <?php }else{ ?>
        <tr><td colspan="9" align="center">No Data Found</td></tr>
        <?php } ?>

</table>                  
<?php echo $user_page_link; ?>
