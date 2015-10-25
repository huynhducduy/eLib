<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] == NULL)
{
ob_start();
session_start();
$error = array(
    'error' => 'success',
    'name' => '0',
	'class' => '0',
	'scode' => '0',
	'birthday' => '0',
	'password' => '0',
	'confirmpassword' => '0',
    'email' => '0',
	'done' => '0',
);
function email_check($s) {
	if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$s) == 1) {return true;} else {return false;}
}
function class_check($s) {
	if(preg_match('/^([0-9]{2,2})+([a-dA-d]{1,1})+([1-5]{1,1})$/',$s) == 1) {return true;} else {return false;}
}
function birthday_check($s) {
	if(preg_match('/^([0-9]{4,4})+\-([0-9]{2,2})+\-([0-9]{2,2})$/',$s) == 1) {return true;} else {return false;}
}
function is_number($s)
{
	if(preg_match('/^([0-9]+)$/',$s) == 1) {return true;} else {return false;}
}
$sub=$_POST['sub'];
if ($_POST['name'] == NULL) $error['name']='1'; else
{ 
	$name=$_POST['name']; 
	if ($_POST['class1'] == NULL) $error['class']='1'; else
	{
		$class=$_POST['class1'];
		if (!class_check($class)) $error['class']='3'; else 
		{
			if ($_POST['birthday']== NULL) $error['birthday']='1'; else
			{
				$birthday=$_POST['birthday'];
				if (!birthday_check($birthday)) $error['birthday']='3'; else
				{
					if ($_POST['email']== NULL) $error['email']='1'; else 
					{ 
						$email=$_POST['email'];
						if (!email_check($email)) $error['email']='3'; else 
						{
							if ($_POST['scode']== NULL) $error['scode']='1'; else
							{
								$scode=$_POST['scode'];
								if (!is_number($scode)) $error['scode']='3'; else
								{
									if ($_POST['password']== NULL) $error['password']='1'; else
									{
										$password=$_POST['password'];
										if ($_POST['confirmpassword'] == NULL) $error['confirmpassword']='1'; else
										{
											$confirmpassword=$_POST['confirmpassword'];
											if ($confirmpassword != $password) $error['confirmpassword']='2'; else
											{
												$sql="select * from `user` where `email`='".$email."'";
												$query=@mysql_query($sql);
												if(@mysql_num_rows($query) != NULL) $error['email']='2'; else
												{
													$sql="select * from `user` where `scode`='".$scode."'";
													$query=@mysql_query($sql);
													if(@mysql_num_rows($query) != NULL)
													{
														$error['scode']='2';
													}
													else
													{
														$sql="insert into `user`(name,email,scode,birthday,password,class) values('".$name."','".$email."','".$scode."','".$birthday."','".$password."','".$class."')";
														$query=@mysql_query($sql);
														$error['done']='1';
														if ($sub == 'sub')
														{
															$sql="select * from `subscribe` where `email`='".$email."'";
															$query=@mysql_query($sql);
															if(@mysql_num_rows($query) == NULL)
															{
																$sql="insert into `subscribe`(email) values('".$email."')";
																$query=@mysql_query($sql);
															}
														}
													}
												}
											}
										}
									} 
								}
							}
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