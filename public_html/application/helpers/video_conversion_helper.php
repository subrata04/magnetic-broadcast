<?php
/**
* Function for converting the video into FLV file
* 
* @param mixed $s_source_path (folder path)
* @param mixed $s_video_upload_path (folder path)
* @param mixed $s_vid_name (with extension of file)
*/
function video_convert($s_source_path="", $s_video_upload_path="", $s_vid_name="") {
    $CI = & get_instance();
    // echo $s_vid_conv_cmd = $CI->config->item('ffmpeg_path')." -i ".$s_source_path." -f flv ".$s_video_upload_path.$s_vid_name; exit;
    $s_vid_conv_cmd = $CI->config->item('ffmpeg_path')." -i ".$s_source_path." -f flv -s 640x480 -qscale 10 ".$s_video_upload_path.$s_vid_name;
    exec($s_vid_conv_cmd);
    
    /**
    * E:/xampp/ffmpeg/ffmpeg.exe -i E:\xampp\htdocs\model\php\uploads/video/13522642750.wmv -f flv -s 640x480 E:\xampp\htdocs\model\php\uploads/video/convert/13522642750.flv
    */
}

/**
* Function for creating video file SNAPSHOT
* 
* @param mixed $s_source_path (folder path)
* @param mixed $s_thumbnail_path (folder path)
* @param mixed $s_thumb_name (with extension of file)
*/
function create_thumb_from_video($s_source_path="", $s_thumbnail_path="", $s_thumb_name="") {
    $CI = & get_instance();
   // echo  $s_source_path;
    $CI->config->item('ffmpeg_path')  ;
      //$s_thumbnail_path;
//   echo  $s_thumb_name;    exit;
    // $s_img_cmd = $CI->config->item('ffmpeg_path')." -i ".$s_source_path." -vsync 60 -r 0.1 ".$s_thumbnail_path.$s_thumb_name.'-%03d.jpg';   // Running code for multiple frame output 
    $s_img_cmd = 
                    $CI->config->item('ffmpeg_path')." -i ".
                    $s_source_path." -y -f image2 -ss 1 -sameq -t 1 -s ".
                    config_item('thumb_video_image_width')."*".config_item('thumb_video_image_height')." ".
                 $s_thumbnail_path.$s_thumb_name.'.jpg';
                

    exec($s_img_cmd);
    
    /*
    // ffmpeg -ss 60 -i input.mpg -frames:v 20 frame_%d.png     
    /// ffmpeg -i in.avi -vsync 1 -r 1 'img-%03d.jpeg'                 
    // echo $s_img_cmd = config_item('ffmpeg_path')." -i ".$s_source_path." img.jpeg";
    // exec("?enable-demuxer=DEMUXER"); // if it is disabled then this should be un commented
    // 
    /**
    * ffmpeg -i in.avi -vsync 1 -r 1 'img-%03d.jpeg'
    * ffmpeg -f fbdev -frames:v 1 -r 1 -i /dev/fb0 screenshot.jpeg
    * ffmpeg -i ../some_mjpeg.avi -c:v copy frames_%d.jpg
    * ffmpeg -i in.avi -vsync 1 -r 1 'img-%03d.jpeg'
    * E:/xampp/ffmpeg/ffmpeg.exe -i E:\xampp\htdocs\model\php\uploads/video/13521977880.wmv -vsync 1 -r 1 img-%03d.jpeg
    * 
    * ffmpeg -i in.avi -vsync 1 -r 1 -f image2 'img-%03d.jpeg'
    * 
    * E:/xampp/ffmpeg/ffmpeg.exe -i E:\xampp\htdocs\model\php\uploads/video/13522041850.avi -vsync 1 -r 1 E:\xampp\htdocs\model\php\uploads/video/thumb/img-%03d.jpeg 
    * 
    * E:/xampp/ffmpeg/ffmpeg.exe -i E:\xampp\htdocs\model\php\uploads/video/13521989350.mpg -vsync 1 -r 1 img-%03d.jpeg
    * 
    */

}
