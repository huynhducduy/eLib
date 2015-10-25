<?php
if (isset($_POST['firewall']))
{
	setcookie("firewall",1,time()+3600);
	header("Refresh:0");
}
?>
<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title>Tường lửa | Thư viện trực tuyến THPT Lê Quý Đôn</title>
	<meta name="robots" content="noindex, nofollow"/>
	<style>
	.btn {
		margin-top: 125px;
		color: white;
		background-color: #1abc9c;
		text-decoration: none;
		display: inline-block;
		border: none;
		font-size: 25px;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;
		font-family: "Segoe UI","Segoe","Segoe WP","Tahoma","Verdana","Arial","sans-serif";
		padding: 10px 20px 10px 20px;
		cursor: pointer;
		-webkit-box-shadow: 0 10px #319380;
		-moz-box-shadow: 0 10px #319380;
		box-shadow: 0 10px #319380;
	}
	.btn:hover {
		background-color: #2AAE94;
	}
	.btn:active {
		background-color: #2AAE94;
		-webkit-box-shadow: 0 5px #319380;
		-moz-box-shadow: 0 5px #319380;
		box-shadow: 0 5px #319380;
		-webkit-transform: translateY(5px);
		-moz-transform: translateY(5px);
		-ms-transform: translateY(5px);
		-o-transform: translateY(5px);
		transform: translateY(5px);
	}
	span {
		font-size: 15px;
	}
	</style>
</head>
<body style='background-color:#ecf0f5'>
<center>
	<form action='' method='POST'>
		<button class="btn" type="submit" name='firewall'>
			<b>BẤM VÀO ĐÂY</b><br/>
			<span><b>Để tiếp tục</b></span>
		</button>
	</form>
</center>
</body>
</html>