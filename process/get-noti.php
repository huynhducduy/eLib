<?php 
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
function ti_me($time_ago)
{
	if ($time_ago == '') return 'Không có';
	$cur_time=time();
	$time_elapsed = $cur_time - $time_ago;
	$seconds = $time_elapsed ;
	$minutes = round($time_elapsed / 60 );
	$hours = round($time_elapsed / 3600);
	$days = round($time_elapsed / 86400 );
	$weeks = round($time_elapsed / 604800);
	$months = round($time_elapsed / 2600640 );
	$years = round($time_elapsed / 31207680 );
	if($seconds <= 60)
	{
		return $time_ago='Cách đây '.$seconds.' giây';
	}
	else if($minutes <=60)
	{
		return $time_ago='Cách đây '.$minutes.' phút';
	}
	else if($hours <=24)
	{
		return $time_ago="Cách đây $hours tiếng";
	}
	else if($days <= 7)
	{
		return $time_ago='Cách đây '.$days.' ngày';
	}
	else if($weeks <= 4.3)
	{
		return $time_ago='Cách đây '.$weeks.' tuần';
	}
	else if($months <=12)
	{
		return $time_ago='Cách đây '.$months.' tháng';
	}
	else
	{
		return $time_ago='Cách đây '.$years.' năm';
	}
}
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	if ($page < 1) {
		$page = 1;
	}
	$limit = 10;
	$start = ($limit * $page) - $limit;
	$querynoti=@mysql_query("SELECT * FROM `notification` where `userid`='".$_SESSION['userid']."' ORDER BY `id` DESC LIMIT ".$start.",".($limit + 1));
	while ($rownoti=@mysql_fetch_assoc($querynoti))
	{
		$rownoti['time']=ti_me($rownoti['time']);
		$result[]=$rownoti;
	}
	die (json_encode($result));
}
}
?>