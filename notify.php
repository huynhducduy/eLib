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
require_once('./library/model/notify.php');
require_once('./library/view/notify.php');
require_once('./library/view/acc-sidebar.php');
require_once('./library/controller/acc-sidebar.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
require_once('./library/view/fast-view-box.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$notify_model = new notify_model;
$notify_view = new notify_view;
$acc_sidebar_controller = new acc_sidebar_controller;
$acc_sidebar_view = new acc_sidebar_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$notify_view->config();
$header_view->show();
$notify_view->show();
$footer_view->show();
?>