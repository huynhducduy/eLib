<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'done' => '0',
	);
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	if (isset($_POST['id']) && is_number($_POST['id']))
	{
		$sql="SELECT * FROM `order` WHERE `id`='".$_POST['id']."'";
		$query=@mysql_query($sql);
		if (@mysql_num_rows($query) != 0)
		{
			if ($_POST['type'] != '1')
			{
				$sql2="UPDATE `order` SET `note`='".$_POST['note']."' WHERE `id`='".$_POST['id']."'";
				@mysql_query($sql2);
			}
			else
			{
				$row=mysql_fetch_assoc($query);
				$error['note']=$row['note']!=''?$row['note']:'Không có';
			}
			$error['done']=1;
		}
	die (json_encode($error));
	}
}
?>