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
	if (isset($_POST['number']) && (isset($_POST['id']) && is_number($_POST['id']) && is_number($_POST['number'])))
	{
		$sql="SELECT * FROM `book` WHERE `id`='".$_POST['id']."'";
		$query=@mysql_query($sql);
		if (@mysql_num_rows($query) != 0)
		{
			$row=mysql_fetch_assoc($query);
			$q=$row['number']-$row['remain'];
			$number=$row['number']+$_POST['number'];
			$remain=$number-$q;
			$sql2="UPDATE `book` SET `number`='".$number."',`remain`='".$remain."' WHERE `id`='".$_POST['id']."'";
			@mysql_query($sql2);
			$error['done']=1;
			$error['sql']=$sql2;
		}
	die (json_encode($error));
	}
}
?>