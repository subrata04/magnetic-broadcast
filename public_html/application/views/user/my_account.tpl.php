<script type="text/javascript">
    $(function(){
        //  $(".my_check:first").trigger("click");

        <?php 

            if(set_value('country')!=""){
            ?>
            fetchState($("#country"), 'state_dd', '<?php echo set_value('state_dd',$state_id)?>');
            <?php
            }
        ?>
    });
    function get_price(e)
    {
        var offer_price = $(e).children('option:selected').attr('price');
        
        if(offer_price == undefined){
            $(e).parent().parent().next().hide();
            $(e).parent().parent().next().children('td.offPrc').html('');
        }else{
            $(e).parent().parent().next().show();
            $(e).parent().parent().next().children('td.offPrc').html(offer_price);
        }
    }
</script> 
   
    <div class="middle-contain" style="padding-bottom:20px;">
 <img src="images/demo-img.png" alt="#" />

    <div class="right-text">
      
      <h1><span>Account</span> Management</h1>
          <?php if(!empty($s_err_msg)){ 
            echo $s_err_msg;
        }
    ?>
  

      <?php echo show_msg(); ?>
          <form id="myaccnt_info" name="myaccnt_info" action="" method="post" enctype="multipart/form-data">
           <!-- Sign up form section 1 -->
                <div class="sign_up">
                
                <h1>Personal Details</h1>
                <div class="sign_up_form">
                <table width="700" border="0" cellspacing="8" cellpadding="0">
                                      <tbody>
                                                                   <tr>
                                        <td valign="middle" align="right" class="text">User :</td>
                                        <td valign="top" align="left">
                                            <?php if($m_dataset['s_image_name']==""){ 
                                                    if($m_dataset['s_gender']=="Female"){
                                                    ?>                    
                                                    <div class="pic pic_female"></div>
                                                    <?php }else{ ?>
                                                    <div class="pic pic_male"></div>
                                                    <?php } 
                                                }else{?>
                                                <div id='img_div'><img src="<?php echo config_item('thumb_user_image_url').$m_dataset['s_image_name']; ?>" alt="" style="left top;width:72px;height:72px;"></div>
                                                <?php } ?>
                                            <a href="javascript:void(0);" onclick="javascript:delete_imgage('<?php echo strEncode($m_dataset['id']); ?>')">Delete Image</a>    
                                        </td>
                                        <td valign="top" align="left" class="error"></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text">Chose User Image :</td>
                                        <td valign="top" align="left">
                                            <input type="file" border="0" class="fild" name="imgfile">

                                        </td>
                                        <td valign="top" align="left" class="error"><?php echo (!empty($s_msg))?$s_msg:""; ?></td>
                                    </tr>
   
                                      
                                      <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>First Name :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="fname" id="fname" value="<?php echo set_value('fname',$m_dataset['s_firstname']); ?>"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('fname','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Last Name :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="lname" id="lname" value="<?php echo set_value('lname',$m_dataset['s_lastname']); ?>"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('lname','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Gender :</td>
                                        <td valign="top" align="left">
                                            <select id="gender" name="gender" class="select">
                                                <?php echo get_dd(array('Male'=>'Male', 'Female'=>'Female'),put_safe($m_dataset['s_gender'])); ?>      
                                            </select>
                                        </td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('lname','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>E-mail :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="email" id="email" value="<?php echo set_value('email',$m_dataset['s_email']); ?>"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('email','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Phone Number :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="phno" id="phno" value="<?php echo set_value('phno',$m_dataset['s_phone']); ?>"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('phno','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Address :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="address" id="address" value="<?php echo set_value('address',$m_dataset['s_address']); ?>"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('address','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Country :</td>
                                        <td valign="top" align="left">
                                            <select id="country" name="country" class="select" onchange="fetchState(this,'state_dd',<?php echo set_value('state_dd',$m_dataset['i_state'])?>);">

                                                <?php echo get_country_dd(set_value('country',$m_dataset['i_country'])); ?>
                                            </select>
                                        </td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('country','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>State :</td>
                                        <td valign="top" align="left">
                                            <select name="state_dd" id="state_dd" class="select">
                                                <option value="">Select Country first</option>    
                                                <?php echo get_state_dd(set_value('country',$m_dataset['i_country']),set_value('state_dd',$m_dataset['i_state'])); ?>
                                            </select>
                                        </td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('state_dd','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>City :</td>
                                        <td valign="top" align="left">
                                            <input type="text" class="fild" name="city" id="city" value="<?php echo set_value('city',$m_dataset['s_city']) ?>">
                                            <?php 
                                                /* 
                                                <select style="margin-top:8px;" class="select" name="">
                                                <option value="a">a</option>
                                                <option value="s">s</option>
                                                </select> 
                                                */
                                            ?>
                                        </td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('city','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Zip :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="zip" id="zip" value="<?php echo set_value('zip',$m_dataset['s_zip']) ?>"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('zip','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                </div>
                <div class="clear"></div>
                </div>

                <!-- Sign up form section 1 end -->
 <div class="sign_up">
                        <h1>Your Others Information</h1>
                        <div class="sign_up_form">
                            <table width="700" cellspacing="8" cellpadding="0" border="0">

                                <tbody><tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Username :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="username" id="username" value="<?php echo set_value('username',$m_dataset['s_username']); ?>">
                                        <span class="small" style="color: #333;">To Change user name you must enter the old password</span>  </td>

                                        <td valign="top" align="left" class="error"><?php echo form_error('username','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Old Password :</td>
                                        <td valign="top" align="left"><input type="password" class="fild" name="password" id="password"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('password','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Password :</td>
                                        <td valign="top" align="left"><input type="password" class="fild" name="npassword" id="npassword"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('npassword','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Confirm Password :</td>
                                        <td valign="top" align="left"><input type="password" class="fild" name="cnpassword" id="cnpassword"></td>
                                        <td valign="top" align="left" class="error"><?php echo form_error('cnpassword','<div class="login_error">','</div>'); ?></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" align="right">&nbsp;</td>
                                        <td valign="top" align="left"><input type="submit" class="submit_buttton" value="Submit" name="" onclick="return valid_check();"></td>
                                        <td valign="top" align="left">&nbsp;</td>
                                    </tr>
                                </tbody></table>
                        </div><div class="clear"></div>
                    </div>                 
                 
                 </form>
                <div class="clear"></div>
                </div>
                               
     
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
