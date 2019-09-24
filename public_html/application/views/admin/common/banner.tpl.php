<h2>Banner Settings</h2>
<?php 
    echo validation_errors('<div id="error">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div id="error">'.$s_msg.'</div>';
    }
?>
<?php
    // Message showing from controller
    echo show_msg();
    //pr($m_send_data);
?>
<span class="small req">[ * marked field are mandatory ]</span>
<form action="" enctype="multipart/form-data" method="post">

    <label>Select Page:<span class="req">*</span></label>
    <select name="user_role" id="user_role" onchange="javascript:fetch_page_image(this)" >
        <?php 
            echo get_dd($m_page_arr, $s_page);
        ?>
    </select>
    <div id="shform" style="<?php echo ($b_show_form)?"display:block":"display:none"; ?>" >    
        <label>Upload Image <span class="req">*</span></label>
        <?php if(!empty($m_send_data['s_image_name'])) { ?>
            <img src="<?php echo config_item('banner_image_url').$m_send_data['s_image_name'] ?>" /><br />
            <input type="hidden" name="prev_image" value="<?php echo $m_send_data['s_image_name'] ?>" /> 
            <?php } ?>
        <input type="file" style="margin-bottom:7px;" name="banner_upload" size="33">
        <br />
        <input type="submit" value="Submit" name="submit" class="button">          
    </div>                         

</form>