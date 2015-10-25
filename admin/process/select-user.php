<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$query = $_REQUEST["q"];
	$sql="SELECT `id`,`name`,`image`,`scode` FROM `user` WHERE `id` LIKE '%".$query."%' OR `name` LIKE '%".$query."%' OR `scode` LIKE '%".$query."%' OR `class` LIKE '%".$query."%' OR `email` LIKE '%".$query."%' LIMIT 0,5";
	$query=@mysql_query($sql);
	while ($row = @mysql_fetch_assoc($query))
	{
		$results[] = $row;	
	}
	echo json_encode($results);
}
?>