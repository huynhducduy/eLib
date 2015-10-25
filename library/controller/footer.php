<?php
/*
// Require:
// setting
*/ 
class footer_controller
{
	function handle_info()
	{
		return array(
			'../../quy-dinh' => 'Quy định của thư viện',
			'../../lien-he' => 'Liên hệ',
			'../../tro-giup' => 'Trợ giúp',
			'../../sitemap.xml' => 'Sitemap',
		);
	}
	function handle_contact()
	{
		global $setting;
		return array(
		'Địa chỉ' => array ($setting->get('admin_address')),
		'Điện thoại' => array ($setting->get('admin_phone')),
		'Email' => array ($setting->get('admin_mail'),'mailto:'.$setting->get('admin_mail')),
		'Skype' => array ($setting->get('admin_skype'),'skype:'.$setting->get('admin_skype')),
		'Yahoo' => array ($setting->get('admin_yahoo'),'yahoo:'.$setting->get('admin_yahoo')),
		);
	}
}
?>