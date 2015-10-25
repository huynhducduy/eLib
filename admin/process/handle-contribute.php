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
	if (isset($_POST['type']) && (isset($_POST['id']) && is_number($_POST['id'])))
	{
		$sql="SELECT * FROM `contribute` WHERE `id`='".$_POST['id']."'";
		$query=@mysql_query($sql);
		if (@mysql_num_rows($query) != 0)
		{
			$row=mysql_fetch_assoc($query);
			switch ($_POST['type'])
			{
				case '1':
				if ($row['status'] == 0)
				{
					$sql2="UPDATE `contribute` SET `status`='1' WHERE `id`='".$_POST['id']."'";
					$error['done']=1;
				}
				break;
				case '2':
				if ($row['status'] == 0)
				{
					$sql2="UPDATE `contribute` SET `status`='3' WHERE `id`='".$_POST['id']."'";
					$error['done']=1;
				}
				break;
				case '3':
				$error['idb']=0;
				if ($_POST['idb'] == NULL)
				{
					$error['idb']=1;
				}
				else
				{
					$sql4="SELECT * FROM `book` WHERE `id`='".$_POST['idb']."'";
					$query4=@mysql_query($sql4);
					if(@mysql_num_rows($query4) == NULL)
					{
						$error['idb']=2;
					} 
					else
					{
						if ($row['status'] == 1)
						{
							$sql2="UPDATE `contribute` SET `status`='2',`idb`='".$_POST['idb']."' WHERE `id`='".$_POST['id']."'";
							$error['done']=1;
						}
					}
				}
				break;
			}
			@mysql_query($sql2);
		}
	die (json_encode($error));
	}
}
?>