<?php  //pr($m_dataset); ?>
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
</script>
<div class="body-section">
    <?php if(!empty($s_err_msg)){ 
            echo $s_err_msg;
        }
    ?>
    <?php echo show_msg(); ?>
    <div class="body-topsec">
        <div class="body-topleft"><img width="170" height="565" alt="" src="images/banner.gif"></div>
        <div class="body-topright">

            <div class="blog-sec">

                <!-- Sign up heading -->
                <h2><span>A</span>ccount Management</h2>

                <!-- Sign up form section 1 -->
                <form id="myaccnt_info" name="myaccnt_info" action="" method="post" enctype="multipart/form-data">

                    <div class="sign_up">
                        <h1 style="background:url(images/persinal_bullet.jpg) no-repeat left top;">Personal Details</h1>
                        <div class="sign_up_form">
                            <table width="700" cellspacing="8" cellpadding="0" border="0">
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
                                </tbody></table>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- Sign up form section 1 end -->
                    <div class="sign_up">
                        <h1 style="background:url(images/info_bullet.png) no-repeat left top;">Your Others Information</h1>
                        <div class="sign_up_form">
                            <table width="700" cellspacing="8" cellpadding="0" border="0">

                                <tbody><tr>
                                        <td valign="top" align="right" class="text"><span class="requar">*</span>Username :</td>
                                        <td valign="top" align="left"><input type="text" class="fild" name="username" id="username" value="<?php echo set_value('username',$m_dataset['s_username']); ?>">
                                        <span class="small">To Change user name you must enter the old password</span>  </td>

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
                <!-- Sign up form section 3 end -->

                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div> 

    <div class="clear"></div>
</div>

