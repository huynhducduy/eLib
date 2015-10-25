<?php
/*
// Require:
// Nothing
*/ 
class acc_sidebar_controller
{
	function handle()
	{
		if ($_SESSION['userid'] == NULL) 
		{
			return array('../../dang-nhap' => 'Đăng nhập',
			'../../dang-ky' => 'Đăng ký',
			'../../quen-mat-khau' => 'Quên mật khẩu',
			'../../theo-doi' => 'Đăng ký theo dõi');
		} 
		else 
		{
			return array('../../thong-tin' => 'Xem thông tin cá nhân',
			'../../thong-bao' => 'Thông báo',
			'../../sach-yeu-thich' => 'Sách yêu thích',
			'../../gio-sach' => 'Giỏ sách',
			'../../donsach' => 'Đơn sách',
			'../../doi-mat-khau' => 'Đổi mật khẩu',
			'javascript:logout()' => 'Đăng xuất',
			'../../theo-doi' => 'Đăng ký theo dõi');
		}
	}
}
?>