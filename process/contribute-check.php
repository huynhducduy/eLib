<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
$error = array(
    'error' => 'success',
    'title' => '0',
	'author' => '0',
	'image' => '0',
	'reason' => '0',
	'imagemethod' => '0',
	'done' => '0',
);
function getExt($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return strtolower($ext);
}
$size=3; //MB
$mimes = array('jpeg','png','gif','jpg','tiff','bmp');
if ($_POST['title'] == NULL) $error['title']='1'; else
{	
$title=$_POST['title'];
	if ($_POST['author'] == NULL) $error['author']='1'; else
	{	
	$author=$_POST['author'];
		if ($_POST['imagemethod'] == '1')
		{
			if ($_FILES['image']['name'] != NULL)
			{
				if (in_array(getExt($_FILES['image']['name']),$mimes))
				{
					if ($_FILES["image"]["size"] <= 1024*1024*$size)
					{
						$name=md5(rand(0,9999999)).md5(rand(0,9999999)).".".getExt($_FILES['image']['name']);
						move_uploaded_file($_FILES["image"]["tmp_name"], "../upload/".$name);
						$image="upload/".$name;
						$sqlr="insert into `contribute`(title,author,time,image,userid) values('".$title."','".$author."','".time()."','".$image."',".$_SESSION['userid'].")";
						$queryr=@mysql_query($sqlr);
						$error['done']='1';
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
				$error['image']='1';
			}
		}
		else if ($_POST['imagemethod'] == '2')
		{
			if ($_POST['image'] != NULL)
			{
				$image=$_POST['image'];
				$sqlr="insert into `contribute`(title,author,time,image,userid) values('".$title."','".$author."','".time()."','".$image."',".$_SESSION['userid'].")";
				$queryr=@mysql_query($sqlr);
				$error['done']='1';
			}
			else
			{
				$error['image']='1';
			}
		} else if ($_POST['imagemethod'] == '3')
		{
			$sqlr="insert into `contribute`(title,author,time,userid) values('".$title."','".$author."','".time()."',".$_SESSION['userid'].")";
			$queryr=@mysql_query($sqlr);
			$error['done']='1';
		}
	}	
}
}
die (json_encode($error));
}
?>