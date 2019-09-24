<div class="addbutton" onclick="window.location='<?php echo admin_url()?>user/add-lead.html'">
    <input type="button" value="Add" name="submit" class="button">
</div>
<h2> Lead Listing</h2>
<div class="">
<form action="" method="post"> Search By Name/User Name: <input class="input-medium" type="text" name="searchval"><input type="submit" value="SEARCH" class="button" style=" margin-left: 5px; padding: 3px 5px;"><input type="button" value="SHOW ALL"  onclick="location = '<?php echo admin_url()?>user/lead-listing.html'" class="button" style=" margin-left: 5px; padding: 3px 5px;">  </form>
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
        <th width="15%">Lead By Whom</th>
        <th width="15%">Action</th>
    </tr>
    <?php if(count($m_dataset)>0):?>
        <?php 
            foreach($m_dataset as $m_row):
            ?>
            <tr>
                <td align="left">
                        <?php echo $m_row['s_firstname']." ".$m_row['s_lastname'];?>
                </td>
                <td align="left">
                        <?php echo $m_row['s_username'];?>
                </td>
                <td><?php echo $m_row['s_email'];?></td>
                <td align="center"><?php echo $m_row['s_phone'];?></td>
                <td><?php echo $m_row['s_parent_firstname']."  ".$m_row['s_parent_lastname'];?></td>
                <td align="center">
                    <a rel="tip" title="Edit user details" href="<?php echo admin_url().'user/edit_lead/'.strEncode($m_row['id']); ?>">
                        <img 
                            width="16" height="16" border="0" style="margin-right:5px;" 
                            alt="Edit" src="<?php echo base_url()?>images/admin/edit.png">
                    </a>
                    <a rel="tip" title="Convert Lead to Member" href="<?php echo admin_url().'user/edit/'.strEncode($m_row['id']); ?>">
                        <img 
                            width="16" height="16" border="0" style="margin-right:5px;" 
                            alt="Edit" src="<?php echo base_url()?>images/admin/icon_user.png">
                    </a>
                    <a rel="tip" title="Send Notification" href="<?php echo admin_url().'user/send_notification/'.strEncode($m_row['id']); ?>">
                        <img 
                            width="16" height="16" border="0" style="margin-right:5px;" 
                            alt="Edit" src="<?php echo base_url()?>images/admin/email_icon.png">
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>

</table>                  

