<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$query = $_REQUEST["q"];
	$sql="SELECT `id`,`title`,`img1`,`cid` FROM `book` WHERE `title` LIKE '%".$query."%' OR `id` LIKE '%".$query."%' OR `des` LIKE '%".$query."%' OR `keyword` LIKE '%".$query."%' LIMIT 0,5";
	$query=@mysql_query($sql);
	while ($row = @mysql_fetch_assoc($query))
	{
		$sql2="SELECT `title`,`id1` FROM `cate2` WHERE `id`='".$row['cid']."'";
		$query2=@mysql_query($sql2);
		$row2=@mysql_fetch_assoc($query2);
		$sql3="SELECT `title` FROM `cate1` WHERE `id`='".$row2['id1']."'";
		$query3=@mysql_query($sql3);
		$row3=@mysql_fetch_assoc($query3);
		$row['cate']=$row3['title'].' / '.$row2['title'];
		$results[] = $row;	
	}
	echo json_encode($results);
}
?>