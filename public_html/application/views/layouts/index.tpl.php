 <script>
 
 $(document).ready(function()
 {
   
   var flag=0;            
    $('#facebox').css('height','320px');

     //$('#facebox').css('width','800px');
     $.facebox($('#aa').html());
     $('#facebox').css('height','640px');
     $('#facebox').css('width','860px');
     $('.popup').css('width','804px');
     
     var windowwidth= $(window).width();
     
      var divmain = parseInt(windowwidth - 860);
      
            $('#facebox').css('left',parseInt(divmain/2));
            
           // alert(parseInt(divmain/2)); 
        
     setTimeout(function(){

        //alert($('.blockPage').find('iframe').attr('src'));
        $('.content').find('iframe').attr('src', $('.content').find('iframe').attr('src')+'?rel=0&autoplay=1');


    } ,3000)
    
        $(".popup").find(".content").next().click(function(){
             if(flag==0)
             {
              $('.popup').css('width','40%');  
        
         // alert(1);
        $('.content').find('iframe').attr('src', $('.content').find('iframe').attr('src')+'?rel=0&autoplay=1');
         $('html, body').animate({ scrollTop: $(".form-body").offset().top-100 }, 1000);
        //$(window).scrollTop($('#signupform').position().top);
        $(".form-body input").first().focus();
        //$(".input1").focus();
         flag=1;
        return false;
             } 
    });
     
  $("#s_country").val(254);   
  fetchState( $("#s_country"),'state');   
 });
 
function gotop()
{
    
   $('html, body').animate({ scrollTop: $(".form-body").offset().top-100 }, 1000);
        //$(window).scrollTop($('#signupform').position().top);
        $(".form-body input").first().focus();
        //$(".input1").focus();

        return false; 
} 
 
