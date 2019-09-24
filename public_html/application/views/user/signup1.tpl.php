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
                                            */ 
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
                                    <td align="right" valign="top" class="text"><span class="requar">*</span>Offer :</td>     
                                    <td align="left" valign="top">


                                        <?php echo get_configure(set_value('configure')); ?>

                                        <!--    <input name="state_dd" id="country_text" type="text" class="fild" style="display: none;margin-top:8px;"/>   -->
                                    </td>

                                    <td align="left" valign="top" class="error"><?php echo form_error('configure'); ?></td>
                                </tr>
                                <tr style="display: none;">
                                    <td align="right" valign="top" class="text"><span class="requar">*</span>Price :</td>
                                    <td align="left" valign="top" class="offPrc">&nbsp;sdds</td>
                                    <td align="left" valign="top" class="error">&nbsp;</td>
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
                    <?php 
                        $count= getCountPrice();
                        if ($count>0)
                        {
                        ?>

                        <!-- Sign up form section 2 -->

                        <div class="sign_up" id="pay1">
                            <h1 style="background:url(images/payment_bullet.jpg) no-repeat left top;">Payment Details</h1>
                            <div class="sign_up_form">
                                <table width="708" border="0" cellspacing="8" cellpadding="0">
<!--                                    <tr>
                                        <td align="right" valign="top" class="text"><span class="requar">*</span>Payment Option :</td>
                                        <td align="left" valign="top">
                                            <select name="payment_opt" id="payment_opt" class="select">
                                                <option value="">Select a payment option</option>
                                                <?php echo get_payment_option(set_value('payment_opt')) ?>
                                            </select>
                                        </td>
                                        <td align="left" valign="top" class="error"></td>
-->                                    </tr>
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
                        <?php }?>
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
                                    <td align="left" valign="top" class="term">I Agree with the <a href="javascript:void(0);" onclick="show_terms_condition()">Terms and Conditions</a>.</td>
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