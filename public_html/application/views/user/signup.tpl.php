<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("div.slide_content").hide();
        //        alert($("input.slide_radio").size());
        $("input.slide_radio").live('click',function(){
            // alert($(this).parent('div').length);
            $("div.slide_content").slideUp();
            $(this).parent('div').next('div.slide_content').slideDown();
        });
        //slide_content
    })
</script>
<!--
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
-->
<script type="text/javascript">
$(function()
{
  
  
    var user_type='<?php echo $user_type?>'; 
   // alert(user_type);  
  
    if(user_type==1)
    {
//$('#user_signup').show(); 
$("input[type='radio'][name='upload_radio'][value=1]").attr('checked',true); 
$('#user_signup').show(); 
     <?php 

            if(set_value('country')!=""){
            ?>
            fetchState($("#country"), 'state_dd', '<?php echo set_value('state_dd',$state_id)?>');
            <?php
            }
        ?>

//error='<?php /*echo nl2br(@$error_msg);*/?>';
error='<?php echo str_replace(array("\n", "\r"), '', @$error_msg);?>';
//error = error.replace(/\n/g, '<br />');
 
$.facebox('<div class="fb_div" style="color:red;background-color:#000000">'+error+'</div>');
}
if(user_type==2)
{
 $("input[type='radio'][name='upload_radio'][value=2]").attr('checked',true); 
$('#model_signup').show(); 
     <?php 

            if(set_value('m_country')!=""){
            ?>
            fetchState($("#m_country"), 'm_state_dd', '<?php echo set_value('m_state_dd',$state_id)?>');
            <?php
            }
        ?>

//error='<?php /*echo nl2br(@$error_msg);*/?>';
error='<?php echo str_replace(array("\n", "\r"), '', @$error_msg);?>';
//error = error.replace(/\n/g, '<br />');
 
$.facebox('<div class="fb_div" style="color:red;background-color:#000000">'+error+'</div>');
}
}
) ;
</script>
  <?php 
   // echo validation_errors('<div class="error closeable">', '</div>'); 
    if(!empty($s_msg)){
        echo '<div class="error closeable">'.$s_msg.'</div>';
    }
?>

 <div class="cont"> 
