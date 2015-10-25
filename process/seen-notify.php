<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
require_once('../assets/config.php');
if ($_POST['all'] == NULL)
{
	if ($_SESSION['userid'] != NULL)
	{
		$querynoti=@mysql_query("UPDATE `notification` SET `seen`='1' where `id`='".$_POST['id']."' and `userid`='".$_SESSION['userid']."'");
	}
}
else
{
	$querynoti=@mysql_query("UPDATE `notification` SET `seen`='1' where `seen`='0' and `userid`='".$_SESSION['userid']."'");
}
}
?>