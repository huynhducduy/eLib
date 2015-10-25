<?php
require_once('./assets/config.php');
require_once('./assets/function.php');
require_once('./assets/online.php');
/////////////////////////////////////////////////////////
require_once('./library/database.php');
require_once('./library/check.php');
require_once('./library/setting.php');
require_once('./library/model/header.php');
require_once('./library/controller/header.php');
require_once('./library/view/header.php');
require_once('./library/view/search.php');
require_once('./library/model/search.php');
require_once('./library/controller/search.php');
require_once('./library/view/fast-view-box.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$check = new check;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$search_model = new search_model;
$search_controller = new search_controller;
$search_view = new search_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$search_view->check_ajax();
$search_view->config();
$header_view->show();
$search_view->show();
$footer_view->show();
?>