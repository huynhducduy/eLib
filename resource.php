<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ob_start();
session_start();
if ($_SESSION["userid"] != NULL)
{
	require_once('request.php');
}
else
{
	require_once('requested.php');
}
?>