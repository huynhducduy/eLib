<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
	$error = array(
		'error' => 'success',
		'err' => '0',
		'done' => '0',
		'thanks' => '0',
		'lol' => '0'
	);
	if ($_POST['id'] == NULL) { $error['err']='2'; } 
	else 
	{ 
		$id=$_POST['id'];  
		$sqlreview="SELECT * FROM `review` where `id`='".$id."'";
		$queryreview=@mysql_query($sqlreview);
		if (@mysql_num_rows($queryreview) == NULL)
		{
			$error['err']='3';
		}
		else
		{
			$rowreview=@mysql_fetch_assoc($queryreview);
			if ($rowreview['nthanks'] == 0) 
			{
				$sql="update `review` set `nthanks`='1',`dthanks`='".$_SESSION['userid'].",' where `id`='".$id."'";
				$query=@mysql_query($sql);
				$error['done']='1';
				$error['thanks']='1';
				$error['lol']='1';
			}
			else
			{
				$x=explode(',',$rowreview['dthanks']);
				$c=-1;
				foreach ($x as $data)
				{
					$c++;
					if ($data == $_SESSION['userid'])
					{
					$x['$c']='';
					$dthanks=implode(',',$x);
					$nthanks=$rowreview['nthanks']-1;
					$sql="update `review` set `nthanks`='".$nthanks."',`dthanks`='".$dthanks."' where `id`='".$id."'" ;
					$query=@mysql_query($sql);
					$kt='1';
					$error['done']='1';
					$error['thanks']=$nthanks;
					break;
					}
				}
				if ($kt == NULL)
				{
					$nthanks=$rowreview['nthanks']+1;
					$sql="update `review` set `nthanks`='".$nthanks."',`dthanks`='".$rowreview['dthanks'].$_SESSION['userid'].",' where `id`='".$id."'" ;
					$query=@mysql_query($sql);
					$error['done']='1';
					$error['thanks']=$nthanks;
					$error['lol']='1';
				}	
			}
		}
	}
}
else
{
	$error = array(
		'error' => 'success',
		'err' => '1',
		'done' => '0'
	);
}
die (json_encode($error));
}
?>