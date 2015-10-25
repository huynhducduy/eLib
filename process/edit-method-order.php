<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
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
			$row=mysql_fetch_assoc($query);
			if ($row['userid'] == $_SESSION['userid'])
			{
				if (($row['status'] == 0) || ($row['status'] == 1))
				{
					switch ($row['method'])
					{
						case '1':
							$sql2="UPDATE `order` SET `method`='2' WHERE `id`='".$_POST['id']."'";
						break;
						case '2':
							$sql2="UPDATE `order` SET `method`='1' WHERE `id`='".$_POST['id']."'";
						break;
					}
					@mysql_query($sql2);
					$error['done']=1;
				}
			}
		}
	die (json_encode($error));
	}
}
}
?>