<?php echo validation_errors("<div class='error'>", "</div>"); ?>
<div class="banner2">    
    <?php // pr($_SESSION) ?>
    <img src="images/ban_top.png" alt="" />
    <form id="page_form" action="" enctype="multipart/form-data" method="post">
        <div class="banner_shead">
            <div class="banner_shead_left">
                <div class="accordion-1">
                    <dl>
                        <dt id="1st_head">First Step</dt>
                        <dd><h2>Personal Information</h2>
                            <div class="login_form">
                                <div class="blok">
                                    <label class="blok_text">First Name</label>
                                    <label>
                                        <input name="fname" type="text" class="blok_fild" id="fname" title="" value="<?php echo set_value('fname') ?>" />
                                    </label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Last Name</label>
                                    <label>
                                        <input name="lname" type="text" id="lname" class="blok_fild" title="" value="<?php echo set_value('lname') ?>" />
                                    </label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Current phone No.</label>
                                    <label>
                                        <input name="mob_no" type="text" id="mob_no" class="blok_fild" title="" value="<?php echo set_value('mob_no') ?>" />
                                    </label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Current email id.</label>
                                    <label>
                                        <input name="email" type="text" id="email" class="blok_fild" title="" value="<?php echo set_value('email') ?>" />
                                    </label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Gender</label>
                                    <label>
                                        <select name="gender" class="blok_fild" id="gender" >
                                            <?php
                                                $m_gender = array('Female' => 'Female', 'Male' => 'Male');
                                                echo get_dd($m_gender);
                                            ?>
                                        </select>
                                    </label>
                                </div>
                                <?php /*
                                    <div class="blok">
                                    <label class="blok_text">Your Birth day</label>
                                    <label>
                                    <input name="b_date" id="inputDate" title="" style="width: 100px;" type="text" class="blok_fild" value="<?php echo date('d/m/Y') ?>"  />
                                    </label>
                                    </div>
                                */ ?>
                                <div class="blok">
                                    <label class="blok_text">Country</label>
                                    <label>
                                        <select name="country" class="blok_fild" id="country_dd" onchange="javascript:fetchState(this, 'state_dd')" >
                                            <option  value="">Select Country</option>
                                            <?php echo get_country_dd(); ?>                                        
                                        </select>
                                    </label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">State</label>
                                    <label>
                                        <select name="state_dd" class="blok_fild state_dd" id="state_dd" >
                                            <option value="">Select Country First</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">&nbsp;</label>
                                    <label>
                                        <input name="" type="button" class="but" value="Next" onclick="javascript:firstFormCheck();" />
                                    </label>
                                </div>
                            </div>
                        </dd>
                        <dt id="2nd_head">Second Step</dt>
                        <dd >
                            <h2>Account Information</h2>
                            <div class="login_form">                            
                                <div class="blok">
                                    <label class="blok_text">Choose Username </label>
                                    <label><input name="username" id="username" type="text" class="blok_fild" value="<?php echo set_value('username') ?>" /></label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Choose Password </label>
                                    <label><input name="pass" id="pass" type="password" class="blok_fild" /></label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Confirm Password</label>
                                    <label><input name="conpass" type="password" id="conpass" class="blok_fild" /></label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">Security Code</label>
                                    <label><img src="<?php echo base_url(); ?>images/captchaimage.php" alt="" /></label>
                                </div>
                                <div class="blok">
                                    <label class="blok_text">&nbsp;</label>
                                    <label><input name="captcha" id="captcha" type="text" class="blok_fild" style="text-align:center;" /></label>
                                </div> 
                                <div class="blok">
                                    <label class="blok_text">&nbsp;</label>
                                    <label>
                                        <input name="back" type="button" class="but" value="Back" style="margin-right: 15px" onclick="gotoFirst()" />&nbsp;</label><label>
                                        <input name="next" type="button" class="but" value="Next" onclick="javascript:secondFormCheck();" /></label>
                                </div>
                                <div class="blok">
                                    <span class="imp" ><?php // echo !empty($s_msg_captcha)?$s_msg_captcha:""; ?></span>
                                </div>
                            </div>
                        </dd>
                        <dt id="3rd_head">Third Step</dt>
                        <dd><h2>Join As</h2>
                            <div class="login_form">
                                <div class='mycustomscroll'>

                                    <div class="blok">
                                        <!--<label class="blok_text">I am as </label>  -->                                  
                                        <input name="user_type" type="radio" value="<?php echo strEncode(PROMOTER_ROLE); ?>" id="opt1" <?php echo set_radio('user_type', strEncode(PROMOTER_ROLE)); ?> /> <span class="user_role">Promoter</span>
                                        <input name="user_type" type="radio" value="<?php echo strEncode(PROMOTER_PRO_ROLE); ?>" id="opt2" <?php echo set_radio('user_type', strEncode(PROMOTER_PRO_ROLE)); ?> /> <span class="user_role">Promoter Pro</span>
                                        <input name="user_type" type="radio" value="<?php echo strEncode(FREE_AFFILIATE_ROLE); ?>" id="opt3" <?php echo set_radio('user_type', strEncode(FREE_AFFILIATE_ROLE)); ?> /> <span class="user_role">Free Affiliate</span> 
                                        <div class="clr"></div> 
                                        <div id="err_msg"></div>
                                        <input type="hidden" id='enr_fee' name="enr_fee" />
                                    </div>

                                    <div id="main_cont" style="display: none;">
                                        <div>
                                            <div class="blok_text2 show_details">Select a Package</div>
                                            <div class="clr"></div> 

                                            <div class="blok tggl_div" id="prod_div">
                                                <!--***************************Start product list********************************* -->
                                                <div class="arrowlistmenu">
                                                    <?php
                                                        //pr($m_data_set); 
                                                        foreach ($m_data_set as $m_row) {
                                                        ?>
                                                        <h3 class="menuheader show_hide" ><?php echo $m_row['s_title'] ?></h3>
                                                        <ul class="categoryitems">
                                                            <?php
                                                                if (count($m_row['package_details'])) {
                                                                    foreach ($m_row['package_details'] as $m_row_pack) {
                                                                    ?>
                                                                    <li class="parentLi">
                                                                        <img src="<?php echo config_item('pacakage_image_thumb_url') . $m_row_pack['s_image_name'] ?>" height="50" alt="" align="right" />
                                                                        <h4 class="prodChk">
                                                                            <input type="checkbox" name="sel_prod[]" class="sel_prod" value="<?php echo strEncode($m_row_pack['id']); ?>" <?php echo set_checkbox('sel_prod[]', strEncode($m_row_pack['id'])); ?> />
                                                                            <a href="javascript:void(0)" target="_blank">
                                                                                <?php echo $m_row_pack['s_title'] ?>
                                                                            </a>
                                                                            <input type="hidden" class="prodTitle" value="<?php echo $m_row_pack['s_title'] ?>" />
                                                                            <input type="hidden" class="prodDetails" value="<?php echo $m_row_pack['s_product_details'] ?>" />
                                                                            <input type="hidden" class="prodImg" value="<?php echo config_item('pacakage_image_thumb_url') . $m_row_pack['s_image_name'] ?>" />
                                                                            <input type="hidden" class="prodPrice" value="<?php echo $m_row_pack['f_price'] ?>" />
                                                                        </h4>
                                                                        <p>
                                                                            <?php echo $m_row_pack['s_product_details'] ?>
                                                                        </p>
                                                                        <strong>
                                                                            Price : $ <span>
                                                                                <?php echo $m_row_pack['f_price'] ?>
                                                                            </span>
                                                                        </strong>
                                                                    </li>
                                                                    <?php
                                                                    }
                                                                } else {
                                                                ?>
                                                                <li>
                                                                    <h4>No package details found.</h4>
                                                                </li>
                                                                <?php } ?>
                                                        </ul>
                                                        <?php
                                                        }
                                                    ?>
                                                    
                                                    <div class="clr"></div>
                                                </div>
                                                <!--***************************end product list********************************* -->
                                            </div>
                                        </div>

                                        <!--***************************Start billing add********************************* -->
                                        <div>
                                            <div class="blok_text2 show_details">Billing & Shipping Info</div>
                                            <div class="clr"></div>

                                            <div class="blok tggl_div"  id="billing_div" >
                                                <div class="blok">
                                                    <label class="blok_text"><strong>Billing Information :</strong></label>
                                                    <div class="clr"></div>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">First Name :</label>
                                                    <label>
                                                        <input name="b_fname" id="b_fname" type="text" class="blok_fild" value="<?php echo set_value('b_fname') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Last Name :</label>
                                                    <label>
                                                        <input name="b_lname" id="b_lname" type="text" class="blok_fild" value="<?php echo set_value('b_lname') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Address :</label>
                                                    <label>
                                                        <input name="b_addr" id="b_addr" type="text" class="blok_fild" value="<?php echo set_value('b_addr') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Country :</label>
                                                    <label>
                                                        <select name="b_country_dd" class="blok_fild" id="b_country_dd" onchange="javascript:fetchState(this, 'b_state_dd')" >
                                                            <option value="">Select Country</option>
                                                            <?php echo get_country_dd(); ?> 
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">State :</label>
                                                    <label>
                                                        <select name="b_state_dd" id="b_state_dd" class="blok_fild" >
                                                            <option value="">Select Country first</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Zip/Postal Code :</label>
                                                    <label>
                                                        <input name="b_zip" id="b_zip" type="text" class="blok_fild" value="<?php echo set_value('b_zip') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Telephone :</label>
                                                    <label>
                                                        <input name="b_tele" id="b_tele" type="text" class="blok_fild" value="<?php echo set_value('b_zip') ?>" />
                                                    </label>
                                                </div>
                                            </div>
                                            <!--***************************end Billing add********************************* -->
                                            <!--***************************Start ship add********************************* -->
                                            <div class="blok tggl_div" id="shipping_div">
                                                <div class="blok">
                                                    <label class="blok_text"><strong>Shipping Information :</strong></label>
                                                    <div class="clr"></div>
                                                    <label>
                                                        <input name="same_fill" onclick="copy_to_shipping('same_fill')" id="same_fill" type="checkbox" /> Same as billing address
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">First Name :</label>
                                                    <label>
                                                        <input name="s_fname" id="s_fname" type="text" class="blok_fild" value="<?php echo set_value('s_fname') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Last Name :</label>
                                                    <label>
                                                        <input name="s_lname" id="s_lname" type="text" class="blok_fild" value="<?php echo set_value('s_lname') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Address :</label>
                                                    <label>
                                                        <input name="s_addr" id="s_addr" type="text" class="blok_fild" value="<?php echo set_value('s_addr') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Country :</label>
                                                    <label>
                                                        <select name="s_country_dd" id="s_country_dd" class="blok_fild" onchange="javascript:fetchState(this, 's_state_dd')"  >
                                                            <option value="">Select Country</option>
                                                            <?php echo get_country_dd(); ?> 
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">State :</label>
                                                    <label>
                                                        <select name="s_state_dd" id="s_state_dd" class="blok_fild" >
                                                            <option value="">Select Country first</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Zip/Postal Code :</label>
                                                    <label>
                                                        <input name="s_zip" id="s_zip" type="text" class="blok_fild" value="<?php echo set_value('s_zip') ?>" />
                                                    </label>
                                                </div>
                                                <div class="blok">
                                                    <label class="blok_text">Telephone :</label>
                                                    <label>
                                                        <input name="s_tele" id="s_tele" type="text" class="blok_fild" value="<?php echo set_value('s_tele') ?>" />
                                                    </label>
                                                </div>
                                                <div class="clr"></div>
                                                <br />
                                            </div>
                                        </div>
                                        <div class="clr"></div>
                                    </div>
                                    <!--***************************end ship add********************************* -->
                                    <div class="blok">
                                        <label class="blok_text">&nbsp;</label>
                                        <label>
                                            <input name="back" type="button" class="but" value="Back" style="margin-right: 15px" onclick="gotoSecond()" />&nbsp;</label><label>
                                            <input name="next" type="button" class="but" value="Next" onclick="javascript:thirdFormCheck();" /></label>
                                    </div>
                                    <div class="clr"></div>
                                </div>


                            </div>
                        </dd>
                        <dt id="4th_head">Forth Step</dt>
                        <dd>
                            <h2>Thank for Join with us</h2>
                            <div class="login_form">
                                <p id="cart_head" style="">
                                    Cart Details
                                </p>
                                <div id="cart_div" style="height: 180px; overflow: auto; overflow-x:hidden ;">
                                    <table border="0" cellpadding="0" cellspacing="0" class="signupCart" id="cartSignup">
                                    </table>
                                </div>   
                                <p class="blok">
                                    <input type="checkbox" name="terms" id="terms" /> 
                                    I have read and understand the <a href="common/get_terms_ajax" rel="facebox">Terms and Conditions</a> of Mpulse International
                                </p>
                                <div class="clear"></div>
                                <div class="blok">
                                    <label class="blok_text">&nbsp;</label>
                                    <label>
                                        <input name="back" type="button" class="but1" value="Back" style="margin-right: 15px" onclick="gotoThird()" />&nbsp;</label><label>
                                        <input name="next" type="button" class="but1" value="Final Submission" onclick="final_submission_form()" /></label>
                                </div>
                                <?php /*
                                    <div class="blok">  
                                    <label style="width: 100%; text-align: center;">
                                    <input style="margin-right: 15px; margin-bottom: 15px; margin-left: 122px;" name="final_submission" type="button" class="but2" value="Final Submission" onclick="final_submission_form()" />&nbsp;
                                    </label>
                                    <div class="clr"></div>
                                    <label>
                                    <input name="back" type="button" class="but1" value="Back" style="margin-left: 190px;" onclick="gotoThird()" />&nbsp;
                                    </label>
                                    <div class="clr"></div>
                                    </div>
                                */?>
                                <div class="clr"></div>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="banner_shead_right">
                <div class="accordion2">
                    <h3 id="1st_acc_head">MPulse product 1</h3>
                    <div class="area" style="display:block;">
                        <img src="images/accor_pro.jpg" alt="" align="right" style="padding-left:10px;" />
                        <h1>Demo Text .</h1>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>

                    <h3 id="2nd_acc_head">MPulse product 2</h3>
                    <div class="area">
                        <img src="images/accor_pro.jpg" alt="" align="right" style="padding-left:10px;" />
                        <h1>Demo Text .</h1>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>

                    <h3 id="3rd_acc_head">MPulse product 3</h3>
                    <div class="area">
                        <img src="images/accor_pro.jpg" alt="" align="right" style="padding-left:10px;" />
                        <h1>Demo Text .</h1>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>

                    <h3 id="4th_acc_head">MPulse product 4</h3>
                    <div class="area">
                        <img src="images/accor_pro.jpg" alt="" align="right" style="padding-left:10px;" />
                        <h1>Demo Text .</h1>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </div>
                </div>
            </div>

        </div>
    </form>
    <img src="images/ban_bottom.png" alt="" />
