<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'inorder'   => '0',
		'dayorder'     => '0',
		'done' => '0'
	);
	if ($_POST['inorder'] == NULL) 
	{
		$error['inorder']='1';
	}
	else
	{
		if ($_POST['dayorder'] == NULL) 
		{
			$error['dayorder']='1';
		}
		else
		{
			$error['done']=1;
			$sql3="UPDATE `setting` SET `limitinorder`='".$_POST['inorder']."',`limitdayorder`='".$_POST['dayorder']."' WHERE 1";
			mysql_query($sql3);
		}
	}
	die (json_encode($error));
}
?>