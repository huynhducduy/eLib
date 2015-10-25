<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
	$error = array(
		'error' => 'success'
	);
	$sql="select * from `book` where `id`='".$_POST['bookid']."'";
	$query=@mysql_query($sql);
	if (@mysql_num_rows($query) != NULL)
	{
		$row=@mysql_fetch_assoc($query);
		$x=explode('|',$row['drating']);
		$c=-1;
		foreach ($x as $data)
		{
			$c++;
			$y=explode(',',$data);
			$sum=$sum+$y['1'];
			if ($y['0'] == $_SESSION['userid'])
			{
				$kt=1;
				$sum=$sum-$y['1'];
				$x[$c]=$y['0'].",".$_POST['value'];
			}
		}
		if ($kt != 1)
		{
			$nrating=$row['nrating']+1;
			$drating=$row['drating']."|".$_SESSION['userid'].",".round($_POST['value'],1);
			$rating=round(($row['rating']*$row['nrating']+$_POST['value'])/$nrating,1);
		}
		else
		{
			$nrating=$row['nrating'];
			$drating=implode('|',$x);	
			$rating=round(($sum+$_POST['value'])/$nrating,1);
		}
		$sqlrate="update `book` set `rating`='".$rating."',`nrating`='".$nrating."',`drating`='".$drating."' where `id`='".$_POST[bookid]."'";
		$queryrate=@mysql_query($sqlrate);
	}
}
die (json_encode($error));
}
?>