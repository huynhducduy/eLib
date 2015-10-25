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
		UserList.init();
	});
</script>";
$title='Danh sách tài khoản';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Danh sách tài khoản <small>Liệt kê toàn bộ tài khoản trên thư viện</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Tài khoản</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Danh sách tài khoản</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa icon-users font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Danh sách tài khoản</span>
								<span class="caption-helper">Quản lí tài khoản</span>
							</div>
							<div class="actions">
								<a href="../../dang-ky" target='_blank' class="btn btn-circle green-haze">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">Thêm tài khoản mới </span>
								</a>
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
								<table class="table table-striped table-bordered table-hover" id="datatable_users">
								<thead>
								<tr role="row" class="heading">
									<th width='1%'>
										<input type="checkbox" class="group-checkable">
									</th>
									<th width='10%'>
										 ID
									</th>
									<th width='15%'>
										 Mã học sinh
									</th>
									<th>
										 Tên
									</th>
									<th width='10%'>
										 Lớp
									</th>
									<th width='1%'>
										 Đang mượn
									</th>
									<th width='1%'>
										 Tình trạng
									</th>
									<th width='1%'>
									</th>
								</tr>
								<tr role="row" class="filter">
									<td>
									</td>
									<td>
										<input type="number" class="form-control form-filter input-sm" name="user_id">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="user_code">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="user_name">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="user_class">
									</td>
									<td>
										<input type="number" class="form-control form-filter input-sm" name="user_borrowing">
									</td>
									<td>
										<select name="user_verify" class="form-control form-filter input-sm">
											<option value="0">...</option>
											<option value="1">Chưa xác nhận</option>
											<option value="2">Đã xác nhận</option>
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