function popsup(e)
{
  //alert(e);  
  //$.facebox("e"); 
  
       $('.popup').css('width','40%');   
    if(e==1)
    $.facebox("<div style='text-align:left; padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Welcome Page Customization</strong> <img src='images/b1.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>Add a personalized welcome message for all users with the option to add an image as well.</div>");
     if(e==2)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Activity Report Panel</strong> <img src='images/b2.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>Track all posts from social broadcasts - you will be able track the total number of posts, clicks from links, and conversions.</div> <div style='padding:15px 0 0 15px'>- Date Range: You can select date ranges and see statistics corresponding to those dates.</div> <div style='padding:15px 0 0 15px'>- Full Report: Sectionalized by Social Media - this will show you the actual post, time sent, clicks, conversions, and if open channel is enabled..</div>");

      if(e==3)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Scheduled Post</strong> <img src='images/b3.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>Will show pending posts - this shows the actual post, scheduled date, selected social media, and open channel option. </div> <div style='padding:15px 0 0 15px'>-  Add new post - post title, post content, scheduled date, scheduled time, selected social media, and open channel option.</div> ");

     if(e==4)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Marketing Code</strong> <img src='images/b4.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>Add banners for distributors to select. These banners will automatically identify with distributor's ID in posts. When customers select the banner, it will bring them to the distributor's opportunity page, rather than the admin's.</div> ");

    
     if(e==5)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Distributor's Info Tab</strong> <img src='images/b5.png' style='display:block; margin:0px auto; margin-bottom:10px;'/> - Show Top 3 Social Media Broadcasting Tech. This will show their Rep ID, phone number, address, email, and opportunity page. </br></br>- Active Downline: Shows total number of users that are currently subscribed to the SM Broadcasting Tech with activity report and rep ID. </br></br>- Non-Active Downline: Shows total number of users that are not currently subscribed to SM Broadcasting Tech with their rep ID.</div> ");


       if(e==6)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Home Page Tab</strong> <img src='images/b6.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>  -  Adminstrator Photo </br></br>-Contact Information: Email, Mobile, Skype, Website address </br></br>-Posts: Add specific downline, photos, and videos.</br></br>-News Feed: Most recent feeds from downlines. </br></br>-Statistics Report: Shows current users, users offline, number of non-active members, total post in the last 30, 60, and 90 days, and top users.</br></br>-Calendar Events specific to admin or all users.</div> ");

    
      if(e==7)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Add Social Media Accounts</strong> <img src='images/b7.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>  This displays social media accounts added from admin. Also shows SM available for distributors to use.</div> ");

         if(e==8)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Invite Downline</strong> <img src='images/b8.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>  Shows a list of non-active distributors. Admins can do a personalized email to distributors inviting them to join the SM broadcasting or send a mass email for events.</div> ");

    
     if(e==9)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>List an Event</strong> <img src='images/b9.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>  Add an event - events displayed on this calendar will show up on all distributors' calendar.</div> ");

    
     if(e==10)                                                                                                                                                                                                                                                                                                                                        
    $.facebox("<div style='text-align:left;padding-bottom:15px;'><strong style='display:block; text-align:center; padding-bottom:15px;'>Training</strong> <img src='images/b10.png' style='display:block; margin:0px auto; margin-bottom:10px;'/>  Admin can add training Materials and make them available to distributors. They can add videos, images, links, or documents.</div> ");

    
    
    
} 
 function fetchState(obj,state_id,i_sel_id){

    //  var res_ = {};
    if(i_sel_id=='undefined')i_sel_id=0;
    i_country_id=$(obj).val();  
    id=$(obj).attr('id');
    if(i_country_id>0){
        var url = "<?php echo base_url();?>home/get_state_dd_ajax/"+i_country_id+"/"+i_sel_id;+
        $.get(url, function(msg){

            $("#"+state_id).html(msg);

            //  res_.msg=msg;  
            //  console.log(res_);

        });
        $("#"+id+"_text").hide(); 
        $("#"+state_id+"_text").hide();
        $("#"+state_id).css("display","block");
    }
    else{    
        //  $(obj).hide();

        $("#"+id+"_text").show(); 
        //   $("#"+state_id).hide();
        $("#"+state_id+"_text").show(); 

    }
    //  return res_;
}
    function contact_insert()
    {
        
        //alert($('#state').val());
/*        $('.input1').css('border','1px solid #CFCFCF');
        $('.input5').css('border','1px solid #CFCFCF');
        $('.input6').css('border','1px solid #CFCFCF'); */
        
        
        /*online1 = '';
        online2 = '';
        
        
        if($('#chk_online').is(':checked')){
            online1 = 'online';
        }                 */
        
        /*if($('#chk_online_only').is(':checked')){
            online2 = 'online_only';
        }
        */

        s_fname=$('#s_fname').val();
        s_lname=$('#s_lname').val();
        s_email=$('#s_email').val();
        s_phone=$('#s_phone').val();
        s_city=$('#s_city').val();
        state=$('#state').val();
        s_country=$('#s_country').val();
        s_zip=$('#s_zip').val();
        s_phone=$('#s_phone').val();
        s_address=$('#s_address').val();
       

        regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if(s_fname=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter First Name</p></div>');
            $('#s_fname').css('border','1px solid #FF0000');
        }
        else if(s_lname=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Last Name</p></div>');
            $('#s_lname').css('border','1px solid #FF0000');
        }
        else if(s_phone=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Contact Phone</p></div>');
            $('#s_phone').css('border','1px solid #FF0000');
        } 
        else if(s_email=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Email Address</p></div>');
            $('#s_email').css('border','1px solid #FF0000');
        }
        else if(!regex.test(s_email))
            {
            $.facebox('<div class="contacterror"><p>Please enter valid Email Address</p></div>');  
            $('#s_email').css('border','1px solid #FF0000');
        }
        
        else if(s_city=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Email Address</p></div>');
            $('#s_city').css('border','1px solid #FF0000');
        }
        
        else if(s_country=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Email Address</p></div>');
            $('#s_country').css('border','1px solid #FF0000');
        }

         else if(s_zip=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Email Address</p></div>');
            $('#s_zip').css('border','1px solid #FF0000');
        }
        
        else if(state=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Email Address</p></div>');
            $('#state').css('border','1px solid #FF0000');
        }
        else if(s_address=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Email Address</p></div>');
            $('#s_address').css('border','1px solid #FF0000');
        }
        else
            {

            $.blockUI({ 
                message: "<h1>Submitting...<img src='images/loading5.gif' alt='' /></h1>",
                css: { 
                    border: 'none', 
                    padding: '15px', 
                    backgroundColor: '#fff', 
                    '-webkit-border-radius': '10px', 
                    '-moz-border-radius': '10px', 
                    opacity: .8, 
                    color: '#CB0000' 
                } 
            }); 

            $.post('<?php echo base_url()?>home/contact',
            {s_fname:s_fname,s_lname:s_lname,s_email:s_email,s_phone:s_phone,s_city:s_city,s_zip:s_zip,s_country:s_country,state:state,s_address:s_address},
            function(result)
            {
                $.unblockUI();
                //alert(result);
                //alert(result);
                if(result==1)  
                    {
                    // setTimeout($.facebox('<div class="contacterror">You are connected comming soon !</div>'),5000);

                    $.facebox('<div class="contacterror">We will get back to you soon!</div>');

                    $('#s_fname').val('');
                    $('#s_lname').val('');
                    $('#s_email').val('');
                    $('#s_phone').val('');
                    $('#s_city').val('');
                    $('#s_zip').val('');
                    $('#s_country').val('');
                    $('#state').val('');
                    $('#s_address').val('');
                    
                    setTimeout(function() {
                        jQuery(document).trigger('close.facebox')

                    }, 5000);



                }
            }


            );
        }

    }