<?php /*
    <div class="body-section">
    <div class="body-topsec">
    <div class="body-topleft"><img src="<?php echo base_url() ?>images/banner.gif" alt="" width="170" height="565" /></div>
    <div class="body-topright">

    <div class="blog-sec">
    <!-- Sign up heading -->
    <h2><span>S</span>ign Up</h2>
    <form name="signup" id="signup" enctype="multipart/form-data" action="" method="post"> 
    <!-- Sign up form section 1 -->
    <div class="sign_up">
    <h1 style="background:url(images/persinal_bullet.jpg) no-repeat left top;">Personal Details</h1>

    <div class="sign_up_form">

    <table width="700" border="0" cellspacing="8" cellpadding="0">
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>First Name :</td>
    <td align="left" valign="top"><input name="fname" id="fname" type="text" class="fild" value="<?php echo set_value('fname'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('fname'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Last Name :</td>
    <td align="left" valign="top"><input name="lname" id="lname" type="text" class="fild" value="<?php echo set_value('lname'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('lname'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Gender :</td>
    <td align="left" valign="top">
    <select name="gender" class="select" style="width: 80px;">
    <?php echo get_dd(array('Male'=>'Male','Female'=>'Female'),set_value('gender')); ?>
    </select>
    </td>
    <td align="left" valign="top" class="error"><?php echo form_error('gender'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Address :</td>
    <td align="left" valign="top"><input name="address" id="address" type="text" class="fild" value="<?php echo set_value('address'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('address'); ?></td>
    </tr>

    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Country :</td>     
    <td align="left" valign="top">
    <select id="country" name="country" class="select" onchange="fetchState(this,'state_dd');">
    <option value="">Select Country</option>    
    <?php echo get_country_dd(set_value('country')); ?>
    </select>
    <!--    <input name="state_dd" id="country_text" type="text" class="fild" style="display: none;margin-top:8px;"/>   -->
    </td>

    <td align="left" valign="top" class="error"><?php echo form_error('country'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>State :</td>
    <td align="left" valign="top"> 
    <select name="state_dd" id="state_dd" class="select">
    <option value="">Select Country first</option>    

    </select>
    <!--    <input name="state_dd" id="state_dd_text" type="text" class="fild" style="display: none;"/>   -->
    </td></td>
    <td align="left" valign="top" class="error"><?php echo form_error('state_dd'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>City :</td>
    <td align="left" valign="top">
    <input name="city" id="city" type="text" class="fild" value="<?php echo set_value('city'); ?>"/>
    <?php 
    /*
    <select name="city" class="select" style="margin-top:8px;">
    <option value="a">a</option>
    <option value="s">s</option>
    </select>
    * / 
    ?>  
    </td>
    <td align="left" valign="top" class="error"><?php echo form_error('city'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Zip :</td>
    <td align="left" valign="top"><input name="zip" id="zip" type="text" class="fild" value="<?php echo set_value('zip'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('zip'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>E-mail :</td>
    <td align="left" valign="top"><input name="email" id="email" type="text" class="fild" value="<?php echo set_value('email'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('email'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Phone No. :</td>
    <td align="left" valign="top"><input name="phone_no" id="phone_no" type="text" class="fild" value="<?php echo set_value('phone_no'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('phone_no'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Username :</td>
    <td align="left" valign="top"><input id="username" name="username" type="text" class="fild" value="<?php echo set_value('username'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('username'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Password :</td>
    <td align="left" valign="top"><input name="pass" id="pass" type="password" class="fild" value="" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('pass'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Confirm Password :</td>
    <td align="left" valign="top"><input name="conpass" id="conpass" type="password" class="fild" value="" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('conpass'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text">User Image :</td>
    <td align="left" valign="top"><input name="up_image" id="up_image" type="file" class="fild" border="0" /></td>
    <td align="left" valign="top" class="error"></td>
    </tr>
    </table>

    </div>
    <div class="clear"></div>
    </div>
    <!-- Sign up form section 1 end -->
    <!-- Sign up form section 2 -->
    <div class="sign_up">
    <h1 style="background:url(images/payment_bullet.jpg) no-repeat left top;">Payment Details</h1>
    <div class="sign_up_form">
    <table width="708" border="0" cellspacing="8" cellpadding="0">
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Payment Option :</td>
    <td align="left" valign="top">
    <select name="payment_opt" id="payment_opt" class="select">
    <option value="">Select a payment option</option>
    <?php echo get_payment_option(set_value('payment_opt')) ?>
    </select>
    </td>
    <td align="left" valign="top" class="error"></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Card Holder Name :</td>
    <td align="left" valign="top"><input name="cardholdername" id="cardholdername" type="text" class="fild" value="<?php echo set_value('cardholdername'); ?>" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('cardholdername'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Card No. :</td>
    <td align="left" valign="top"><input name="cardno" id="cardno" type="text" class="fild" value="<?php echo set_value('cardno'); ?>"/></td>
    <td align="left" valign="top" class="error"><?php echo form_error('cardno'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Card Epire Date :</td>
    <td align="left" valign="top">
    <select name="exp_month" id="exp_month" class="select" style="width:80px;">
    <option value="">Month</option>
    <?php
    for($i_indx=1; $i_indx<13; $i_indx++) {
    $m_month[$i_indx] = str_pad($i_indx,2,'00',0);
    }
    echo get_dd($m_month, set_value('exp_month',$exp_month_id)); 
    ?>
    </select>
    <select name="exp_year" id="exp_year" class="select" style="width:120px; margin-left:15px;">
    <option value="">Year</option>
    <?php
    $i_inc = 0;
    for($i_indx=date('Y'); $i_indx<(date('Y')+15); $i_indx++) {
    $m_year[date('y')+$i_inc++] = $i_indx;
    }
    echo get_dd($m_year, set_value('exp_year',$exp_year_id)); 
    ?>
    </select>
    </td>
    <td align="left" valign="top" class="error"><?php form_error('exp_month')." ".form_error('exp_year') ?></td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>CVV2 No. :</td>
    <td align="left" valign="top"><input name="ccvno" id="ccvno" type="text" class="fild" style="width: 82px;" value="<?php echo set_value('ccvno'); ?>" /><a class="tooltip" href="#"><img src="<?php echo base_url() ?>images/question.png" alt="" align="absmiddle" style="padding-left:2px; border:0;" /><span class="classic">&nbsp;</span></a></td>
    <td align="left" valign="top" class="error"><?php echo form_error('ccvno'); ?></td>
    </tr>
    </table>
    </div>
    <div class="clear"></div>
    </div>
    <!-- Sign up form section 2 end -->
    <div class="sign_up">
    <h1 style="background:url(images/vari_bullet.jpg) no-repeat left top;">Verify Your Self</h1>
    <div class="sign_up_form">
    <table width="700" border="0" cellspacing="8" cellpadding="0">
    <tr>
    <td align="right" valign="top" class="text">&nbsp;</td>
    <td align="left">
    <img id="captchaimg" src="<?php echo base_url(); ?>images/captchaimage.php" style="width:290px;" alt="" />
    <a href="javascript:void(0)" onclick="$('#captchaimg').attr('src','<?php echo base_url(); ?>images/captchaimage.php?timestamp=' + new Date().getTime())" title="refresh captcha" rel="tip" >
    <img src="<?php echo base_url().'images/refresh.png' ?>" alt="" width="16" />
    </a>
    </td>
    <td align="left" valign="top" class="error">&nbsp;</td>
    </tr>
    <tr>
    <td align="right" valign="top" class="text"><span class="requar">*</span>Type the code :</td>
    <td align="left" valign="top"><input name="captcha" id="captcha" type="text" class="fild" placeholder="Enter the code exactly as shown above" /></td>
    <td align="left" valign="top" class="error"><?php echo form_error('captcha'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="middle" class="text"><input name="agree" id="agree" type="checkbox" value="" /></td>
    <td align="left" valign="top" class="term">I Agree with the <a href="javascript:void(0);">Terms and Conditions</a>.</td>
    <td align="left" valign="top" class="error"><?php echo form_error('agree'); ?></td>
    </tr>
    <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td align="left" valign="top"><input name="" type="submit" value="Submit" class="submit_buttton" onclick="return valid_check();" /></td>
    <td align="left" valign="top">&nbsp;</td>
    </tr>
    </table>
    </div><div class="clear"></div>
    </div>
    <!-- Sign up form section 3 end -->
    </form>
    <div class="clear"></div>
    </div>

    <div class="clear"></div>
    </div>
    <div class="clear"></div>
    </div> 

    <div class="clear"></div>
    </div>

*/ ?>