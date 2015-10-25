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
require_once('./library/model/contributed.php');
require_once('./library/controller/contributed.php');
require_once('./library/view/contributed.php');
require_once('./library/view/resource-sidebar.php');
require_once('./library/controller/resource-sidebar.php');
require_once('./library/view/form-info.php');
require_once('./library/controller/form-info.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
require_once('./library/view/fast-view-box.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$contributed_model = new contributed_model;
$contributed_controller = new contributed_controller;
$contributed_view = new contributed_view;
$resource_sidebar_controller = new resource_sidebar_controller;
$resource_sidebar_view = new resource_sidebar_view;
$form_info_controller = new form_info_controller;
$form_info_view = new form_info_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$contributed_view->check_ajax();
$contributed_view->config();
$header_view->show();
$contributed_view->show();
$footer_view->show();
?>