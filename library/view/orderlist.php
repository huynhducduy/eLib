<?php
class orderlist_view
{
	function show_heady()
	{
		global $acc_sidebar_view;
		echo "<div class='main'>
		<div class='container'>
		<ul class='breadcrumb'>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
				<li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
				<li class='active'>Đơn sách</li>
			</ul>
			<!-- BEGIN SIDEBAR & CONTENT -->
			<div class='row margin-bottom-40'>";
		$acc_sidebar_view->show();	
		echo "<div class='col-md-9 col-sm-9 margin-bottom-20'>
		<h1>Danh sách đơn sách</h1>";
	}
	
	function show_footy()
	{
		echo "</div>
		</div>
		</div>
		</div>";
	}
	
	function show_orderlist()
	{
		global $orderlist_model;
		if ($_SESSION['userid'] != NULL)
		{
			$count=$orderlist_model->get_num(); 
			echo "<div class='goods-page'>
			<p style='display: none' id='emptyorder'>Danh sách đơn sách bạn trống</p>
					<div class='goods-data clearfix' id='content2order'>
						<div class='table-wrapper-responsive'>
						<table summary='Shopping cart'>
						<tr>
							<th class='goods-page-image'>#</th>
							<th class='goods-page-title'>Thời gian</th>
							<th class='goods-page-description'>Số sách</th>
							<th class='goods-page-stock' width='1%'>Tình trạng</th>
							<th class='goods-page-stock' colspan='2' width='1%'></th>
						</tr>";
			$orderlist=$orderlist_model->get();
			if ($orderlist != NULL)
			{
				foreach ($orderlist as $data)
				{
					echo "<tr id='order".$data['id']."'>
					<td class='goods-page-image'>
						".$data['id']."
					</td>
					<td class='goods-page-title'>
						".ti_me($data['time'])."
					</td>
					<td class='goods-page-description'>
						".$data['count']."
					</td>
					<td class='goods-page-stock'>";
					$status='<span id="orderTus'.$data['id'].'"class="label label-';
					switch ($data['status']) {
						case '0': $status.='warning">Chưa xác nhận'; break;
						case '1': $status.='default">Chưa mượn'; break;
						case '2': $status.='primary">Đang mượn'; break;
						case '3': $status.='success">Đã trả'; break;
						case '4': $status.='danger">Đã hủy'; break;
					}
					if ($data['status'] == 0)
					{
						if ($data['reconfirm'] == 1) 
						{
							$status.=' - Đang xác nhận lại';
						}
						else if ($data['reconfirm'] == 2)
						{
							$status.=' - Đã xác nhận lại';
						}
					}
					$status.='</span>';
					echo $status;
					echo "</td>
					<td class='goods-page-time'>
						<a href='../../donsach/".$data['id']."' class='btn btn-xs default btn-editable'><i class='fa fa-pencil'></i> Xem</a>
					</td>
					<td class='del-goods-col'>";
					if (($data['status'] == 0) || ($data['status'] == 1))
					{
						echo "<a class='del-goods' alt='Hủy đơn sách' id='btncancel".$data['id']."' onclick='cancelorder(".$data['id'].")'></a>";
					}
					echo "</td>
					</tr>";
				}
			}
			echo  "<div id='contentorder' count='".$count."'></div></table>
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
		<p>Danh sách đơn sách bạn trống</p>
		</div>
		</div>";
	}
	
	function show_require_login()
	{
		echo "<div class='shopping-cart-page'>
		<div class='shopping-cart-data clearfix'>
		<p>Bạn phải đăng nhập để xem danh sách đơn sách</p>
		</div>
		</div>";
	}
	
	function show_content()
	{
		global $orderlist_model;
		$count=$orderlist_model->get_num();
		if ($count != '0') 
		{ 
			$this->show_orderlist();
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
		$header_view->title='Đơn sách';
		$header_view->description='Đơn sách';
		$header_view->keyword='don sach';
		$header_view->pagelv2="
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Layout.init();
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