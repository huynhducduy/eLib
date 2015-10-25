<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.min.css"/>';
$pagelv2='<script src="../../assets/global/scripts/metronic.min.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script>
    jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		EcommerceOrdersView.init();
    });
</script>';
$title='Đơn sách';
require_once('../assets/config.php');
require_once('./lib/header.php');
function ti_me($time_ago)
{
	if ($time_ago == '') return 'Không có';
  $cur_time=time();
  $time_elapsed = $cur_time - $time_ago;
  $seconds = $time_elapsed ;
  $minutes = round($time_elapsed / 60 );
  $hours = round($time_elapsed / 3600);
  $days = round($time_elapsed / 86400 );
  $weeks = round($time_elapsed / 604800);
  $months = round($time_elapsed / 2600640 );
  $years = round($time_elapsed / 31207680 );
  if ($seconds <= 60)
  {
    return $time_ago='Cách đây '.$seconds.' giây';
  }
  else if ($minutes <=60)
  {
    return $time_ago='Cách đây '.$minutes.' phút';
  }
  else if ($hours <=24)
  {
    return $time_ago="Cách đây $hours tiếng";
  }
  else if ($days <= 7)
  {
    return $time_ago='Cách đây '.$days.' ngày';
  }
  else if ($weeks <= 4.3)
  {
    return $time_ago='Cách đây '.$weeks.' tuần';
  }
  else if ($months <=12)
  {
    return $time_ago='Cách đây '.$months.' tháng';
  }
  else
  {
    return $time_ago='Cách đây '.$years.' năm';
  }
}
?>
<style>
.del-goods {
  width: 17px;
  height: 17px;
  color: #fff !important;
  border-radius: 22px !important;
  float: right;
  background: #d7dde3 url(../../assets/frontend/layout/img/icons/del-goods.png) no-repeat 50% 50%;
}
.del-goods:hover {
  background: #E94D1C url(../../assets/frontend/layout/img/icons/del-goods.png) no-repeat 50% 50%;
}
</style>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Đơn sách <small>xem chi tiết đơn sách</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="user-list.php">Đơn sách</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Xem đơn sách</a>
				</li>
			</ul>
			<?php
			$sql="SELECT * FROM `order` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
				$status='<span class="label label-';
				switch ($row['status']) {
					case '0': $status.='warning">Chưa xác nhận'; break;
					case '1': $status.='default">Chưa mượn'; break;
					case '2': $status.='primary">Đang mượn'; break;
					case '3': $status.='success">Đã trả'; break;
					case '4': $status.='danger">Đã hủy'; break;
				}
				if ($row['status'] == 0)
				{
					if ($row['reconfirm'] == 1) 
					{
						$status.=' - Đang xác nhận lại';
					}
					else if ($row['reconfirm'] == 2)
					{
						$status.=' - Đã xác nhận lại';
					}
				}
				$status.='</span>';
				$sql2="SELECT * FROM `user` WHERE `id`='".$row['userid']."'";
				$query2=@mysql_query($sql2);
				$row2=@mysql_fetch_assoc($query2);
				$sql3="SELECT * FROM `eachorder` WHERE `oid`='".$row['id']."'";
				$query3=@mysql_query($sql3);
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-basket font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">
								#<?php echo $row['id']; ?> </span>
								<?php echo $status;	?>
							</div>
							<div class="actions btn-set">
								<a href="order-list.php" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Quay lại</a>
								<?php
								if ($row['status'] == 0)
								{
								?>	<button type="button" onclick="reConfirmOrder(<?php echo $row['id']; ?>)" class="btn blue-madison btn-circle"><i class="fa fa-bell"></i> Thông báo xác nhận lại</button>
									<button type="button" onclick="confirmOrder(<?php echo $row['id']; ?>)" class="btn green-haze btn-circle"><i class="fa fa-check"></i> Xác nhận đơn</button>
								<?php
								}
								if (($row['status'] == 0) || ($row['status'] == 1))
								{
								?>
									<button type="button" onclick="cancelOrder(<?php echo $row['id']; ?>)" class="btn red-haze btn-circle"><i class="fa fa-remove"></i> Hủy đơn</button>
								<?php
								}
								if ($row['status'] == 2)
								{
								?>
									<button type="button" onclick="warnOrder(<?php echo $row['id']; ?>)" class="btn red-haze btn-circle"><i class="fa fa-book"></i> Yêu cầu trả sách</button>
									<button type="button" onclick="stopOrder(<?php echo $row['id']; ?>)" class="btn purple btn-circle"><i class="fa fa-book"></i> Đã trả</button>
								<?php
								}
								if ($row['status'] == 1)
								{
								?>
									<button type="button" onclick="startOrder(<?php echo $row['id']; ?>)" class="btn green-meadow btn-circle"><i class="fa fa-book"></i> Đã mượn</button>
								<?php
								}
								?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="tabbable">
								<div class="tab-content">
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
															<?php echo $row['id']; ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															 Thời gian đặt sách
														</div>
														<div class="col-md-7 value">
															 <?php echo ti_me($row['time']); ?>
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
															 <?php echo $row['count']; ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															Hình thức 
														</div>
														<div class="col-md-7 value">
														<span id='editMethodSn'><?php
															switch ($row['method']) {
																case '1': echo 'Đọc tại chỗ'; break;
																case '2': echo 'Mượn về'; break;
															}
														?></span>
														<?php 
														if (($row['status'] == 0) || ($row['status'] == 1))
														{
														?>
														<a class="pull-right btn btn-xs grey-cascade" style='position: inherit;' id='editMethodBtn' onclick='editMethod(<?php echo $row['id']; ?>)'>
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
															<?php echo ti_me($row['timestart']); ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															Thời gian trả
														</div>
														<div class="col-md-7 value">
															<?php echo ti_me($row['timestop']); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<div class="portlet blue-hoki box">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>Thông tin người đặt
													</div>
													<div class="actions">
														<a target='_blank' href="user-edit.php?id=<?php echo $row2['id']; ?>" class="btn btn-default btn-sm">
														<i class="fa fa-pencil"></i> Sửa</a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="row static-info">
														<div class="col-md-5 name">
															 Họ và tên
														</div>
														<div class="col-md-7 value">
															 <?php echo $row2['name']; ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															 Lớp
														</div>
														<div class="col-md-7 value">
															 <?php echo $row2['class']; ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															Ngày sinh
														</div>
														<div class="col-md-7 value">
															<?php echo $row2['birthday']; ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															 Mã học sinh
														</div>
														<div class="col-md-7 value">
															 <?php echo $row2['scode']; ?>
														</div>
													</div>
													<div class="row static-info">
														<div class="col-md-5 name">
															 Email
														</div>
														<div class="col-md-7 value">
															<?php echo $row2['email']; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="portlet red-sunglo box">
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>Ghi chú
													</div>
													<div class="actions">
														<a class="btn btn-default btn-sm" id='editNoteBtn' onclick='editNote(<?php echo $row['id']; ?>)'>
														<i class="fa fa-pencil"></i> Sửa</a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="row static-info" style='margin-bottom:0'>
														<div class="col-md-12" style='font-size: 14px;'>
															<span id='editNoteSn'><?php echo $row['note']!=NULL?$row['note']:'Không có'; ?></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="portlet grey-cascade box" style='margin-bottom:0'>
												<div class="portlet-title">
													<div class="caption">
														<i class="fa fa-cogs"></i>Sách trong giỏ <span class="badge badge-success"><?php echo $row['count']; ?></span>
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
															if ($row['status'] == 0)
															{
																echo '<th></th>';
															}
															?>
														</tr>
														</thead>
														<tbody>
														<?php
														while ($row3=@mysql_fetch_assoc($query3))
														{
															$sql4="SELECT * FROM `book` WHERE `id`='".$row3['bid']."'";
															$query4=@mysql_query($sql4);
															$row4=@mysql_fetch_assoc($query4);
														?>
														<tr id="eachorder<?php echo $row3['id']; ?>">
															<td>
																<a href="#">
																	<img src="../../135x180/<?php echo $row4['img1']; ?>">
																</a>
															</td>
															<td class='static-info'>
																<a href="#" class='value'><?php echo $row4['title']; ?></a>
															</td>
															<td>
																<?php echo $row4['des']; ?>
															</td>
															<td>
															<?php
																if ($row4['remain']>0) {
																	echo '<span class="label label-sm label-success">Còn sách</span>';
																} else {
																	echo '<span class="label label-sm label-danger">Hết sách</span>';
																}
															?>
																
															</td>
															<?php
																if ($row['status'] == 0)
																{
																	echo '<td><a class="del-goods" alt="Bỏ khỏi đơn sách" title="Bỏ khỏi đơn sách" onclick="delEachOrder('.$row3['id'].','.$row['id'].')">&nbsp;</a></td>';
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
				</div>
			</div>
			<?php
			}
			else {
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Đơn sách này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php require_once('./lib/footer.php'); ?>