</script>
<div class="home-banner">
        <div class="main-wrapper">
        
        <div class="form-right-box">
        
        <div class="box-text-part">
        
        <span style="font-size:34px; display:block; line-height:40px; text-align:center; font-family:'Times New Roman', Times, serif; padding-bottom:15px; margin:0; text-shadow:none;"><span style="color:#cb0000;">Magnetic</span> Broadcast</span>


        Our #1 Goal is to Facilitate an Automated Process in Social Broadcasting Giving Your Company Optimal Marketing Impact. <br /><br />



<strong>BROADCAST YOUR MESSAGE THROUGH YOUR ORGANIZATION AND REACH MILLIONS </strong><br /><br />



OUR SOFTWARE IS TRULY MAGNETIC 
        
        </div>
        
        <div class="arrow-div">Fill Out the form to learn more!</div>
              </div>
    <div class="form-contain">

      <div class="top-heding">WANT TO KNOW MORE ?</div>

      <div class="form-body">
       <!--<span class="error">error msg</span>-->
       <input type="text" id="s_fname" placeholder="First Name" class="input1" />
       <!--<span class="error">error msg</span>-->
       <input type="text" id="s_lname" placeholder="Last Name"  class="input1"/>
      <!--<span class="error">error msg</span>-->
       <input type="text" placeholder="Phone" class="input1" id="s_phone"/>
      
      <!--<span class="error">error msg</span>-->
       <input type="text" placeholder="Email" class="input1"  id="s_email"/>
      <!--<input type="text" id="state" placeholder="State"  class="input1"/> -->
      <textarea placeholder="Address" id="s_address" class="input2"></textarea>
          <!--<label>State</label> -->
      <input type="text" id="s_city" placeholder="City"  class="input1"/> 
     <select class="input3" name="state" id="state" style="float: none; margin: 0 auto; display: block;">
        <option value="">Select Country First</option>  
    </select> 
     <input type="text" placeholder="Zip Code" id="s_zip" class="input1" />       
    <select class="input3" name="country" id="s_country" style="display: none;" onchange="fetchState(this,'state')">
        <option value="">Select Country</option>
        <?php echo get_country_dd(set_value('country')); ?>
    </select>  
    

      
      <!--<span class="error">error msg</span>-->
      
     <!-- <select class="input3" id="state">
      <option>State</option>
       <option>State</option>
        <option>State</option>
         <option>State</option>
      </select>   -->
      
      <!--<span class="error">error msg</span>-->
        
       
       <!--<span class="error">error msg</span>-->
      
            <!--<input type="text" placeholder="Country" id="s_country" class="input1" />-->
     
 
            
      
        <!--<span class="error">error msg</span>-->
       
       
        <!--<span class="error">error msg</span>-->
         
       
       <input type="submit" class="btn" onclick="contact_insert()" value="" />

      
      
      </div>
       
       <div class="form-bottom"></div>


</div>


    <div class="clear"></div>
    
    </div>
    
    </div>
    
    
    
    <div class="clear"></div>
    <div class="body-part1">
    
     <div class="main-wrapper">
<div class="text-wrapper">
  <h1>The Power to Reach Is Only a Click Away</h1>



</div>

<h2>We connect your distributors to all of the most popular social platforms for top performance marketing!</h2>

<div class="icon-div-contain">
<ul>
<li><a href="#"><img src="images/1.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/2.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/3.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/4.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/5.png"  alt="#"/></a></li>

</ul>
</div>
<div class="clear"></div>
<img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>

<h3 style="margin:25px 0;">Turn your Orgnaization into a Social <span>Broadcast Revolution</span></h3>


