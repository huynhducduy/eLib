<?php
class requested_view
{
	function show_breadcrumb()
	{
		global $requested_controller;
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-nguyen'><span itemprop='title'>Tài nguyên</span></a></div></li>
			<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../sach-duoc-yeu-cau'><span itemprop='title'>Sách được yêu cầu</span></a></div></li>
            <li class='active'>Trang <span id='bread_p'>".$requested_controller->p."</span></li>
		</ul>";
	}
	function show_resource_sidebar()
	{
		global $resource_sidebar_view;
		$resource_sidebar_view->show();
	}

	function get_paginator()
	{
		global $requested_controller;
		global $requested_model;
		echo "<div class='row'>";
		echo "<div class='col-md-4 col-sm-4 items-info' id='pag-tip'>Sách thứ <i>".$requested_controller->start2."</i>&nbsp; đến <i>".$requested_controller->end."</i>&nbsp; trong số <i>".$requested_model->record."</i>&nbsp; sách</div>"; 
		echo "<div class='col-md-8 col-sm-8' id='content-paging'>
		<ul class='pagination pull-right' id='paging'>";
		if ($requested_controller->page > 1)
        {
			$prev=$requested_controller->p-1;
			$next=$requested_controller->p+1;
            if ($requested_controller->p > 1)
            {
                echo "<li><a href='".$requested_controller->str_uri."' alt='Trang đầu tiên' title='Trang đầu tiên'>&laquo;</a></li>";
                echo "<li><a href='".$requested_controller->str_uri_p.$prev."' alt='Trang trước' title='Trang trước'>&lsaquo;</a></li>";
            }
            for ($i = $requested_controller->min; $i <= $requested_controller->max; $i++)
            {
                if ($requested_controller->p == $i)
				{
                    echo "<li><span alt='Trang hiện tại' title='Trang hiện tại' style='color: #fff'>".$i."</span></li>";
                }
                else
				{
                    echo "<li><a href='".$requested_controller->str_uri_p.$i."' alt='Trang ".$i."' title='Trang ".$i."'>".$i."</a></li>";
                }
            }
            if ($requested_controller->p < $requested_controller->page)
            {
                echo "<li><a href='".$requested_controller->str_uri_p.$next."' alt='Trang sau' title='Trang sau'>&rsaquo;</a></li>";
                echo "<li><a href='".$requested_controller->str_uri_p.$requested_controller->page."' alt='Trang cuối cùng' title='Trang cuối cùng'>&raquo;</a></li>";;
            }
        }
		echo "</ul>
		</div>
		</div>";
	}
	function show_data()
	{
		global $requested_model;
		global $requested_controller;
		if ($requested_model->record != 0)
		{
			echo '<div id="datadiv">';
			echo '<div class="row product-list">';
			$result = $requested_model->get_data($requested_controller->start,$requested_controller->d);
			$i=0;
			foreach ($result as $data)
			{
				$i++;
				echo "<div class='col-md-3 col-sm-6 col-xs-12' style='padding-right:6px;padding-left:6px;'>
				<div class='product-item' style='margin-bottom:10px;'>";
				if ($data['hot'] == '1') echo "<div class='sticker sticker-hot'></div>";
				if ($data['new'] == '1') echo "<div class='sticker sticker-new'></div>";
				echo "<div class='pi-img-wrapper'>
					<img src='../../410x550/".$data['img1']."' class='img-responsive' alt='".$data['title']."' title='".$data['title']."'>
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
				{ echo "<a class='btn btn-default add2cart' onclick='cart(".$data['id'].")'><i class='fa fa-legal'></i>&nbsp;Mượn</a>"; }
				else { echo "<a href='javascipt:void()' class='btn btn-default add2cart'><i class='fa fa-slack'></i>&nbsp;Hết sách</a>"; }
				echo "</div>
				</div>";
				if ($i == 4)
				{
					echo "</div>
					<div class='row product-list'>";
					$i=0;
				}
			}
			echo '</div>
			</div>';
			$this->get_paginator();
		} else
		{
			echo "<center><p>Không có sách nào</p></center>";
		}
	}
	function show_content()
	{
		echo '<div class="row margin-bottom-40">';
		$this->show_resource_sidebar();
		echo '<div class="col-md-9 col-sm-7" id="scroll-to">
        <h1>Yêu cầu sách đã được đáp ứng</h1>
		<div id="put-loading">';
		echo "
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
		$this->show_data();
		echo '</div>
		</div>
		</div>';
	}
	function config()
	{
		global $header_view;
		$header_view->title='Yêu cầu sách đã được đáp ứng';
		$header_view->description='Yêu cầu sách đã được đáp ứng';
		$header_view->keyword='yeu cau sach da duoc dap ung';
		$header_view->pagelv1="<link href='../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css' rel='stylesheet'>
		<link href='../../assets/global/plugins/rateit/src/rateit.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js' type='text/javascript'></script><!-- pop up -->
		<script src='../../assets/global/plugins/rateit/src/jquery.rateit.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Metronic.init();
				Layout.init();
			});
		</script>";
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
									html +="<div class='pi-img-wrapper'><img src='../../410x550/"+data['img1']+"' class='img-responsive' alt='"+data['title']+"' title='"+data['title']+"'><div><a href='#product-pop-up' class='btn btn-default fancybox-fast-view' id='fastview"+data['id']+"' onclick='fastview("+data['id']+")'><i class='fa fa-search-plus'></i>&nbsp;&nbsp;xem thêm</a></div></div><h3 style='padding-bottom:0; margin-bottom:5px;'><a href='../../"+sf(data['title'],0)+"."+data['id']+".html'>"+data['title']+"</a><br/><span class='author2'>"+data['author']+"</span></h3><div class='pi-price'>";
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
			global $requested_model;
			global $requested_controller;
			die (json_encode(array(
				'data' => $requested_model->get_data($requested_controller->start,$requested_controller->d),
				'paging' => array(
					'start2' => $requested_controller->start2,
					'end' => $requested_controller->end,
					'record' => $requested_model->record,
					'page' => $requested_controller->page,
					'p' => $requested_controller->p,
					'str_uri' => $requested_controller->str_uri,
					'str_uri_p' => $requested_controller->str_uri_p,
					'min' => $requested_controller->min,
					'max' => $requested_controller->max
				)
			)));
		}
	}
	function show()
	{
		echo '<div class="main">
		<div class="container">';
		$this->show_breadcrumb();
		$this->show_content();
		fast_view_box_view::show();
		echo '</div>
		</div>';
		$this->show_ajax();
	}
}
?>