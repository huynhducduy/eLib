<?php
/*
// Require:
// header_model
// header_controller
// setting
// database
*/
class header_view
{
	var $title;
	var $robots;
	var $description;
	var $keyword;
	var $image;
	var $pagelv1;
	var $pagelv2;
	function show_head()
	{
		global $setting;
		global $header_controller;
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
		<!--[if IE 8]> <html lang='en' class='ie8 no-js'> <![endif]-->
		<!--[if IE 9]> <html lang='en' class='ie9 no-js'> <![endif]-->
		<!--[if !IE]><!-->
		<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='vi'>
		<!--<![endif]-->
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta content='width=device-width, initial-scale=1.0' name='viewport'>  
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<title>".$this->title." | ".$setting->get('description')."</title>
		<link rel='shortcut icon' href='../../favicon.ico' type='image/x-icon'>
		<link rel='icon' href='../../favicon.ico' type='image/x-icon'>
		<meta property='og:title' content='".$this->title." | ".$setting->get('description')."'/>
		<meta name='description' class='description' content='".$this->description." - ".$setting->get('description')."' />
		<meta name='abstract' class='description' content='".$this->description." - ".$setting->get('description')."'>
		<meta property='og:description' class='description' content='".$this->description." - ".$setting->get('description')."' />
		<meta name='keyword' class='keyword' content='".$this->keyword.",".$setting->get('keyword')."' />
		<meta property='og:url' itemprop='url' content='http://".$setting->get('domain').$_SERVER['REQUEST_URI']."'/>
		<link rel='canonical' href='http://".$setting->get('domain').$_SERVER['REQUEST_URI']."' />";
		if ($this->image == NULL)
		{
			echo "<meta property='og:image' content='http://".$setting->get('domain')."/".$setting->get('logo')."' />
			<link rel='image_src' href='http://".$setting->get('domain')."/".$setting->get('logo')."' />";
		}
		else
		{
			echo "<meta property='og:image' content='http://".$setting->get('domain')."/".$this->image."' />
			<link rel='image_src' href='http://".$setting->get('domain')."/".$this->image."' />";
		}
		echo "
		<meta property='fb:admins' content='".$setting->get('fb_id_admin')."' />
		<meta property='fb:app_id' content='".$setting->get('fb_id_app')."' />
		<meta property='article:author' content='http://www.facebook.com/".$setting->get('fb_id_page')."' />   
		<meta property='article:publisher' content='http://www.facebook.com/".$setting->get('fb_id_page')."' />";
		if ($this->rating != '')
		{ echo "<meta name='rating' content='".$this->rating."' />"; }
		echo "<meta name='generator' content='Notepad++' />
		<meta name='copyright' content='Huỳnh Đức Duy' />
		<meta name='author' content='Huỳnh Đức Duy' />
		<meta property='og:site_name' content='".$setting->get('domain')."' />
		<meta property='og:locale' content='vi_VN' />
		<meta property='og:type' content='website'/>
		<meta http-equiv='Page-Exit' content='BlendTrans(Duration=0)' /> 
		<meta http-equiv='Page-Enter' content='BlendTrans(Duration=0)' />  
		<meta http-equiv='Content-Script-Type' content='text/javascript' />
		<meta http-equiv='Content-Style-Type' content='text/css' />
		<meta http-equiv='Content-Language' content='vi' />
		<link rel='alternate' href='http://".$setting->get('domain')."' hreflang='vi-vn' />
		<meta name='reply-to' content='".$setting->get('admin_mail')."'>
		<meta name='geo.placename' content='Việt Nam'>
		<meta name='geo.region' content='vn'>
		<meta name='language' content='vietnamese' />
		<meta name='distribution' content='global' />
		<meta name='google' content='notranslate' />
		<meta name='resource-type' content='document' />";
		if ($this->robots != '1')
		{ echo "<meta name='robots' content='all' />"; }
		else { echo "<meta name='robots' content='none' />";}
		echo "<meta name='classification' content='SEO' />
		<link href='../../assets/global/plugins/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		".$this->pagelv1."
		<link href='../../assets/global/css/components.min.css' rel='stylesheet'>
		<link href='../../assets/global/css/plugins.min.css' rel='stylesheet'>
		<link href='../../assets/frontend/layout/css/style.min.css' rel='stylesheet'>
		<link href='../../assets/frontend/pages/css/style-shop.min.css' rel='stylesheet' type='text/css'>
		<link href='../../assets/frontend/layout/css/style-responsive.min.css' rel='stylesheet'>
		<link href='../../assets/frontend/layout/css/themes/".$header_controller->get_color().".min.css' rel='stylesheet' id='style-color'>
		<link href='../../assets/global/plugins/bootstrap-toastr/toastr.min.css' rel='stylesheet'>
		<!--[if lt IE 9]>
		<script src='../../assets/global/plugins/respond.min.js'></script>  
		<![endif]-->
		<script src='../../assets/global/plugins/jquery.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/jquery-migrate.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/bootstrap/js/bootstrap.min.js' type='text/javascript'></script>      
		<script src='../../assets/frontend/layout/scripts/back-to-top.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/bootstrap-toastr/toastr.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/smoothscroll.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/bootbox/bootbox.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/lazyload/lazyload.min.js' type='text/javascript'></script>
		<script src='../../assets/function.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/custom.js' type='text/javascript'></script>
		".$this->pagelv2."
		</head>";
		?>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "WebSite",
			"url": "http://<?php echo $setting->get('domain'); ?>/",
			"name" : "<?php echo $setting->get('tit'); ?>",
			"alternateName" : "<?php echo $setting->get('title'); ?>",
			"potentialAction": {
			"@type": "SearchAction",
			"target": "http://<?php echo $setting->get('domain'); ?>/tim-kiem/{search_term}",
			"query-input": "required name=search_term"
			}
		}
		</script>
		<?php
	}
	
	function show_vuload()
	{
		echo "
		<div id='loading'>
			<div class='vuload' id='vuload'>
				<div class='vuitems' id='vuitems_1'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_2'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_3'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_4'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_5'><div class='comp'></div></div>
			</div>
		</div>";
	}
	
	function show_color_panel()
	{
		global $header_controller;
		echo "
		<div class='color-panel hidden-sm'>
			<div class='color-mode-icons icon-color'></div>
			<div class='color-mode-icons icon-color-close'></div>
			<div class='color-mode'>
				<p>MÀU SẮC</p>
					<ul class='inline' style='display: inline;'>
					<li id='btn_red' class='color-red ".$header_controller->handle_color_panel('1')."' data-style='red' onclick='setcolor(1)'></li>
					<li id='btn_blue' class='color-blue ".$header_controller->handle_color_panel('2')."' data-style='blue' onclick='setcolor(2)'></li>
					<li id='btn_green' class='color-green ".$header_controller->handle_color_panel('3')."' data-style='green' onclick='setcolor(3)'></li>
					<li id='btn_orange' class='color-orange ".$header_controller->handle_color_panel('4')."' data-style='orange' onclick='setcolor(4)'></li>
					<li id='btn_gray' class='color-gray ".$header_controller->handle_color_panel('5')."' data-style='gray' onclick='setcolor(5)'></li>
				</ul>
			</div>
		</div>";
	}
	
	function show_pre_header()
	{
		global $header_controller;
		echo "
		<div class='pre-header'>
			<div class='container'>
				<div class='row'>
					<div class='col-md-6 col-sm-6 additional-shop-info'>
					</div>
					<div class='col-md-6 col-sm-6 additional-nav'>
						<ul class='list-unstyled list-inline pull-right'>";
		$pre_header=$header_controller->handle_pre_header();
		foreach ($pre_header as $data1 => $data2)
		{
			echo "<li><a href='".$data1."'>".$data2."</a></li>";
		}
		echo"			</ul>
					</div>
				</div>
			</div>        
		</div>";
	}
	
	function show_logo()
	{
		global $header_controller;
		global $setting;
		echo "
		<a class='site-logo' href='../../trang-chu'>
			<img src='../../assets/global/img/logos/logo-".$header_controller->get_color().".png' alt='".$setting->get('title')."' title='".$setting->get('title')."'>
		</a>";
		echo "
		<a href='javascript:void(0);' class='mobi-toggler'><i class='fa fa-bars'></i></a>";
	}
	
	function show_cart()
	{
		global $header_model;
		if ($_SESSION['userid'] != NULL)
		{
			$count=$header_model->get_cart_num(); 
			echo "
			<div class='top-cart-block' style='margin-left: 10px;'>
			<div class='top-cart-info'>
				<a href='javascript:void(0);' class='top-cart-info-count' id='content3' count='".$count."'>".$count."</a>
				<a href='javascript:void(0);' class='top-cart-info-value'></a>
			</div>
			<i class='fa fa-shopping-cart'></i>
			<div class='top-cart-content-wrapper'>
				<div class='top-cart-content'>
				<ul class='scroller' style='height: 250px;'>
				<p style='display: none' id='emptycart'>Giỏ sách của bạn trống</p>";
				if ($count >0)
				{
					$cart=$header_model->get_cart();
					foreach ($cart as $data)
					{
						echo "<li id='cart".$data['id']."'>
						<a href='../../".sf($data['title'],0).".".$data['id'].".html'><img src='../../26x35/".$data['img1']."' alt='".$data['title']."' height='35'></a>
						<strong><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a></strong>
						<a class='del-goods' style='float: right;' onclick='delcart(".$data['id'].")'>&nbsp;</a>
						</li>";
					}
				}
				else
				{
					echo "<center>Giỏ sách của bạn trống</center>";
				}
				echo "
				</ul>
				<div class='text-right'>
					<a href='../../gio-sach' class='btn btn-default'>Xem giỏ sách</a>
					<a href='../../datsach' class='btn btn-primary'>Đặt sách</a>
				</div>
				</div>
			</div>            
			</div>";
		}	
	}
	
	function show_noti()
	{
		global $header_model;
		if ($_SESSION['userid'] != NULL)
		{
			echo "
			<div class='top-cart-block'>
			<div class='top-cart-info'>";
				$count=$header_model->get_noti_num();
				if ($countnoti>0) 
				{
					echo "<script>$(document).attr('title','(".$count.") '+title);</script>";
				}
				echo "
				<a href='javascript:void(0);' class='top-cart-info-count' id='noticount'>".$count."</a>
				<a href='javascript:void(0);' class='top-cart-info-value'></a>
			</div>
			<i class='fa fa-bell'></i>
			<div class='top-cart-content-wrapper'>
				<div class='top-cart-content'>
				<ul class='scroller' style='height: 250px;' id='noticontent'>";
					$noti=$header_model->get_noti();
					if ($noti != NULL)
					{
						foreach ($noti as $data)
						{
							echo "<li><strong class='noticontent2'><a onclick='seen_notify(".$data['id'].")' href='".$data['link']."'>".$data['content']."</a></strong><div class='notitime'>".ti_me($data['time'])."</div></li>";
						}
					}
					else
					{
						echo "<center>Bạn không có thông báo mói</center>";
					}
					echo "
				</ul>
				<div class='text-right'>
					<a href='../../thong-bao' class='btn btn-default'>Xem tất cả</a>
					<a onclick='seen_all()' class='btn btn-primary'>Đã xem</a>
				</div>
				</div>
			</div>            
			</div>";
		}
	}
	
	function show_cate()
	{
		global $header_model;
		echo "
		<li class='dropdown dropdown-megamenu'>
          <a class='dropdown-toggle' data-toggle='dropdown' data-target='#' href='#'>
		  Danh mục sách
          </a>
          <ul class='dropdown-menu'>
            <li>
              <div class='header-navigation-content'>
                <div class='row'>";
		$cate=$header_model->get_cate();
		foreach ($cate as $data)
		{
			echo "<div class='col-md-4 header-navigation-col'>
			<h4><a href='../../".sf($data[title],0).".".$data[id]."'>".$data[title]."</a></h4>
			<ul>";
			foreach ($data['cate2'] as $data2)
			{
				echo "<li><a href='../../".sf($data[title],0)."/".sf($data2[title],0).".".$data2[id]."'>".$data2[title]."</a></li>";
			}
			echo "</ul>
			</div>";  
		}
		echo "
                </div>
              </div>
            </li>
          </ul>
        </li>";
	}
	
	function show_resource()
	{
		global $header_controller;
		echo "            
		<li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' data-target='#' href='#'>
          Tài nguyên
          </a>
          <ul class='dropdown-menu'>";
		$resource_nav=$header_controller->handle_resource_nav();
		foreach ($resource_nav as $data1 => $data2)
		{
			echo "<li><a href='".$data1."'>".$data2."</a></li>";
		}
		echo "
          </ul>
        </li>";
	}
	
	function show_acc()
	{
		global $header_controller;
		echo "
		<li class='dropdown'>
          <a class='dropdown-toggle' data-toggle='dropdown' data-target='#' href='#'>
          Tài khoản
          </a>
          <ul class='dropdown-menu'>";
		$acc_nav=$header_controller->handle_acc_nav();
		foreach ($acc_nav as $data1 => $data2)
		{
			echo "<li><a href='".$data1."'>".$data2."</a></li>";
		}
		echo "
          </ul>
        </li>";
	}
	
	function show_search()
	{
		echo "
		<li class='menu-search'>
          <span class='sep'></span>
          <i class='fa fa-search search-btn'></i>
          <div class='search-box'>
            <form action='#' onsubmit='return search2()'>
              <div class='input-group'>
                <input type='text' placeholder='Tìm kiếm' class='form-control' id='txtSearch2'/>
                <span class='input-group-btn'>
                  <button class='btn btn-primary' type='submit'>Tìm</button>
                </span>
              </div>
            </form>
          </div> 
        </li>";
	}
	
	function show_nav()
	{
		echo "
		<div class='header-navigation'>
			<ul>";
		$this->show_cate();
		$this->show_resource();
		$this->show_acc();
		$this->show_search();
		echo "
			</ul>
        </div>";
	}
	
	function show_body_header()
	{
		echo "
		<div class='header'>
		  <div class='container'>";
		$this->show_logo();
		$this->show_cart();
		$this->show_noti();
		$this->show_nav();
		echo "
		  </div>
		</div>
		";
	}
	
	function show_body()
	{
		echo "<body class='ecommerce'>";
		$this->show_vuload();
		$this->show_color_panel();
		$this->show_pre_header();
		$this->show_body_header();
	}
	
	function show()
	{
		$this->show_head();
		$this->show_body();
	}
} 	
?>