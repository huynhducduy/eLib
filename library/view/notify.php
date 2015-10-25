<?php
class notify_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
            <li class='active'>Thông báo</li>
        </ul>";
	}
	function show_acc_sidebar()
	{
		global $acc_sidebar_view;
		$acc_sidebar_view->show();
	}

	function show_data()
	{
		echo '<div class="goods-data clearfix" id="content2wish">
				<div class="table-wrapper-responsive">
					<table summary="Shopping cart">
						<tbody id="data-noti">';
		if ($_SESSION['userid'] != NULL)
		{
			global $notify_model;
			if ($notify_model->record != 0)
			{
				$result = $notify_model->data;
				foreach ($result as $data)
				{
					echo '<tr>';
					if ($data['seen'] != 1) { echo "<td class='new-noti' onclick='seen_notify(".$data['id'].")'>"; } else { echo '<td>'; }
					echo "
						<a href='".$data['link']."' class='nohighlight'>
							<p>".$data['content']."</p>
							<div class='notitime'>".ti_me($data['time'])."</div>
						</a>
						</td>
					</tr>";
				}
			} 
			else
			{
				echo "<center><p>Không có thông báo nào</p></center>";
			}
		}
		else
		{
			echo "<center><p>Bạn chưa đăng nhập, không thể xem thông báo</p></center>";
		}
		echo '		</tbody>
				</table>
            </div>';
			global $notify_model;
			if (($_SESSION['userid'] != NULL) && ($notify_model->record > 10))
			{
				echo '<div class="goods-page" style="margin-top:20px">
					<center><button class="btn btn-default" id="load_more" style="float: none">Xem thêm <i class="fa fa-circle-o-notch"></i></button></center>
				</div>';
			}
		echo '</div>';
	}
	function show_content()
	{
		echo '<div class="row margin-bottom-40">';
		$this->show_acc_sidebar();
		echo '<div class="col-md-9 col-sm-7" id="scroll-to">
        <h1>Thông báo</h1>';
		$this->show_data();
		echo '</div>
		</div>';
	}
	function config()
	{
		global $header_view;
		$header_view->robots='1';
		$header_view->title='Thông báo';
		$header_view->description='Thông báo';
		$header_view->keyword='thong bao';
		$header_view->pagelv1="<style>
		.goods-data td {
			padding: 10px 10px 10px 0 !important;
		}
		</style>";
		$header_view->pagelv2="
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
		<script>
		var is_busy = false;
		var page = 1;
		var record_per_page = 10;
		var stopped = false;
		$(document).ready(function()
		{
			$('#load_more').click(function()
			{
				$element = $('#data-noti');
				$button = $(this);
				if (is_busy == true) {
					return false;
				}
				page++;
				$button.html('ĐANG TẢI ...');
				$.ajax(
				{
					type: 'get',
					dataType: 'json',
					url: '../../process/get-noti.php',
					data: {page: page},
					success: function(result)
					{
						var html = '';
						if (result.length <= record_per_page)
						{
							$.each(result, function (key, obj){
								html += '<tr>';
								if (obj.seen != 1) { html+= "<td class='new-noti'>"; } else { html+= '<td>'; }
								html+="<a href='"+obj.link+"' class='nohighlight'><p>"+obj.content+"</p><div class='notitime'>"+obj.time+"</div></a></td></tr>";
							});
							$element.append(html);
							$button.remove();
						}
						else {
							$.each(result, function (key, obj){
								if (key < result.length - 1){
									html += '<tr>';
									if (obj.seen != 1) { html+= "<td class='new-noti'>"; } else { html+= '<td>'; }
									html+="<a href='"+obj.link+"' class='nohighlight'><p>"+obj.content+"</p><div class='notitime'>"+obj.time+"</div></a></td></tr>";
								}
							});
							$element.append(html);
						}
		
					}
				})
				.always(function()
				{
					$button.html('XEM THÊM <i class="fa fa-circle-o-notch"></i>');
					is_busy = false;
				});
			});
		});
		</script>
		<?php
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