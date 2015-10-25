<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'admin'   => '0',
		'page'     => '0',
		'app'   => '0',
		'gcs'    => '0',
		'gkey'    => '0',
		'done' => '0'
	);
	if ($_POST['admin'] == NULL) 
	{
		$error['admin']='1';
	}
	else
	{
		if ($_POST['page'] == NULL) 
		{
			$error['page']='1';
		}
		else
		{
			if ($_POST['app'] == NULL) 
			{
				$error['app']='1';
			}
			else
			{
				if ($_POST['gcs'] == NULL) 
				{
					$error['gcs']='1';
				}
				else
				{
					if ($_POST['gkey'] == NULL) 
					{
						$error['gkey']='1';
					}
					else
					{	
						$error['done']=1;
						$sql3="UPDATE `setting` SET `fb_id_admin`='".$_POST['admin']."',`fb_id_app`='".$_POST['app']."',`fb_id_page`='".$_POST['page']."',`gcseid`='".$_POST['gcs']."',`gkey`='".$_POST['gkey']."' WHERE 1";
						mysql_query($sql3);
					}
				}
			}
		}
	}
	die (json_encode($error));
}
?>