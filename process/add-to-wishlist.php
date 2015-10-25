<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
$error = array(
    'error' => 'success',
	'id' =>'0',
	'done' => '0',
);
function is_number($s)
{
	if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
if ($_SESSION['userid'] != NULL)
{
	if (isset($_POST['id']) && is_number($_POST['id'])) 
	{
		$id=$_POST['id'];
		$sqluser="SELECT * FROM `user` where `id`='".$_SESSION['userid']."'";
		$queryuser=@mysql_query($sqluser);
		$rowuser=@mysql_fetch_assoc($queryuser);
		$x=explode('|',$rowuser['wishlist']);
		foreach ($x as $data)
		{
			$y=explode(',',$data);
			if ($y['0'] == $id)
			{
				$kt='1'; // Đã có sách trong wishlist
				break;
			}
		}
		if ($kt == NULL)
		{
			if ($_POST['del'] != '1')
			{
				$sqlwish="SELECT * FROM `book` WHERE `id`='".$id."'";
				$querywish=@mysql_query($sqlwish);
				if (@mysql_num_rows($querywish) != 0)
				{
							$sqlupdatewish="UPDATE `user` SET `wishlist`='".$rowuser['wishlist'].$id.",".time()."|' WHERE `id`='".$_SESSION['userid']."'";
							$queryupdatewish=@mysql_query($sqlupdatewish);
							$error['done']='1';
				}
				else
				{
					$error['id']='3'; // Sách không có thật
				}
			}
			else
			{
				$error['id']='5'; // Không có trong wishlist để xóa
			}
		}
		else
		{
			if ($_POST['del'] != '1')
			{
				$error['id']='2'; // Đã có sách trong wishlist
			}
			else
			{
				$c=-1;
				foreach ($x as $data)
				{
					$c++;
					$y=explode(',',$data);
					if ($y['0'] == $id)
					{
						unset($x[$c]);
						break;
					}
				}
				$kq=implode($x,'|');
				$sqlupdatewish="UPDATE `user` SET `wishlist`='".$kq."' WHERE `id`='".$_SESSION['userid']."'";
				$queryupdatewish=@mysql_query($sqlupdatewish);
				$error['done']='1';
			}
		}
	}
	else
	{
		$error['id']='1'; // Lỗi
	}
}
else
{
	$error['id']='4'; // Chưa đăng nhập
}
die (json_encode($error));
}
?>