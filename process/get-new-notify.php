<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
	$time=time();
	$querynoti=@mysql_query("SELECT * FROM `notification` where `userid`='".$_SESSION['userid']."' and `time`>='".($time-1)."' and `time`<='".($time+1)."' and `display`='0'");
	while ($rownoti=@mysql_fetch_assoc($querynoti))
	{
		$result[]=$rownoti;
		$querynoti2=@mysql_query("UPDATE `notification` SET `display`='1' where `id`='".$rownoti['id']."'");
	}
}
die (json_encode($result));
}
?>