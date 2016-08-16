<?php
/**
 * 计算给定时间戳与当前时间相差的时间，并以一种比较友好的方式输出
 * @param  [int] $timestamp [给定的时间戳]
 * @param  [int] $current_time [要与之相减的时间戳，默认为当前时间]
 * @return [string]            [相差天数]
 */
function tmspan($timestamp,$current_time=0){
    if(!$current_time) $current_time=time();
    $span=$current_time-$timestamp;
    if($span<60){
        return "刚刚";
    }else if($span<3600){
        return intval($span/60)."分钟前";
    }else if($span<24*3600){
        return intval($span/3600)."小时前";
    }else if($span<(7*24*3600)){
        return intval($span/(24*3600))."天前";
    }else{
        return date('Y-m-d',$timestamp);
    }
 }
 
function show_mode($mode) {
    switch ($mode){
        case 0  : return    '未发货';     break;
        case 1  : return    '已发货';     break;
		case 2  : return    '取消交易';     break;
        default : return    false;      break;
    }
}

function get_prize_name($id = 0){
	$info = M('prize')->field('title')->find($id);
	if($info !== false && $info['title'] ){
		$name = $info['title'];
	} else {
		$name = '';
	}
    return $name;
}

function get_recom_url(){
	if(substr(C("WEB_URL"),0,7) != 'http://'){
		$url = 'http://'.C("WEB_URL");
	}else{
		$url = C("WEB_URL");
	}
	return $url."/?userID=".UID;
}

function recordArray($uid=''){
	if($uid){
		$movHistory=M('PlayerLog')->where('uid='.$uid)->getField('log');
	}else{
		$movHistory=cookie('movHistory');
	}
	$movHistory=json_decode(trim(stripslashes($movHistory),'"'),true);
	foreach ($movHistory as $key=>$value){
		$timeType=timeType($value['time']);
		$info=D('Movie')->field(true)->find($value['id']);
		$recordMov[$timeType]['type']=timeTypeName($timeType);
		$recordMov[$timeType]['movie'][$key]=D('Home/Tag')->movieChange($info,'movie');
		$recordMov[$timeType]['movie'][$key]['url']=$value['url'];
		$recordMov[$timeType]['movie'][$key]['purl']=$value['purl'];
	}
	return $recordMov;
}

function timeType($timestamp,$current_time=0){
	if(!$current_time) $current_time=time();
	$span=$current_time-$timestamp;
	if($span<24*3600){
		return 1;
	}else if($span<(7*24*3600)){
		return 2;
	}else{
		return 3;
	}
}

function timeTypeName($type){
	switch ($type){
	case 1:
		return "今天";
		break;  
	case 2:
		return "一周";
		break;
	default:
		return "更早";
	}
}

//只留下单一元素
function a_array_unique($array){
   $out = array();
   foreach ($array as $key=>$value) {
	   if (!in_array($value, $out)){
		   $out[$key] = $value;
	   }
   }
   return $out;
}

function unescape($str){   
	$str = rawurldecode($str);
	preg_match_all("/%u.{4}|.+/U",$str,$r);
	$ar = $r[0];
	foreach($ar as $k=>$v){
		if(substr($v,0,2) == "%u"){
			//$ar[$k] = mb_convert_encoding(pack("H4",substr($v,-4)),"UTF-8","UCS-2");
			$ar[$k] = iconv("UCS-2","UTF-8",pack("H4",substr($v,-4)));  
		}
	}
	return join("",$ar);
}
?>