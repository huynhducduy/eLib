<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
$error = array(
    'error' => 'success',
	'img1' => '',
	'title' => '',
	'author' => '',	
	'remain' => '0',
	'des' => '',
	'borrow' => '0',
	'rating' => '0',
	'nrating' => '0',
	'done' => '0'
);
if ($_POST['id'] != NULL) 
{ 
	$id=$_POST['id'];
	$sql="SELECT * FROM `book` where `id`='".$id."'";
	$query=@mysql_query($sql);
	if (@mysql_num_rows($query) != NULL) 
	{
		$row=@mysql_fetch_assoc($query);
		$error['done']='1';
		$error['img1']=$row['img1'];
		$error['title']=$row['title'];
		$error['author']=$row['author'];
		$error['remain']=$row['remain'];
		$error['des']=$row['des'];
		$error['borrow']=$row['borrow'];
		$error['rating']=$row['rating'];
		$error['nrating']=$row['nrating'];
	}
}
die (json_encode($error));
}
?>