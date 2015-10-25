<?php
/*
// Require:
// acc_sidebar_view
// wishlist_model
// header_view
// hot_new_book_view
// fast_view_box_view
*/
class wishlist_view
{
	function show_heady()
	{
		global $acc_sidebar_view;
		echo "<div class='main'>
		<div class='container'>
		<ul class='breadcrumb'>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
				<li class='active'>Sách yêu thích</li>
			</ul>
			<!-- BEGIN SIDEBAR & CONTENT -->
			<div class='row margin-bottom-40'>";
		$acc_sidebar_view->show();	
		echo "<div class='col-md-9 col-sm-9 margin-bottom-20'>
		<h1>Sách yêu thích</h1>";
	}
	
	function show_footy()
	{
		global $hot_new_book_view;
		echo "</div>
		</div>";
		$hot_new_book_view->show();
		echo "</div>
		</div>";
		fast_view_box_view::show();
	}
	
	function show_wishlist()
	{
		global $wishlist_model;
		if ($_SESSION['userid'] != NULL)
		{
			$count=$wishlist_model->get_num(); 
			echo "<div class='goods-page'>
			<p style='display: none' id='emptywish'>Sách yêu thích của bạn trống</p>
					<div class='goods-data clearfix' id='content2wish'>
						<div class='table-wrapper-responsive'>
						<table summary='Shopping cart'>
						<tr>
							<th class='goods-page-image'>Hình ảnh</th>
							<th class='goods-page-title'>Tên sách</th>
							<th class='goods-page-description'>Mô tả</th>
							<th class='goods-page-stock'>Sách còn</th>
							<th class='goods-page-time' colspan='2'>Thời gian thêm</th>
						</tr>";
			$wishlist=$wishlist_model->get();
			if ($wishlist != NULL)
			{
				foreach ($wishlist as $data)
				{
					echo "<tr id='wish".$data['id']."'>
					<td class='goods-page-image'>
						<a href='../../".sf($data['title'],0).".".$data['id'].".html'><img src='../../135x180/".$data['img1']."'></a>
					</td>
					<td class='goods-page-title'>
						<h3><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a></h3>
					</td>
					<td class='goods-page-description'>
						<p>".$data['des']."</p>
					</td>
					<td class='goods-page-stock'>";
					if ($data['remain'] != 0) { echo $data['remain']; } else { echo 'Đã hết sách'; }
					echo "</td>
					<td class='goods-page-time'>
						<p>".ti_me($data[timeadd])."</p>
					</td>
					<td class='del-goods-col'>
						<a class='del-goods' onclick='delwish2(".$data[id].")'></a>
					</td>
					</tr>";
				}
			}
			echo  "<div id='contentwish' count='".$count."'></div></table>
               </div>
             </div>
           </div>
         ";
		}	
	}
	
	function show_empty()
	{
		echo "<div class='shopping-cart-page'>
		<div class='shopping-cart-data clearfix'>
		<p>Danh sách sách yêu thích của bạn trống</p>
		</div>
		</div>";
	}
	
	function show_require_login()
	{
		echo "<div class='shopping-cart-page'>
		<div class='shopping-cart-data clearfix'>
		<p>Bạn phải đăng nhập để sử dụng danh sách sách yêu thích</p>
		</div>
		</div>";
	}
	
	function show_content()
	{
		global $wishlist_model;
		$count=$wishlist_model->get_num();
		if ($count != '0') 
		{ 
			$this->show_wishlist();
		} else 
		{
			$this->show_empty();
		}
	}
	
	function show_page()
	{
		if ($_SESSION['userid'] != NULL)
		{
			$this->show_content();
		}
		else
		{
			$this->show_require_login();
		}
	}
	function config()
	{
		global $header_view;
		$header_view->robots='1';
		$header_view->title='Sách yêu thích';
		$header_view->description='Sách yêu thích';
		$header_view->keyword='sach yeu thich';
		$header_view->pagelv1="<link href='../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/rateit/src/rateit.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js' type='text/javascript'></script><!-- pop up -->
		<script src='../../assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js' type='text/javascript'></script><!-- slider for products -->
		<script src='../../assets/global/plugins/rateit/src/jquery.rateit.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Layout.init();    
				Layout.initOWL();
			});
		</script>";
	}
	function show()
	{
		$this->show_heady();
		$this->show_page();
		$this->show_footy();
	}
}
?>