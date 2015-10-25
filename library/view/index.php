<?php
class index_view
{
	function show_carousel()
	{
		global $setting;
		echo "<div class='front-carousel margin-bottom-30' style='margin-top: -22px;z-index: -1;'>
		<div id='myCarousel' class='carousel slide' data-ride='carousel'>
		<ol class='carousel-indicators'>";
		$x=explode('|',$setting->get('slide1'));
		for ($c=0;$c<count($x);$c++)
		{
			if ( $c == 0 ) { echo "<li data-target='#myCarousel' data-slide-to='".$c."' class='active'></li>"; }
			else { echo "<li data-target='#myCarousel' data-slide-to='".$c."'></li>";}
		}
		echo "
		</ol>
		<div class='carousel-inner'>";
		$c=1;
		foreach ($x as $data)
		{   
			if($data != '')
			{
				$y=explode(',',$data);
				if ($c==1)
				{ 
					echo "<div class='item active'><a href='".$y['1']."'><img src='".$y['0']."' style='width:100%'></a></div>"; 
				} 
				else 
				{
					echo "<div class='item'><a href='".$y['1']."'><img src='".$y['0']."' style='width:100%'></a></div>"; 
				} 
				$c=0;
			}
		}
		echo "
		</div>
		<a class='left carousel-control' href='#myCarousel' data-slide='prev'>
			<span class='glyphicon glyphicon-chevron-left'></span>
		</a>
		<a class='right carousel-control' href='#myCarousel' data-slide='next'>
			<span class='glyphicon glyphicon-chevron-right'></span>
		</a>
		</div>
		</div>";
	}
	function show_sidebar()
	{
		global $category_sidebar_view;
		echo "<div class='sidebar col-md-3 col-sm-5'>
		<ul class='list-group margin-bottom-25 sidebar-menu'>";
		$category_sidebar_view->show(1,0);
		echo "</ul>
		</div>";
	}
	function show_hot_new()
	{
		global $index_model;
		$result = $index_model->get_hot_new();
		echo "<div class='col-md-9 col-sm-8'>
        <h2>Sách mới - hot</h2>
        <div class='owl-carousel owl-carousel5'>";
		foreach ($result as $data)
		{
			echo "<div>
			<div class='product-item'>
			<div class='pi-img-wrapper'>
			<img src='../../194x260/".$data['img1']."' class='img-responsive' alt='".$data['title']."' title='".$data['title']."'>
			<div>
			<a href='#product-pop-up' class='btn btn-default fancybox-fast-view' onclick='fastview(".$data['id'].")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;Xem thêm</a>
			</div>
			</div>
			<h3 style='padding-bottom: 0'><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a><br/><span class='author2'>".$data['author']."</span></h3>";
			if ($data['remain'] > 0)
			{ echo "<a onclick='cart(".$data['id'].")' class='btn btn-default add2cart'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; }
			else { echo "<a href='javascript:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; }
			if ($data['hot'] ==1) echo "<div class='sticker sticker-hot'></div>";
			if ($data['new'] ==1) echo "<div class='sticker sticker-new'></div>";
			echo "</div></div>";
		}
		echo "</div>
        </div>";
	}
	function show_row1()
	{
		echo "<div class='row margin-bottom-10'>";
		$this->show_sidebar();
		$this->show_hot_new();
		echo "</div>";
	}
	function show_rec()
	{
		global $index_model;
		echo "<div class='col-md-6 two-items-bottom-items'>
        <h2>Sách nên đọc</h2>
        <div class='owl-carousel owl-carousel3'>";
		$result = $index_model->get_rec(); 
		foreach ($result as $data)
		{
			echo "<div>
			<div class='product-item'>
			<div class='pi-img-wrapper'>
			<img src='../../194x260/".$data['img1']."' class='img-responsive' alt='".$data['title']."' title='".$data['title']."'>
			<div>
			<a href='#product-pop-up' class='btn btn-default fancybox-fast-view' onclick='fastview(".$data['id'].")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;Xem thêm</a>
			</div>
			</div>
			<h3 style='padding-bottom: 0'><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a><br/><span class='author2'>".$data['author']."</span></h3>";
			if ($data['remain'] > 0)
			{ echo "<a onclick='cart(".$data['id'].")' class='btn btn-default add2cart'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; }
			else { echo "<a href='javascript:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; }
			if ($data['hot'] ==1) echo "<div class='sticker sticker-hot'></div>";
			else if ($data['new'] ==1) echo "<div class='sticker sticker-new'></div>";
			echo "</div></div>";
		}
		echo "</div>
        </div>";
	}
	function show_car2()
	{
		global $setting;
		echo "<div class='col-md-6 shop-index-carousel'>
          <div class='content-slider'>
            <div id='myCarousel1' class='carousel slide' data-ride='carousel'>
              <ol class='carousel-indicators'>";
		$x=explode('|',$setting->get('slide2'));
		for ($c=0;$c<count($x);$c++)
		{
			if ( $c == 0 ) { echo "<li data-target='#myCarousel1' data-slide-to='".$c."' class='active'></li>"; }
			else { echo "<li data-target='#myCarousel1' data-slide-to='".$c."'></li>";}
		}
		echo "</ol>
        <div class='carousel-inner'>";
		$c=1;
		foreach ($x as $data)
		{   
			if($data != '')
			{
				$y=explode(',',$data);
				if ($c==1)
				{ 
					echo "<div class='item active'><a href='".$y['1']."'><img src='".$y['0']."' style='width:100%'></a></div>"; 
				} 
				else 
				{
					echo "<div class='item'><a href='".$y['1']."'><img src='".$y['0']."' style='width:100%'></a></div>"; 
				} 
				$c=0;
			}
		}
			  echo "</div>
            </div>
          </div>
        </div>";
	}
	function show_row2()
	{
		echo "<div class='row margin-bottom-35'>";
		$this->show_rec();
		$this->show_car2();
		echo "</div>";
	}
	function show_row3()
	{
		echo "<div class='row margin-bottom-40'>";
		$sql='SELECT * FROM `cate1`'; 
		$query=@mysql_query($sql);
		while($row=@mysql_fetch_assoc($query))
		{
			$sql2="SELECT * FROM `cate2` where `id1`='".$row['id']."'"; 
			$query2=@mysql_query($sql2); 
			while($row2=@mysql_fetch_assoc($query2))
			{
				echo "
				<div class='col-md-12 sale-product' style='margin-bottom: 10px'>
				<h2><a style='text-decoration: none;' href='../../".sf($row['title'],0).".".$row['id']."'>".$row['title']."</a> / <a style='text-decoration: none;' href='../".sf($row['title'],0)."/".sf($row2['title'],0).".".$row2['id']."'>".$row2['title']."</a></h2>
				<div class='owl-carousel owl-carousel5'>
				";
				$sqlall="SELECT * FROM `book` where `cid`=".$row2['id']." order by `id` DESC LIMIT 0,5";
				$queryall=@mysql_query($sqlall);
				if (@mysql_num_rows($queryall) != 0)
				{
					while ($rowall=@mysql_fetch_assoc($queryall))
					{
						echo "<div>
						<div class='product-item'>
						<div class='pi-img-wrapper'>
						<img src='../../194x260/".$rowall['img1']."' class='img-responsive' alt='".$rowall['title']."' title='".$rowall['title']."'>
						<div>
						<a href='#product-pop-up' class='btn btn-default fancybox-fast-view' onclick='fastview(".$rowall['id'].")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;Xem thêm</a>
						</div>
						</div>
						<h3 style='padding-bottom: 0'><a href='../../".sf($rowall['title'],0).".".$rowall['id'].".html'>".$rowall['title']."</a><br/><span class='author2'>".$rowall['author']."</span></h3>
						<div class='pi-price'>";
						if ($rowall['rating'] != 0)
						{
							echo "<div class='rateit' data-rateit-value='".$rowall['rating']."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
						} 
						echo "</div>";
						if ($rowall['remain'] > 0)
						{ echo "<a onclick='cart(".$rowall['id'].")'class='btn btn-default add2cart'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; }
						else { echo "<a href='javascript:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; }
						if ($rowall['hot'] ==1) echo "<div class='sticker sticker-hot'></div>";
						else if ($rowall['new'] ==1) echo "<div class='sticker sticker-new'></div>";
						echo "</div>
						</div>";
					}
				}
				echo "</div>
			</div>";
			}
		}
        echo "</div>";
	}
	function show_main()
	{
		echo "<div class='main'>
		<div class='container'>";
		$this->show_row1();
		$this->show_row2();
		$this->show_row3();
		echo "</div>
		</div>";
		fast_view_box_view::show();
	}
	function config()
	{
		global $header_view;
		$header_view->pagelv1="<link href='../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/rateit/src/rateit.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js' type='text/javascript'></script><!-- pop up -->
		<script src='../../assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js' type='text/javascript'></script><!-- slider for products -->
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/rateit/src/jquery.rateit.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Layout.init();    
				Layout.initOWL();
			});
		</script>";
		$header_view->title='Trang chủ';
		$header_view->description='Trang chủ';
		$header_view->keyword='trang chu';
	}
	function show()
	{
		$this->show_carousel();
		$this->show_main();
	}
}
?>