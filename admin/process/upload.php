<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	ob_start();
	session_start();
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'image' => '0',
	    'link' => '',
		'done' => '0',
	);
	function getExt($str) {
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return strtolower($ext);
	}
	function rand_str() {
		$str='';
		$length=rand(4,8);
		$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$chars=str_shuffle($chars);
		$size=strlen($chars);
		for($i=0;$i<$length;$i++) {
			$str.=$chars[rand(0,$size-1)];
		}
		return $str.str_shuffle($str);
	}
	$size=3; //MB
	$mimes = array('jpeg','png','gif','jpg','tiff','bmp');
	if ($_FILES['image']['name'] != NULL)
	{
		if (in_array(getExt($_FILES['image']['name']),$mimes))
		{
			if ($_FILES["image"]["size"] <= 1024*1024*$size)
			{
				$name=rand_str().".".getExt($_FILES['image']['name']);
				move_uploaded_file($_FILES["image"]["tmp_name"], "../../upload/".$name);
				$error['link']="upload/".$name;
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
	die (json_encode($error));
}
?>