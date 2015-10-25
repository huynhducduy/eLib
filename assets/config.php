<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ob_start();
session_start();
if ($_COOKIE["userid"] != '')
{
	//$_SESSION["userid"] = $_COOKIE["userid"];
}
setcookie("firewall",1,time()+3600);
///////////////////////////////////////////////////////////////////////////////////
$db_host = "localhost"; // Giữ mặc định
$db_name    = 'lib';// Thay Đổi
$db_username    = 'root'; // Thay Đổi
$db_password    = ''; // Thay Đổi
@mysql_connect("{$db_host}", "{$db_username}", "{$db_password}") or die("ERROR");
@mysql_select_db("{$db_name}");
@mysql_query("SET NAMES 'UTF8'");
date_default_timezone_set('Asia/Ho_Chi_Minh');
///////////////////////////////////////////////////////////////////////////////////
if (!get_magic_quotes_gpc())
{
	function addslashes_array($in)
	{
		return is_array($in)?array_map('addslashes_array',$in):addslashes($in);
	}
	$_REQUEST = addslashes_array($_REQUEST);
	$_GET = addslashes_array($_GET);
	$_POST = addslashes_array($_POST);
	$_COOKIE = addslashes_array($_COOKIE);
}
?>