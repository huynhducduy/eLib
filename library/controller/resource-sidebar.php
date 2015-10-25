<?php
/*
// Require:
// nothing
*/
class resource_sidebar_controller
{
	function handle()
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