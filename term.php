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
require_once('./library/view/term.php');
require_once('./library/model/term.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$term_model = new term_model;
$term_view = new term_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$term_view->config();
$header_view->show();
$term_view->show();
$footer_view->show();
?>