<img src="images/middle-img.png"  alt="#" style="width:100%; display:block; margin:25px auto;"/>

<div class="middle-text-div">
Our Social Media Broadcasting Technology is extremely powerful for organizations. Every aspect of our technology allows the organization to strengthen their relationship with their marketers and develop a loyalty to the brand. This is cutting edge technology for use in communications and posts in the social media sphere. Companies now have the 
ability to set up topic specific programming "channels" targeting both internal and external audiences. Use this to your advantage and help make consumers your own content producers that share their knowledge to countless others.

</div>


<div class="text-body-contain">
<h2>With our Social Media Broadcasting Technology you can:</h2>

<div class="div-block">
<ul>

<li>Engage your audience
at a higher level.
</li>


<li>Generate sales and
revenue.
</li>


<li>Optimize your
marketing.
</li>


<li>Increase operational
efficiency.
</li>

</ul>
<div class="clear"></div>
</div>

<div class="clear"></div>

</div>

<img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>


<h4>Administrative Features</h4>

<div class="box-div-wrapper">

<div class="div-box">
<strong>Welcome Page Customization</strong>

<div class="bimg">
<img src="images/b1.png" alt="#" />
</div>

<span>Add a personalized welcome message for all users with the option to add an image as well.</span>

<a href="javascript:void(0)" onclick="popsup(1)"><img src="images/read-more.png"  alt="#"/></a>
</div>

<div class="div-box">
<strong>Activity Report Panel</strong>

<div class="bimg">
<img src="images/b2.png" alt="#" />
</div>

<span>Track all posts from social broadcasts - you will be able track the total number of posts...</span>

<a href="javascript:void(0)" onclick="popsup(2)"><img src="images/read-more.png"  alt="#"/></a>
</div>

<div class="div-box">
<strong>Scheduled Post</strong>

<div class="bimg">
<img src="images/b3.png" alt="#" />
</div>

<span>Will show pending posts - this shows the actual post, scheduled date, selected social media...</span>

<a href="javascript:void(0)" onclick="popsup(3)"><img src="images/read-more.png"  alt="#"/></a>
</div>

<div class="div-box">
<strong>Marketing Code</strong>

<div class="bimg">
<img src="images/b4.png" alt="#" />
</div>

<span>Add banners for distributors to select. These banners will automatically identify with distributor's ID...</span>

<a href="javascript:void(0)" onclick="popsup(4)"><img src="images/read-more.png"  alt="#"/></a>
</div>


<div class="div-box">
<strong>Distributor's Info Tab</strong>

<div class="bimg">
<img src="images/b5.png" alt="#" />
</div>

<span>Show Top 3 Social Media Broadcasting Tech. This will show their Rep ID, phone number, address...</span>

<a href="javascript:void(0)" onclick="popsup(5)"><img src="images/read-more.png"  alt="#"/></a>
</div>


<div class="div-box">
<strong>Home Page Tab</strong>

<div class="bimg">
<img src="images/b6.png" alt="#" />
</div>

<span>Statistics Report: Shows current users, users offline, number of non-active members...</span>

<a href="javascript:void(0)" onclick="popsup(6)"><img src="images/read-more.png"  alt="#"/></a>
</div>

<div class="div-box">
<strong>Add Social Media Accounts</strong>

<div class="bimg">
<img src="images/b7.png" alt="#" />
</div>

<span>This displays social media accounts added from admin. Also shows SM available for distributors to use...</span>

<a href="javascript:void(0)" onclick="popsup(7)"><img src="images/read-more.png"  alt="#"/></a>
</div>

<div class="div-box">
<strong>Invite Downline</strong>

<div class="bimg">
<img src="images/b8.png" alt="#" />
</div>

<span>Shows a list of non-active distributors. Admins can do a personalized email to distributors...</span>

<a href="javascript:void(0)" onclick="popsup(8)"><img src="images/read-more.png"  alt="#"/></a>
</div>

<div class="div-box" id="spach-div">
<strong>List an Event</strong>

<div class="bimg">
<img src="images/b9.png" alt="#" />
</div>

<span>Add an event - events displayed on this calendar will show up on all distributors...</span>

<a href="javascript:void(0)" onclick="popsup(9)"><img src="images/read-more.png"  alt="#"/></a>
</div>


<div class="div-box">
<strong>Training</strong>

<div class="bimg">
<img src="images/b10.png" alt="#" />
</div>

