<script>
    function validate(obj){
        email = $(obj).find('input[name="s_email"]').val();
        regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(email=='')
            {
            alert('Please Enter Email Id');
            return false;
        }
        else if(!regex.test(email))
            {
            alert('Please Enter Valid Email Id');
            return false;
        }else{
            return true;
        }
    }
</script>
<?php 
    echo validation_errors('<div id="error">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div id="error">'.$s_msg.'</div>';
    }
?>
<h2>Admin Email </h2>

<form action="<?php echo admin_url();?>email/add_mail" enctype="multipart/form-data" onsubmit="return validate(this)" method="post">
    <label>Add Admin Mail:</span></label>
    <input type="hidden" name="i_type" value="0" />
    <input type="text" name="s_email" style="width:280px;" class="input-big" />
    <input type="submit" value="Submit" name="submit" class="button">
</form>

<table class="details" style="width: 50%;">
    <caption>&nbsp;</caption>
    <?php
        //pr($m_dataset);
    ?>
    <tr>
        <th width="30%">Email</th>
        <th width="5%" colspan="3">Action</th>
    </tr>
    <?php   
        // pr($m_dataset) ;
        if(count($m_email_dataset)>0){
        ?>
        <?php 
            foreach($m_email_dataset as $m_row){


            ?>
            <tr>
                <td><?php echo $m_row['s_email']; ?></td>

                <td align="center"> 
                    <a rel="tip" title="Delete contact details" href="javascript:delete_confirmation('<?php echo admin_url().'email/del/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>');">
                        <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                    </a>
                </td>


            </tr>

            <?php } ?>
        <?php }else{ ?>
        <tr><td colspan="9" align="center">No Data Found</td></tr>
        <?php } ?>

</table>

<br /><br />

<h2>Sender Email </h2>

<form action="<?php echo admin_url();?>email/add_mail" enctype="multipart/form-data" onsubmit="return validate(this)" method="post">
    <label>Add Sender Mail:</span></label>
    <input type="hidden" name="i_type" value="1" />
    <input type="text" name="s_email" style="width:280px;" class="input-big" />
    <input type="submit" value="Submit" name="submit" class="button">
</form>

<table class="details" style="width: 50%;">
    <caption>&nbsp;</caption>
    <?php
        //pr($m_dataset);
    ?>
    <tr>
        <th width="30%">Email</th>
        <th width="5%" colspan="3">Action</th>
    </tr>
    <?php   
        // pr($m_dataset) ;
        if(count($m_sender_dataset)>0){
        ?>
        <?php 
            foreach($m_sender_dataset as $m_row){


            ?>
            <tr>
                <td><?php echo $m_row['s_email']; ?></td>

                <td align="center"> 
                    <a rel="tip" title="Delete contact details" href="javascript:delete_confirmation('<?php echo admin_url().'email/del/'.strEncode($m_row['id']).'/'.strEncode($this->uri->uri_string()); ?>');">
                        <img width="14" height="14" border="0" style="margin-right:5px;" alt="Delete" src="<?php echo base_url()?>images/admin/delete.png">
                    </a>
                </td>


            </tr>

            <?php } ?>
        <?php }else{ ?>
        <tr><td colspan="9" align="center">No Data Found</td></tr>
        <?php } ?>

</table>   