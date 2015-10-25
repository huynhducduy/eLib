<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ob_start();
session_start();
if ($_SESSION["admin"] == 1)
{
	header("refresh: 0; url=dash.php");
	die();
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8"/>
<title>Đăng nhập | Bảng điều khiển quản trị</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/pages/css/login.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/components-rounded.min.css" id="style_components" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="login">
<div class="logo">
</div>
<div class="content">
	<form class="login-form" onsubmit='return adminLogin();'>
		<h3 class="form-title">Đăng nhập</h3>
		<div class="alert alert-danger" id='error' style='display:none'>
			<button class="close" data-close="alert"></button>
			<span>Thông tin đăng nhập không chính xác</span>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Tên đăng nhập</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id='user'/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Mật khật</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id='pass'/>
		</div>
		<div class="form-actions" style='padding-bottom:0;'>
			<button type="submit" class="btn btn-success uppercase">Đăng nhập</button>
		</div>
	</form>
</div>
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/scripts/metronic.min.js" type="text/javascript"></script>
<script>
function adminLogin()
{
	$.ajax({
		url : 'process/login.php',
		type : 'post',
		dataType : 'json',
		data : {
			user : $('#user').val(),
			pass : $('#pass').val(),
		},
		success : function (result)
		{
			if (!result.hasOwnProperty('error') || result['error'] != 'success')
			{
				alert('ERROR');
				return false;
			}
			else
			{
				if (result.done == '1') {
					window.location='dash.php';
				} else
				{
					$('#error').show('fast');
				}
			}
		}
	});
	return false;
}
jQuery(document).ready(function() {	
	Metronic.init();
});
</script>
</body>
</html>