<div class="wrapper" style="background:#3084a6; overflow:hidden;">
    
<link href="css/login_style.css" rel="stylesheet" type="text/css" />
<link href="css/login_layout.css" rel="stylesheet" type="text/css" />
<link href="css/login_media.css" rel="stylesheet" type="text/css" />

   <div class="logologin"><a href="#"><img src="images/logo.png" alt="" border="0" /></a></div>
   
<div class="login-area">
           <div class="loginsection">
          <div class="login_con">
               <div class="loginheading">Login</div>
             <form id="login-form" action="<?php echo base_url()?>user/login/<?php echo strEncode($s_redirct_url);?>" method="post">
             
             <?php if(!empty($s_msg_login)){ 
    echo '<span style="color:#ff0000;">'.$s_msg_login.'</span>';
}?>
                
                    <label for="name">Email Id</label>
                    <input class="input-medium" type="text" value="" name="email" id="name"/>
                    <div class="clear"></div>
               
                    <label for="password">Password&nbsp;</label>
                    <input class="input-medium" type="password" value="" name="password" id="password"/>
                    <div class="clear"></div>
            
               
                    <!--<label for="checkbox1" style="font-weight:normal; font-size:11px;">Remember me?</label>
                    <input type="checkbox" value="1" name="checkbox1" id="checkbox1" />-->
                    
                   <!-- <div class="forgot_pw"><a href="index-2.php">Forgot password?</a></div>-->
                    <div class="clear"></div>
                    <label>&nbsp;&nbsp;&nbsp;</label>
                    <input class="button" name="submit" type="submit" value="Login"/>                
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