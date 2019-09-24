<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "7638feaa-5356-487e-91d1-a8bb7c4b562b"}); </script>
<script type="text/javascript">
    $(function(){
        // Details show [start]
        $(".view_det12").bind('click', function(){
            showFBMsg("<div class='fb_div' style='width:600px; color: #333333;' >"+$(this).next('input.hid_desc').val()+'</div>');
        });
        // Details show [end]
        // 

    })
</script>


  <!--slider_contain-->
  <?php
  if(count($m_home_image_dataset)){
  ?>
  <div class="slider_contain" id="gallery">
    <div id="mcs5_container">
      <div class="customScrollBox">
        <!-- horWrapper div is important for horizontal scrollers! -->
        <div class="horWrapper">
          <div class="container">
            <div class="content">
            <?php
            foreach($m_home_image_dataset as $m_row){
            ?>
              <div class="slider-box" > <img src="images/zoomimg.png" alt="#"  /> <a rel="image_slider" href="<?php echo config_item('main_image_url').$m_row['image_name'] ?>" title="<?php echo ucfirst($m_row['title']);?>"> <img src="<?php echo config_item('thumb_image_url').$m_row['image_name'] ?>" alt="<?php echo $m_row['title']?>" style="position:absolute; top: -1px; left: 0px;"  /></a>
                <p> <span><?php echo ucfirst($m_row['title']);?></span><br />
                  <?php echo put_safe($m_row['desc']);?></p>
              </div>
              <?php }?>
              <div class="clear"></div>
            </div>
          </div>
          <div class="dragger_container">
            <div class="dragger"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <?php }?>
  <!--end slider_contain-->
  <!--middle-contain-->
  <div class="middle-contain"> 
  <div class="clear"></div> 
  <?php echo show_msg();?>
    <div class="clear"></div>
    <div class="left_video_contain">
      <h2>Featured videos</h2>
      <div class="modfytslider">
        <div id="video" class="video_box" >
        <a href="<?php echo config_item('main_video_convert_url').$m_video_dataset[0]['s_video_name']; ?>" style="display:block;width:350px;height:335px;" id="player"></a>
        </div>
        <div id="paginate-fytslider1" class="video-img">
          <div style="text-align: center;"> 
                    <?php
                        // pr($m_video_dataset);
                        if(count($m_video_dataset)>0){
                            foreach($m_video_dataset as $m_row){
                            ?>
                          <a href="javascript:void(0)" class="toc"><img src="<?php echo config_item('main_video_thumb_url').getName($m_row['s_video_name']).'.jpg'; ?>" alt="<?php echo config_item('main_video_convert_url').$m_row['s_video_name']; ?>" width="156" height="78" /></a>
                            <?php 
                            }
                        }
                    ?>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <div class="viewmore-btn4"><a href="<?php echo base_url();?>videos.html">View More Video</a></div>
            <div class="clear"></div>
    </div>
    <div class="facebook-contain">
      <div class=" top_tab_contain">
        <ul id="tabmenu" class="tabmenu">
          <li><a href="#description"><img src="images/t_twitter.png" alt="" />The Daily Show <br />
            on <span>Twitter</span></a></li>
          <li class="active"><a href="#usage"><img src="images/t_facebook.png" alt="" />The Daily Show <br />
            on <span style="color:#02356a;">Facebook</span></a></li>
        </ul>
        <div id="description" class="content2" >
          <div style="height:200px;width:417px;overflow:scroll;overflow-x: hidden; padding-top:10px;">
            <div class="tab_text_cintain" style="padding:0;"> <img src="images/f_img1.jpg"  alt=""/>
              <p><strong>Sam  dollar
                demo content by....</strong><br />
                6 hrs ago</p>
              <div class="clear"></div>
            </div>
            <div class="tab_text_cintain"> <img src="images/f_img2.jpg"  alt=""/>
              <p><strong>tem Ipsum Ipsum dollar
                demo content by....</strong><br />
                6 hrs ago</p>
              <div class="clear"></div>
            </div>
            <div class="tab_text_cintain"> <img src="images/f_img3.jpg"  alt=""/>
              <p><strong>tem Ipsum Ipsum dollar
                demo content by....</strong><br />
                6 hrs ago</p>
              <div class="clear"></div>
            </div>
            <div class="tab_text_cintain"> <img src="images/f_img1.jpg"  alt=""/>
              <p><strong>tem Ipsum Ipsum dollar
                demo content by....</strong><br />
                6 hrs ago</p>
              <div class="clear"></div>
            </div>
            <div class="tab_text_cintain"> <img src="images/f_img2.jpg"  alt=""/>
              <p><strong>tem Ipsum Ipsum dollar
                demo content by....</strong><br />
                6 hrs ago</p>
              <div class="clear"></div>
            </div>
            <div class="tab_text_cintain"> <img src="images/f_img3.jpg"  alt=""/>
              <p><strong>tem Ipsum Ipsum dollar
                demo content by....</strong><br />
                6 hrs ago</p>
              <div class="clear"></div>
            </div>
          </div>
          <div class="fb_share" >
        <div class="facebook_button_contain">
          <div class="button_img1"> </div>
          <div class="button_img1_text_contain">631 followers</div>
          <div class="clear"></div>
        </div>
        <div class="button_tab_text">Trending topics:<br />
          <span>#tdsbreakingnews</span> </div>
        <div class="button_tab_text" style="border:none;">Join the Conversation:<br />
          <span>@TheDailyShow</span> </div>
        <div class="clear"></div>
        <div class="button_follow_btn"><a href="#">Login to Twitter</a></div>
        <div class="clear"></div>
      </div>
        </div>
        <div id="usage" class="content2" style="width: 412px;">
          <div style="height:297px;width:417px; padding-top:10px;">

                                    <div id="fb-root"></div>
                        <iframe id="fb_fan_page_iframe" name="fb_fan_page_iframe" src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($s_fb_url)?>&amp;width=417&amp;height=297&amp;colorscheme=light&amp;show_faces=false&amp;border_color=%23FFFFFF&amp;stream=true&amp;header=false&amp;appId=282680865175878" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:417px; height:297px;" allowTransparency="true"></iframe>

          </div>
        </div>
        <div class="clear"></div>
      </div>
      
          </div>
    <div class="clear"></div>
    <div class="featured-photo">
      <h2>Featured Photo</h2>
      <ul  class="Scontainer" id="gallery">
            <?php
                // pr($m_image_dataset);
                if(count($m_image_dataset)>0){
                    foreach($m_image_dataset as $m_row){
                    ?>
        <li><a rel="image_slider1" href="<?php echo config_item('zoom_model_image_url').$m_row['s_image_name'] ?>" title="<?php echo $m_row['s_title'] ?>"><img src="<?php echo config_item('thumb_model_image_url').$m_row['s_image_name'] ?>" alt="<?php echo $m_row['s_title'] ?>" width="157" height="107" /></a></li>
                    <?php 
                    }
                }
            ?>                                           
      </ul>
      <div class="clear"></div>
    </div>
    <div class="product-listing">
    <?php if(count($m_product_dataset)){?>
      <h2>Product Listing </h2>
      <?php foreach($m_product_dataset as $m_row){ 
       //  echo put_safe($m_row['product_desc']); 
          ?>
      
      <div class="cd-contaon">
        <div class="cd-box"><img src="<?php echo get_download_url($m_row['id'])?>" alt="" width="152" height="160" /></div>
        <p><?php echo character_limiter(ucfirst($m_row['product_title']),10);?><br />
          <span>$ <?php echo $m_row['product_price'];?></span></p>
        <span><a href="<?php echo base_url().'shopping_cart/add/'.strEncode($m_row['id']).'/1'; ?>" class="cart-btn">Add to cart</a> <a href="javascript:void(0);" class="detail view_det12">Details</a>
        <input class="hid_desc" type="hidden" value='<?php echo $m_row['product_desc']; ?>' />
       
        <div class="clear"></div>
      </div>
      <?php } ?>
      <div class="clear"></div>
      <div class="viewmore-btn"><a href="<?php echo base_url();?>compressed-download.html">View All</a></div>
      <?php } ?>
      <div class="clear"></div>
    </div>
    <div class="events-contain">
      <h2>Antionette’s Events</h2>
      <div class="calender-contain" id="calender-contain">
        
      </div>
      <div class="right-banner">
        <div class="btn"><a href="<?php echo base_url()?>booking-manager"><img src="images/btn.png" alt="#" /></a></div>
      </div>
      <div class="clear"></div>
    </div>
     <div class="clear"></div>
      <img src="images/demo-img.png" alt="#" />
  <?php if(count($m_blog_dataset)){
      
      ?>
  
    <div class="right-text">
  
    <?php foreach($m_blog_dataset as $m_row){?>
      <h1><?php echo ucfirst($m_row['s_title'])?></h1>
      <p><strong>Posted on <?php echo date('F j, Y',$m_row['t_add_time']);?> by <?php echo $m_row['s_username']?></strong><br /><br />

        <?php echo character_limiter(strip_tags(put_safe($m_row['s_description'])),1000);?> <a href="<?php echo base_url().'blog/details/'.$m_row['id'].'/'.make_title_url(put_safe($m_row['s_title'])).'.html';?>">Learn More&raquo;</a><br />
         </p>
                <table border="0" cellpadding="0" cellspacing="0" width="40%" style="margin-top:8px;">
            <tr>
                <td align="left" valign="top">
                    <span class='st_sharethis_large' displayText='ShareThis'></span>
                    <span class='st_facebook_large' displayText='Facebook'></span>
                    <span class='st_twitter_large' displayText='Tweet'></span>
                    <span class='st_googleplus_large' displayText='Google +'></span>
                    <span class='st_linkedin_large' displayText='LinkedIn'></span>
                    <span class='st_email_large' displayText='Email'></span>
                </td>
            </tr>
        </table>
        <?php } ?>
     <div class="viewmore-btn3"><a href="<?php echo base_url();?>blog.html">View All</a></div>   
    </div>
    <?php } ?>
 <div class="clear"></div>
  </div>
  <!--end middle-contain-->
