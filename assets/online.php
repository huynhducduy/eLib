<?php
$time=time();
$out=300; // second
$new=$time - $out;
if ($_SESSION['userid'] != NULL)
{
	$userid=$_SESSION['userid'];
}
else
{
	$userid=0;
}
if ($_SERVER['X_FORWARDED_FOR'] != NULL)
{
	$X_FORWARDED_FOR=explode(",", $_SERVER['X_FORWARDED_FOR']);
	$count = count($X_FORWARDED_FOR);
	if($count =0 ) {
		$REMOTE_ADDR=trim($X_FORWARDED_FOR);
	} else {
		$REMOTE_ADDR=trim($X_FORWARDED_FOR[0]);
	}
} else {
	$REMOTE_ADDR=$_SERVER['REMOTE_ADDR'];
}
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
	$X_FORWARDED_FOR=explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
	$REMOTE_ADDR=trim($X_FORWARDED_FOR[0]);
} else {
	$REMOTE_ADDR=$_SERVER['REMOTE_ADDR']; 
}
$self=$_SERVER['REQUEST_URI'];

$sql="insert into online(`time`,`ip`,`local`,`userid`) values('{$time}','{$REMOTE_ADDR}','{$self}','{$userid}')";
$query=@mysql_query($sql);
$sql="delete from `online` where `time` < '{$new}'";
$query=@mysql_query($sql);
// Get user đang online
/* $sqlonline='SELECT DISTINCT `ip`,`userid` FROM `online`';
$queryonline=@mysql_query($sqlonline);
$online=@mysql_num_rows($queryonline); */
?>