<span>Admin can add training Materials and make them available to distributors. They...</span>

<a href="javascript:void(0)" onclick="popsup(10)"><img src="images/read-more.png"  alt="#"/></a>
</div>
<div class="clear"></div>
</div>


</div>
 
     </div>
     
     <div class="additional-body">
      <div class="main-wrapper">
      
      <h6>Additional Features</h6>
      
      <ul>
      
      <li>System will allow users to go to the scheduled posts and push certain posts that are scheduled, but not time controlled, to go out.</li>
      <li>Admins are able to schedule posts to be timing based. These posts cannot be pushed until after the time they are scheduled.</li>
      <li>System will go and run a cron that indicates the number of posts that an individual is making in their social. Instead of just broadcasting.  the broadcast is scheduled as "natural" to start with.  Each company will set their natural post (for example every 7 posts post 1 from the broadcast) </li>
      
      <li>Users can go in and change from natural to a higher post number by increasing the post number directly in their back office.  They can select this for all or just one of their social accounts it it up to them.</li>
      
      <li>Admins can assign Jr admin rights to users that are able to go in and add to or change posts that are for them and for their downlines.</li>
      
      <li>Jr Admins are also able to go in and schedule posts for areas and for their downline. Meaning opportunity and local event meetings can be scheduled into the posts and blended with the main corporate posts. </li>
      
      </ul>
      
      
      </div>     
     </div>
     
     <div class="body-bottom">
     
     
     <div class="main-wrapper">
     
     
     <img src="images/logo2.png" style="width:40%; display:block; margin:40px auto;" />
     <img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>
     
     <div class="beto-contain">
     
     <div class="contain-text">
      <h5>Beto Paredes, LLC<strong></strong></h5>
      The Magnetic Broadcast is partnered with Beto Paredes, LLC, a team that has launched over 15 Multi-Level Marketing companies. With the sophisticated technology and experience, Beto Paredes, LLC have become experts in the MLM industry. They specialize in selling to buyers through direct response and 
utilize social broadcasts to sell directly to customers. Our Direct Response Marketing System is made to allow the user to engage their audience from a number of different marketing angles. This gives them a complete set of tools and a variety of options to successfully sell to as many people as possible.
      
      <a href="http://betoparedes.com/" target="_blank" class="btn1"><img src="images/btn2.png"  alt="#"/></a>
     
     </div>
     
     </div>
     
     <div class="stev-contain">
     
     <div class="contain-text2">
      <h5>Steve Smith & Associates<strong></strong></h5>
      Magnetic Broadcasting provides the foremost MLM consulting group with Social Broadcast Technology.</br>
      The Steve Smith and Associates consulting firm is looking to reshape the industry by actively engaging and partnering with pre-existent network marketers and distributors interested in fresh, sustainable growth and profits. The principal partners, Steve Smith and Beto Paredes, are both veteran network marketing professionals and have a vast knowledge of how the industry works. Steve Smith is a master marketing expert in the MLM Industry. He is known for his acumen and seasoned experience as co-founder and CMO of the industry giant, Excel Communications.
      </br>
See what we have accomplished <a href="http://stevesmithmlm.com/" target="_blank">stevesmithmlm.com</a>
      
      <a href="http://stevesmithmlm.com/" target="_blank" class="btn2"><img src="images/btn2.png"  alt="#"/></a>
     
     </div>
     
     
     <div class="clear"></div>
     </div>
     
     
     <div class="bottom-btn">
      <a href="javascript:void(0)" onclick="gotop()"><img src="images/btn3.jpg"  alt="#"/></a>
     </div>
     
     </div>
     
     
     
     
     
     </div>
     
     
   
     
    
<div id="aa" style="z-index:99999999; display:none; ">
                                                                    
<div style="cursor:auto; background:#141817; border-radius:5px; width: 800px; height: 600px; " class="video-popup">

  
 <!--<div class="closev"><a href="#" onclick="$.unblockUI()"><img src="<?php echo $themeUrl ?>/images/close.png"  alt="#"/></a></div>-->
 
 <div class="clear"></div>
 
<strong style="color:#fff; display:block; text-align:center; padding:25px 0; font-size: 16px;">  Power to Reach Is Only A Click Away</strong> 

<iframe width="90%" height="90%" style="margin-left: 38px" id="playing" height="%" src="//www.youtube.com/embed/RNhE8nbV42M" frameborder="0" allowfullscreen></iframe>


</div>
</div>
