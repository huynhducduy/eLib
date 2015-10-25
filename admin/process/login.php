<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	$error = array(
	    'error' => 'success',
		'done' => '0',
	);
	if ($_POST['user'] == 'admin' && $_POST['pass'] == 'admin')
	{
		$error['done']=1;
		$_SESSION["admin"]=1;
	}
	die (json_encode($error));
}
?>