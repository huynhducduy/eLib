<?php
require_once('./assets/config.php');
require_once('./assets/function.php');
require_once('./assets/online.php');
/////////////////////////////////////////////////////////
require_once('./library/database.php');
require_once('./library/setting.php');
require_once('./library/check.php');
require_once('./library/model/header.php');
require_once('./library/controller/header.php');
require_once('./library/view/header.php');
require_once('./library/model/book-list.php');
require_once('./library/controller/book-list.php');
require_once('./library/view/book-list.php');
require_once('./library/view/category-sidebar.php');
require_once('./library/model/category-sidebar.php');
require_once('./library/view/form-info.php');
require_once('./library/controller/form-info.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
require_once('./library/view/fast-view-box.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$check = new check;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$book_list_model = new book_list_model;
$book_list_controller = new book_list_controller;
$book_list_view = new book_list_view;
$category_sidebar_model = new category_sidebar_model;
$category_sidebar_view = new category_sidebar_view;
$form_info_controller = new form_info_controller;
$form_info_view = new form_info_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$book_list_view->check_ajax();
$book_list_view->config();
$header_view->show();
$book_list_view->show();
$footer_view->show();
?>