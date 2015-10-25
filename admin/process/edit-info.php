<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'mail'   => '0',
		'phone'     => '0',
		'addr'   => '0',
		'skype'    => '0',
		'yh' => '0',
		'done' => '0'
	);
	if ($_POST['mail'] == NULL) 
	{
		$error['mail']='1';
	}
	else
	{
		if ($_POST['phone'] == NULL) 
		{
			$error['phone']='1';
		}
		else
		{
			if ($_POST['addr'] == NULL) 
			{
				$error['addr']='1';
			}
			else
			{
				if ($_POST['skype'] == NULL) 
				{
					$error['skype']='1';
				}
				else
				{
					if ($_POST['yh'] == NULL) 
					{
						$error['yh']='1';
					}
					else
					{
						$error['done']=1;
						$sql3="UPDATE `setting` SET `admin_mail`='".$_POST['mail']."',`admin_phone`='".$_POST['phone']."',`admin_address`='".$_POST['addr']."',`admin_skype`='".$_POST['skype']."',`admin_yahoo`='".$_POST['yh']."' WHERE 1";
						mysql_query($sql3);
					}
				}
			}
		}
	}
	die (json_encode($error));
}
?>