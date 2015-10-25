<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] == NULL)
{
$error = array(
    'error' => 'success',
    'scode' => '0',
	'password' => '0',
	'done' => '0',
);
function is_number($s)
{
	if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
if ($_POST['scode'] == NULL) { $error['scode']='1'; } else 
{ 
	$scode=$_POST['scode'];
	if (!is_number($scode)) $error['scode']='3'; else
	{
		if ($_POST['password'] == NULL) { $error['password']='1'; }  else 
		{ 
			$password=$_POST['password']; 
			$sql="select * from `user` where `scode`='".$scode."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) == NULL) { $error['scode']='2'; } else 
			{
				$sql="select * from `user` where `password`='".$password."' and `scode`='".$scode."'";
				$query=@mysql_query($sql);
				if (@mysql_num_rows($query) == NULL) { $error['password']='2'; } else
				{
					$row=mysql_fetch_assoc($query);
					if ($row['verify'] == 0) $error['done']='2'; else
					{
						$_SESSION['userid']=$row[id];
						if ($_POST['remember'] != NULL) 
						{ 
							setcookie("userid", $row[id], time()+60*60*24*7);
						}
						$error['done']='1';
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