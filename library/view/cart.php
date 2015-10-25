<?php
/*
// Require:
// acc_sidebar_view
// cart_model
// header_view
// hot_new_book_view
// fast_view_box_view
*/
class cart_view
{
	function show_heady()
	{
		global $acc_sidebar_view;
		echo "<div class='main'>
		<div class='container'>
		<ul class='breadcrumb'>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
				<li class='active'>Giỏ sách</li>
			</ul>
			<!-- BEGIN SIDEBAR & CONTENT -->
			<div class='row margin-bottom-40'>";
		$acc_sidebar_view->show();	
		echo "<div class='col-md-9 col-sm-9 margin-bottom-20'>
		<h1>Giỏ sách</h1>";
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
	
	function show_cart()
	{
		global $cart_model;
		if ($_SESSION['userid'] != NULL)
		{
			$count=$cart_model->get_cart_num(); 
			echo "
			<div class='goods-page' id='content' count='".$count."'>
				<p style='display: none' id='emptycart'>Giỏ sách của bạn trống</p>
				<div class='goods-data clearfix' id='content2'>
					<div class='table-wrapper-responsive'>
						<table summary='shopping cart'>
							<tr>
								<th class='goods-page-image'>Hình ảnh</th>
								<th class='goods-page-title'>Tên sách</th>
								<th class='goods-page-description' colspan='2'>Mô tả</th>
							</tr>";
			if ($count>0)
			{
				$cart=$cart_model->get_cart();
				foreach ($cart as $data)
				{
							echo "
							<tr id='2cart".$data['id']."'>
								<td class='goods-page-image'>
									<a href='../../".sf($data['title'],0).".".$data['id'].".html'><img src='../../135x180/".$data['img1']."'></a>
								</td>
								<td class='goods-page-title'>
									<h3><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a></h3>
								</td>
								<td class='goods-page-description'>
									<em>".$data['des']."</em>
								</td>
								<td class='del-goods-col'>
									<a id='delcart".$data['id']."' class='del-goods' alt='Bỏ khỏi giỏ sách' title='Bỏ khỏi giỏ sách' onclick='delcart(".$data['id'].")'>&nbsp;</a>
								</td>
							</tr>
							";
				}
			}
			echo "		</table>
					</div>
					<div class='shopping-total'>
					<ul>
					<li class='shopping-total-price'>
						<em>Số sách</em>
						<strong class='price' id='content4'>".$count." Cuốn</strong>
					</li>
					</ul>
				</div>
			</div>      
			<a href='../../datsach'><button class='btn btn-primary' type='button' style='margin-bottom: 10px;'>Đặt sách <i class='fa fa-check'></i></button></a>";	
		}	
	}
	
	function show_empty()
	{
		echo "<div class='shopping-cart-page'>
		<div class='shopping-cart-data clearfix'>
		<p>Giỏ sách của bạn trống</p>
		</div>
		</div>";
	}
	
	function show_require_login()
	{
		echo "<div class='shopping-cart-page'>
		<div class='shopping-cart-data clearfix'>
		<p>Bạn phải đăng nhập để sử dụng giỏ sách</p>
		</div>
		</div>";
	}
	
	function show_content()
	{
		global $cart_model;
		$count=$cart_model->get_cart_num();
		if ($count != '0') 
		{ 
			$this->show_cart();
		} else 
		{
			$this->show_empty();
		}
		$this->show_continue();
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
	
	function show_continue()
	{
		echo "<div class='goods-page'>
			<a href='".$_SERVER['HTTP_REFERER']."'><button class='btn btn-default' type='submit'>Tiếp tục chọn sách <i class='fa fa-shopping-cart'></i></button></a>
		</div>";
	}
	function config()
	{
		global $header_view;
		$header_view->robots='1';
		$header_view->title='Giỏ sách';
		$header_view->description='Giỏ sách';
		$header_view->keyword='gio sach';
		$header_view->pagelv1="<link href='../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/rateit/src/rateit.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js' type='text/javascript'></script><!-- pop up -->
		<script src='../../assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js' type='text/javascript'></script><!-- slider for products -->
		<script src='../../assets/global/plugins/zoom/jquery.zoom.min.js' type='text/javascript'></script><!-- product zoom -->
		<script src='../../assets/global/plugins/rateit/src/jquery.rateit.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Layout.init();    
				Layout.initOWL();
				Layout.initImageZoom();
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