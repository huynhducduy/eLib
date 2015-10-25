<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'book' => '0', 
		'user' => '0',
		'type' => '0',
		'note' => '0',
		'done' => '0'
	);
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	if ($_POST['book'] == NULL || !is_number($_POST['book'])) 
	{
		$error['book']='1';
	}
	else
	{
		if ($_POST['user'] == NULL  || !is_number($_POST['user'])) 
		{
			$error['user']='1';
		}
		else
		{
			if ($_POST['type'] != '1' && $_POST['type'] != '2' && $_POST['type'] != '3') 
			{
				$error['type']='1';
			}
			else
			{
				$sql="SELECT * FROM `book` WHERE `id`='".$_POST['book']."'";
				$query=@mysql_query($sql);
				if (@mysql_num_rows($query) == 0)
				{
					$error['book']='2';
				}
				else
				{
					$sql2="SELECT * FROM `user` WHERE `id`='".$_POST['user']."'";
					$query2=@mysql_query($sql2);
					if (@mysql_num_rows($query2) == 0)
					{
						$error['user']='2';
					}
					else
					{
						$error['done']=1;
						$sql3="INSERT INTO `problem` (type,bid,userid,time,note) VALUES ('".$_POST['type']."','".$_POST['book']."','".$_POST['user']."','".time()."','".$_POST['note']."')";
						@mysql_query($sql3);
					}
				}
			}
		}
	}
	die (json_encode($error));
}
?>