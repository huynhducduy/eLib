<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.min.css"/>
<link href="../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-summernote/summernote.css">
<style>
.radio {  min-height: 18px !important; padding-top: 0 !important; margin-bottom: 5px!important;   margin-right: 3px !important;}
</style>';
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/scripts/datatable.min.js'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		UserEdit.init();
	});
</script>";
$title='Chỉnh sửa tài khoản';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Chỉnh sửa tài khoản <small>Xem và chỉnh sửa thông tin tài khoản</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="user-list.php">Tài khoản</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Chỉnh sửa tài khoản</a>
				</li>
			</ul>
			<?php
			$sql="SELECT * FROM `user` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" id='userdata' onsubmit='return useredit();'>
					<input type='hidden' id='userid' name='user[id]' value="<?=$row['id']?>"/>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Chỉnh sửa tài khoản </span>
									<span class="caption-helper"><?=$row['scode']?></span>
								</div>
								<div class="actions btn-set">
									<button class="btn btn-default btn-circle"><a href='user-list.php'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<button type='button' onclick='delBook(<?=$row['id']?>)'class="btn red-haze btn-circle"><i class="fa fa-remove"></i> Xóa</button>
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Lưu</button>
								</div>
							</div>
							<div class="portlet-body">
								<div class="tabbable">
									<ul class="nav nav-tabs" id='click'>
									<?php
									$sqlcount1="SELECT * FROM `user` where `id`='".$_GET['id']."'";
									$querycount1=@mysql_query($sqlcount1);
									$rowcount1=@mysql_fetch_assoc($querycount1);
									$x=explode('|',$rowcount1['wishlist']);
									$count1=count($x)-1;
									$sqlcount2="SELECT * FROM `request` WHERE `userid`=".$_GET['id']."";
									$querycount2=@mysql_query($sqlcount2);
									$count2=mysql_num_rows($querycount2);
									$sqlcount3="SELECT * FROM `contribute` WHERE `userid`=".$_GET['id']."";
									$querycount3=@mysql_query($sqlcount3);
									$count3=mysql_num_rows($querycount3);
									$sqlcount4="SELECT * FROM `order` WHERE `userid`=".$_GET['id']."";
									$querycount4=@mysql_query($sqlcount4);
									$count4=mysql_num_rows($querycount4);
									$sqlcount5="SELECT * FROM `review` WHERE `userid`=".$_GET['id']."";
									$querycount5=@mysql_query($sqlcount5);
									$count5=mysql_num_rows($querycount5);
									$sqlcount6="SELECT * FROM `comment` WHERE `userid`=".$_GET['id']."";
									$querycount6=@mysql_query($sqlcount6);
									$count6=mysql_num_rows($querycount6);
									?>
										<li class="active">
											<a href="#tab_general" data-toggle="tab">Thông tin </a>
										</li>
										<li>
											<a href="#tab_wishlist" data-toggle="tab">Yêu thích <span class="badge badge-success"><?=$count1?></span></a>
										</li>
										<li>
											<a href="#tab_request" data-toggle="tab">Yêu cầu <span class="badge badge-success"><?=$count2?></span></a>
										</li>
										<li>
											<a href="#tab_contribute" data-toggle="tab">Đóng góp <span class="badge badge-success"><?=$count3?></span></a>
										</li>
										<li>
											<a href="#tab_order" data-toggle="tab">Đơn hàng <span class="badge badge-success"><?=$count4?></span></a>
										</li>
										<li>
											<a href="#tab_review" data-toggle="tab">Nhận xét <span class="badge badge-success"><?=$count5?></span></a>
										</li>
										<li>
											<a href="#tab_comment" data-toggle="tab">Bình luận <span class="badge badge-success"><?=$count6?></span></a>
										</li>
									</ul>
									<br/>
									<div class="tab-content no-space">
										<div class="tab-pane active" id="tab_general">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-2 control-label">ID: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" readonly value="<?=$row['id']?>">
													</div>
												</div>
												<div class="form-group" id='namediv'>
													<label class="col-md-2 control-label">Họ và tên: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errname'></i>
														<input type="text" class="form-control" name="user[name]" id="username" value="<?=$row['name']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='classdiv'>
													<label class="col-md-2 control-label">Lớp: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errclass'></i>
														<input type="text" class="form-control" name="user[class]" id="userclass" value="<?=$row['class']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='birthdaydiv'>
													<label class="col-md-2 control-label">Ngày sinh: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errbirthday'></i>
														<input type="text" class="form-control date-picker" data-date="<?=$row['birthday']?>" data-date-format="yyyy-mm-dd" name="user[birthday]" value="<?=$row['birthday']?>">
													<span class="help-block">
													Định dạng: YYYY-MM-DD </span>
													</div>
													</div>
												</div>
												<div class="form-group" id='emaildiv'>
													<label class="col-md-2 control-label">Email: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='erremail'></i>
														<input type="text" class="form-control" name="user[email]" id="useremail" value="<?=$row['email']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='scodediv'>
													<label class="col-md-2 control-label">Mã học sinh: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errscode'></i>
														<input type="text" class="form-control" name="user[scode]" id="userscode" value="<?=$row['scode']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='passdiv'>
													<label class="col-md-2 control-label">Mật khẩu: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errpass'></i>
														<input type="text" class="form-control" name="user[pass]" id="userpass" onchange='userMd5PassEncode()' value="<?=$row['password']?>">
													</div>
													<span class="help-block">
													Định dạng: MD5 </span>
													</div>
												</div>
												<div class="form-group" id='scodediv'>
													<label class="col-md-2 control-label">Tình trạng: </label>
													<div class="col-md-10">
														<?php if ($row['verify'] != '1') { ?>
														<div style='font-size: 15px; padding: 6px 6px;'class="label label-sm label-danger" id='textConfirm'>Chưa xác nhận</div>
														<a href='javascript:confirmUser(<?=$_GET['id']?>)'><span id='btnConfirm' class="help-block" style='margin-top: 10px;'>Xác nhận</span></a>
														<?php } else { ?>
														<div style='font-size: 15px; padding: 6px 6px;'class="label label-sm label-success" id='textConfirm'>Đã xác nhận</div>
														<?php } ?>
													</div>
												</div>
											</div>
											<div class="form-actions form-actionlol">
												<div class="row">
													<div class="col-md-offset-2 col-md-10">
														<button type="submit" class="btn green"><i class="fa fa-check"></i> Chỉnh sửa</button>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_wishlist">
											<div class="table-container">
												<div class="table-actions-wrapper">
													<span>
													</span>
													<select class="table-group-action-input form-control input-inline input-small input-sm">
														<option value="">...</option>
														<option value="1">Xóa</option>
													</select>
													<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Thực thi</button>
												</div>
												<table class="table table-striped table-bordered table-hover" id="datatable_wishlist">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='20%'>
														ID sách
													</th>
													<th width='20%'>
														Tên sách
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="wishlist_bookid">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="wishlist_title">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="wishlist_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="wishlist_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab_request">
											<div class="table-container">
												<div class="table-actions-wrapper">
													<span>
													</span>
													<select class="table-group-action-input form-control input-inline input-small input-sm">
														<option value="">...</option>
														<option value="1">Xóa</option>
													</select>
													<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Thực thi</button>
												</div>
												<table class="table table-striped table-bordered table-hover" id="datatable_request">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='5%'>
														ID
													</th>
													<th width='20%'>
														Tên sách
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th width='15%'>
														Tình trạng
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="request_id">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="request_title">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="request_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="request_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<select name="request_status" class="form-control form-filter input-sm">
															<option value="-1">...</option>
															<option value="0">Chưa xác nhận</option>
															<option value="1">Chưa đáp ứng</option>
															<option value="2">Đã đáp ứng</option>
															<option value="3">Không đáp ứng</option>
														</select>
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab_contribute">
											<div class="table-container">
												<div class="table-actions-wrapper">
													<span>
													</span>
													<select class="table-group-action-input form-control input-inline input-small input-sm">
														<option value="">...</option>
														<option value="1">Xóa</option>
													</select>
													<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Thực thi</button>
												</div>
												<table class="table table-striped table-bordered table-hover" id="datatable_contribute">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
														ID
													</th>
													<th width='20%'>
														Tên sách
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th width='15%'>
														Tính trạng
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="contribute_id">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="contribute_title">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="contribute_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="contribute_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<select name="request_status" class="form-control form-filter input-sm">
															<option value="-1">...</option>
															<option value="0">Chưa xác nhận</option>
															<option value="1">Chưa nhận</option>
															<option value="2">Đã nhận</option>
															<option value="3">Không nhận</option>
														</select>
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab_order">
											<div class="table-container">
												<div class="table-actions-wrapper">
													<span>
													</span>
													<select class="table-group-action-input form-control input-inline input-small input-sm">
														<option value="">...</option>
														<option value="1">Xóa</option>
													</select>
													<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Thực thi</button>
												</div>
												<table class="table table-striped table-bordered table-hover" id="datatable_order">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
														ID
													</th>
													<th width='20%'>
														Số sách
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th width='15%'>
														Thời gian mượn
													</th>
													<th width='15%'>
														Thời gian trả
													</th>
													<th width='15%'>
														Tình trạng
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="order_id">
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="order_count">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="order_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="order_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="order_time11" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="order_time12" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="order_time21" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="order_time22" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<select name="request_status" class="form-control form-filter input-sm">
															<option value="-1">...</option>
															<option value="0">Chưa xác nhận</option>
															<option value="1">Chưa mượn</option>
															<option value="2">Đang mượn</option>
															<option value="3">Đã trả</option>
															<option value="4">Đã hủy</option>
														</select>
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab_review">
											<div class="table-container">
												<div class="table-actions-wrapper">
													<span>
													</span>
													<select class="table-group-action-input form-control input-inline input-small input-sm">
														<option value="">...</option>
														<option value="1">Xóa</option>
													</select>
													<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Thực thi</button>
												</div>
												<table class="table table-striped table-bordered table-hover" id="datatable_reviews">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
														ID
													</th>
													<th width='10%'>
														Sách
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th width='1%'>
														Đánh giá
													</th>
													<th>
														Nội dung
													</th>
													<th width='1%'>
														Cảm ơn
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="review_id">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_book">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="review_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="review_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_rating">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_content">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_thanks">
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab_comment">
											<div class="table-container">
												<div class="table-actions-wrapper">
													<span>
													</span>
													<select class="table-group-action-input form-control input-inline input-small input-sm">
														<option value="">...</option>
														<option value="1">Xóa</option>
													</select>
													<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Thực thi</button>
												</div>
												<table class="table table-striped table-bordered table-hover" id="datatable_comments">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
														ID
													</th>
													<th width='10%'>
														Sách
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th>
														Nội dung
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="comment_id">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="comment_book">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="comment_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="comment_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="comment_content">
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
										<div class="tab-pane" id="tab_history">
											<div class="table-container">
												<table class="table table-striped table-bordered table-hover" id="datatable_history">
												<thead>
												<tr role="row" class="heading">
													<th width='1%' class="sorting_disabled">
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
													ID
													</th>
													<th width="25%">
														 Thời gian mượn
													</th>
													<th width="25%">
														 Thời gian trả
													</th>
													<th width="55%">
														 Người mượn
													</th>
													<th width="10%">
														 Trạng thái
													</th>
													<th width="10%">
													</th>
												</tr>
												<tr role="row" class="filter">
													<td></td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="history_id">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time11" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time22" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="history_user"/>
													</td>
													<td>
														<select name="history_status" class="form-control form-filter input-sm">
															<option value="0">...</option>
															<option value="1">Chưa mượn</option>
															<option value="2">Đang mượn</option>
															<option value="3">Đã trả</option>
															<option value="4">Đã bị hủy</option>
														</select>
													</td>
													<td>
														<div class="margin-bottom-5">
															<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> Tìm</button>
														</div>
														<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> Hủy</button>
													</td>
												</tr>
												</thead>
												<tbody>
												</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			}
			else {
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Thành viên này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>