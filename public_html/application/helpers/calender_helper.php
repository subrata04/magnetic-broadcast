<?php 

function addCalendar($st, $et, $sub, $ade){
  $ret = array();
  try{
    $CI = & get_instance();
    $sql = "insert into `jqcalendar` (`subject`, `starttime`, `endtime`, `isalldayevent`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."' )";
    //echo($sql);
        if(mysql_query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = mysql_insert_id();
    }
    }catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


function addDetailedCalendar($st, $et, $sub, $ade, $dscr, $loc, $color, $tz,$user_id=0){
  $ret = array();
  try{
    $CI = & get_instance();
    
    $str = "";
    $flag = 0;
    $sql = "select * from `itpl_jqcalendar`";
    $res = $CI->db->query($sql);
    foreach($res->result_array() as $row){
        $st_t1 = strtotime($st);
        $et_t1 = strtotime($et);
        $st_t2 = strtotime($row['StartTime']);
        $et_t2 = strtotime($row['EndTime']);
        
        if((($st_t1 <= $st_t2) && ($st_t2 < $et_t1)) || (($st_t1 < $et_t2) && ($et_t2 <= $et_t1)) || (($st_t1 >= $st_t2) && ($et_t2 >= $et_t1))){
            $flag = 1;
            break;
        }
        

    }
    //$user_id=get_ses_data('i_user_id');
    
    $sql = "insert into `itpl_jqcalendar` (`subject`, `starttime`, `endtime`, `isalldayevent`, `description`, `location`, `color`,`user_id`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2MySqlTime(js2PhpTime($st))."', '"
      .php2MySqlTime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($color)."',".$user_id." )";
      
      
    //echo($sql);
    
    if($flag == 1){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = "In range";
        
    }else{
        if($CI->db->query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = $CI->db->insert_id();
    }
        
    }
    
    }catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  
  return $ret;
}

function listCalendarByRange($sd, $ed){
  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2JsTime($sd);
  $ret["end"] = php2JsTime($ed);
  $ret['error'] = null;
  try{
    $CI = & get_instance();
    $sql = "select * from `itpl_jqcalendar` where `starttime` between '"
      .php2MySqlTime($sd)."' and '". php2MySqlTime($ed)."'";
    $handle = $CI->db->query($sql);
    //echo $sql;
    foreach($handle->result() as $row) {
      $ret['events'][] = array(
        $row->Id,
        $row->Subject,
        php2JsTime(mySql2PhpTime($row->StartTime)),
        php2JsTime(mySql2PhpTime($row->EndTime)),
        $row->IsAllDayEvent,
        0, //more than one day event
        //$row->InstanceType,
        0,//Recurring event,
        $row->Color,
        1,//editable
        $row->Location, 
        ''//$attends
      );
    }
    }catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listCalendar($day, $type){
  $phpTime = js2PhpTime($day);
  //echo $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //echo date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
  //echo $st . "--" . $et;
  return listCalendarByRange($st, $et);
}

function updateCalendar($id, $st, $et){
  $ret = array();
  try{
    $CI = & get_instance();
    
    $str = "";
    $flag = 0;
    $sql = "select * from `itpl_jqcalendar`";
    $res = $CI->db->query($sql);
    foreach($res->result_array() as $row){
        $st_t1 = strtotime($st);
        $et_t1 = strtotime($et);
        $st_t2 = strtotime($row['StartTime']);
        $et_t2 = strtotime($row['EndTime']);
        
        if((($st_t1 <= $st_t2) && ($st_t2 < $et_t1)) || (($st_t1 < $et_t2) && ($et_t2 <= $et_t1)) || (($st_t1 >= $st_t2) && ($et_t2 >= $et_t1))){
            $flag = 1;
            break;
        }
        

    }
    
    $sql = "update `itpl_jqcalendar` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "' "
      . "where `id`=" . $id;
    //echo $sql;
    
    if($flag == 1){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = "In range";
        
    }else{
        if($CI->db->query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
    }
    }catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function updateDetailedCalendar($id, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz, $is_approve=1){
   
  $ret = array();
  try{
    $CI = & get_instance();
    
    $str = "";
    $flag = 0;
    $sql = "select * from `itpl_jqcalendar` WHERE `id` !=".$id;
    $res = $CI->db->query($sql);
    foreach($res->result_array() as $row){
        $st_t1 = strtotime($st);
        $et_t1 = strtotime($et);
        $st_t2 = strtotime($row['StartTime']);
        $et_t2 = strtotime($row['EndTime']);
        
        if((($st_t1 <= $st_t2) && ($st_t2 < $et_t1)) || (($st_t1 < $et_t2) && ($et_t2 <= $et_t1)) || (($st_t1 >= $st_t2) && ($et_t2 >= $et_t1))){
            $flag = 1;
            break;
        }
        

    }
    
    $color = ($is_approve==1)?-1:0;
    
    $sql = "update `itpl_jqcalendar` set"
      . " `starttime`='" . php2MySqlTime(js2PhpTime($st)) . "', "
      . " `endtime`='" . php2MySqlTime(js2PhpTime($et)) . "', "
      . " `subject`='" . mysql_real_escape_string($sub) . "', "
      . " `isalldayevent`='" . mysql_real_escape_string($ade) . "', "
      . " `description`='" . mysql_real_escape_string($dscr) . "', "
      . " `location`='" . mysql_real_escape_string($loc) . "', "
      . " `color`='" . mysql_real_escape_string($color) . "', "
      . " `is_approve`='" .$is_approve. "' "
      . "where `id`=" . $id;
    //echo $sql;
    
    if($flag == 1){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = "In range";
        
    }else{
        if($CI->db->query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
    }
    }catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function removeCalendar($id){
  $ret = array();
  try{
    $CI = & get_instance();
    
    $sql = "delete from `itpl_jqcalendar` where `id`=" . $id;
        if($CI->db->query($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
    }catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function js2PhpTime($jsdate){
  if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
    $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
    //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
    $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
    //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }
  return $ret;
}

function php2JsTime($phpDate){
    //echo $phpDate;
    //return "/Date(" . $phpDate*1000 . ")/";
    return date("m/d/Y H:i", $phpDate);
}

function php2MySqlTime($phpDate){
    return date("Y-m-d H:i:s", $phpDate);
}

function mySql2PhpTime($sqlDate){
    $arr = date_parse($sqlDate);
    return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);

}
