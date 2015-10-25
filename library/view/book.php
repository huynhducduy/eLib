<?php
class book_view
{
	function show_breadcrumb()
	{
		global $book_model;
		$book=$book_model->book;
		$cate1=$book_model->cate1;
		$cate2=$book_model->cate2;
		echo "<ul class='breadcrumb'>
			<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
			<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../".sf($cate1['title'],0).".".$cate1['id']."'><span itemprop='title'>".$cate1['title']."</span></a></div></li>
			<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../".sf($cate1['title'],0)."/".sf($cate2['title'],0).".".$cate2['id']."'><span itemprop='title'>".$cate2['title']."</span></a></div></li>
			<li class='active'>".$book['title']."</li>
		</ul>";
	}
	function show_list_cate()
	{
		global $category_sidebar_view;
		global $book_model;
		echo "<ul class='list-group margin-bottom-25 sidebar-menu'>";
		$category_sidebar_view->show($book_model->cate1['id'],$book_model->cate2['id']);
		echo "</ul>"; 
	}
	function show_random()
	{
		global $book_model;
		echo "<div class='sidebar-products clearfix'>
		<h2>Có thể bạn muốn xem</h2>";
		$result = $book_model->get_random();
		foreach ($result as $data)
		{
			echo "<div class='item' style='width: 100%;'><table><tr>
			<td width='20%'><a href='../../".sf($data['title'],0).".".$data['id'].".html'><img src='../../135x180/".$data['img1']."' alt='".$data['title']."' title='".$data['title']."'></a></td>
			<td><h3 style='margin-left:10px;'><a href='../../".sf($data['title'],0).".".$data['id'].".html' alt='".$data['title']."' title='".$data['title']."'>".cut($data['title'],30)."</a><br/><span class='author2'>".$data['author']."</span>";
			if ($data['rating'] != 0)
			{
				echo "<br/><div class='rateit' data-rateit-value='".$data['rating']."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
			}
			echo "</div></h3>
			</td></tr></table></div>";
		}
		echo "</div>";
	}
	function show_sidebar()
	{
		echo "<div class='sidebar col-md-3 col-sm-5'>";
		$this->show_list_cate();
		$this->show_random();
		echo "</div>";
	}
	function show_image()
	{
		global $book_model;
		global $setting;
		$book=$book_model->book;
		echo "<div class='col-md-6 col-sm-6'>
		<div class='product-main-image'>
		<img src='../../410x550/".$book['img1']."' alt='".$book['title']."' title='".$book['title']."'class='img-responsive' data-BigImgsrc='../../600x800/".$book['img1']."' id='img01'>
		<div style='display:none' itemscope itemtype='http://www.data-vocabulary.org/Product/' >
			<h1 itemprop='name'>".$book['title']."</h1>
			<img itemprop='photo' src='http://".$setting->get('domain')."/".$book['img1']."' />
			<img itemprop='image' src='http://".$setting->get('domain')."/".$book['img1']."' />
			<span itemprop='author'>".$setting->get('tit')."</span>
			<span itemprop='summary'>".$book['des']."</span>
			<span itemprop='description'>".$book['description']."</span>
			<meta itemprop='url' content='".$setting->get('domain').$_SERVER['REQUEST_URI']."'>
		</div>
		</div>
		<div class='product-other-images'>
		<center>";
		if ($book['img2'] != NULL) { 
			echo "<a><img alt='".$book['title']."' src='../../135x180/".$book['img1']."' data='".$book['img1']."' id='img1' onclick='change_img(1)'></a>
			<a><img alt='".$book['title']."' src='../../135x180/".$book['img2']."' data='".$book['img2']."' id='img2' onclick='change_img(2)'></a>";
			if ($book['img3'] != NULL) { 
			echo "<a><img alt='".$book['title']."' src='../../135x180/".$book['img3']."' data='".$book['img3']."' id='img3' onclick='change_img(3)'></a>"; }
			if ($book['img4'] != NULL) { 
			echo "<a><img alt='".$book['title']."' src='../../135x180/".$book['img4']."' data='".$book['img4']."' id='img4' onclick='change_img(4)'></a>"; }
			if ($book['img5'] != NULL) { 
			echo "<a><img alt='".$book['title']."' src='../../135x180/".$book['img5']."' data='".$book['img5']."' id='img5' onclick='change_img(5)'></a>"; }
			if ($book['img6'] != NULL) { 
			echo "<a><img alt='".$book['title']."' src='../../135x180/".$book['img6']."' data='".$book['img6']."' id='img6' onclick='change_img(6)'></a>"; }
		}
		echo"</center>
		</div>
		</div>";
	}
	function show_toppy()
	{
		global $book_model;
		global $setting;
		global $book_controller;
		$book=$book_model->book;
		echo "<div class='col-md-6 col-sm-6'>";
		echo "<h1>".$book['title']."<br/><span class='author'>".$book['author']."</span></h1>
		<div class='price-availability-block clearfix'>
		<div class='availability'>";
		if ($book['remain'] == 0) { echo "<strong>Đã hết sách"; } else { echo "Số sách còn lại: <strong>".$book['remain']; }
		echo "</strong>
		</div>
		</div>
		<div class='description' style='border-bottom: 1px solid #f4f4f4;margin-bottom: 17px;'>
		<p>".$book['des']."</p>
		</div>
		<div class='product-page-cart'>";
		if ($book['remain'] == 0) {
			echo "<button class='btn btn-primary btn2' style='background: #000;padding-left: 10px;padding-right: 10px;' type='submit' readonly><i class='fa fa-slack'></i>&nbsp;&nbsp;Đã hết sách</button>";
		} else {
			echo "<button class='btn btn-primary btn2' style='padding-left: 10px;padding-right: 10px;' onclick='cart(".$book['id'].")'><i class='fa fa-legal'></i>&nbsp;&nbsp;Mượn</button>";
		}
		echo "<a style='display: inline-block'>".$book['borrow']." lượt mượn</a></div>
		<div class='review'>
		<input type='range' value='".$book_controller->rating."' step='0.25' id='rating'>
		<div class='rateit rateit2' data-rateit-backingfld='#rating' data-rateit-min='0' data-rateit-max='5'"; 
		if ($_SESSION['userid'] != NULL) {
			echo "data-rateit-resetable='false' data-rateit-ispreset='true'  id='rateit' data-bookid='".$book['id']."'";
		}
		else {
			echo "data-rateit-ispreset='true' data-rateit-readonly='true'";
		}
		echo "></div>
		<a>".$book['nrating']." lượt đánh giá</a>
		</div>";
		if ($book_controller->rating >0)
		{
			echo "<div style='display:none'>
				<div itemprop='aggregateRating' itemscope itemtype='http://schema.org/AggregateRating'>
					<span itemprop='Value'>".$book_controller->rating."</span>/<span itemprop='bestRating'>5</span>
					<span itemprop='ratingCount'>".$book['nrating']."</span>
				</div>
			</div>";
		}
		echo "<div class='product-page-cart' style='border-bottom:0;margin-bottom:0'>";
		if ($book['proofread'] != NULL)
		{
			$c=0;
			$x=explode('|',$book['proofread']);
			foreach ($x as $data)
			{	
				if ($data != NULL)
				{
					$c++;
					$y=explode(',',$data);
					if ($c == 1)
					{
						echo "<a class='proofread' rel='proofread1' href='../../".$y[0]."' title='".$y[1]."'>
						<button class='btn btn-primary btn2' style='padding-left: 10px;padding-right: 10px;margin-right: 10px'>
						<i class='fa fa-coffee' style='display: inline-block;'></i>&nbsp;&nbsp;Đọc thử</button>
						</a>";	
					}
					else
					{
						echo "<a class='proofread' rel='proofread1' href='../../".$y[0]."' title='".$y[1]."'></a>";
					}
				}
			}
		}
		else
		{
			echo "<button class='btn btn-primary btn2' style='padding-left: 10px;padding-right: 10px;margin-right: 10px;background: #000;'>
			<i class='fa fa-coffee' style='display: inline-block;'></i>&nbsp;&nbsp;Chưa thể đọc thử</button>";
		}
		if ($book_controller->wished == 0)
		{
			echo "<button class='btn default btn2' style='padding-left: 10px;padding-right: 10px;' id='wish' onclick='wish(".$book['id'].")'>
			<i class='fa fa-heart-o' id='wishi'></i>&nbsp;&nbsp;Yêu thích</button>";
		}
		else
		{
			echo "<button class='btn btn2 btn-primary' style='padding-left: 10px;padding-right: 10px;' id='wish' onclick='delwish(".$book['id'].")'>
			<i class='fa fa-heart' id='wishi'></i>&nbsp;&nbsp;Yêu thích</button>";
		}
		echo "
		</div>
		<script language='javascript'>
		$('#rateit').bind('rated', function ()
		{
			$.ajax({
				url : '../../process/rating.php',
				type : 'post',
				dataType : 'json',
				data : {
					value : $('#rateit').rateit('value'),
					bookid: $('#rateit').data('bookid')
				},
				success : function (result)
				{
					if (!result.hasOwnProperty('error') || result['error'] != 'success')
					{
						alert('ERROR');
						return false;
					}
				}
			});
			return false;
		});
		</script>";
		echo "</div>";
	}
	function show_description()
	{
		global $book_model;
		$book = $book_model->book;
		echo "<div class='tab-pane fade in active' id='Description'>
			<p>".$book['description']."</p>
		</div>";
	}
	function show_info()
	{
		global $book_model;
		global $book_controller;
		$book = $book_model->book;
		echo "<div class='tab-pane fade' id='Information'>
		<table class='datasheet'>
			<tr>
				<th colspan='2'>Thông tin chính</th>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Tên sách</td>
				<td>".$book['title']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Tác giả</td>
				<td>".$book['author']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Danh mục</td>
				<td>".$book_model->cate1['title']." / ".$book_model->cate2['title']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Số trang</td>
				<td>".$book['pagen']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Ngôn ngữ</td>
				<td>".$book_controller->get_lang()."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Nhà xuất bản</td>
				<td>".$book['publisher']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Ngày xuất bản</td>
				<td>".$book['publish-time']."</td>
			</tr>
		</table>
		<br/>
		<table class='datasheet'>
			<tr>
				<th colspan='2'>Thông tin khác</th>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Mã sách</td>
				<td>".$book['bcode']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Số lượng sách</td>
				<td>".$book['number']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Số sách còn</td>
				<td>".$book['remain']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Lượt xem</td>
				<td>".$book['view']."</td>
			</tr>
			<tr>
				<td class='datasheet-features-type'>Lượt mượn</td>
				<td>".$book['borrow']."</td>
			</tr>
		</table>
		</div>";
	}
	function show_review()
	{
		global $book_model;
		$book=$book_model->book;
		echo "<div class='tab-pane fade' id='Reviews'>";
		if ($book_model->get_review_nums() == 0)
		{
			echo "<div class='review-item clearfix' id='noreview'>
			<p>Chưa có nhận xét nào</p>
			</div>";
		}
		else
		{
			$result=$book_model->get_review();
			foreach ($result as $data)
			{
				echo "<div class='review-item clearfix''>
				<div class='review-item-submitted'>
				<strong>".$data['data']['name']."</strong>
				<em>".ti_me($data['time'])."</em>
				<div class='rateit' data-rateit-value='".$data['rating']."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
				if ($data['thanked'] == 1)
				{
					echo "<a class='btn btn-xs btn-thanks btn-primary' id='tks".$data['id']."' alt='Cảm ơn' title='Cảm ơn' onclick='thanks(".$data['id'].")'>
					<i class='fa fa-thumbs-up' id='tksi".$data['id']."'></i> <span id='tkst".$data['id']."'>".$data['nthanks']."</span></a>";
				}
				else
				{
					echo "<a class='btn btn-xs default btn-thanks' id='tks".$data['id']."' alt='Cảm ơn' title='Cảm ơn' onclick='thanks(".$data['id'].")'>
					<i class='fa fa-thumbs-o-up' id='tksi".$data['id']."'></i> <span id='tkst".$data['id']."'>".$data['nthanks']."</span></a>";
				}
				echo "</div>                                              
				<div class='review-item-content'>
				<p>".$data['content']."</p>
				</div>
				</div>";
			}
		}
		if ($_SESSION['userid'] != NULL)
		{
			echo "<form class='reviews-form' role='form' id='review' onsubmit='return review(".$book['id'].")'>
			<div class='alert alert-danger nodisplay' id='err'></div>
			<h2>Viết nhận xét</h2>
			<div class='form-group'>
			<textarea class='form-control' rows='8' id='content'></textarea>
			</div>
			<div class='form-group'>
			<label for='email'>Đánh giá</label>
			<input type='range' value='0' step='0.25' id='rating2'>
			<div class='rateit' id='rateit2' data-rateit-backingfld='#rating2' data-rateit-resetable='false' data-rateit-ispreset='false' data-rateit-min='0' data-rateit-max='5'>
			</div>
			</div>
			<div class='padding-top-0'>
			<button type='submit' class='btn btn-primary'><i class='fa fa-comment'></i>&nbsp;&nbsp;Gửi</button>
			</div>
			</form>";
		} else 
		{
			// echo "<div class='review-item clearfix'><p>Đăng nhập để nhận xét</p></div>";
		}
		echo "</div>";
	}
	function show_comment()
	{
		global $book_model;
		$book=$book_model->book;
		echo "<div class='tab-pane fade' id='Comments'>";
		if ($book_model->get_comment_nums() == NULL)
		{
			echo "<div class='review-item clearfix' id='nocomment'>
			<p>Chưa có bình luận nào</p>
			</div>";
		}
		else
		{
			$result = $book_model->get_comment();
			foreach ($result as $data)
			{
				echo "<div class='review-item clearfix'>
				<div class='review-item-submitted'>
				<strong>".$data['data']['name']."</strong>
				<em>".ti_me($data['time'])."</em>
				</div>                                              
				<div class='review-item-content'>
				<p>".$data['content']."</p>
				</div>
				</div>";
			}
		}
		if ($_SESSION['userid'] != NULL)
		{
			echo "<form class='reviews-form' role='form' id='comment' onsubmit='return comment(".$book['id'].")'>
			<div class='alert alert-danger nodisplay' id='err2'></div>
			<h2>Viết bình luận</h2>
			<div class='form-group'>
			<textarea class='form-control' rows='8' id='content2'></textarea>
			</div>
			<div class='padding-top-0'>                  
			<button type='submit' class='btn btn-primary'><i class='fa fa-comment'></i>&nbsp;&nbsp;Gửi</button>
			</div>
			</form>";
		} else 
		{
			// echo "<div class='review-item clearfix'><p>Đăng nhập để bình luận hoặc bình luận bằng Facebook</p></div>";
		}
		echo "</div>";
	}
	function show_cmt_fb()
	{
		global $setting;
		echo "<div class='tab-pane fade' id='Comments-fb'>
			<div class='fb-comments' data-href='http://".$setting->get('domain').$_SERVER['REQUEST_URI']."' data-numposts='5' data-width ='767px' data-colorscheme='light'></div>
		</div>";
	}
	function show_botty()
	{
		echo "<div class='product-page-content' style='padding-top: 7px'>
		<ul id='myTab' class='nav nav-tabs'>
			<li class='active'><a href='#Description' data-toggle='tab'>Mô tả chi tiết</a></li>
			<li><a href='#Information' data-toggle='tab'>Thông tin chi tiết</a></li>
			<li><a href='#Reviews' data-toggle='tab'>Nhận xét</a></li>
			<li><a href='#Comments' data-toggle='tab'>Bình luận</a></li>
			<!--<li><a href='#Comments-fb' data-toggle='tab'>Bình luận trên facebook</a></li>-->
		</ul><div id='myTabContent' class='tab-content'  style='padding-bottom:0'>";
		$this->show_description();
		$this->show_info();
		$this->show_review();
		$this->show_comment();
		//$this->show_cmt_fb();
		echo "</div></div>";
	}
	function show_book()
	{
		global $book_model;
		$book=$book_model->book;
		echo "<div class='col-md-9 col-sm-7'>
		<div class='product-page'>";
		if ($book['hot'] == 1) { echo "<div class='sticker sticker-hot'></div>"; }
		if ($book['new'] == 1) { echo "<div class='sticker sticker-new'></div>"; }
		echo "<div class='row'>";
		$this->show_image();
		$this->show_toppy();
		$this->show_botty();
		echo "</div>
		</div>
		</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_sidebar();
		$this->show_book();
		echo "</div>";
	}
	function config()
	{
		global $header_view;
		global $book_model;
		if ($book_model->error != 1)
		{
			$book=$book_model->book;
			$header_view->title=$book['title'];
			$header_view->description=$book['des'];
			$header_view->keyword=$book['keyword'];
			$header_view->image=$book['img1'];
			$header_view->rating=$book['rating'];
		}
		else
		{
			$header_view->title='Cuốn sách này không có thật';
			$header_view->description='Cuốn sách này không có thật';
			$header_view->keyword='cuon sach nay khong co that';
		}
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
			$(document).ready(function() {
				$('.proofread').fancybox({
					openEffect	: 'none',
					closeEffect	: 'none'
				});
			});
		</script>";
	}
	function show()
	{
		global $book_model;
		if ($book_model->error != 1)
		{
			global $hot_new_book_view;
			echo "<div class='main'>
			<div class='container'>";
			$this->show_breadcrumb();
			$this->show_content();
			$hot_new_book_view->show();
			echo "</div>
			</div>";
			fast_view_box_view::show();
		}
		else
		{
			global $category_sidebar_view;
			echo "
			<div class='main'>
				<div class='container'>
					<ul class='breadcrumb'>
						<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
						<li class='active'>Lỗi</li>
					</ul>
					<div class='row margin-bottom-40'>
						<div class='sidebar col-md-3 col-sm-5'>
							<ul class='list-group margin-bottom-25 sidebar-menu'>";
							$category_sidebar_view->show(0,0);
							echo "
							</ul>
						</div>
						<div class='col-md-9 col-sm-7'>
							<div class='product-page'>
								<div class='alert alert-danger' id='errscode' style='margin-bottom: 0'>
									Cuốn sách này không có thật
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}
	}
}
?>