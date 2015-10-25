<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
$error = array(
    'error' => 'success',
	'done' => '0',
	'acceptterm' => '0',
	'pass' => '0',
	'confirminfo' => '0',
	'borrowmethod' => '0',
	'note' => '0',
	'limit' => '0'
);
function is_number($s)
{
	if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
if ($_POST['acceptterm'] != '1') { $error['acceptterm']='1'; } else 
{
	if ($_POST['pass'] == NULL) { $error['pass']='1'; }  else 
	{ 
		$sql="select * from `user` where `id`='".$_SESSION['userid']."' and `password`='".$_POST['pass']."'";
		$query=@mysql_query($sql);
		if (@mysql_num_rows($query) == NULL) { $error['pass']='2'; } else 
		{
			if ($_POST['confirminfo'] != '1') { $error['confirminfo']='1'; } else 
			{
				if (($_POST['borrowmethod'] != '1')
					&& ($_POST['borrowmethod'] != '2'))
				{ $error['borrowmethod']='1'; } 
				else 
				{
					if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
					{
						$sqlchecklimit="SELECT * FROM `order` WHERE `status` IN (0,1,2) AND `userid`='".$_SESSION['userid']."'";
						$querychecklimit=@mysql_query($sqlchecklimit);
						if (@mysql_num_rows($querychecklimit) == 0)
						{
							$error['done']='1';
							$time=time();
							$sql="INSERT INTO `order`(`userid`, `time`, `note`, `count`, `status`,`method`) VALUES ('".$_SESSION['userid']."','".$time."','".$_POST['note']."','".count($_SESSION['cart'])."','0','".$_POST['borrowmethod']."')";
							@mysql_query($sql);
							$sql2="SELECT * FROM `order` WHERE `userid`='".$_SESSION['userid']."' AND `time`='".$time."' AND `note` = '".$_POST['note']."' AND `count`='".count($_SESSION['cart'])."' AND `status`='0' AND `method`='".$_POST['borrowmethod']."'";
							$query2=mysql_query($sql2);
							$row2=mysql_fetch_assoc($query2);
							$oid = $row2['id'];
							foreach ($_SESSION['cart'] as $data1 => $data2)
							{
								$sql3="INSERT INTO `eachorder`(`bid`,`oid`) VALUES ('".$data1."','".$oid."')";
								@mysql_query($sql3);
							}
							unset($_SESSION['cart']);
						}
						else
						{
							$error['limit']=1;
						}
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