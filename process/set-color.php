<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	session_start();
	$_SESSION['color']=$_POST['color'];
}
?>