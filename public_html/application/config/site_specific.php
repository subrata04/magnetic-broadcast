<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//////////////// Site specific config [start]/////////////////

// general config
$config['image_temp_path'] = FCPATH.'uploads/temp/';
$config['image_temp_url'] = BASE_URL.'uploads/temp/';
$config['video_temp_path'] = FCPATH.'uploads/video/';
$config['video_temp_url'] = BASE_URL.'uploads/video/';
$config['unzip_folder'] = FCPATH.'uploads/unzip/';


/*
@author:Abirlal Mukherjee
*/
//User Image Constants [starts]
$config['main_image_types'] = 'gif|jpg|jpeg|png';
$config['user_image_path'] = FCPATH.'uploads/user_image/';
$config['user_profile_image_path'] = FCPATH.'uploads/user_image/profile_pic/';
$config['user_profile_image_url'] = BASE_URL.'uploads/user_image/profile_pic/';
$config['user_profile_thumb_image_path'] = FCPATH.'uploads/user_image/profile_pic/thumb/';
$config['user_profile_thumb_image_url'] = BASE_URL.'uploads/user_image/profile_pic/thumb/';
$config['thumb_user_image_path'] = FCPATH.'uploads/user_image/thumb/';
$config['user_noimage_path'] = FCPATH.'uploads/user_image/noimage/';
$config['user_image_url'] = BASE_URL.'uploads/user_image/';
$config['thumb_user_image_url'] = BASE_URL.'uploads/user_image/thumb/';
$config['user_noimage_url'] = BASE_URL.'uploads/user_image/noimage/';
//$config['thumb_user_image_width'] = 484;
//$config['thumb_user_image_height'] = 265;

$config['thumb_user_image_width'] = 300;
$config['thumb_user_image_height'] = 300;

//User Image Constants [Ends]

//Event Image Constants [starts]
$config['main_image_types'] = 'gif|jpg|jpeg|png';
$config['event_image_path'] = FCPATH.'uploads/event_image/';
$config['thumb_event_image_path'] = FCPATH.'uploads/event_image/thumb/';
$config['event_image_url'] = BASE_URL.'uploads/event_image/';
$config['thumb_event_image_url'] = BASE_URL.'uploads/event_image/thumb/';
$config['thumb_event_image_width'] = 50;
$config['thumb_event_image_height'] = 50;
//Event Image Constants [Ends]

// Image Gallery Constants [start]
$config['main_image_types'] = 'gif|jpg|jpeg|png';
$config['model_image_unzip_path'] = FCPATH.'uploads/main_model_image/zips/';
$config['main_model_image_path'] = FCPATH.'uploads/main_model_image/';
$config['zoom_model_image_path'] = FCPATH.'uploads/main_model_image/zoom_image/';
$config['thumb_model_image_path'] = FCPATH.'uploads/main_model_image/thumb/';
$config['main_model_image_url'] = BASE_URL.'uploads/main_model_image/';
$config['zoom_model_image_url'] = BASE_URL.'uploads/main_model_image/zoom_image/';
$config['thumb_model_image_url'] = BASE_URL.'uploads/main_model_image/thumb/';
$config['zoom_model_image_width'] = 1000;
$config['zoom_model_image_height'] = 1000;
$config['thumb_model_image_width'] = 193;
$config['thumb_model_image_height'] = 124;
// Image Gallery Constants [end]



//Image MAnagement [start]
$config['main_image_types'] = 'gif|jpg|jpeg|png';
$config['main_image_path'] = FCPATH.'uploads/image/';
$config['main_image_url'] = BASE_URL.'uploads/image/';
$config['thumb_image_path'] = FCPATH.'uploads/image/thumb/';
$config['thumb_image_url'] = BASE_URL.'uploads/image/thumb/';
$config['image_width'] = 5000;
$config['image_height'] = 5000;
$config['thumb_image_width'] = 225;
$config['thumb_image_height'] = 259;
//Image MAnagement [end]

