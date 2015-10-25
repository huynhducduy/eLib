<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
require_once('../assets/config.php');
if ($_SESSION['userid'] != NULL)
{
$error = array(
    'error' => 'success',
    'err' => '',
	'done' => '',
	'html' => ''
);
if ($_POST['idb'] == NULL) { $error['err']='Lỗi'; } 
else 
{ 
	$id=$_POST['idb'];
	if ($_POST['content'] == NULL) { $error['err']='Bạn chưa nhập nhận xét'; } 
	else 
	{ 
	$content=$_POST['content']; 
	if ($_POST['rating'] == 0) { $error['err']='Bạn chưa đánh giá'; } 
		else 
		{
		$sqluser="SELECT * FROM `user` where `id`='".$_SESSION['userid']."'";
		$queryuser=@mysql_query($sqluser);
		$rowuser=@mysql_fetch_assoc($queryuser);			
		$rating=$_POST['rating']; 
		$time=time();
		$sql="insert into `review`(idb,userid,time,content,rating) values('".$id."','".$_SESSION['userid']."','".$time."','".$content."','".$rating."')";
		$query=@mysql_query($sql);
		$error['done']='done';
		$sql2="select * from `review` where `idb`='".$id."' and `userid`='".$_SESSION['userid']."' and `time`='".$time."' and `content`='".$content."' and `rating`='".$rating."' LIMIT 0,1";
		$query2=@mysql_query($sql2);
		$row2=@mysql_fetch_assoc($query2);
		$error['html']="
		<div class='review-item clearfix'>
                        <div class='review-item-submitted'>
                          <strong>".$rowuser[name]."</strong>
                          <em>Vừa xong</em>
                          <div class='rateit' data-rateit-value='".$rating."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>
						  <a class='btn btn-xs default btn-thanks' id='tks".$row2['id']."' alt='Cảm ơn' title='Cảm ơn' onclick='thanks(".$row2['id'].")'>
						  <i class='fa fa-thumbs-o-up' id='tksi".$row2['id']."'></i> <span id='tkst".$row2['id']."'>0</span></a>
                        </div>                                              
                        <div class='review-item-content'>
                            <p>".$content."</p>
                        </div>
                      </div>
		<script src='../../assets/global/plugins/rateit/src/jquery.rateit.js' type='text/javascript'></script>
		";
		}
	}
}
}
die (json_encode($error));
}
?>