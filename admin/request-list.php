<?php
$pagelv1="<link rel='stylesheet' type='text/css' href='../../assets/global/plugins/select2/select2.min.css'/>
<link rel='stylesheet' type='text/css' href='../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.css'/>";
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/scripts/datatable.min.js'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		RequestList.init();
	});
</script>";
$title='Danh sách yêu cầu';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Danh sách yêu cầu sách <small>Liệt kê các yêu cầu sách trên thư viện</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="book-list.php">Sách</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Yêu cầu sách</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Danh sách</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa icon-hourglass font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Danh sách yêu cầu</span>
								<span class="caption-helper">Quản lí yêu cầu sách</span>
							</div>
						</div>
						<div class="portlet-body">
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
								<table class="table table-striped table-bordered table-hover" id="datatable_requests">
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
									<th width='20%'>
										Thành viên
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
										<input type="text" class="form-control form-filter input-sm" name="request_user">
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
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once('./lib/footer.php'); ?>