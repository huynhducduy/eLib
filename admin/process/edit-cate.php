<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'image' => '0',
		'id' => '0',
		'cate' => '0',
		'title' => '0',
		'description' => '0',
		'keyword' => '0',
		'done' => '0',
	);
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	function getExt($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return strtolower($ext);
	}
	$size=3; //MB
	$mimes = array('jpeg','png','gif','jpg','tiff','bmp');
	if (($_POST['cateid'] == NULL) || (!is_number($_POST['cateid'])) || (($_POST['catetype'] != '1') && ($_POST['catetype'] != '2')))
	{
		$error['id']='1';
	}
	else
	{
		if ($_POST['catetitle'] == NULL) 
		{
			$error['title']='1';
		}
		else
		{
			if ($_POST['catedescription'] == NULL) 
			{
				$error['description']='1';
			}
			else
			{
				if ($_POST['catekeyword'] == NULL) 
				{
					$error['keyword']='1';
				}
				else
				{
					if ((($_POST['catecate'] == NULL) || (!is_number($_POST['catecate']))) && ($_POST['catetype'] == '2')) 
					{
						$error['cate']='2';
					}
					else
					{
						if (($_POST['cateimagestatus'] == '1') && ($_FILES['cateimage']['name'] != NULL))
						{
							if (in_array(getExt($_FILES['cateimage']['name']),$mimes))
							{
								if ($_FILES["cateimage"]["size"] <= 1024*1024*$size)
								{
									$size = getimagesize($_FILES["cateimage"]["tmp_name"]);
									if (($size[0] >= 1500) && ($size[1] >= 280) && ($size[0]/$size[1]) > 5)
									{
										$name=md5(rand(0,9999999)).md5(rand(0,9999999)).".".getExt($_FILES['cateimage']['name']);
										move_uploaded_file($_FILES["cateimage"]["tmp_name"], "../../upload/".$name);
										if ($_POST['catetype'] == '2')
										{
											$sql="UPDATE `cate2` SET `id1`='".$_POST['catecate']."',`title`='".$_POST['catetitle']."',`description`='".$_POST['catedescription']."',`keyword`='".$_POST['catekeyword']."',`title-wrapper`='upload/".$name."' WHERE `id`='".$_POST['cateid']."'";
										}
										else if ($_POST['catetype'] == '1')
										{
											$sql="UPDATE `cate1` SET `title`='".$_POST['catetitle']."',`description`='".$_POST['catedescription']."',`keyword`='".$_POST['catekeyword']."',`title-wrapper`='upload/".$name."' WHERE `id`='".$_POST['cateid']."'";
										}
										@mysql_query($sql);
										$error['done']='1';
									}
									else
									{
										$error['image']='4';
									}
								}
								else
								{
									$error['image']='3';
								}
							}
							else
							{
								$error['image']='2';
							}
						}
						else
						{
							if ($_POST['catetype'] == '2')
							{
								$sql="UPDATE `cate2` SET `id1`='".$_POST['catecate']."',`title`='".$_POST['catetitle']."',`description`='".$_POST['catedescription']."',`keyword`='".$_POST['catekeyword']."',`title-wrapper`='' WHERE `id`='".$_POST['cateid']."'";
							}
							else if ($_POST['catetype'] == '1')
							{
								$sql="UPDATE `cate1` SET `title`='".$_POST['catetitle']."',`description`='".$_POST['catedescription']."',`keyword`='".$_POST['catekeyword']."',`title-wrapper`='' WHERE `id`='".$_POST['cateid']."'";
							}
							@mysql_query($sql);
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