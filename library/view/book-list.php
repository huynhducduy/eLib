<?php
class book_list_view
{
	function show_title_wrapper()
	{
		global $book_list_model;
		if ($book_list_model->type == 2)
		{
			echo "<div class='title-wrapper' style='background: #72c2ff url(../../".$book_list_model->cate2['title-wrapper'].") no-repeat 100% 100%;'>
			<div class='container'><div class='container-inner'>
				<h1>Danh mục sách <span>".$book_list_model->cate2['title']."</span></h1>
				<em>".$book_list_model->cate2['description']."</em>
			</div></div>
			</div>";
		} 
		else if ($book_list_model->type == 1)
		{
			echo "<div class='title-wrapper' style='background: #72c2ff url(../../".$book_list_model->cate1['title-wrapper'].") no-repeat 100% 100%;'>
			<div class='container'><div class='container-inner'>
				<h1>Danh mục sách <span>".$book_list_model->cate1['title']."</span></h1>
				<em>".$book_list_model->cate1['description']."</em>
			</div></div>
			</div>";
		}
	}
	function show_breadcrumb()
	{
		global $book_list_model;
		global $book_list_controller;
		echo "<ul class='breadcrumb'>
		<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>";
		if ($book_list_model->type == 2)
		{
			echo "<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../".sf($book_list_model->cate1['title'],0).".".$book_list_model->cate1['id']."'>".$book_list_model->cate1['title']."</span></a></div></li>
			<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../".sf($book_list_model->cate1['title'],0)."/".sf($book_list_model->cate2['title'],0).".".$book_list_model->cate2['id']."'><span itemprop='title'>".$book_list_model->cate2['title']."</span></a></div></li>
			<li class='active'>Trang <span id='bread_p'>".$book_list_controller->p."</span></li>";
		}
		else if ($book_list_model->type == 1)
		{
			echo "<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../".sf($book_list_model->cate1['title'],0).".".$book_list_model->cate1['id']."'>".$book_list_model->cate1['title']."</span></a></div></li>
			<li class='active'>Trang <span id='bread_p'>".$book_list_controller->p."</span></li>";
		}
		echo "</ul>";
	}
	function show_list_cate()
	{
		global $category_sidebar_view;
		global $book_list_model;
		echo "<ul class='list-group margin-bottom-25 sidebar-menu'>";
		$category_sidebar_view->show($book_list_model->cate1['id'],$book_list_model->cate2['id']);
		echo "</ul>"; 
	}
	function show_filter()
	{
		echo "<div class='sidebar-filter margin-bottom-25'>
		<h2>Bộ lọc</h2>
		<h3>Tùy chọn </h3>
		<form method='GET'>
		<div class='checkbox-list'>";
		if (($_GET['conSach'] == NULL) 
			&& ($_GET['hetSach'] == NULL) 
			&& ($_GET['coTheDocThu'] == NULL) 
			&& ($_GET['khongTheDocThu'] == NULL) 
			&& ($_GET['tiengViet'] == NULL) 
			&& ($_GET['tiengAnh'] == NULL) 
			&& ($_GET['ngonNguKhac'] == NULL) 
			&& ($_GET['soTrang'] == '1 đến 1000'))
		{
			echo "<label><input type='checkbox' name='conSach' checked> Còn sách</label>
			<label><input type='checkbox' name='hetSach' checked> Hết sách</label>
			<label><input type='checkbox' name='coTheDocThu' checked> Có thể đọc thử</label>
			<label><input type='checkbox' name='khongTheDocThu' checked> Không thể đọc thử</label>
			<label><input type='checkbox' name='tiengViet' checked> Tiếng Việt</label>
			<label><input type='checkbox' name='tiengAnh' checked> Tiếng Anh</label>
			<label><input type='checkbox' name='ngonNguKhac' checked> Ngôn ngữ khác</label>
			</div>
			<h3>Số trang</h3>
			<p>
			<label for='amount'>Từ</label>
			<input type='text' id='amount' name='soTrang' value='1 đến 1000' style='border:0; color:#f6931f; font-weight:bold;' readonly>";
		}
		else
		{
			if ($_GET['conSach'] == 'on') { $on1='checked'; }
			if ($_GET['hetSach'] == 'on') { $on2='checked'; }
			if ($_GET['coTheDocThu'] == 'on') { $on3='checked'; }
			if ($_GET['khongTheDocThu'] == 'on') { $on4='checked'; }
			if ($_GET['tiengViet'] == 'on') { $on5='checked'; }
			if ($_GET['tiengAnh'] == 'on') { $on6='checked'; }
			if ($_GET['ngonNguKhac'] == 'on') { $on7='checked'; }
			echo "<label><input type='checkbox' name='conSach' ".$on1."> Còn sách</label>
			<label><input type='checkbox' name='hetSach' ".$on2."> Hết sách</label>
			<label><input type='checkbox' name='coTheDocThu' ".$on3."> Có thể đọc thử</label>
			<label><input type='checkbox' name='khongTheDocThu' ".$on4."> Không thể đọc thử</label>
			<label><input type='checkbox' name='tiengViet' ".$on5."> Tiếng Việt</label>
			<label><input type='checkbox' name='tiengAnh' ".$on6."> Tiếng Anh</label>
			<label><input type='checkbox' name='ngonNguKhac' ".$on7."> Ngôn ngữ khác</label>
			</div>
			<h3>Số trang</h3>
			<p>
				<label for='amount'>Từ</label>
				<input type='text' id='amount' name='soTrang' value='".$_GET['soTrang']."' style='border:0; color:#f6931f; font-weight:bold;' readonly>";
		}
			echo "</p>
			<div id='slider-range'></div>
			<br/>
			<center>
			<button type='submit' class='btn btn-primary'><i class='fa fa-check-circle'></i>&nbsp;&nbsp;Xác nhận</button>
			</center>
			</div>";
	}
	function show_random()
	{
		global $book_list_model;
		echo "<div class='sidebar-products clearfix'>
		<h2>Có thể bạn muốn xem</h2>";
		$result = $book_list_model->get_data_random();
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
	function show_side_bar()
	{
		echo "<div class='sidebar col-md-3 col-sm-5'>";
		$this->show_list_cate();
		$this->show_filter();
		$this->show_random();
		echo "</div>";
	}
	function show_sorting()
	{
		global $book_list_controller;
		echo "<div class='row list-view-sorting clearfix'>
			<div class='pull-right pull-left' style='margin-left:0'>
				<label class='control-label'>Tìm kiếm</label>
				<input class='form-control input-sm' name='tim-kiem' onchange='submit()' style='width:auto' value='".$_GET['tim-kiem']."'>
			</div>
			<div class='pull-right'>
			<label class='control-label'>Hiển thị</label>
			<select class='form-control input-sm' name='hienThi' onchange='submit()'>";
			if ($book_list_controller->d == 12) { echo "<option value='12' selected>12</option>"; } else { echo "<option value='12'>12</option>"; }
			if ($book_list_controller->d == 16) { echo "<option value='16' selected>16</option>"; } else { echo "<option value='16'>16</option>"; }
			if ($book_list_controller->d == 20) { echo "<option value='20' selected>20</option>"; } else { echo "<option value='20'>20</option>"; }
			if ($book_list_controller->d == 24) { echo "<option value='24' selected>24</option>"; } else { echo "<option value='24'>24</option>"; }
			if ($book_list_controller->d == 28) { echo "<option value='28' selected>28</option>"; } else { echo "<option value='28'>28</option>"; }				  
			echo "</select>
			</div>
			<div class='pull-right'>
			<label class='control-label'>Sắp xếp</label>
			<select class='form-control input-sm' name='sapXep' onchange='submit()'>";
			if ($_GET['sapXep'] != NULL) {
			if ($_GET['sapXep'] == 'a-z') { echo "<option value='a-z' selected>Tên (A - Z)</option>"; } else { echo "<option value='a-z' >Tên (A - Z)</option>"; }
			if ($_GET['sapXep'] == 'z-a') { echo "<option value='z-a' selected>Tên (Z - A)</option>"; } else { echo "<option value='z-a' >Tên (Z - A)</option>"; }
			if ($_GET['sapXep'] == 'danhGia') { echo "<option value='danhGia' selected>Đánh giá (Cao - Thấp)</option>"; } else { echo "<option value='danhGia'>Đánh giá (Cao - Thấp)</option>"; }
			if ($_GET['sapXep'] == 'danhGia2') { echo "<option value='danhGia2' selected>Đánh giá (Thấp - Cao)</option>"; } else { echo "<option value='danhGia2'>Đánh giá (Thấp - Cao)</option>"; }
			if ($_GET['sapXep'] == 'thoiGian') { echo "<option value='thoiGian' selected>Thời gian (Mới - Cũ)</option>"; } else { echo "<option value='thoiGian'>Thời gian (Mới - Cũ)</option>"; }
			if ($_GET['sapXep'] == 'thoiGian2') { echo "<option value='thoiGian2' selected>Thời gian (Cũ - Mới)</option>"; } else { echo "<option value='thoiGian2'>Thời gian (Cũ - Mới)</option>"; }
			if ($_GET['sapXep'] == 'soTrang') { echo "<option value='soTrang' selected>Số trang (Nhiều - Ít)</option>"; } else { echo "<option value='soTrang'>Số trang (Nhiều - Ít)</option>"; }
			if ($_GET['sapXep'] == 'soTrang2') { echo "<option value='soTrang2' selected>Số trang (Ít - Nhiều)</option>"; } else { echo "<option value='soTrang2'>Số trang (Ít - Nhiều)</option>"; }
			if ($_GET['sapXep'] == 'luotXem') { echo "<option value='luotXem' selected>Lượt xem (Nhiều - Ít)</option>"; } else { echo "<option value='luotXem'>Lượt xem (Nhiều - Ít)</option>";  }
			if ($_GET['sapXep'] == 'luotXem2') { echo "<option value='luotXem2' selected>Lượt xem (Ít - Nhiều)</option>"; } else { echo "<option value='luotXem2'>Lượt xem (Ít - Nhiều)</option>"; }
			if ($_GET['sapXep'] == 'luotMuon') { echo "<option value='luotMuon' selected>Lượt mượn (Nhiều - Ít)</option>"; } else { echo "<option value='luotMuon'>Lượt mượn (Nhiều - Ít)</option>"; }
			if ($_GET['sapXep'] == 'luotMuon2') { echo "<option value='luotMuon2' selected>Lượt mượn (Ít - Nhiều)</option>"; } else { echo "<option value='luotMuon2'>Lượt mượn (Ít - Nhiều)</option>"; }
			} else
			{
				echo "<option value='a-z'>Tên (A - Z)</option>
				<option value='z-a'>Tên (Z - A)</option>
				<option value='danhGia'>Đánh giá (Cao - Thấp)</option>
				<option value='danhGia2'>Đánh giá (Thấp - Cao)</option>
				<option value='thoiGian' selected>Thời gian (Mới - Cũ)</option>
				<option value='thoiGian2'>Thời gian (Cũ - Mới)</option>
				<option value='soTrang'>Số trang (Nhiều - Ít)</option>
				<option value='soTrang2'>Số trang (Ít - Nhiều)</option>
				<option value='luotXem'>Lượt xem (Nhiều - Ít)</option>
				<option value='luotXem2'>Lượt xem (Ít - Nhiều)</option>
				<option value='luotMuon'>Lượt mượn (Nhiều - Ít)</option>
				<option value='luotMuon2'>Lượt mượn (Ít - Nhiều)</option>
				";
			}
			echo "</select>
			</form>
			</div>
		</div>";
	}
	function show_data()
	{
		global $book_list_model;
		global $book_list_controller;
		echo "<div id='datadiv'><div class='row product-list'>";
		if ($book_list_model->record > 0)
		{
			$i=0;
			$result = $book_list_model->get_data($book_list_controller->start,$book_list_controller->d);
			foreach ($result as $data)
			{			  
				$i++;
				echo "<div class='col-md-3 col-sm-6 col-xs-12' style='padding-right:6px;padding-left:6px;'>
				<div class='product-item' style='margin-bottom:10px;'>";
				if ($data['hot'] == '1') echo "<div class='sticker sticker-hot'></div>";
				if ($data['new'] == '1') echo "<div class='sticker sticker-new'></div>";
				echo "<div class='pi-img-wrapper'>
				<img src='../../194x260/".$data['img1']."' class='img-responsive' alt='".$data['title']."' title='".$data['title']."'>
				<div>
				<a href='#product-pop-up' class='btn btn-default fancybox-fast-view' id='fastview".$data['id']."' onclick='fastview(".$data['id'].")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;xem thêm</a>
				</div>
				</div>
				<h3 style='padding-bottom:0; margin-bottom:5px;'><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a><br/><span class='author2'>".$data['author']."</span></h3>
				<div class='pi-price'>";
				if ($data['rating'] != 0)
				{
					echo "<div class='rateit' data-rateit-value='".$data['rating']."' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
				} 
				echo "</div>";
				if ($data['remain'] > 0)
				{
					echo "<a class='btn btn-default add2cart' onclick='cart(".$data['id'].")'><i class='fa fa-legal'></i>&nbsp;Mượn</a>";
				}
				else
				{
					echo "<a href='javascript:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>";
				}
				echo "</div>
				</div>";
				if ($i == 4)
				{
					echo "</div>
					<div class='row product-list'>";
					$i=0;
				}
			}
		}
		else
		{
			echo "<center><p>Không có sách nào</p></center>";
		}	
		echo"</div>
		</div>";
	}
	function show_pag()
	{
		global $book_list_controller;
		global $book_list_model;
		echo "<div class='row'>";
		if ($book_list_model->record > 0)
		{
			echo "<div class='col-md-4 col-sm-4 items-info' id='pag-tip'>Sách thứ <i>".$book_list_controller->start2."</i>&nbsp; đến <i>".$book_list_controller->end."</i>&nbsp; trong số <i>".$book_list_model->record."</i>&nbsp; sách</div>"; 
		}
		echo "<div class='col-md-8 col-sm-8' id='content-paging'>
		<ul class='pagination pull-right' id='paging'>";
		if ($book_list_controller->page > 1)
        {
			$prev=$book_list_controller->p-1;
			$next=$book_list_controller->p+1;
            if ($book_list_controller->p > 1)
            {
                echo "<li><a href='".$book_list_controller->str_uri.$book_list_controller->qstr2."' alt='Trang đầu tiên' title='Trang đầu tiên'>&laquo;</a></li>";
                echo "<li><a href='".$book_list_controller->str_uri_p.$prev.$book_list_controller->qstr2."' alt='Trang trước' title='Trang trước'>&lsaquo;</a></li>";
            }
            for ($i = $book_list_controller->min; $i <= $book_list_controller->max; $i++)
            {
                if ($book_list_controller->p == $i)
				{
                    echo "<li><span alt='Trang hiện tại' title='Trang hiện tại' style='color: #fff'>".$i."</span></li>";
                }
                else
				{
                    echo "<li><a href='".$book_list_controller->str_uri_p.$i.$book_list_controller->qstr2."' alt='Trang ".$i."' title='Trang ".$i."'>".$i."</a></li>";
                }
            }
            if ($book_list_controller->p < $book_list_controller->page)
            {
                echo "<li><a href='".$book_list_controller->str_uri_p.$next.$book_list_controller->qstr2."' alt='Trang sau' title='Trang sau'>&rsaquo;</a></li>";
                echo "<li><a href='".$book_list_controller->str_uri_p.$book_list_controller->page.$book_list_controller->qstr2."' alt='Trang cuối cùng' title='Trang cuối cùng'>&raquo;</a></li>";;
            }
        }
		echo "</ul>
		</div>
		</div>";
	}
	function show_content()
	{
		echo "<div class='col-md-9 col-sm-7' id='scroll-to'>";
		echo "<div id='put-loading'>
		<div id='loading2' style='display: none;'>
			<center>
			<div class='vuload' id='vuload' style='top: 40px'>
				<div class='vuitems' id='vuitems_1'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_2'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_3'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_4'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_5'><div class='comp'></div></div>
			</div>
			</center>
		</div>";
		$this->show_sorting();
		$this->show_data();
		$this->show_pag();
		echo "</div>";
		echo "</div>";
	}
	function show_page()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_side_bar();
		$this->show_content();
		echo "</div>";
	}
	function show_main()
	{
		echo "<div class='main'>
		<div class='container'>";
		$this->show_breadcrumb();
		$this->show_page();
		echo "</div>
		</div>";
	}
	function config()
	{
		global $header_view;
		global $book_list_model;
		$header_view->pagelv1="<link href='../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/uniform/css/uniform.default.min.css' rel='stylesheet' type='text/css'>
		<link href='../../assets/global/plugins/jquery-ui/jquery-ui.min.css' rel='stylesheet' type='text/css'><!-- for slider-range -->
		<link href='../../assets/global/plugins/rateit/src/rateit.min.css' rel='stylesheet' type='text/css'>";
		if ($book_list_model->error == 0)
		{
			if ($book_list_model->type == 2)
			{
				$header_view->title=$book_list_model->cate2['title'];
				$header_view->description=$book_list_model->cate2['description'];
				$header_view->keyword=$book_list_model->cate2['keyword'];
			}
			else if ($book_list_model->type == 1)
			{
				$header_view->title=$book_list_model->cate1['title'];
				$header_view->description=$book_list_model->cate1['description'];
				$header_view->keyword=$book_list_model->cate1['keyword'];
			}
			$header_view->pagelv2="<script src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js' type='text/javascript'></script><!-- pop up -->
			<script src='../../assets/global/plugins/uniform/jquery.uniform.min.js' type='text/javascript'></script>
			<script src='../../assets/global/plugins/jquery-ui/jquery-ui.min.js' type='text/javascript'></script>
			<script src='../../assets/global/plugins/rateit/src/jquery.rateit.min.js' type='text/javascript'></script>
			<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
			<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					Metronic.init();
					Layout.init();
					Layout.initUniform();
					Layout.initSliderRange();
				});
			</script>";
		} else
		{
			$header_view->pagelv2="<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
			<script type='text/javascript'>
				jQuery(document).ready(function() {
					Layout.init();
				});
			</script>";
			$header_view->title='Danh mục này không có thật';
			$header_view->description='Danh mục sách này không có thật';
			$header_view->keyword='danh muc sach nay khong co that';
		}
	}
	function show_ajax()
	{
	?>
		<script language="javascript">
             $('#content-paging').on('click','#paging a', function ()
             {
				 $('#loading2').fadeIn('fast');
				 Metronic.scrollTo2($('#scroll-to'),-15);
                 var url = $(this).attr('href');
                 $.ajax({
                     url : url,
                     type : 'get',
                     dataType : 'json',
                     success : function (result)
                     {
						 $("#content-paging").ajaxComplete(function(event, request, settings)
						 {
							if (result.hasOwnProperty('data') && result.hasOwnProperty('paging'))
							{
								html = '<div class="row product-list">';
								html2 = '';
								i=0;
								$.each(result['data'], function (key, data)
								{
									i++;
									html += "<div class='col-md-3 col-sm-6 col-xs-12' style='padding-right:6px;padding-left:6px;'><div class='product-item' style='margin-bottom:10px;'>";
									if (data['hot'] == '1') html += "<div class='sticker sticker-hot'></div>";
									if (data['new'] == '1') html += "<div class='sticker sticker-new'></div>";
									html +="<div class='pi-img-wrapper'><img src='../../194x260/"+data['img1']+"' class='img-responsive' alt='"+data['title']+"' title='"+data['title']+"'><div><a href='#product-pop-up' class='btn btn-default fancybox-fast-view' id='fastview"+data['id']+"' onclick='fastview("+data['id']+")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;xem thêm</a></div></div><h3 style='padding-bottom:0; margin-bottom:5px;'><a href='../../"+sf(data['title'],0)+"."+data['id']+".html'>"+data['title']+"</a><br/><span class='author2'>"+data['author']+"</span></h3><div class='pi-price'>";
									if (data['rating'] != 0)
									{
										html +="<div class='rateit' data-rateit-value='"+data['rating']+"' data-rateit-ispreset='true' data-rateit-readonly='true'></div>";
									} 
									html +="</div>";
									if (data['remain'] > 0)
									{ 
										html +="<a class='btn btn-default add2cart' onclick='cart("+data['id']+")'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; 
									}
									else 
									{ 
										html += "<a href='javascipt:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; 
									}
									html += "</div></div>";
									if (i == 4)
									{
										html += '</div><div class="row product-list">';
										i=0;
									}
								});
								html +='</div>';
								if (result['paging']['page'] > 1)
								{
									prev=result['paging']['p']-1;
									next=result['paging']['p']+1;
									if (result['paging']['p'] > 1)
									{
										html2 += "<li><a href='"+result['paging']['str_uri']+"' alt='Trang đầu tiên' title='Trang đầu tiên'>&laquo;</a></li>";
										html2 += "<li><a href='"+result['paging']['str_uri_p']+prev+"' alt='Trang trước' title='Trang trước'>&lsaquo;</a></li>";
									}
									for (i = result['paging']['min']; i <= result['paging']['max']; i++)
									{
										if (result['paging']['p'] == i)
										{
											html2 += "<li><span alt='Trang hiện tại' title='Trang hiện tại' style='color: #fff'>"+i+"</span></li>";
										}
										else
										{
											html2 += "<li><a href='"+result['paging']['str_uri_p']+i+"' alt='Trang "+i+"' title='Trang "+i+"'>"+i+"</a></li>";
										}
									}
									if (result['paging']['p'] < result['paging']['page'])
									{
										html2 += "<li><a href='"+result['paging']['str_uri_p']+next+"' alt='Trang sau' title='Trang sau'>&rsaquo;</a></li>";
										html2 += "<li><a href='"+result['paging']['str_uri_p']+result['paging']['page']+"' alt='Trang cuối cùng' title='Trang cuối cùng'>&raquo;</a></li>";;
									}
								}
								html3 = "Sách thứ <i>"+result['paging']['start2']+"</i>&nbsp; đến <i>"+result['paging']['end']+"</i>&nbsp; trong số <i>"+result['paging']['record']+"</i>&nbsp; sách"; 
								$('#bread_p').html(result['paging']['p']);
								$('#datadiv').html(html);
								$('#paging').html(html2);
								$('#pag-tip').html(html3);
								window.history.pushState({path:url},'',url);
								$('#loading2').fadeOut('slow');
							}
                         });
                     }
                 });
                 return false;
             });
         </script>
	<?php
	}
	function check_ajax()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			global $book_list_model;
			global $book_list_controller;
			die (json_encode(array(
				'data' => $book_list_model->get_data($book_list_controller->start,$book_list_controller->d),
				'paging' => array(
					'start2' => $book_list_controller->start2,
					'end' => $book_list_controller->end,
					'record' => $book_list_model->record,
					'page' => $book_list_controller->page,
					'p' => $book_list_controller->p,
					'str_uri' => $book_list_controller->str_uri,
					'str_uri_p' => $book_list_controller->str_uri_p,
					'min' => $book_list_controller->min,
					'max' => $book_list_controller->max
				)
			)));
		}
	}
	function show()
	{
		global $book_list_model;
		if ($book_list_model->error == 0)
		{
			$this->show_title_wrapper();
			$this->show_main();
			fast_view_box_view::show();
			$this->show_ajax();
		}
		else
		{
			echo "<div class='main'>
			<div class='container'>
			<ul class='breadcrumb'>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
				<li class='active'>Lỗi</li>
			</ul>
			<!-- BEGIN SIDEBAR & CONTENT -->
			<div class='row margin-bottom-40'>
			<!-- BEGIN SIDEBAR -->
			<div class='sidebar col-md-3 col-sm-5'>
				<ul class='list-group margin-bottom-25 sidebar-menu'>";
			global $category_sidebar_view;
			echo "<ul class='list-group margin-bottom-25 sidebar-menu'>";
			$category_sidebar_view->show(0,0);
			echo "</ul>"; 
			echo "</ul>";
			echo "</div>
			<!-- END SIDEBAR -->
			<!-- BEGIN CONTENT -->
			<div class='col-md-9 col-sm-7'>
				<div class='product-page'>
				<div class='alert alert-danger' id='errscode' style='margin-bottom: 0'>
				Danh mục sách này không có thật
				</div>
				</div>
			</div>
			<!-- END CONTENT --></div></div>";
		}
	}
}
?>