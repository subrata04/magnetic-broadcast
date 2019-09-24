 <script>
 
 $(document).ready(function()
 {


         $('.getstartedbtn').click(function () {
             $('html, body').animate({scrollTop:$('.form-contain').offset().top}, 'slow');
             return false;
         });
contact_insert

   
   var flag=0;            
    $('#facebox').css('height','320px');

     //$('#facebox').css('width','800px');
     //$.facebox($('#aa').html());
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
        s_message=$('#s_message').val();
        


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
            $.facebox('<div class="contacterror"><p>Please enter Valid City</p></div>');
            $('#s_city').css('border','1px solid #FF0000');
        }
        
        else if(s_country=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Valid Country</p></div>');
            $('#s_country').css('border','1px solid #FF0000');
        }

         else if(s_zip=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Valid Zip</p></div>');
            $('#s_zip').css('border','1px solid #FF0000');
        }
        
        else if(state=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Valid State</p></div>');
            $('#state').css('border','1px solid #FF0000');
        }
        else if(s_address=='')
            {
            $.facebox('<div class="contacterror"><p>Please enter Valid Address</p></div>');
            $('#s_address').css('border','1px solid #FF0000');
        }
        else if(s_message=='')
        {
            $.facebox('<div class="contacterror"><p>Please enter Message</p></div>');
            $('#s_message').css('border','1px solid #FF0000');
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
            {s_fname:s_fname,s_lname:s_lname,s_email:s_email,s_phone:s_phone,s_city:s_city,s_zip:s_zip,s_country:s_country,state:state,s_address:s_address,s_message:s_message},
            function(result)
            {
                $.unblockUI();
                //alert(result);
                //alert(result);
                if(result==1)  
                    {
                        //alert(3);
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
                    $('#s_message').text('');
                    $('#s_message').val('');
                    
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

    <img src="images/home_new_banner2.jpg" class="home_new_banner2" />
        <div class="main-wrapper">
        
        <div class="form-right-box" >
        
        <div class="box-text-part" style="text-transform: uppercase;">
        
        <span style="font-size:34px; display:block; line-height:40px; text-align:center; font-family:Georgia, "Times New Roman", Times, serif; font-weight:normal; padding-bottom:15px; margin:0; text-shadow:none;"><span style="color:#cb0000; text-transform: uppercase;">Automotive Social<!--Magnetic--> Sharing</span><!--Broadcast--></span>


        <!--Our #1 Goal is to Facilitate an Automated Process in Social Broadcasting Giving Your Company Optimal Marketing Impact.-->Our #1 Goal is to Facilitate an Automated Process in Social Broadcasting Giving Your Sales
            team and Employees Powerful ways to Help You Market.  <br />



<strong>BROADCAST YOUR MESSAGE THROUGH YOUR ORGANIZATION AND REACH HUNDREDS OF MORE CAR BUYERS EVERY WEEK.<!--BROADCAST YOUR MESSAGE THROUGH YOUR ORGANIZATION AND REACH MILLIONS--> </strong><br />



            <span style="font-size: 40px; display: block; padding: 5px 0 0 0; line-height: 45px;">LET YOUR STAFF JOIN IN THE EFFORT
            TO SELL MORE CARS<!--OUR SOFTWARE IS TRULY MAGNETIC --></span>
        
        </div>
        
       <!-- <div class="arrow-div">Fill Out the form to learn more!</div>-->
              </div>
    <div class="form-contain">

      <div class="top-heding">GET MORE SALES <span>NOW!</span></div>

      <div class="form-body">
       <!--<span class="error">error msg</span>-->
       <input type="text" id="s_fname" placeholder="First Name" class="input1" />
       <!--<span class="error">error msg</span>-->
       <input type="text" id="s_lname" placeholder="Last Name"  class="input1"/>
      <!--<span class="error">error msg</span>-->
       <input type="text" placeholder="Phone Number" class="input1" id="s_phone"/>
      
      <!--<span class="error">error msg</span>-->
       <input type="text" placeholder="Email Address" class="input1"  id="s_email"/>


          <textarea placeholder="Message" id="s_message" class="input2"></textarea>
      <!--<input type="text" id="state" placeholder="State"  class="input1"/> -->
    <!--  <textarea placeholder="Address" id="s_address" class="input2"></textarea>-->
          <!--<label>State</label> -->
     <!-- <input type="text" id="s_city" placeholder="City"  class="input1"/> -->
     <!--<select class="input3" name="state" id="state" style="float: none; margin: 0 auto; display: block;">
        <option value="">Select Country First</option>  
    </select>-->
   <!--  <input type="text" placeholder="Zip Code" id="s_zip" class="input1" />       -->
   <!-- <select class="input3" name="country" id="s_country" style="display: none;" onchange="fetchState(this,'state')">
        <option value="">Select Country</option>
        <?php /*echo get_country_dd(set_value('country')); */?>
    </select> -->
    

      
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
  <h1><span>Get connected!</span> Broadcast your dealership’s inventory through all of your staff’s social accounts.
      <!--Broadcast Your Dealership’s Opportunities through all of your Staff’s social accounts and get connected!--><!--The Power to Reach Is Only a Click Away--></h1>
</div>

<h2>We connect your sales staff and employees to all of the most popular social platforms allowing them to join the effort in bringing in more car buyers!<!--We connect your sales staff and employees to all of the most popular social platforms allowing them to join the effort in bringing in more car buyers!--><!--We connect your distributors to all of the most popular social platforms for top performance marketing!--></h2>

<div class="icon-div-contain">
<ul>
<!--<li><a href="#"><img src="images/1.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/2.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/3.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/4.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/5.png"  alt="#"/></a></li>
<li><a href="#"><img src="images/6.png"  alt="#"/></a></li>-->

    <li><a href="javascript:void(0)"><img src="images/new_social_icon3.png"  alt="#"/></a></li>
    <li><a href="javascript:void(0)"><img src="images/new_social_icon1.png"  alt="#"/></a></li>

    <li><a href="javascript:void(0)"><img src="images/new_social_icon5.png"  alt="#"/></a></li>

    <li><a href="javascript:void(0)"><img src="images/new_social_icon6.png"  alt="#"/></a></li>
    <li><a href="javascript:void(0)"><img src="images/new_social_icon4.png"  alt="#"/></a></li>
    <li><a href="javascript:void(0)"><img src="images/new_social_icon2.png"  alt="#"/></a></li>





</ul>
</div>
<div class="clear"></div>
<img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>

<!--<h3 style="margin:25px 0;"><span>Social Media </span>is one of the most powerful marketing tools for
    automotive that has ever come around.</h3>-->


<!--<img src="images/n_home_socialmedia.png"  alt="#" style="width:100%; display:block; margin:25px auto;"/>-->


         <div class="homesocialmwdiablock">
<h1><span>Social Media</span> is one of the most powerful marketing tools for
    automotive that has ever come around. </h1>


             <img src="images/bd_new_homeblock.png" class="bd_new_homeblock" />
             <div class="homesocialmwdiablock_wrapper">
             <p>What is missing from what most dealers experience is the personal social aspects that make social media so effective.  Social media is about being who you are amongst the people you care about the most. When you grasp the power, you have through your staff in the social realm it becomes obvious that you need a broadcasting tool.
               <br> <br>
             The <span>Magnetic Broadcast</span> allows you to manage the messaging that is shared through your staff.  Not only can you have your staff work with you, but anyone that is interested in working with sending your dealership referrals is able to plug straight in as well!</p>

                 <a href="javascript:void(0)" class="getstartedbtn">get started </a>

             </div>
         </div>




         <div class="clear"></div>
         <img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>

         <h3 style="margin:25px 0;">Some of the Incredible features of the <span>Magnetic Broadcast</span></h3>

         <div class="incrediblefeatures">
             <ul>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if1.png" alt="#">
                         <h2>Adding in Employees, Staff and Others</h2>
                         <p>
                             <!--Every member of your staff can connect to the broadcast. This allows them to come in and have their own account where they can ..-->Every member of your staff can connect to the broadcast. This allows them to come in and have their own account where they can change some very simple rules. Some of these are what broadcasts to subscribe to and how frequent they post messaging from the dealership.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if2.png" alt="#">
                         <h2>Natural Social Posting</h2>
                         <p>
                             <!--It is very important that people remain people. When you are posting in social your friends and family want to see you and what is ...-->It is very important that people remain people. When you are posting in social your friends and family want to see you and what is happening in your life. Our software can be set to post messaging based on the frequency of the post for the user. What this means is as your staff post they will put up a few posts that are personal for every message from the dealership. This keeps it social and friendly getting much better reception of messaging from the dealership.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if3.png" alt="#">
                         <h2>Developing Broadcast Marketing Paths</h2>
                         <p>
                             <!--The marketing broadcasts that you develop can go from one subscription or several depending on what you ...-->The marketing broadcasts that you develop can go from one subscription or several depending on what you want to do with your social marketing objectives. You can create several different broadcasts for your dealership and have your staff and referral network choose what to subscribe to. You can have a member of your staff manage this or hire our content and design team to create these broadcast paths for you.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>

                 <div class="clear"></div>

                 <span class="newdeviderspan"><img src="images/newlidevider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:0 auto;"/></span>
                 <div class="clear"></div>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if4.png" alt="#">
                         <h2>Adding in Referral Links and Landing Pages</h2>
                         <p>
                             <!--As part of the social experience you can customize the links that are in your messaging to push to lead capture landing pages for a ...-->As part of the social experience you can customize the links that are in your messaging to push to lead capture landing pages for a variety of reasons. Adding in landing pages and social capture funnels will allow the marketing being pushed through social to capture potential car buyers much easier through the broadcast messaging.
                         </p>
                       <!--  <a href="#">Read more</a>-->
                     </div>
                 </li>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if5.png" alt="#">
                         <h2>Developing a Local Referral Network.</h2>
                         <p>
                             <!--Besides adding in your staff and employees you can use the Magnetic Broadcast to have any number of marketers plug in.-->Besides adding in your staff and employees you can use the Magnetic Broadcast to have any number of marketers plug in. You could over time have dozens or even a few hundred referral partners sharing your dealership messaging with their social networks.  This again is tracked and you can tie in incentives and commissions for people that are outside of your dealership for referrals!  This is one of the most powerful way to create a viral marketing and social proof environment for your dealership.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if6.png" alt="#">
                         <h2>Personalized Messaging Options.</h2>
                         <p>
                            <!-- Those that want to be a bit more engaged can come in and see the messaging that will be broadcast.-->Those that want to be a bit more engaged can come in and see the messaging that will be broadcast.  They will have an opportunity to go in and customize the messaging to be more personalized.  This way when they broadcast they have their own personal touch making it an even bigger advantage.
                         </p>
                         <!--<a href="#">Read more</a>-->
                     </div>
                 </li>

                 <div class="clear"></div>

                 <span class="newdeviderspan"><img src="images/newlidevider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:0 auto;"/></span>                 <div class="clear"></div>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if7.png" alt="#">
                         <h2>Connecting to the Major Social Networks.</h2>
                         <p>
                            <!-- The Magnetic Broadcast is connected to all the major social networks, covering more than 90% of all the opportunities available for social ...-->The Magnetic Broadcast is connected to all the major social networks, covering more than 90% of all the opportunities available for social sharing. These include Facebook, twitter, Instagram, LinkedIN and Google+. Each member can enter in their user and pass for each of the Networks they plan to share the dealership marketing through.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if8.png" alt="#">
                         <h2>RSS Syndication through the Broadcast</h2>
                         <p>
                             <!--You can mix up the broadcasts that you are sending by incorporating RSS feeds from other local and national websites.-->You can mix up the broadcasts that you are sending by incorporating RSS feeds from other local and national websites. This could be from your OEM, local businesses and events or any other source.  These will be branded as being shared by your dealership and can help enrich the experience of your staff and those that are viewing their broadcast posts.  There are literally millions of websites all over the internet that have RSS available.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>
                 <li>
                     <div class="maincontentdiv">
                         <img src="images/if9.png" alt="#">
                         <h2>Reviewing Metrics of Each Member.</h2>
                         <p>
                            <!-- You have access to reporting that shows the number of shared posts from your staff and everyone in your referral network.-->You have access to reporting that shows the number of shared posts from your staff and everyone in your referral network.  This includes how many shares, clicks and overall lead conversions. This will help you know who to reward and how to adjust your marketing as you continue to create new broadcasts for your dealership.
                         </p>
                        <!-- <a href="#">Read more</a>-->
                     </div>
                 </li>
             </ul>
         </div>
         <img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>
         <div class="new_bottomtextblock">

             <h3><label><span>Get in touch</span> with us and let’s get you started!</label>
                 The sooner your dealership is broadcasting the faster you can start making a marketing impact
                 through the viral power of people and social media!</h3>

             <a class="getstartedbtn" href="javascript:void(0)">get started </a>
         </div>



<!--
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

<img src="images/devider.png"  alt="#" style="width:100%; display:block; margin:0 auto; margin:15px auto;"/>-->


         <!--<h4>Administrative Features</h4>

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
 
     </div>--->

         <!-- <div class="additional-body">
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
     </div>-->

         <!--<div class="body-bottom">
     
     
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
     
     
     
     
     
     </div>-->
     
     
   
     
    
<div id="aa" style="z-index:99999999; display:none; ">
                                                                    
<div style="cursor:auto; background:#141817; border-radius:5px; width: 800px; height: 600px; " class="video-popup">

  
 <!--<div class="closev"><a href="#" onclick="$.unblockUI()"><img src="<?php echo $themeUrl ?>/images/close.png"  alt="#"/></a></div>-->
 
 <div class="clear"></div>
 
<strong style="color:#fff; display:block; text-align:center; padding:25px 0; font-size: 16px;">  Power to Reach Is Only A Click Away</strong> 

<iframe width="90%" height="90%" style="margin-left: 38px" id="playing" height="%" src="//www.youtube.com/embed/RNhE8nbV42M" frameborder="0" allowfullscreen></iframe>


</div>
</div>
