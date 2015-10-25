<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../assets/config.php');
	if ($_SESSION['userid'] != NULL)
	{
		$error = array(
			'error' => 'success',
			'cant' => '0',
			'done' => '0',
		);
		function is_number($s)
		{
			if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
		}
		if (isset($_POST['id']) && is_number($_POST['id']))
		{
			$sql="SELECT * FROM `order` WHERE `id`='".$_POST['id']."' AND `userid`='".$_SESSION['userid']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) != 0)
			{
				$row=mysql_fetch_assoc($query);
				if (($row['status'] == 0) || ($row['status'] == 1))
				{
					$sql2="UPDATE `order` SET `status`='4' WHERE `id`='".$_POST['id']."'";
					@mysql_query($sql2);
					$error['done']=1;
				}
				else
				{
					$error['cant']=1;
				}
			}
		die (json_encode($error));
		}
	}
}
?>