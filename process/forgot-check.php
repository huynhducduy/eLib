<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] == NULL)
{
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
		$sql="select * from `user` where `email`='".$email."'";
		$query=@mysql_query($sql);
		if (@mysql_num_rows($query) == NULL) $error['email']='2';
		else
		{
			$newpass = substr(substr(md5(rand(0,999999)),rand(1,26)),1,6);
			$sql2="update `user` set `password`='".md5($newpass)."' where `email`='".$email."'";
			$query2=@mysql_query($sql2);
			// GỬI MAIL ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$error['done']='1';
		}
	}	
}
}
die (json_encode($error));
}
?>