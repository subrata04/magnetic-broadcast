<?php /*
<div class="FBG">

    <div class="Heading">
        <div class="Heading_left">&nbsp; &nbsp; Most Recent Videos</div>
        <div class="Heading_mid"></div>
        <div class="Heading_right">
            <ul>
                <li class="none"><a href="#" target="_self">Most Recent </a></li>
                <li><a href="#" target="_self">Most Viewed</a></li>
                <li><a href="#" target="_self">Top Rated</a></li>
                <li><a href="#" target="_self">Longest</a></li>
                <li><a href="#" target="_self">Featured</a></li>
            </ul>
        </div>
    </div>

    <div class="picareas">
        <?php
            $i_vid_count = 0;
            foreach($lower_top_pannel_data as $row){
                $i_vid_count ++;
                //pr($row);
                $subtime = date('F j, Y g:i a',  strtotime($row['dt_vid_add_date']));
                $s_title = character_limiter($row['s_vid_name'], 20);
                $s_thumb_url = "";
                $s_video_url = "";
                if($row['i_is_internal_link']==1){
                    $s_thumb_url = $this->config->item('video_upload_thumb_url').$row['s_thumbnail_url'];
                    $s_video_url = $this->config->item('video_upload_url').$row['s_vid_url'];
                } else {
                    $s_thumb_url = $row['s_thumbnail_url'];
                    $s_video_url = $row['s_vid_url'];
                }
            ?>
            <div class="boxarea" style="margin:<?php echo ($i_vid_count%5==0)?"0 0px 9px 0":"0 9px 9px 0"?>;">
                <img src="<?php echo $s_thumb_url;?>" alt="" style="cursor: pointer;" onclick="javascript:window.location='<?php echo base_url();?>user/show-video/<?php echo $row['id'].'/'.make_title_url($row['s_vid_name']).'.html' ?>'" />
                <p align="center" title="<?php echo $row['s_vid_name']?>"><a href="<?php echo base_url();?>user/show-video/<?php echo $row['id'].'/'.make_title_url($row['s_vid_name']).'.html' ?>" target="_self"><?php echo $s_title; ?></a><br />
                    00:04         <span style="padding-left:108px;">100%</span><br />
                    <span style="float:left;">2 months ago</span>        <span style="float:right;">views: <?php echo $row['i_view_count']?></span>
                </p>
            </div>
            <?php
            }
        ?>
    </div>
    <div class="clr"></div>
    <div class="Flogo">
        <a href="index.php" target="_self">
            <img src="images/flogo.png" alt="" border="0" />
        </a>
    </div>

            </div>
            <div class="clr"></div>
            
            */ ?>