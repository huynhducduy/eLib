<?php
require_once('../assets/config.php');
if ($_SESSION["admin"] != 1)
{
	header("refresh: 0; url=/admin");
	die();
}
?>
<!DOCTYPE html>
<!--[if IE 8]><html lang="en" class="ie8 no-js"><![endif]-->
<!--[if IE 9]><html lang="en" class="ie9 no-js"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
<title><?php echo $title ?> | Bảng điều khiển quản trị</title>
<meta name="robots" content="NONE"/>
<script src="../../assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>
<link href="../../assets/global/plugins/pace/themes/pace-theme-flash.min.css" rel="stylesheet" type="text/css"/>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" type="text/css"/>
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/smoothscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="../../assets/admin/function.min.js" type="text/javascript"></script>
<?=$pagelv1?>
<?=$pagelv2?>
<link href="../../assets/global/css/components-rounded.min.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
<div class="page-header navbar" style='height: 55px;min-height: 55px;'>
	<div class="page-header-inner">
		<div class="page-logo" style='height:55px'>
			<a href="dash.php">
			<img src="../../assets/admin/layout/img/logo-light.png" alt="logo" class="logo-default" style="margin-top:18px"/>
			</a>
			<div class="menu-toggler sidebar-toggler" style="margin-top:20px">
			</div>
		</div>
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse" style="margin-top:20px"></a>
		<div class="page-top" style='height:55px'>
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown dropdown-user dropdown-dark" style="height:55px">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" style="padding-top:15px;padding-bottom:8px">
						<span class="username">Admin</span>
						<img alt="" class="img-circle" src="../../assets/admin/layout/img/avatar.png"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li onclick='adminLogout()'>
								<a><i class="icon-key"></i>Đăng xuất</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="clearfix">
</div>
<div class="page-container" style='margin-top:0'>
<?php require_once('./lib/sidebar.php'); ?>