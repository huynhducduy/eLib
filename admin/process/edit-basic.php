<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'title'   => '0',
		'des'     => '0',
		'intro'   => '0',
		'term'    => '0',
		'keyword' => '0',
		'domain'  => '0',
		'done' => '0'
	);
	if ($_POST['title'] == NULL) 
	{
		$error['title']='1';
	}
	else
	{
		if ($_POST['des'] == NULL) 
		{
			$error['des']='1';
		}
		else
		{
			if ($_POST['intro'] == NULL) 
			{
				$error['intro']='1';
			}
			else
			{
				if ($_POST['term'] == NULL) 
				{
					$error['term']='1';
				}
				else
				{
					if ($_POST['keyword'] == NULL) 
					{
						$error['keyword']='1';
					}
					else
					{
						if ($_POST['domain'] == NULL) 
						{
							$error['domain']='1';
						}
						else
						{
							$error['done']=1;
							$sql3="UPDATE `setting` SET `title`='".$_POST['title']."',`description`='".$_POST['des']."',`introduce`='".$_POST['intro']."',`term`='".$_POST['term']."',`keyword`='".$_POST['keyword']."',`domain`='".$_POST['domain']."' WHERE 1";
							@mysql_query($sql3);
						}
					}
				}
			}
		}
	}
	die (json_encode($error));
}
?>