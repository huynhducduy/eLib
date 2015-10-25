<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'id' => '0',
		'name' => '0',
		'class' => '0',
		'birthday' => '0',
		'email' => '0',
		'scode' => '0',
		'pass' => '0',
		'done' => '0',
	);
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	function birthday_check($s) {
	if(preg_match('/^([0-9]{4,4})+\-([0-9]{2,2})+\-([0-9]{2,2})$/',$s) == 1) {return true;} else {return false;}
	}
	function email_check($s) {
	if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$s) == 1) {return true;} else {return false;}
	}
	function class_check($s) {
		if(preg_match('/^([0-9]{2,2})+([a-dA-d]{1,1})+([1-5]{1,1})$/',$s) == 1) {return true;} else {return false;}
	}
	if (($_POST['userid'] == NULL) || (!is_number($_POST['userid'])))
	{
		$error['id']='1';
	}
	else
	{
		if ($_POST['username'] == NULL) 
		{
			$error['name']='1';
		}
		else
		{
			if ($_POST['userclass'] == NULL) 
			{
				$error['class']='1';
			}
			else
			{
				if (!class_check($_POST['userclass'])) 
				{
					$error['class']='2';
				}
				else
				{
					if ($_POST['userbirthday'] == NULL) 
					{
						$error['birthday']='1';
					}
					else
					{
						if (!birthday_check($_POST['userbirthday'])) 
						{
							$error['birthday']='2';
						}
						else
						{
							if ($_POST['useremail'] == NULL) 
							{
								$error['email']='1';
							}
							else
							{
								if (!email_check($_POST['useremail'])) 
								{
									$error['email']='2';
								}
								else
								{
									if ($_POST['userscode'] == NULL) 
									{
										$error['scode']='1';
									}
									else
									{
										if (!is_number($_POST['userscode'])) 
										{
											$error['scode']='2';
										}
										else
										{
											if ($_POST['userpass'] == NULL) 
											{
												$error['pass']='1';
											}
											else
											{
												if (strlen($_POST['userpass']) < 32) 
												{
													$error['pass']='2';
												}
												else
												{
													$sql="SELECT * FROM `user` WHERE `password` = '".$_POST['userpass']."' AND `id` != '".$_POST['userid']."'";
													$query=@mysql_query($sql);
													if (@mysql_num_rows($query) > 0)
													{
														$error['pass']='3';
													}
													else
													{
														$sql="UPDATE `user` SET `name`='".$_POST['username']."',`class`='".$_POST['userclass']."',`birthday`='".$_POST['userbirthday']."',`email`='".$_POST['useremail']."',`scode`='".$_POST['userscode']."',`password`='".$_POST['userpass']."' WHERE `id`='".$_POST['userid']."'";
														@mysql_query($sql);
														$error['done']='1';
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