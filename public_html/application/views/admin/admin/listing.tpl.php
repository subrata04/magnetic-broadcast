<div class="addbutton" onclick="window.location='<?php echo admin_url()?>admin/add.html'">
    <input type="button" value="Add New Admin" name="submit" class="button">
</div>
<?php
    if(in_array(ADMIN_ROLE, get_ses_data('i_roles'))){
    ?>
    <div class="addbutton" onclick="window.location='<?php echo admin_url()?>admin/unassigned-members-listing.html'">
        <input type="button" value="Unassigned Members" name="submit" class="button">
    </div>
    <?php
    }
?>
<h2>Admin Listing </h2>
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

    <form action="" method="post">Search By Name/User Name: 
        <input class="input-medium" type="text" name="searchval" value="<?php echo $searchval; ?>" >
        <input type="submit" value="SEARCH" class="button" style=" margin-left: 5px; padding: 3px 5px;">
        <input type="button" value="SHOW ALL"  onclick="location = '<?php echo admin_url()?>admin/listing.html'" class="button" style=" margin-left: 5px; padding: 3px 5px;">
    </form>  



</div>
<div class="clear"></div>
Select Action From the list
<select id="act_type" name="act_type">
    <?php echo get_dd(array('Select action', 'Delete Admins','Block Admins','Unblock Admins')) ?>
</select>
<input type="button" value="Apply" name="apply" onclick="apply_action(<?php echo ADMIN_ROLE; ?>)" class="button">
<div class="clear"></div>
<div id="show_err_js_msg">
</div>
<div id="messege_portion">
    <?php
        // Message showing from controller
        echo show_msg();
    ?>
</div>

<table class="details">
    <caption>&nbsp;</caption>
    <?php
        //pr($m_dataset);
    ?>
    <tr>
        <th width="2%"><a rel="tip" title="check all"><input type="checkbox" id="chk_all"></a></th>
        <th width="8%">Images</th>
       <!-- <th width="18%">User ID</th>    -->
        <th width="20%">Full name</th>
        <th width="16%">Username</th>
        <th width="22%">Email</th>
        <?php /*<th width="12%">Phone</th>*/ ?>

        <th width="12%" colspan="3">Action</th>
    </tr>
    <?php if(count($m_dataset)>0){
        //pr($m_dataset);
        ?>
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
                    <td><a rel="tip" title="check this admin"><input type="checkbox" class="chk_admin" name="chkadmin[]" value="<?php echo strEncode($m_row['id']); ?>"></a></td>
                    <td align="center">
                        <?php if($m_row['s_image_name']!=""){ ?>
                            <a rel="facebox" title="show Image" href="<?php echo config_item("user_image_url").$m_row['s_image_name']; ?>" class="link_show"><img src="<?php echo $image_file;?>" height="50px" width="50px"></a>
                            <?php }else{ ?>      
                            <a rel="tip" title="show Image" href="javascript:showFBMsg('No Image Available')" class="link_show">
                                <img src="<?php echo $image_file;?>" height="50px" width="50px">
                            </a>
                            <?php } ?>
                    </td>
                    <!--<td align="left">
                        <a rel="tip" title="View admin details" href="javascript:open_user_info('<?php echo strEncode($m_row['id']);?>')" class="link_show" >
                            <?php echo $m_row['id']; ?>
                        </a>
                    </td>-->
                    
                    <td align="left">

                       <a rel="tip" title="View admin details" href="javascript:open_user_info('<?php echo strEncode($m_row['id']);?>')" class="link_show" > <?php echo $m_row['s_firstname']." ".$m_row['s_lastname'];?>
                     </a>
                    </td>
                    <td align="left">
                        <a rel="tip" title="Edit admin account details" href="javascript:open_user_accn('<?php echo strEncode($m_row['id']);?>')" class="link_show" >
                            <?php echo $m_row['s_username'];?>
                        </a>
                    </td>
                    <td><a rel="tip" title="<?php echo $m_row['s_email'];?>"><?php echo $s_email;?></a></td>
                    <?php /*  <td align="center"><a rel="tip" title="<?php echo $m_row['s_phone'];?>"><?php echo $s_phone; ?></a></td> */ ?>
                    <?php
                        /* <td><a rel="tip" title="<?php echo ucwords($m_row['s_roles']);?>"><?php echo ucwords($s_roles);?></a></td> */
                    ?>
                    <td align="center">
                        <a rel="tip" title="Edit admin details" href="<?php echo admin_url().'admin/edit/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>">
                            <img 
                                width="14" height="14" border="0" style="margin-right:5px;" 
                                alt="Edit" src="<?php echo base_url()?>images/admin/edit.png">
                        </a>
                    </td>
                    <td align="center"> 
                        <a rel="tip" title="Delete admin details" href="javascript:delete_confirmation('<?php echo admin_url().'admin/del/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>');">
                            <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                        </a>
                    </td>
                    <td align="center"> 
                        <?php if($m_row['i_is_active']==1) { ?>
                            <a rel="tip" title="Block Admins" href="javascript:ban_confirmation(2,'<?php echo strEncode($m_row['id']); ?>');">
                                <img 
                                    width="14" height="14" border="0" style="margin-right:5px;" 
                                    alt="Edit" src="<?php echo base_url()?>images/admin/unban.png">
                            </a>                  
                            <?php }else{ ?> 
                            <a rel="tip" title="Unblock Admins" href="javascript:unban_confirmation('<?php echo admin_url().'admin/change_state/allow/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>')">
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

