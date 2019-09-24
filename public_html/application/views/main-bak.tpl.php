<?php
//Set no caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache"); 
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//header("Cache-Control: post-check=0, pre-check=0", false);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url()?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
        <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
        <?php 
            //header("Cache-Control: no-cache, must-revalidate");
            //header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        ?>
        <title><?php echo $s_title; ?></title>
        <script type="text/javascript" >
            var base_url = "<?php echo base_url(); ?>";
            var admin_url = "<?php echo admin_url(); ?>";
        </script>   
        <script type='text/javascript' src='<?php echo base_url(); ?>js/admin/jquery.min.js'></script>
        <?php echo $s_js; ?>
        <?php echo $s_css; ?>
    </head>
    <body>
        <div class="mpi_main">
            <div class="mpi_wraper">
                <!-- START left pannel -->
                <?php echo $s_left_panel; ?>
                <!-- END left pannel -->                
                <div class="right_contain">
                
                    <!-- START HEADER PART -->
                    <?php echo $s_header; ?>
                    <!-- END HEADER PART --> 
                     
                    <!-- START mid pannel -->
                    <?php echo $s_tpl_data; ?>
                    <!-- END mid pannel -->
                    
                    <!-- START footer PART -->
                    <?php echo $s_footer; ?>
                    <!-- START footer PART -->

                    <div class="clear"></div>
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="mpi_button"></div>
    </body>
</html>