</div>







<?php /*

    <script type="text/javascript">
    $(function(){
    $("input[type='radio']").click(function(){
    //alert($("#user_role2").attr("checked"));
    if($("#user_role2").attr("checked")=='checked') {
    $("#package_div").slideDown("slow");
    } else {
    $("#package_div").slideUp();
    }
    });
    });
    </script>
    <div class="about_main">
    <div class="about_top"></div>
    <div class="about_contain" style="padding:0px 15px 0px 16px; width:684px;">

    <div class="form_page" >
    <!--<h2>Add User</h2>-->
    <h3  class="user">User details</h3>
    <?php
    echo validation_errors('<div id="error">', '</div>');
    if (!empty($s_msg)) {
    echo '<div id="error">' . $s_msg . '</div>';
    }
    echo show_msg();
    //pr($m_data_set);
    ?>
    <span class="small req">[ * marked field are mandatory ]</span>
    <form class="page_form" action="" enctype="multipart/form-data" method="post">
    <div style="padding-left: 30px;">
    <label>First Name <span class="req">*</span></label>
    <input type="text" id="fname" name="fname" value="<?php echo set_value('fname'); ?>" class="input-medium"/>
    <div class="clear"></div>
    <label>Last Name <span class="req">*</span></label>
    <input type="text" id="lname" name="lname" value="<?php echo set_value('lname'); ?>" class="input-medium"/>
    <div class="clear"></div>
    <label>Gender <span class="req">*</span></label>
    <select name="gender" id="gender">
    <?php echo get_dd(array('Male' => 'Male', 'Female' => 'Female'), set_value('gender')); ?>
    </select>
    <div class="clear"></div>
    <label>Email Address <span class="req">*</span></label>
    <input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" class="input-medium"/>
    <div class="clear"></div>
    <label>Phone Number <span class="req">*</span></label>
    <input type="text" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" class="input-medium"/>
    <div class="clear"></div>
    <label>Address <span class="req">*</span></label>
    <textarea cols="10" rows="3" name="address" id="address" ><?php echo set_value('address'); ?></textarea>
    </div>
    <div class="clear"></div>
    <h3 class="pass">Login details</h3>
    <div class="clear"></div>
    <div style="padding-left: 30px;">
    <label>Username <span class="req">*</span></label>
    <input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" class="input-medium"/>
    <div class="clear"></div>
    <label>Password <span class="req">*</span></label>
    <input type="password" id="password" name="password" value="" class="input-medium"/>
    <div class="clear"></div>
    <label>Confirm Password <span class="req">*</span></label>
    <input type="password" id="repassword" name="repassword" value="" class="input-medium"/>
    <div class="clear"></div>
    </div>

    <h3 class="pay">Choose the user type</h3>
    <div style="padding-left: 30px;">
    <input type="radio" name="user_role" value="5" class="radio" id="user_role1"> <h3>Customer</h3>
    <div class="clear"></div>
    <input type="radio" name="user_role" value="3" class="radio" id="user_role2"> <h3>Promoter</h3>
    <div class="clear"></div>
    <input type="radio" name="user_role" value="4" class="radio" id="user_role3"> <h3>Free Affiliate</h3>
    <div class="clear"></div>
    <div id="package_div">
    <p>Select package from below :</p>
    <?php
    foreach ($m_data_set as $m_row_data) {
    ?>
    <p style="color: #027CC5;"><?php echo $m_row_data['s_title'] ?></p>
    <div class="clear"></div>
    <span>Available Packages :</span><br />
    <?php foreach ($m_row_data['package_details'] as $m_pkg) { //pr($m_row);   ?>

    <input type="checkbox" value="<?php echo strEncode($m_pkg['id']) ?>" name="ch_pkg[]" />
    <strong style="color: #027CC5;"><?php echo ucwords($m_pkg['s_title']) ?></strong> |
    <strong style="color: #1A4056;"><?php echo $m_pkg['s_product_details'] ?></strong> |
    <strong style="color: #5E6E96;">Price : $ <?php echo $m_pkg['f_price'] ?></strong>
    <div class="clear"></div>

    <?php } ?>
    <?php
    }
    ?>
    </div>
    <label></label>
    <input type="submit" value="Submit" name="submit" class="button">
    <div class="clear"></div>
    </div>
    </form>
    </div>


    </div>
    <div class="about_button"></div>
    </div>

*/ ?>