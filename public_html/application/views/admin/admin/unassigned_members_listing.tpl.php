<div class="addbutton" onclick="window.location='<?php echo admin_url()?>user/add.html'">
    <input type="button" value="Add New Members" name="submit" class="button">
</div>

    <div class="addbutton" onclick="window.location='<?php echo admin_url()?>user/listing.html'">
        <input type="button" value="All Members" name="submit" class="button">
    </div>

<h2>Unassigned <?php echo ucwords($i_user_role_name); ?> Member Listing </h2>

<div class="">
    Search By Role: 
    <select name="user_role" id="user_role" onchange="javascript:list_particular_unass(this)" >
        <option value="" selected="selected">All</option>
        <?php echo get_user_role_dd($i_user_role); ?>
    </select>

    <form action="" method="post">Search By Name/User Name: 
        <input class="input-medium" type="text" name="searchval" value="<?php echo $searchval; ?>" >
        <input type="submit" value="SEARCH" class="button" style=" margin-left: 5px; padding: 3px 5px;">
        <input type="button" value="SHOW ALL"  onclick="location = '<?php echo admin_url()?>user/listing.html'" class="button" style=" margin-left: 5px; padding: 3px 5px;">
    </form>  



</div>
<div class="clear"></div>
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

<table class="details">
    <caption>&nbsp;</caption>
    <?php
        // pr($m_dataset);
    ?>
    <tr>
        <th width="25%">Full name</th>
        <th width="20%">Username</th>
        <th width="20%">Email</th>
        <th width="10%">Phone</th>
        <th width="15%">User role</th>
        <th width="15%">Action</th>
    </tr>
    <?php if(count($m_dataset)>0):?>
        <?php 
            foreach($m_dataset as $m_row):
                if($m_row['id']!=1){
                    $s_email = strlen($m_row['s_email'])>17?substr_replace($m_row['s_email'],'...',15):$m_row['s_email'];
                    $s_phone = strlen($m_row['s_phone'])>12?substr_replace($m_row['s_phone'],'...',10):$m_row['s_phone'];
                    $s_roles = strlen($m_row['s_roles'])>12?substr_replace($m_row['s_roles'],'...',10):$m_row['s_roles'];
                ?>
                <tr>
                    <td align="left">
                        <a rel="tip" title="View user details" href="javascript:open_user_info('<?php echo strEncode($m_row['id']);?>')" class="link_show" >
                            <?php echo $m_row['s_firstname']." ".$m_row['s_lastname'];?>
                        </a>
                    </td>
                    <td align="left">
                        <a rel="tip" title="Edit user account details" href="javascript:open_user_accn('<?php echo strEncode($m_row['id']);?>')" class="link_show" >
                            <?php echo $m_row['s_username'];?>
                        </a>
                    </td>
                    <td><a rel="tip" title="<?php echo $m_row['s_email'];?>"><?php echo $s_email;?></a></td>
                    <td align="center"><a rel="tip" title="<?php echo $m_row['s_phone'];?>"><?php echo $s_phone; ?></a></td>
                    <td><a rel="tip" title="<?php echo ucwords($m_row['s_roles']);?>"><?php echo ucwords($s_roles);?></a></td>
                    <td align="center">
                        <a rel="tip" title="Edit user details" href="<?php echo admin_url().'user/edit/'.strEncode($m_row['id']); ?>">
                            <img 
                                width="14" height="14" border="0" style="margin-right:5px;" 
                                alt="Edit" src="<?php echo base_url()?>images/admin/edit.png">
                        </a>
                        <a rel="tip" title="Delete user details" href="javascript:delete_confirmation('<?php echo admin_url().'user/del/'.strEncode($m_row['id']) ?>');">
                            <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                        </a>
                        <a rel="tip" title="Send Notification" href="<?php echo admin_url().'user/send_notification/'.strEncode($m_row['id']); ?>">
                            <img 
                                width="14" height="14" border="0" style="margin-right:5px;" 
                                alt="Edit" src="<?php echo base_url()?>images/admin/email_icon.png">
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php endforeach; ?>
        <?php endif; ?>

</table>                  

