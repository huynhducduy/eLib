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
require_once('./library/view/index.php');
require_once('./library/model/index.php');
require_once('./library/view/category-sidebar.php');
require_once('./library/model/category-sidebar.php');
require_once('./library/model/hot-new-book.php');
require_once('./library/view/hot-new-book.php');
require_once('./library/view/fast-view-box.php');
require_once('./library/view/footer.php');
require_once('./library/controller/footer.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$database = new database;
$setting = new setting;
$header_model = new header_model;
$header_controller = new header_controller;
$header_view = new header_view;
$hot_new_book_model = new hot_new_book_model;
$hot_new_book_view = new hot_new_book_view;
$index_model = new index_model;
$index_view = new index_view;
$category_sidebar_model = new category_sidebar_model;
$category_sidebar_view = new category_sidebar_view;
$footer_controller = new footer_controller;
$footer_view = new footer_view;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$index_view->config();
$header_view->show();
$index_view->show();
$footer_view->show();
?>