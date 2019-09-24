<?php

/**
* function country dropdown
* 
* @param mixed $i_sel_id
*/
function get_country_dd($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_name')->from('itpl_country')->get();
    //pr($o_res);
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_name']."</option>";   
            }
        }
    }
   // $html.="<option value='0' id='other'>Other.....</option>";
    unset($CI, $i_sel_id, $o_res, $m_res);                                           
    return $html;
}

/**
* function for state dropdown
* 
* @param mixed $i_sel_id
*/
function get_state_dd($i_country_id=0, $i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $CI->db->order_by('s_st_name');
    $o_res = $CI->db->select('id, s_st_name')->from('itpl_state')->where(array('i_cnt_id'=>$i_country_id))->get() ;
    //pr($o_res);
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['s_st_name']."' ".$s_select.">".$m_row['s_st_name']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}

function get_configure($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,d_ammount,s_text_to_show,i_day_of_sub,s_type')->from('itpl_configuration')->where(array('is_show_in_signup'=>1))->order_by('d_ammount','asc')->get();
    //pr($o_res);
    if($o_res->num_rows()){
        $html = "<select id=\"configure\" name=\"configure\" class=\"select\"  onchange=\"get_price(this);\" ><option value=\"\">Select Offer</option>";
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option price='$".$m_row['d_ammount']."' value='".$m_row['id']."' ".$s_select.">".$m_row['s_text_to_show']."</option>";
            }
        }
        $html .= "</select>";
    } else {
        $html ="Free forever";
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}
function get_price($id=0, $i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,d_ammount')->from('itpl_configuration')->where(array('id'=>$id))->get();
    //pr($o_res);
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select.">".$m_row['d_ammount']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}


