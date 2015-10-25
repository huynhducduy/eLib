<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'slide1'   => '0',
		'slide2'     => '0',
		'done' => '0'
	);
	if ($_POST['slide1'] == NULL) 
	{
		$error['slide1']='1';
	}
	else
	{
		if ($_POST['slide2'] == NULL) 
		{
			$error['slide2']='1';
		}
		else
		{
			$error['done']=1;
			$sql3="UPDATE `setting` SET `slide1`='".$_POST['slide1']."',`slide2`='".$_POST['slide2']."' WHERE 1";
			mysql_query($sql3);
		}
	}
	die (json_encode($error));
}
?>