//Video Gallery Constants[Start]
$config['main_video_types'] = 'mp4|vob|mpeg|mpg|wmv|avi|flv|3gp';
$config['main_video_path'] = FCPATH.'uploads/video/';
$config['main_video_url'] = BASE_URL.'uploads/video/';
$config['main_video_temp_path'] = FCPATH.'uploads/video/temp/';
$config['main_video_convert_path'] = FCPATH.'uploads/video/convert/';
$config['main_video_convert_url'] = BASE_URL.'uploads/video/convert/';
$config['main_video_thumb_path'] = FCPATH.'uploads/video/thumb/';
$config['main_video_thumb_url'] = BASE_URL.'uploads/video/thumb/';
$config['thumb_video_image_width'] = 290;
$config['thumb_video_image_height'] = 160;
$config['ffmpeg_path'] = FFMPEG_PATH;
//Video Gallery Constants[End]

// Zip upload constants [start]
$config['zip_types'] = '7z|zip|tar|gz';
$config['zip_upload_path'] = FCPATH.'uploads/zips/';
$config['zip_upload_url'] = BASE_URL.'uploads/zips/';
$config['zip_max_size'] = 1024*50;
// Zip upload constants [end]

// Product upload constants [start]
$config['product_zip_types'] = '7z|zip|tar|gz|txt|pdf|docx|doc';
$config['product_zip_upload_path'] = FCPATH.'uploads/product/zip_file/';
$config['product_zip_upload_url'] = BASE_URL.'uploads/product/zip_file/';
$config['product_zip_max_size'] = 1024*50;

$config['product_image_types'] = 'jpg|png|gif|bmp|jpeg';
$config['product_image_upload_path'] = FCPATH.'uploads/product/image_file/';
$config['product_image_upload_url'] = BASE_URL.'uploads/product/image_file/';
$config['product_thumb_image_upload_path'] = FCPATH.'uploads/product/image_file/thumb/';
$config['product_thumb_image_upload_url'] = BASE_URL.'uploads/product/image_file/thumb/';
$config['product_image_width'] = 5000;
$config['product_image_height'] = 5000;
$config['product_thumb_image_width'] = 152;
$config['product_thumb_image_height'] = 160;

$config['page_image_types'] = 'jpg|png|gif|bmp|jpeg';
$config['page_image_upload_path'] = FCPATH.'uploads/page_settings_image/';
$config['page_image_upload_url'] = BASE_URL.'uploads/page_settings_image/';
$config['page_image_upload_thumb_path'] = FCPATH.'uploads/page_settings_image/thumb/';
$config['page_image_upload_thumb_url'] = BASE_URL.'uploads/page_settings_image/thumb/';



// Zip upload constants [end]


// Email settings [start]
$config['site_admin_email'] = "arnab.involutiontech@gmail.com";
$config['site_admin_name'] = "Model Website Team";
$config['site_cc_email'] = "";
$config['site_bcc_email'] = "";
// Email settings [end]

$config['video_upload_directory'] = FCPATH.'uploads'."/".'video'."/";
$config['video_upload_convert_directory'] = FCPATH.'uploads'."/".'video'."/".'convert'."/";

$config['s_order_date_format'] = 'd/m/Y';
$config['s_blog_date_format'] = 'F d, Y';
$config['s_blog_reply_date_format'] = 'F NS, Y';
$config['s_blog_reply_time_format'] = 'h.ia';

//// User access specific config [start]////