function get_user_role_dd($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id, s_role_name')->from('itpl_user_role')->get();
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_role_name']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}

/**
* function to get user role full dataset
* 
* @param mixed $m_where
*/
function get_user_role_dataset(){
    $CI = & get_instance();
    $o_res = $CI->db->select('id, s_role_name')->from('itpl_user_role')->order_by('s_role_name')->get();    
    if($o_res->num_rows()){
        return $m_res = $o_res->result_array();
    } else {
        return array();
    }
}

/**
* function to get dropdown
* 
* @param mixed $m_arr
* @param mixed $i_sel_id
*/
function get_dd($m_arr=array(), $i_sel_id=0){
    $html = '';
    $s_select = '';
    if(count($m_arr)>0){
        foreach($m_arr as $m_key=>$m_val){
            $s_select = '';
            if($i_sel_id==$m_key){
                $s_select = "selected='selected'";
            }
            $html .= "<option value='".$m_key."' ".$s_select." >".$m_val."</option>";
        }
    }
    return $html;
}

/**
* function to get dropdown for user
* 
* @param mixed $m_arr
* @param mixed $i_sel_id
*/
function get_user_dd($m_where=array(), $m_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $CI->db->where($m_where);
    $o_res = $CI->db->select('id, s_firstname, s_lastname')->from('itpl_vw_user_details')->order_by('s_firstname')->group_by('id')->get();
    $m_res = $o_res->result_array();
    if(count($m_res)>0){
        foreach($m_res as $m_row){
            $s_select = '';
            if(in_array(intval($m_row['id']), $m_sel_id)){
                $s_select = "selected='selected'";
            }
            $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_firstname']." ".$m_row['s_lastname']."</option>";
        }
    }
    return $html;
}

function get_model_dd($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $m_where= array('i_user_role'=>3,'i_is_member' =>1)   ;
    $CI->db->where($m_where);
    $o_res = $CI->db->select('id, s_firstname, s_lastname')->from('itpl_vw_user_details')->order_by('s_firstname')->group_by('id')->get();
    $m_res = $o_res->result_array();
    if(count($m_res)>0){
        foreach($m_res as $m_row){
            $s_select = '';
            if(intval($m_row['id'])==intval($i_sel_id)){
                $s_select = "selected='selected'";
                
            }
            $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_firstname']." ".$m_row['s_lastname']."</option>";
        }
    }
    return $html;
}

function get_model_dd_album($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $m_where= array('i_user_role'=>3,'i_is_member' =>1)   ;
    $CI->db->where($m_where);
    $o_res = $CI->db->select('id, s_firstname, s_lastname')->from('itpl_vw_user_details')->order_by('s_firstname')->group_by('id')->get();
    $m_res = $o_res->result_array();
    if(count($m_res)>0){
        foreach($m_res as $m_row){
            $s_select = '';
           // $model_id= $m_row['uid'] ;
          //  $onclick="onclick='album_name_by_model($model_id)'" ;
          
          if($i_sel_id == $m_row['id']){
               $s_select = "selected='selected'";
          }
          
            $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_firstname']." ".$m_row['s_lastname']."</option>";
        }
    }
    return $html;
}

function get_model_dd_feed($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $m_where= array('i_user_role'=>3,'i_is_member'=>1)   ;
    $CI->db->where($m_where);
    $o_res = $CI->db->select('id, s_firstname, s_lastname,s_tw_scren,s_fb_url')->from('itpl_vw_user_details')->order_by('s_firstname')->group_by('id')->get();
    $m_res = $o_res->result_array();
    if(count($m_res)>0){
      
        foreach($m_res as $m_row){
            $s_select = '';
           // $model_id= $m_row['uid'] ;
          //  $onclick="onclick='album_name_by_model($model_id)'" ;
          if(($m_row['s_tw_scren']=='') && ($m_row['s_fb_url']==''))
          {
          if($i_sel_id == $m_row['id']){
               $s_select = "selected='selected'";
          }
          
            $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_firstname']." ".$m_row['s_lastname']."</option>";
        }
        }
    }
    return $html;
}

/**
* Function to get album list
* @author Arnab Chattopadhyay
* @param mixed $i_sel_id
*/


function get_album_list($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('album')->get();
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_title']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}

function album_video_name_by_model($i_model_id=0,$i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('video_album')->where(array('i_model_id'=>$i_model_id))->get();
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_title']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}
function album_name_by_model($i_model_id=0,$i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('album')->where(array('model_id'=>$i_model_id))->get();
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_title']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}

/**
* Added by Abirlal Mukherjee
*/

function get_video_album_list($i_sel_id=0){
    $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('video_album')->get();
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if(intval($i_sel_id)==intval($m_row['id'])){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_title']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}




/**
* Function to get Album Name
* @author Arnab Chattopadhyay
* @param mixed $i_sel_id
* @return string
*/
function get_album_name($i_sel_id=0){
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('album')->where(array('id'=>$i_sel_id))->get();
    $ret_ = $o_res->row_array();
    if(count($ret_))
        return ucfirst($ret_['s_title']);
    else
        return "";
}

function get_album_name_by_model($i_sel_id=0){
   // echo    $i_sel_id;
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('album')->where(array('model_id'=>$i_sel_id))->get();
    $ret_ = $o_res->row_array();
    if(count($ret_))
        return ucfirst($ret_['s_title']);
    else
        return "";
}

function get_model_name($i_sel_id=0){
    $CI = & get_instance();
    $o_res = $CI->db->select('uid,s_firstname,s_lastname')->from('user_details')->where(array('uid'=>$i_sel_id))->get();
    $ret_ = $o_res->row_array();
    if(count($ret_))
        return ucfirst($ret_['s_firstname']).' '.ucfirst($ret_['s_lastname']);  
    else
        return "";
}


/**
* Added By Abirlal Mukherjee
* 
*/

function get_video_album_name($i_sel_id=0){
    $CI = & get_instance();
    $o_res = $CI->db->select('id,s_title')->from('video_album')->where(array('i_is_allowed'=>1, 'id'=>$i_sel_id))->get();
    $ret_ = $o_res->row_array();
    if(count($ret_))
        return ucfirst($ret_['s_title']);
    else
        return "";
}

/**
* Get Payment option 
* @author Abirlal Mukherjee
*/

 function get_modelname($model_id=0) {
    // echo    $model_id;
    $CI=&get_instance(); 
    $o_res = $CI->db->select('s_firstname,s_lastname')->from('user_details')->where(array('uid'=>$model_id))->get();
          $o_res=$o_res->result_array();
        //  pr($o_res)  ;
       if(count($o_res))
       {
           foreach($o_res as $row)
           {
               $name=  ucfirst($row['s_firstname']).' '.ucfirst($row['s_lastname']);  
           }
           return $name;    
       }
        
    else
        return "";

   
     
 }



function get_payment_option($i_sel_id=''){
   $html = '';
    $s_select = '';
    $CI = & get_instance();
    $o_res = $CI->db->select('id, s_text_to_show')->from('configuration')->get();
    if($o_res->num_rows()){
        $m_res = $o_res->result_array();
        if(count($m_res)>0){
            foreach($m_res as $m_row){
                $s_select = '';
                if($i_sel_id==$m_row['id']){
                    $s_select = "selected='selected'";
                }
                $html .= "<option value='".$m_row['id']."' ".$s_select." >".$m_row['s_text_to_show']."</option>";
            }
        }
    }
    unset($CI, $i_sel_id, $o_res, $m_res);
    return $html;
}

