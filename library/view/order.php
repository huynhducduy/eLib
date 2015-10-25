<?php
class order_view
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
		echo "<div class='col-md-9 col-sm-9 margin-bottom-20'>";
	}
	
	function show_footy()
	{
		echo "</div>
		</div>
		</div>
		</div>";
	}
	
	function show_page()
	{
		if ($_SESSION['userid'] != NULL)
		{
			global $order_controller;
			if ($order_controller->check_exist == true)
			{
				if ($order_controller->check_owner == true)
				{
					global $order_model;
					$order=$order_model->order;
					$eachorder=$order_model->eachorder;
					$status='<span class="label label-';
					switch ($order['status']) {
						case '0': $status.='warning">Chưa xác nhận'; break;
						case '1': $status.='default">Chưa mượn'; break;
						case '2': $status.='primary">Đang mượn'; break;
						case '3': $status.='success">Đã trả'; break;
						case '4': $status.='danger">Đã hủy'; break;
					}
					if ($order['status'] == 0)
					{
						if ($order['reconfirm'] == 1) 
						{
							$status.=' - Đang xác nhận lại';
						}
						else if ($order['reconfirm'] == 2)
						{
							$status.=' - Đã xác nhận lại';
						}
					}
					$status.='</span>';
		?>
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-basket font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">
								#<?php echo $order['id']; ?> </span>
								<?php echo $status;	?>
							</div>
							<div class="actions btn-set">
								<a href="../../donsach" class="btn btn-default">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
								Quay lại </span>
								</a>
								<?php
								if (($order['status'] == 0) && ($order['reconfirm'] == 1))
								{
								?>
									<button type="button" onclick="reConfirmOrder(<?php echo $order['id']; ?>)" class="btn blue-madison"><i class="fa fa-bell"></i> Xác nhận lại</button>	
								<?php
								}
								if (($order['status'] == 0) || ($order['status'] == 1))
								{
								?>
									<button type="button" onclick="cancelorder2(<?php echo $order['id']; ?>)" class="btn red"><i class="fa fa-remove"></i> Hủy đơn</button>
								<?php
								}
								?>
							</div>
						</div>
						<div class="portlet-body">
							<?php
							if (($order['status'] == 0) || ($order['status'] == 1))
							{
							?>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="note note-info">
										<h4 class="block">Yêu cầu xác nhận lại đơn sách</h4>
										<p>Đơn sách của bạn đã được BQT thay đổi, nếu bạn đồng ý với những thay đổi này, bạn hãy xác nhận lại và mượn sách, nếu không bạn có thể hủy đơn sách!</p>
									</div>
								</div>
							</div>
							<?php
							}
							?>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="portlet yellow-crusta box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Thông tin đơn sách
											</div>
										</div>
										<div class="portlet-body">
											<div class="row static-info">
												<div class="col-md-5 name">
													Đơn sách #:
												</div>
												<div class="col-md-7 value">
													<?php echo $order['id']; ?>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													 Thời gian đặt sách
												</div>
												<div class="col-md-7 value">
													 <?php echo ti_me($order['time']); ?>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													 Tình trạng
												</div>
												<div class="col-md-7 value">
													<?php echo $status; ?>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													 Số sách
												</div>
												<div class="col-md-7 value">
													 <?php echo $order['count']; ?>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Hình thức 
												</div>
												<div class="col-md-7 value">
												<span id='editMethodSn'><?php
													switch ($order['method']) {
														case '1': echo 'Đọc tại chỗ'; break;
														case '2': echo 'Mượn về'; break;
													}
												?></span>
												<?php 
												if (($order['status'] == 0) || ($order['status'] == 1))
												{
												?>
												<a class="pull-right btn btn-xs grey-cascade" style='position: inherit;' id='editMethodBtn' onclick='editMethod(<?php echo $order['id']; ?>)'>
												<i class="fa fa-pencil"></i> Sửa</a>
												<?php
												}
												?>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Thời gian mượn
												</div>
												<div class="col-md-7 value">
													<?php echo ti_me($order['timestart']); ?>
												</div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name">
													Thời gian trả
												</div>
												<div class="col-md-7 value">
													<?php echo ti_me($order['timestop']); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="portlet red box">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Ghi chú
											</div>
											<div class="actions">
												<a class="btn btn-default btn-sm" id='editNoteBtn' onclick='editNote(<?php echo $order['id']; ?>)'>
												<i class="fa fa-pencil"></i> Sửa</a>
											</div>
										</div>
										<div class="portlet-body">
											<div class="row static-info" style='margin-bottom:0'>
												<div class="col-md-12" style='font-size: 14px;'>
													<span id='editNoteSn'><?php echo $order['note']!=NULL?$order['note']:'Không có'; ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="portlet purple box" style='margin-bottom: 0'>
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-cogs"></i>Sách trong giỏ <span class="badge badge-success"><?php echo $order['count']; ?></span>
											</div>
										</div>
										<div class="portlet-body">
											<div class="table-responsive">
												<table class="table table-hover table-bordered table-striped" style='margin-bottom: 0'>
												<thead>
												<tr>
													<th width='1%'>
														Hình ảnh
													</th>
													<th width='20%'>
														Tên sách
													</th>
													<th>
														Mô tả
													</th>
													<th>
														Tình trạng
													</th>
													<?php
													if ($order['status'] == 0)
													{
														echo '<th></th>';
													}
													?>
												</tr>
												</thead>
												<tbody>
												<?php
												foreach ($eachorder as $data)
												{
												?>
												<tr id="eachorder<?php echo $data['id']; ?>">
													<td>
														<a href='../../<?php echo sf($data['book']['title'],0).".".$data['book']['id']; ?>.html'>
															<img src="../../135x180/<?php echo $data['book']['img1']; ?>">
														</a>
													</td>
													<td class='static-info'>
														<a href='../../<?php echo sf($data['book']['title'],0).".".$data['book']['id']; ?>.html' class='value'><?php echo $data['book']['title']; ?></a>
													</td>
													<td>
														<?php echo $data['book']['des']; ?>
													</td>
													<td>
													<?php
														if ($data['book']['remain']>0) {
															echo '<span class="label label-sm label-success">Còn sách</span>';
														} else {
															echo '<span class="label label-sm label-danger">Hết sách</span>';
														}
													?>
														
													</td>
													<?php
														if ($order['status'] == 0)
														{
															echo '<td><a class="del-goods" alt="Bỏ khỏi đơn sách" title="Bỏ khỏi đơn sách" onclick="delEachOrder('.$data['id'].','.$order['id'].')">&nbsp;</a></td>';
														}
													?>
												</tr>
												<?php
												}
												?>
												</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
				}
				else
				{
					echo '<div class="product-page">
					<div class="alert alert-danger" id="errscode" style="margin-bottom: 0">
					Bạn không có quyền xem đơn sách này
					</div>
					</div>';
				}
			}
			else
			{
				echo '<div class="product-page">
				<div class="alert alert-danger" id="errscode" style="margin-bottom: 0">
				Đơn sách này không có thật
				</div>
				</div>';
			}
		}
		else
		{
			echo '<div class="product-page">
			<div class="alert alert-danger" id="errscode" style="margin-bottom: 0">
			Bạn chưa đăng nhập, không thể xem đơn sách này
			</div>
			</div>';
		}			
	}
	function config()
	{
		global $header_view;
		$header_view->robots='1';
		$header_view->title='Đơn sách';
		$header_view->description='Đơn sách';
		$header_view->keyword='don sach';
		$header_view->pagelv2="<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
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