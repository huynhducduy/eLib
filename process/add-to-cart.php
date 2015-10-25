<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
$error = array(
    'error' => 'success',
	'id' =>'0',
	'limit' => '0',
	'done' => '0'
);
function is_number($s)
{
	if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
if ($_SESSION['userid'] != NULL)
{
	$sqllimitinorder='SELECT `limitinorder` FROM `setting`;';
	$querylimitinorder=@mysql_query($sqllimitinorder);
	$rowlimitinorder=@mysql_fetch_assoc($querylimitinorder);
	
		if (isset($_POST['id']) && is_number($_POST['id'])) 
		{
			$id=$_POST['id'];
			if(!isset($_SESSION['cart'][$id]))
			{
				if ($_POST['del'] != '1')
				{
					if (count($_SESSION['cart']) < $rowlimitinorder['limitinorder'])
					{
						$sqlcart="SELECT * FROM `book` WHERE `id`='".$id."'";
						$querycart=@mysql_query($sqlcart);
						if (@mysql_num_rows($querycart) != 0)
						{
							$rowcart=@mysql_fetch_assoc($querycart);
							if ($rowcart['remain'] != 0)
							{
								$_SESSION['cart'][$id]='1';
								$error['done']='1';
							}
							else
							{
								$error['id']='6'; // Đã hết sách
							}
						}
						else
						{
							$error['id']='3'; // Sách không có thật
						}
					}
					else
					{
						$error['limit']='1'; // Quá số sách được mượn
					}
				}
				else
				{
					$error['id']='5'; // Không có trong giỏ hàng để xóa
				}
			}
			else
			{
				if ($_POST['del'] != '1')
				{
					$error['id']='2'; // Đã có sách trong giỏ
				}
				else
				{
					unset($_SESSION['cart'][$id]);
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