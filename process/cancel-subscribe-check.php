<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
$error = array(
    'error' => 'success',
    'email' => '0',
	'done' => '0',
);
function email_check($s) {
	if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$s) == 1) {return true;} else {return false;}
}
if ($_POST['email'] == NULL) $error['email']='1'; else 
{
	
	$email=$_POST['email']; 
	if (!email_check($email)) $error['email']='3'; else 
	{
		$sql="select * from `subscribe` where `email`='".$email."'";
		$query=@mysql_query($sql);
		$num=@mysql_num_rows($query);
		if ($num == '0') $error['email']='2'; else
		{
			$sql="delete from `subscribe` where `email`='".$email."'";
			$query=@mysql_query($sql);
			$error['done']='1';
		}
	}
}
die (json_encode($error));
}
?>