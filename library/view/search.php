<?php
class search_view
{
	function show_breadcrumb()
	{
		global $search_controller;
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
			<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tim-kiem'><span itemprop='title'>Tìm kiếm</span></a></div></li>";
		if ($_GET['q'] != '')
		{
		echo "<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tim-kiem/".rawurlencode($_GET['q'])."'><span itemprop='title'>".$_GET['q']."</span></a></div></li>
            <li class='active'>Trang <span id='bread_p'>".$search_controller->p."</span></li>";
		}
		else
		{
			echo "<li class='active'>Tìm kiếm</li>";
		}
		echo "</ul>";
	}

	function get_paginator()
	{
		global $search_controller;
		global $search_model;
		echo "<div class='row'>";
		echo "<div class='col-md-4 col-sm-4 items-info' id='pag-tip'>Kết quả thứ <i>".$search_controller->start2."</i>&nbsp; đến <i>".$search_controller->end."</i>&nbsp; trong số <i>".$search_model->record."</i>&nbsp; kết quả</div>"; 
		echo "<div class='col-md-8 col-sm-8' id='content-paging'>
		<ul class='pagination pull-right' id='paging'>";
		if ($search_controller->page > 1)
        {
			$prev=$search_controller->p-1;
			$next=$search_controller->p+1;
            if ($search_controller->p > 1)
            {
                echo "<li><a href='".$search_controller->str_uri."' alt='Trang đầu tiên' title='Trang đầu tiên'>&laquo;</a></li>";
                echo "<li><a href='".$search_controller->str_uri_p.$prev."' alt='Trang trước' title='Trang trước'>&lsaquo;</a></li>";
            }
            for ($i = $search_controller->min; $i <= $search_controller->max; $i++)
            {
                if ($search_controller->p == $i)
				{
                    echo "<li><span alt='Trang hiện tại' title='Trang hiện tại' style='color: #fff'>".$i."</span></li>";
                }
                else
				{
                    echo "<li><a href='".$search_controller->str_uri_p.$i."' alt='Trang ".$i."' title='Trang ".$i."'>".$i."</a></li>";
                }
            }
            if ($search_controller->p < $search_controller->page)
            {
                echo "<li><a href='".$search_controller->str_uri_p.$next."' alt='Trang sau' title='Trang sau'>&rsaquo;</a></li>";
                echo "<li><a href='".$search_controller->str_uri_p.$search_controller->page."' alt='Trang cuối cùng' title='Trang cuối cùng'>&raquo;</a></li>";;
            }
        }
		echo "</ul>
		</div>
		</div>";
	}
	function show_data()
	{
		global $search_model;
		global $search_controller;
		if ($search_model->record != 0)
		{
			echo '<div id="datadiv">';
			$result = $search_model->get_data($search_controller->start-1);
			$i=0;
			foreach ($result as $data)
			{
				echo '<div class="search-result-item">
				<table>
				<tr>
					<td style="padding-right: 10px" width="1%">';
				if ($data['image'] != NULL)
				{
					echo '<a href="'.$data['link'].'">
						<img src="'.$data['image'].'" width="45" height="60"/>
					</a>';
				}
				echo '</td>
					<td>
						<h4 style="padding-top:0"><a href="'.$data['link'].'">'.$data['title'].'</a></h4>
						<p style="margin-bottom:2px">'.$data['des'].'</p>
						<a class="search-link" href="'.$data['link'].'">'.$data['url'].'</a>
					</td>
				</tr>
			  </table>
			  </div>';
			}
			echo '</div>';
			$this->get_paginator();
		} else
		{
			echo "<center><p>Không có kết quả nào</p></center>";
		}
	}
	function show_content()
	{
		echo '<div class="row margin-bottom-40">
          <div class="col-md-12">
            <div class="content-page" id="scroll-to">
              <form action="#" class="content-search-view2" onsubmit="return search()">
                <div class="input-group">
                  <input type="text" class="form-control" id="txtSearch" placeholder="Tìm kiếm..." value="'.$_GET['q'].'">
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                  </span>
                </div>
              </form>
			  <div id="put-loading"> 
			  <div id="loading4" style="display: none;">
				<center>
				<div class="vuload" id="vuload" style="top: 40px">
					<div class="vuitems" id="vuitems_1"><div class="comp"></div></div>
					<div class="vuitems" id="vuitems_2"><div class="comp"></div></div>
					<div class="vuitems" id="vuitems_3"><div class="comp"></div></div>
					<div class="vuitems" id="vuitems_4"><div class="comp"></div></div>
					<div class="vuitems" id="vuitems_5"><div class="comp"></div></div>
				</div>
				</center>
			</div>';
	if ($_GET['q'] != '')
	{
		$this->show_data();
	}
	echo ' </div>
            </div>
          </div>
        </div>';
	}
	function config()
	{
		global $header_view;
		global $search_controller;
		$header_view->title='Tìm kiếm';
		if ($search_controller->p > 1)
		{
			$header_view->title.=' - Trang '.$search_controller->p;
		}
		$header_view->description='Tìm kiếm';
		$header_view->keyword='tim kiem';
		$header_view->pagelv2="<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
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
				 $('#loading4').fadeIn('fast');
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
								html = '';
								html2 = '';
								$.each(result['data'], function (key, data)
								{
									html +='<div class="search-result-item">';
									html +='<table>';
									html +='<tr>';
									html +='<td style="padding-right: 10px" width="1%">';
									if (data.image != null)
									{
										html +='<a href="'+data.link+'">';
										html +='<img src="'+data.image+'" width="45" height="60"/>';
										html +='</a>';
									}
									html +='</td>';
									html +='	<td>';
									html +='		<h4 style="padding-top:0"><a href="'+data.link+'">'+data.title+'</a></h4>';
									html +='		<p style="margin-bottom:2px">'+data.des+'</p>';
									html +='		<a class="search-link" href="'+data.link+'">'+data.url+'</a>';
									html +='	</td>';
									html +='</tr>';
									html +='</table>';
									html +='</div>';
								});
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
								html3 = "Kết quả thứ <i>"+result['paging']['start2']+"</i>&nbsp; đến <i>"+result['paging']['end']+"</i>&nbsp; trong số <i>"+result['paging']['record']+"</i>&nbsp; kết quả"; 
								$('#bread_p').html(result['paging']['p']);
								$('#datadiv').html(html);
								$('#paging').html(html2);
								$('#pag-tip').html(html3);
								window.history.pushState({path:url},'',url);
								$('#loading4').fadeOut('slow');
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
			global $search_model;
			global $search_controller;
			die (json_encode(array(
				'data' => $search_model->get_data($search_controller->start),
				'paging' => array(
					'start2' => $search_controller->start2,
					'end' => $search_controller->end,
					'record' => $search_model->record,
					'page' => $search_controller->page,
					'p' => $search_controller->p,
					'str_uri' => $search_controller->str_uri,
					'str_uri_p' => $search_controller->str_uri_p,
					'min' => $search_controller->min,
					'max' => $search_controller->max
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