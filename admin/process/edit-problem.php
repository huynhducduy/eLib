<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'id' => '0',
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
	if ($_POST['id'] == NULL || !is_number($_POST['id'])) 
	{
		$error['id']='1';
	}
	else
	{
		$sql0="SELECT * FROM `problem` WHERE `id`='".$_POST['id']."'";
		$query0=@mysql_query($sql0);
		if (@mysql_num_rows($query0) == 0)
		{
			$error['id']='2';
		}	
		else
		{
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
								$sql3="UPDATE `problem` SET `type`='".$_POST['type']."',`bid`='".$_POST['book']."',`userid`='".$_POST['user']."',`note`='".$_POST['note']."' WHERE `id`='".$_POST['id']."'";
								@mysql_query($sql3);
							}
						}
					}
				}
			}
		}
	}
	die (json_encode($error));
}
?>