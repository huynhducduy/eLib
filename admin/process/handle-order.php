<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'done' => '0',
	);
	function sf($str,$lol){
		$unicode = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|ä|å|æ' , 
		'd'=>'đ|ð', 
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ', 
		'i'=>'í|ì|ỉ|ĩ|ị|î|ï', 
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ', 
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự', 
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ', 
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Ä|Å|Æ' , 
		'D'=>'Đ', 
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë', 
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï', 
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ', 
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự', 
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ', 
		'-'=>' ',
		''=>'|~|!|@|#|$|%|^|&|_|=|{|}|\|:|;|"|<|,|>|[.,]|[(,]|[),]'
		);
		foreach ($unicode as $nonUnicode=>$uni){
			$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		}
		if ($lol == 1) { return strtoupper($str); } else { return strtolower($str); }
	}
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	if (isset($_POST['type']) && (isset($_POST['id']) && is_number($_POST['id'])))
	{
		$sql="SELECT * FROM `order` WHERE `id`='".$_POST['id']."'";
		$query=@mysql_query($sql);
		if (@mysql_num_rows($query) != 0)
		{
			$row=mysql_fetch_assoc($query);
			switch ($_POST['type'])
			{
				case '1':
				if (($row['status'] == 0) || ($row['status'] == 1))
				{
					$sql2="UPDATE `order` SET `status`='4' WHERE `id`='".$_POST['id']."'";
					$sql3="INSERT INTO `notification`(`userid`,`content`,`link`,`time`,`type`) VALUES ('".$row['userid']."','Đơn sách #".$row['id']." của bạn đã bị hủy','../../donsach/".$row['id']."','".time()."','error')";
					@mysql_query($sql3);
				}
				break;
				case '2':
				if ($row['status'] == 0)
				{
					$sql2="UPDATE `order` SET `status`='1' WHERE `id`='".$_POST['id']."'";
					$sql3="INSERT INTO `notification`(`userid`,`content`,`link`,`time`,`type`) VALUES ('".$row['userid']."','Đơn sách #".$row['id']." của bạn đã được BQT xác nhận, bạn có thể đến thư viện để nhận sách','../../donsach/".$row['id']."','".time()."','success')";
					@mysql_query($sql3);
				}
				break;
				case '3':
				if ($row['status'] == 1)
				{
					$sql2="UPDATE `order` SET `status`='2',`timestart`='".time()."' WHERE `id`='".$_POST['id']."'";
					$sql3="SELECT * FROM `eachorder` WHERE `oid`='".$_POST['id']."'";
					$query3=@mysql_query($sql3);
					while ($row3=@mysql_fetch_assoc($query3))
					{
						$sql4="SELECT * FROM `book` WHERE `id`='".$row3['bid']."'";
						$query4=@mysql_query($sql4);
						$row4=@mysql_fetch_assoc($query4);
						$num=$row4['remain']-1;
						$borrow=$row4['borrow']+1;
						$sql5="UPDATE `book` SET `remain`='".$num."',`borrow`='".$borrow."' WHERE `id`='".$row4['id']."'";
						@mysql_query($sql5);
					}
				}
				break;
				case '4':
				if ($row['status'] == 2)
				{
					$sql2="UPDATE `order` SET `status`='3',`timestop`='".time()."' WHERE `id`='".$_POST['id']."'";
					$sql3="SELECT * FROM `eachorder` WHERE `oid`='".$_POST['id']."'";
					$query3=@mysql_query($sql3);
					while ($row3=@mysql_fetch_assoc($query3))
					{
						$sql4="SELECT * FROM `book` WHERE `id`='".$row3['bid']."'";
						$query4=@mysql_query($sql4);
						$row4=@mysql_fetch_assoc($query4);
						$num=$row4['remain']+1;
						if ($num == 1)
						{
							$sql7="SELECT * FROM `user` WHERE `wishlist` LIKE '%".$row4['id'].",%'";
							$query7=mysql_query($sql7);
							while ($row7=mysql_fetch_assoc($query7))
							{
								$sql6="INSERT INTO `notification`(`userid`,`content`,`link`,`time`,`type`) VALUES ('".$row7['id']."','Cuốn ".$row4['title']." vừa có sách, bạn có thể mượn nó ngay!','../../".sf($row4['title'],0).".".$row4['id'].".html','".time()."','success')";
								mysql_query($sql6);
							}
						}
						$sql5="UPDATE `book` SET `remain`='".$num."' WHERE `id`='".$row4['id']."'";
						@mysql_query($sql5);
					}
				}
				break;
				case '5':
				if ($row['status'] == 0 && $row['status'] == 0)
				{
					$sql2="UPDATE `order` SET `reconfirm`='1' WHERE `id`='".$_POST['id']."'";
					$sql3="INSERT INTO `notification`(`userid`,`content`,`link`,`time`,`type`) VALUES ('".$row['userid']."','Đơn sách #".$row['id']." của bạn đã được BQT thay đổi, vui lòng xác nhận lại','../../donsach/".$row['id']."','".time()."','warning')";
					@mysql_query($sql3);
				}
				break;
				case '6':
				if ($row['status'] == 2)
				{
					$sql2="INSERT INTO `notification`(`userid`,`content`,`link`,`time`,`type`) VALUES ('".$row['userid']."','Đơn sách #".$row['id']." của bạn đã quá hạn trả, bạn vui lòng trả sách cho thư viện sớm nhất có thể','../../donsach/".$row['id']."','".time()."','error')";
				}
				break;
			}
			@mysql_query($sql2);
			$error['done']=1;
		}
	die (json_encode($error));
	}
}
?>