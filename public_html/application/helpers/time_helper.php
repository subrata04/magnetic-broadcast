<?php 

function getHumanTime($t_time){
    $t_diff = intval(time() - $t_time);
    
    $m_timenm_arr = array('just now', 'second', 'minute', 'hour', 'day', 'week', 'month', 'year');
    $m_sec_arr = array('0', '5', '60', '3600', '86400', '604800', '2678400', '31536000');
    $i_indx = 0;
    $i_unit = 0;
    $s_add = "";
    $s_term = "";
    foreach($m_sec_arr as $k=>$i_tm){
        if($i_tm>$t_diff) {
            break;
        } else {
            $i_indx = $k;
        }
    }
    
    $s_term = $m_timenm_arr[$i_indx];
    if($i_indx>1){
        $i_unit = intval($t_diff/$m_sec_arr[$i_indx]);
        $s_add = ($i_unit>1)?"s ago":" ago";
    }elseif($i_indx==1){
        $i_unit = intval($t_diff);
        $s_add = ($i_unit>1)?"s ago":" ago";
    }else{
        $i_unit = "";
    }
    return $i_unit." ".$s_term.$s_add;
}