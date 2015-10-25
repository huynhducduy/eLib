<?php
/*
// Require:
// hot_new_book_model
*/
class hot_new_book_view
{
	function show_new()
	{
		echo "<div class='row margin-bottom-10'>
		<div class='col-md-12 col-sm-12'>
		<h2>Sách mới</h2>
		<div class='owl-carousel owl-carousel5'>";
		global $hot_new_book_model;
		$new=$hot_new_book_model->get_new();
		foreach ($new as $data)
		{
			echo "<div>
			<div class='product-item'>
			<div class='pi-img-wrapper'>
			<img src='../../194x260/".$data['img1']."' class='img-responsive' alt='".$data['title']."' title='".$data['title']."'>
			<div>
			<a href='#product-pop-up' class='btn btn-default fancybox-fast-view' onclick='fastview(".$data['id'].")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;Xem thêm</a>
			</div>
			</div>
			<h3 style='padding-bottom: 0'><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a><br/><span class='author2'>".$data['author']."</span></h3>
			<div class='pi-price'>";
			if ($data['rating'] != 0)
			{
				echo "<div class='rateit' data-rateit-value='".$data['rating']."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
			} 
			echo "</div>";
			if ($data['remain'] > 0)
			{ echo "<a class='btn btn-default add2cart' onclick='cart(".$data['id'].")'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; }
			else { echo "<a href='javascript:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; }
			echo "</div>
			</div>";
		}
		echo "
		</div>
		</div>
		</div>";
	}
	
	function show_hot()
	{
		echo "<div class='row margin-bottom-10'>
		<div class='col-md-12 col-sm-12'>
		<h2>Sách hot</h2>
		<div class='owl-carousel owl-carousel5'>";
		global $hot_new_book_model;
		$hot=$hot_new_book_model->get_hot();
		foreach ($hot as $data)
		{
			echo "<div>
			<div class='product-item'>
			<div class='pi-img-wrapper'>
			<img src='../../194x260/".$data['img1']."' class='img-responsive' alt='".$data['title']."' title='".$data['title']."'>
			<div>
			<a href='#product-pop-up' class='btn btn-default fancybox-fast-view' onclick='fastview(".$data['id'].")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;Xem thêm</a>
			</div>
			</div>
			<h3 style='padding-bottom: 0'><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a><br/><span class='author2'>".$data['author']."</span></h3>
			<div class='pi-price'>";
			if ($data['rating'] != 0)
			{
				echo "<div class='rateit' data-rateit-value='".$data['rating']."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
			} 
			echo "</div>";
			if ($data['remain'] > 0)
			{ echo "<a class='btn btn-default add2cart' onclick='cart(".$data['id'].")'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; }
			else { echo "<a href='javascript:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; }
			echo "</div>
			</div>";
		}
		echo "
		</div>
		</div>
		</div>";
	}
	
	function show()
	{
		$this->show_new();
		$this->show_hot();
	}
}