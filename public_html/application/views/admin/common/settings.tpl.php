<h2>Site Settings</h2>
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

    <label>Product discount rate for affiliate user <span class="req">*</span></label>
    <input type="text" maxlength="2" id="discount" name="aff_discount" value="<?php echo $m_send_data['i_aff_discount']; ?>" class="input-vsmall"> %

    <br />
    <input type="submit" value="Submit" name="submit" class="button">                                   

</form>