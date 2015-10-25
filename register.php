<?php
require_once('./assets/config.php');
require_once('./assets/function.php');
require_once('./assets/online.php');
/////////////////////////////////////////////////////////
require_once('./library/database.php');
require_once('./library/setting.php');
require_once('./library/model/header.php');
require_once('./library/controller/header.php');
require_once('./library/view/header.php');
require_once('./library/view/register.php');
require_once('./library/view/acc-sidebar.php');
require_once('./library/controller/acc-sidebar.php');
require_once('./library/view/form-info.php');
require_once('./library/controller/form-info.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$register_view = new register_view;
$acc_sidebar_controller = new acc_sidebar_controller;
$acc_sidebar_view = new acc_sidebar_view;
$form_info_controller = new form_info_controller;
$form_info_view = new form_info_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$register_view->config();
$header_view->show();
$register_view->show();
$footer_view->show();
?>