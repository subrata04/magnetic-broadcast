
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Magnetic Broadcast</title>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link href="css/media.css" type="text/css" rel="stylesheet" />
<link href="css/menu.css" type="text/css" rel="stylesheet" />
<link href="css/facebox.css" rel="stylesheet" type="text/css" /> 
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/facebox.js" type="text/javascript"></script>
<script src="js/jquery.blockUI.js" type="text/javascript"></script>

<script>
function  showmessage()
{
    
  $.facebox('<div style="text-align:center;">Comming sonn</div>'); 
}

   
</script>
</head>

<body>
 <div class="top-contain">
 
   <div class="main-wrapper">
   <div class="logo"><a href="<?php echo base_url(); ?>"><img src="images/newlogo.png" /></a></div>
   
   <div class="top-right-part">
  <div class="top-icon">
   
   <div class="inlogo"><img src="images/inlogo.png" /></div>
  <a href="http://influxiq.com/" target="_blank">An&nbsp;InfluxIQ&nbsp;Software&nbsp;Product</a>
     <!--<a href="javascript:void(0)" onclick="showmessage()"><img src="images/i1.png" alt="#" /></a>
        <a href="javascript:void(0)" onclick="showmessage()"><img src="images/i2.png" alt="#" /></a>
         <a href="javascript:void(0)" onclick="showmessage()"><img src="images/i3.png" alt="#" /></a>
          <a href="javascript:void(0)" onclick="showmessage()"><img src="images/i4.png" alt="#" />-->
     </div>
   
     <div class="top-menu">
     
      <nav id="nav" role="navigation">
    
    
<a href="#nav" title="Show navigation">Show navigation</a> <a href="#" title="Hide navigation">Hide navigation</a>
<ul class="clearfix">
  <li><a href="<?php echo base_url() ?>">Home</a></li>         


  <li><a <?php echo ($s_menu_id=="front_home" && $s_sub_menu_id=="front_home_packages")?"class='active'":""; ?> href="<?php echo base_url(); ?>home/packages.html">Packages</a></li>     
  <li><a <?php echo ($s_menu_id=="front_home" && $s_sub_menu_id=="front_home_about")?"class='active'":""; ?> href="<?php echo base_url(); ?>home/about.html">About</a></li>         
  <li><a <?php echo ($s_menu_id=="front_home" && $s_sub_menu_id=="front_home_contactus")?"class='active'":""; ?> href="<?php echo base_url(); ?>home/contactus.html">Contact Us</a></li>
  
 <!--   <li><a href="http://influxiq.com/" target="_blank">An&nbsp;InfluxIQ&nbsp;Software&nbsp;Product</a></li>-->

  </ul>
</nav>
<div class="clear"></div>
     
     </div>
     
      
   <div class="clear"></div>
   
   </div>
   
    <div class="clear"></div>
   
 </div>
  </div>