  
<div id="fbcontent" class="fb_div" style="width: 400px;text-align: left;">
<?php  ?>
    
    <center><h2>Image Deletion</h2></center>
    <div class="clear"></div>
    <div id="show_msg"></div>
    <?php
        if(count($m_send_data)>0){
            // pr($m_send_data);
        ?>
        <div style="text-align: center;">
        ARE YOU SURE TO DELETE THE IMAGE???
        <br>
            <input type="hidden" name="uid" id="edit_uid" value="<?php echo strEncode($m_send_data['uid']); ?>"> 
            <input type="hidden" name="gender" id="edit_gender" value="<?php echo $m_send_data['s_gender']; ?>">  
            <input type="button" value="YES" name="submit" onclick="submit_val();" style="background: blue;text-align: center;color: white;height:35px;width:84px;" />
            <input type="button" value="NO" name="button" onclick="closeFbDiv()" style="background: blue;text-align: center;color: white;height:35px;width:84px;"/>
        </div>
        <?php
        }else{
            echo "<label>No user information</label>";
        }
    ?>
    <div class="clear"></div>
</div>