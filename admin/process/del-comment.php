<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'id' => '0',
		'done' => '0',
	);
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	if (($_POST['id'] == NULL) || (!is_number($_POST['id'])) || (($_POST['type'] != '1') && ($_POST['type'] != '2')))
	{
		$error['id']='1';
	}
	else
	{
		$sql="DELETE FROM `comment` WHERE `id`='".$_POST['id']."'";
		@mysql_query($sql);
		$error['done']='1';
	}
	die (json_encode($error));
}
?>