<div class="innerpagesarea">
    <h2 class="signup">Please sgin up here</h2>
    <div class="signuparea">
        <div class="signupformarea">
            <div class="topbg"></div>
            <div class="midbg">

                <form name="signup" id="signup" enctype="multipart/form-data" action="" method="post">
                    <div class="headingpart"><input name="upload_radio" type="radio" value="1" class="slide_radio"> For General Users</div>
                   
                    <div class="eachformpart slide_content" id="user_signup">
                        <table width="100%" cellspacing="5" cellpadding="0">
                            <tr>
                                <td width="25%" align="right" valign="middle">First Name :</td>
                                <td align="left" valign="top"><input name="fname" id="fname" type="text" class="formbox" value="<?php echo set_value('fname'); ?>" /></td>
                                <td align="left" valign="top" class=""></td> 
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Last Name :</td>    
                                <td align="left" valign="top"><input name="lname" id="lname" type="text" class="formbox" value="<?php echo set_value('lname'); ?>" /></td>
                                <td align="left" valign="top" class=""></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Gender :</td>
                                <td align="left" valign="top"><select name="gender" class="formbox" style="width: 80px;">
                                        <?php echo get_dd(array('Male'=>'Male','Female'=>'Female'),set_value('gender')); ?>
                                    </select></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Address :</td>
                                <td align="left" valign="top"><input name="address" id="address" type="text" class="formbox" value="<?php echo set_value('address'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Country :</td>
                                <td align="left" valign="top">  
                                 <select id="country" name="country" class="formbox" onchange="fetchState(this,'state_dd');">
                                        <option value="">Select Country</option>    
                                        <?php echo get_country_dd(set_value('country')); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">State :</td>
                                <td align="left" valign="top">                                  
                                <select name="state_dd" id="state_dd" class="formbox">
                                        <option value="">Select Country first</option>    

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">City :</td>
                                <td align="left" valign="top"><input name="city" id="city" type="text" class="formbox" value="<?php echo set_value('city'); ?>"/>
 </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Zip :</td>
                                <td align="left" valign="top"><input name="zip" id="zip" type="text" class="formbox" value="<?php echo set_value('zip'); ?>" /></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Email :</td>
                                <td align="left" valign="top"><input name="email" id="email" type="text" class="formbox" value="<?php echo set_value('email'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Phone Number :</td>
                                <td align="left" valign="top"><input name="phone_no" id="phone_no" type="text" class="formbox" value="<?php echo set_value('phone_no'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle">User Name :</td>
                                <td align="left" valign="top"><input id="username" name="username" type="text" class="formbox" value="<?php echo set_value('username'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Password :</td>
                                <td align="left" valign="top"><input name="pass" id="pass" type="password" class="formbox" value="" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Confirm Password :</td>
                                <td align="left" valign="top"><input name="conpass" id="conpass" type="password" class="formbox" value="" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Upload :</td>
                                <td align="left" valign="top"><input name="up_image" type="file" class="formbox1" value="No file choosen"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">&nbsp;</td>
                                <td align="left" valign="top"><input name="" type="submit" value="SUBMIT" class="besavbuton"></td>
                            </tr>
                        </table></div>
                        

                    <div class="headingpart"><input name="upload_radio" type="radio" value="2" class="slide_radio"> For Models</div>
                    <div class="eachformpart slide_content" id="model_signup"><table width="100%" cellspacing="5" cellpadding="0">
                              <tr>
                                <td width="25%" align="right" valign="middle">First Name :</td>
                                <td align="left" valign="top"><input name="m_fname" id="m_fname" type="text" class="formbox" value="<?php echo set_value('m_fname'); ?>" /></td>
                                <td align="left" valign="top" class=""></td> 
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Last Name :</td>    
                                <td align="left" valign="top"><input name="m_lname" id="m_lname" type="text" class="formbox" value="<?php echo set_value('m_lname'); ?>" /></td>
                                <td align="left" valign="top" class=""></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Gender :</td>
                                <td align="left" valign="top"><select name="m_gender" class="formbox" style="width: 80px;">
                                        <?php echo get_dd(array('Male'=>'Male','Female'=>'Female'),set_value('m_gender')); ?>
                                    </select></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Address :</td>
                                <td align="left" valign="top"><input name="m_address" id="m_address" type="text" class="formbox" value="<?php echo set_value('m_address'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Country :</td>
                                <td align="left" valign="top">  
                                 <select id="m_country" name="m_country" class="formbox" onchange="fetchState(this,'m_state_dd');">
                                        <option value="">Select Country</option>    
                                        <?php echo get_country_dd(set_value('m_country')); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">State :</td>
                                <td align="left" valign="top">                                  
                                <select name="m_state_dd" id="m_state_dd" class="formbox">
                                        <option value="">Select Country first</option>    

                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">City :</td>
                                <td align="left" valign="top"><input name="m_city" id="m_city" type="text" class="formbox" value="<?php echo set_value('m_city'); ?>" /></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Zip :</td>
                                <td align="left" valign="top"><input name="m_zip" id="m_zip" type="text" class="formbox" value="<?php echo set_value('m_zip'); ?>" /></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Email :</td>
                                <td align="left" valign="top"><input name="m_email" id="m_email" type="text" class="formbox" value="<?php echo set_value('m_email'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Phone Number :</td>
                                <td align="left" valign="top"><input name="m_phone_no" id="m_phone_no" type="text" class="formbox" value="<?php echo set_value('m_phone_no'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>

                            <tr>
                                <td align="right" valign="middle">User Name :</td>
                                <td align="left" valign="top"><input id="m_username" name="m_username" type="text" class="formbox" value="<?php echo set_value('m_username'); ?>" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Password :</td>
                                <td align="left" valign="top"><input name="m_pass" id="m_pass" type="password" class="formbox" value="" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Confirm Password :</td>
                                <td align="left" valign="top"><input name="m_conpass" id="m_conpass" type="password" class="formbox" value="" /></td>
                                <td align="left" valign="top" class="error"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle">Upload (3 pics) :</td>
                                <td align="left" valign="top"><input name="up_image1[]" multiple="multiple" type="file" class="formbox1" value="No file choosen"><input name="" type="button" value="Upload" class="browsbtn"></td>
                            </tr>
  <!--                          <tr>
                                <td align="right" valign="middle"></td>
                                <td align="left" valign="top"><input name="" type="text" class="formbox1" value="No file choosen"><input name="" type="button" value="Upload" class="browsbtn"></td>
                            </tr>
                            <tr>
                                <td align="right" valign="middle"></td>
                                <td align="left" valign="top"><input name="" type="text" class="formbox1" value="No file choosen"><input name="" type="button" value="Upload" class="browsbtn"></td>
                            </tr>
-->                            
                            <tr>
                                <td align="right" valign="middle">&nbsp;</td>
                                <td align="left" valign="top"><input name="" type="submit" value="SUBMIT" class="besavbuton" style="margin-left:5px;"></td>
                            </tr>
                        </table></div>
                </form></div>
            <div class="botombg"></div>
        </div>
    </div>
</div>