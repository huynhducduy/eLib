<?php
/*
// Require:
// header_model
*/ 
class header_controller
{
	function handle_color()
	{
		if (($_SESSION['color'] == NULL) 
			|| (($_SESSION['color']!='1') 
				&& ($_SESSION['color']!='2') 
				&& ($_SESSION['color']!='3') 
				&& ($_SESSION['color']!='4') 
				&& ($_SESSION['color']!='5')))
		$_SESSION['color']='1';
	}
	
	function get_color()
	{
		$this->handle_color();
		switch ($_SESSION['color'])
		{
			case '1': return 'red';
			case '2': return 'blue';
			case '3': return 'green';
			case '4': return 'orange';
			case '5': return 'gray';
			default: return 'red';	
		}	
	}
	
	function handle_color_panel($data)
	{
		if ($_SESSION['color'] == $data) return 'current';
	}
	
	function handle_pre_header()
	{
		global $header_model;
		if ($_SESSION['userid'] == NULL)
		{ 
			return array('../../dang-nhap' => 'Đăng nhập','../../dang-ky' => 'Đăng ký'); 
		}
		else { 
			return array('../../thong-tin' => $header_model->get_logging_user('name'),'javascript:logout()' => 'Đăng xuất'); 
		}
	}
	
	function handle_acc_nav()
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
	function handle_resource_nav()
	{
		if ($_SESSION['userid'] == NULL) 
		{
			return array(
			'../../sach-duoc-yeu-cau' => 'Yêu cầu đã được đáp ứng',
			'../../sach-duoc-dong-gop' => 'Sách đã được đóng góp',
			);
		}
		else
		{
			return array(
			'../../yeu-cau-sach' => 'Yêu cầu sách',
			'../../dong-gop-sach' => 'Đóng góp sách',
			'../../sach-duoc-yeu-cau' => 'Yêu cầu đã được đáp ứng',
			'../../sach-duoc-dong-gop' => 'Sách đã được đóng góp',
			);
		}
	}
}
?>