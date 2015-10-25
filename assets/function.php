<?php
// Lấy phần mở rộng
function getExt($str) {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return strtolower($ext);
}
// Làm chuẩn
function sf($str,$lol){
	$unicode = array(
	'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|ä|å|æ' , 
	'd'=>'đ|ð', 
	'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 
	'i'=>'í|ì|ỉ|ĩ|ị|î|ï', 
	'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 
	'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 
	'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 
	'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ä|Å|Æ' , 
	'D'=>'Đ', 
	'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë', 
	'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï', 
	'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 
	'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 
	'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ', 
	'-'=>' ',
	''=>'|~|!|@|#|$|%|^|&|_|=|{|}|\|:|;|"|<|,|>|[.,]|[(,]|[),]'
	);
	foreach ($unicode as $nonUnicode=>$uni){
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
	}
	if ($lol == 1) { return strtoupper($str); } else { return strtolower($str); }
}
// Cắt chuỗi
function cut($s,$len){
	if (mb_strlen($s,'UTF-8') > $len)
	{
		return mb_substr($s,0,$len,'UTF-8')."..."; 
	}
		else
	{
		return mb_substr($s,0,$len,'UTF-8');
	}
}
// Xác định thời gian (Hàm giá trị)
function ti_me($time_ago)
{
	$cur_time=time();
	$time_elapsed = $cur_time - $time_ago;
	$seconds = $time_elapsed ;
	$minutes = round($time_elapsed / 60 );
	$hours = round($time_elapsed / 3600);
	$days = round($time_elapsed / 86400 );
	$weeks = round($time_elapsed / 604800);
	$months = round($time_elapsed / 2600640 );
	$years = round($time_elapsed / 31207680 );
	if ($seconds <= 60)
	{
		return $time_ago='Cách đây '.$seconds.' giây';
	}
	else if ($minutes <=60)
	{
		return $time_ago='Cách đây '.$minutes.' phút';
	}
	else if ($hours <=24)
	{
		return $time_ago="Cách đây $hours tiếng";
	}
	else if ($days <= 7)
	{
		return $time_ago='Cách đây '.$days.' ngày';
	}
	else if ($weeks <= 4.3)
	{
		return $time_ago='Cách đây '.$weeks.' tuần';
	}
	else if ($months <=12)
	{
		return $time_ago='Cách đây '.$months.' tháng';
	}
	else
	{
		return $time_ago='Cách đây '.$years.' năm';
	}
}
// Lấy ngôn ngữ
function get_lang($str){
	$lang = array(
	'Ngôn ngữ khác'=>'0' , 
	'Tiếng Việt'=>'1', 
	'Tiếng Anh'=>'2', 
	'Tiếng Pháp'=>'3', 
	'Tiếng Đức'=>'4', 
	'Tiếng Nhật'=>'5', 
	'Tiếng Trung'=>'6', 
	'Tiếng Hàn'=>'7' 
	);
	foreach ($lang as $lang2=>$n){
		$str =preg_replace("/($n)/i", $lang2, $str);
	}
	return $str;
}
// Loại bỏ trong text
function st($str) {
	return preg_replace('/([^\pL\.\\~\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\+\\[\\]\\{\\}\\:\\"\\;\\:\\,\\<\\.\\>\\/\\?]+)/u', '',strip_tags($str)); 
}
// Kiểm tra số nguyên
function is_number($s)
{
	if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
// Kiểm tra email
function email_check($s) {
	if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$s) == 1) {return true;} else {return false;}
}
// Kiểm tra lớp
function class_check($s) {
	if(preg_match('/^([0-9]{2,2})+([a-dA-d]{1,1})+([1-5]{1,1})$/',$s) == 1) {return true;} else {return false;}
}
// Kiểm tra ngày sinh
function birthday_check($s) {
	if(preg_match('/^([0-9]{4,4})+\-([0-9]{2,2})+\-([0-9]{2,2})$/',$s) == 1) {return true;} else {return false;}
}
?>