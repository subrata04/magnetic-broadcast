<?php //Set no caching
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url()?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $s_title; ?></title>
        <script type="text/javascript" >
            var base_url = "<?php echo base_url(); ?>";
        </script>
        <link href="<?php echo base_url()?>css/admin/site_admin.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>css/admin/custom.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='<?php echo base_url(); ?>js/admin/jquery.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>js/admin/jquery-ui.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>js/admin/custom.js'></script>
        <?php // echo $s_js; ?>
        <?php // echo $s_css; ?>
    </head>


    <body>
    <?php
    echo $page_name;
?>
        <div class="wrapper">
            <div class="logo_login">
                <a href="<?=admin_url()?>"><img src="images/admin/logo.png" alt="" border="0" /></a>
            </div>
            <div class="login-area">
                <div class="loginsection">
                    <div class="login_con">
                        <div class="loginheading">Forgot password</div>
                        <form id="login-form" action="" method="post">
                            <?php 
                                echo validation_errors('<div class="error closeable">', '</div>'); 
                                if(!empty($s_msg)){
                                    echo '<div class="error closeable">'.$s_msg.'</div>';
                                }
                                echo show_msg();
                            ?>         
                            <div class="clear"></div>                                          
                            <label for="name">Email</label>
                            <input type="text" id="email" name="email" class="input-medium" value="" />
                             <div class="clear"></div> 
                             <label for="name">&nbsp;</label> 
                            <span class="small">Enter your email to recover password.</span>
                            <div class="clear"></div>
                            <label>&nbsp;&nbsp;&nbsp;</label>
                            <input class="button" name="submit" type="submit" value="Send"/>                
                        </form>
                        <div class="clear"></div>
                    </div>  
                    <div class="clear"></div>
                </div>      
                <div class="clear"></div>
            </div>
            <div class="push"></div>
            <div class="clear"></div>
        </div>

        <!-- Footer Starts -->
        <div id="footerHolder">&copy; Copyright Company name. All Rights Reserved.</div>
        <!-- Footer Ends -->
    </body>
</html>
