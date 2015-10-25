<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
ob_start();
session_start();
$error = array(
    'error' => 'success',
    'pass1' => '0',
	'password' => '0',
	'confirmpassword' => '0',
	'done' => '0',
);
if ($_POST['pass1'] == NULL) $error['pass1']='1'; else 
{
$sql="select * from `user` where `id`='".$_SESSION['userid']."' and `password`='".$_POST['pass1']."'";
$query=@mysql_query($sql);
if(@mysql_num_rows($query) == NULL) $error['pass1']='2'; else 
	{
	$pass1=$_POST['pass1']; 
	if ($_POST['password'] == NULL) $error['password']='1'; else 
		{ 
		$password=$_POST['password']; 
		if ($_POST['confirmpassword'] == NULL) $error['confirmpassword']='1'; else 
			{ 
			$confirmpassword=$_POST['confirmpassword']; 
			if ($confirmpassword != $password) { $error['confirmpassword']='2'; } else
				{
				$sql2="update `user` set `password`='".$password."' where `id`='".$_SESSION['userid']."' and `password`='".$pass1."'";
				$query2=@mysql_query($sql2);
				$error['done']='1';	
				}
			}
		}
	}
} 
}
die (json_encode($error));
}
?>