$config['menu_access'] = array(
                                'home_menu'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'site_setings'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 

                                'user_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'menu_admin'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'add_admin'=>array(SUPER_ADMIN_ROLE), 
                                'list_admin'=>array(SUPER_ADMIN_ROLE),
                                'delt_admin'=>array(SUPER_ADMIN_ROLE),
 
                                'menu_user'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'add_user'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'list_user'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'sign_up_conf'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'delt_user'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                
                               
                                'menu_model'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'add_model'=>array(SUPER_ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_model'=>array(SUPER_ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'delt_model'=>array(SUPER_ADMIN_ROLE,SUPER_ADMIN_ROLE),
 
                                'image_gallery_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'menu_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'add_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'view_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'arc_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                
                                
                                'video_gallery_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'menu_video_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),                                 
                                'add_video_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_video_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'view_video_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                
                                'blog_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'menu_blog'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'add_blog'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_blog'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'delt_blog'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                
                                'zip_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'menu_zip'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'add_zip'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_zip'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'delt_zip'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                
                                'product_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'menu_product'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'add_product'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_product'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'delt_product'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),

                                
                                'contact_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'menu_contact'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'list_contact'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'delt_contact'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                   
                                'feed_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'menu_feed'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                'fb_feed'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'tw_feed'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),    
                                'add_feed'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'order_dash'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE  ),
                                'menu_order'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE ), 
                                'edit_order'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE  ), 
                                'order_status'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE), 
                                'list_order'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE  ),
                                'invoice_order'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE   ),
                                'refund_order'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'menu_page'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'page_feed'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'add_feed'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                
                                'menu_event'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'add_event'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'list_event'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                
                                
                                'menu_comment'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'list_comment'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),

                                'menu_page_set'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'list_page'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                
                                'menu_my_order_set'=>array(USER_ROLE, ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                
                                'list_my_order'=>array(USER_ROLE, ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                'image_gallery_dash'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'menu_image'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'add_image'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                'list_image'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                                
                                  'menu_booking'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  'list_booking'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  'menu_image_location'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  'menu_image_model'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  'menu_image_talent'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  
                                  'menu_commission'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  'list_commissiom'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE), 
                                  



                                
                             //   'view_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),
                               // 'arc_image_gallery'=>array(ADMIN_ROLE,SUPER_ADMIN_ROLE),

                                
                                /*
                                'prod_dash'=>array(ADMIN_ROLE),
                                'menu_prod'=>array(ADMIN_ROLE),
                                'mng_prod_types'=>array(ADMIN_ROLE), 
                                'add_prod'=>array(ADMIN_ROLE), 
                                'list_prod'=>array(ADMIN_ROLE),
                                'add_pkg'=>array(ADMIN_ROLE),
                                'list_pkg'=>array(ADMIN_ROLE),
                                
                                'order_dash'=>array(ADMIN_ROLE,   ),
                                'menu_order'=>array(ADMIN_ROLE,  ), 
                                'edit_order'=>array(ADMIN_ROLE,   ), 
                                'order_status'=>array(ADMIN_ROLE), 
                                'list_order'=>array(ADMIN_ROLE,   ),
                                'invoice_order'=>array(ADMIN_ROLE,   ),
                                'refund_order'=>array(ADMIN_ROLE),
                                                                
                                'blog_dash'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE), 
                                'menu_blog'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE), 
                                'add_blog'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE), 
                                'list_blog'=>array(ADMIN_ROLE, SUPER_ADMIN_ROLE),
                                
                                'training_dash'=>array(ADMIN_ROLE,  TRAINER_ROLE), 
                                'menu_training'=>array(ADMIN_ROLE,  TRAINER_ROLE), 
                                'add_training'=>array(ADMIN_ROLE, TRAINER_ROLE), 
                                'list_training'=>array(ADMIN_ROLE,  TRAINER_ROLE),
                                
                                'faq_dash'=>array(ADMIN_ROLE,   ), 
                                'menu_faq'=>array(ADMIN_ROLE,   ), 
                                'add_faq'=>array(ADMIN_ROLE), 
                                'list_faq'=>array(ADMIN_ROLE,   ),
                                'add_sugg_faq'=>array(ADMIN_ROLE,   ),
                                'del_faq'=>array(ADMIN_ROLE),
                                
                                'banner_dash'=>array(),
                                'menu_banner'=>array(ADMIN_ROLE),
                                'front_ban'=>array(ADMIN_ROLE),
                                'prod_banner'=>array(ADMIN_ROLE),
                                'prod_details_banner'=>array(ADMIN_ROLE),
                                */
                                );       
                                                     
//// User access specific config [end]////

////By  Iftekar  specific config [start]////
$config['site_email']='iftekar.involutiontech@gmail.com';
$config['date_format']='M d,Y';   
////By  Iftekar  specific config [end]////


$config['industry_array'] = array('Accounting','Auto','Consulting','Medical','Marketing/Advertising','Health/Fitness','Electronics','Service','Franchise','Retail','Sales','Online');




//////////////// Site specific config [end]/////////////////



