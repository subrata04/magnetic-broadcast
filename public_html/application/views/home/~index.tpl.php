<!-- Js for social media icon start -->
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "7638feaa-5356-487e-91d1-a8bb7c4b562b"}); </script>
<!-- Js for social media icon end -->
<div class="body-section">
    <?php
        echo show_msg();
    ?>
    <div class="video-section">
        <h2>Featured videos</h2>
        <div id="products_example">
            <div id="products">
                <div class="slides_container" id="playerContainer">
                    <?php
                        // pr($m_video_dataset);
                        if(count($m_video_dataset)>0){
                        ?>
                        <div class="video" id="video">
                            <a href="<?php echo config_item('main_video_convert_url').$m_video_dataset[0]['s_video_name']; ?>" style="display:block;width:480px;height:360px;" id="player"></a>
                        </div><?php 
                        } 
                    ?>
                    </li>

                </div>
                <ul class="pagination">
                    <?php
                        // pr($m_video_dataset);
                        if(count($m_video_dataset)>0){
                            foreach($m_video_dataset as $m_row){
                            ?>
                            <li>
                                <img src="<?php echo config_item('main_video_thumb_url').getName($m_row['s_video_name']).'.jpg'; ?>" alt="<?php echo config_item('main_video_convert_url').$m_row['s_video_name']; ?>" />
                            </li>
                            <?php 
                            }
                        }
                        /*
                        <li><img src="<?php echo base_url(); ?>images/videodummy/5.png" alt="video (5).flv" /></li>
                        <li><img src="<?php echo base_url(); ?>images/videodummy/3.png" alt="video (3).flv" /></li>
                        <li><img src="<?php echo base_url(); ?>images/videodummy/2.png" alt="video (2).flv" /></li>
                        <li><img src="<?php echo base_url(); ?>images/videodummy/1.png" alt="video (1).flv" /> </li>
                        */ 
                    ?>
                    <li><div id="viewmore"><a href="videos.html">View More</a></div></li>
                </ul>
            </div>
        </div>
        <div class="clr"></div>

    </div>
    <div class="facebook-sec">
        <div id="usual1" class="usual">
            <ul>
                <li class="twi"><a href="#tab1" class="">&nbsp;</a></li>
                <li class="fac"><a href="#tab2" class="">&nbsp;</a></li>
            </ul>
            <div class="clr"></div>
            <div id="tab1" style="display: block;" class="social_face">
                <div class="scrollbar3">
                    <div class="viewport" style="width: 100%;">
                        <div class="socal_bg" id="twitfeed" style="height: 300px;overflow: auto;width: 100%;">
                            
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
                
                <div class="twitter_btn_bg">
                    <iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/follow_button.html?screen_name=<?php echo $s_tw_name; ?>&show-screen-name=true" style="width:300px; height:20px;"></iframe>
                </div>
            </div>
            <div id="tab2" style="display: none;" class="social_face">
                <div class="">
                    <div class="viewportfb">

                        <div id="fb-root"></div>
                        <iframe id="fb_fan_page_iframe" name="fb_fan_page_iframe" src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($s_fb_url)?>&amp;width=356&amp;height=340&amp;colorscheme=light&amp;show_faces=false&amp;border_color=%23FFFFFF&amp;stream=true&amp;header=false&amp;appId=282680865175878" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:356px; height:340px;" allowTransparency="true"></iframe>
                        <?php /*
                        <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=282680865175878";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-like-box" data-href="https://www.facebook.com/MeganNicoleSite?ref=ts" data-width="356" data-height="340" data-show-faces="false" data-border-color="#FFFFFF" data-stream="true" data-header="false"></div> */ ?>
                    </div>
                </div>

                <div class="twitter_btn_bg">
                <div class="twitter_btn"></div>
                <div class="followers">660 Followers</div>
                </div>
            </div>

        </div>

    </div>
    <div class="clear"></div>
    <div class="section-area">
        <div class="sec-headingbg">Featured Photo</div>
        <ul id="scroller">
            <?php
                // pr($m_image_dataset);
                if(count($m_image_dataset)>0){
                    foreach($m_image_dataset as $m_row){
                    ?>
                    <li>
                        <a rel="image_slider" href="<?php echo config_item('zoom_model_image_url').$m_row['s_image_name'] ?>" title="<?php echo $m_row['s_title'] ?>">
                            <img src="<?php echo config_item('thumb_model_image_url').$m_row['s_image_name'] ?>" alt="<?php echo $m_row['s_title'] ?>">
                        </a>
                    </li>
                    <?php 
                    }
                }
            ?>                                           
        </ul>
        <div class="viewmore"><a href="<?php echo base_url(); ?>albums.html">View More</a></div>
        <div class="clear"></div>
    </div>
    <div class="body-topsec">
        <div class="body-topleft"><img src="<?php echo base_url(); ?>images/banner.gif" alt="" width="170" height="565" /></div>
        <div class="body-topright">
            <?php
                // pr($m_image_dataset);
                if(count($m_blog_dataset)>0){
                    foreach($m_blog_dataset as $m_row){
                    ?>
                    <div class="blog-sec">
                        <h2><?php echo put_safe($m_row['s_title']); ?></h2>
                        <h3>Posted on <?php echo date(config_item('s_blog_date_format'), $m_row['t_add_time'])?> by <?php echo put_safe($m_row['s_username'])?></h3>
                        <p>
                            <?php 
                                $s_desc = strip_tags(put_safe($m_row['s_description']));

                                if(strlen($s_desc)>500) {
                                    echo character_limiter($s_desc, 495);
                                ?>
                                <span><a href="<?php echo base_url().'blog/details/'.$m_row['id'].'/'.make_title_url(put_safe($m_row['s_title'])).'.html';?>">Learn More &raquo;</a></span>
                                <span style="float: right;"><a href="<?php echo base_url()?>blog.html">View All Blogs »</a></span>
                                <?php
                                } else {
                                    echo $s_desc;
                                ?>
                                <span><a href="<?php echo base_url().'blog/details/'.$m_row['id'].'/'.make_title_url(put_safe($m_row['s_title'])).'.html';?>">Learn More &raquo;</a></span>
                                <span style="float: right;"><a href="<?php echo base_url()?>blog.html">View All Blogs »</a></span>
                                <?php
                                }
                            ?>
                        </p>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:8px;">
                            <tr>
                                <td align="left" valign="top"><span class='st_sharethis_large' displayText='ShareThis'></span>
                                    <span class='st_facebook_large' displayText='Facebook'></span>
                                    <span class='st_twitter_large' displayText='Tweet'></span>
                                    <span class='st_googleplus_large' displayText='Google +'></span>
                                    <span class='st_linkedin_large' displayText='LinkedIn'></span>
                                    <span class='st_email_large' displayText='Email'></span>
                                </td>
                            </tr>
                        </table>
                        <div class="clear"></div>
                    </div>
                    <?php
                    }        
                }
            ?>          
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>


                            
