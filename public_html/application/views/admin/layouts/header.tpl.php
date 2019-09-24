<script type="text/javascript">
    jQuery(document).ready(function(){


        var windowwidth = jQuery(window).width(); 
        //alert(windowwidth);
        jQuery('.wrapper').css('width',windowwidth);




    });

    function change_email()
    {
        email='<?php echo getEmail()?>' ;

        //alert(email);
        $.facebox('<div id="fbcontent" class="fb_div" style="width: 400px;text-align: left;"><h2>Change Email</h2><div class="clear"></div><div style="color:red;" id="err_msg"></div><label><span style="border-bottom: none;">Email : </span><input type="text" id="email" class="input-medium" value="'+email+'" name="email" /></label><input type="button" value="Save" name="submit" class="button" onclick="submit_email();" /><input type="button" value="Close" name="button" class="button" onclick="closeFbDiv()" /></div><div class="clear"></div></div>')
    }


    function submit_email()
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        $('#err_msg').html(''); 
        email1=$('#email').val(); 
        // alert(email1);
        if(email1=='')
            {
            $('#err_msg').text('Please enter email id'); 
            $('#email').focus();  
        }
        else if(!emailReg.test(email1 ))
            {
            $('#err_msg').text('Please enter valid email id'); 
            $('#email').focus();  

        }
        else
            {



            //  alert(email1);
            // alert(email1) ; 
            $.post('<?php echo admin_url()?>home/changeEmail',
            {'email':email1},
            function(result)
            {
                //alert(result);
                $.facebox('Email updated successfully'); 
                setTimeout('window.location.reload()',2000);   
            }
            );
        }
    }

 

</script>


<?php 
    $menu_access = config_item('menu_access');
    $arr_user_access  = get_ses_data('i_roles');
?>
<div id="head">
    <div class="logo_login"><a href="<?php echo admin_url();?>home.html"><img src="images/logo.png" style="max-height: 90px; max-width: 250px;" alt="" border="0" /></a></div>
    <div class="head_memberinfo">
        <!--<div class="head_memberinfo_logo">
        <span></span>
        <img src="images/unreadmail.png" alt=""/>        </div>-->
        <span class='memberinfo_span'>Welcome <a href="<?php echo admin_url();?>">Admin</a></span>

        <span class='memberinfo_span'><a href="<?php echo base_url();?>" target="_blank">Site Frontend</a></span>
     <!--   <span class='memberinfo_span'><a href="javascript:void(0);" onclick="change_email()" target="">Change Email</a></span>-->
        <span class='memberinfo_span1'><a href="<?php echo base_url()?>user/logout">Logout</a></span>

    </div>
    <!-- Navigation Section Start -->
    <div class="nav_section"><ul id="menu">    
            <li><a href="<?php echo admin_url()?>">Dashboard</a> </li>
            <li><a href="<?php echo admin_url()?>contact/listing.html">Conact Manager</a> </li>

        </ul></div>
    <!-- Navigation Section End -->
</div>
