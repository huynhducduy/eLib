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
	if ($_POST['content'] == NULL) { $error['err']='Bạn chưa nhập bình luận'; } 
	else 
	{ 
	$content=$_POST['content']; 
	$sqluser="SELECT * FROM `user` where `id`='".$_SESSION['userid']."'";
	$queryuser=@mysql_query($sqluser);
	$rowuser=@mysql_fetch_assoc($queryuser);	
	$sql="insert into `comment`(idb,userid,time,content) values('".$id."','".$_SESSION['userid']."','".time()."','".$content."')";
	$query=@mysql_query($sql);
	$error['done']='done';
	$error['html']="
	<div class='review-item clearfix'>
                       <div class='review-item-submitted'>
                          <strong>".$rowuser['name']."</strong>
                         <em>Vừa xong</em>
                        </div>                                              
                        <div class='review-item-content'>
                            <p>".$content."</p>
                        </div>
                      </div>
		";
	}
}
}
die (json_encode($error));
}
?>