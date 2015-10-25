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
		ProblemList.init();
	});
</script>";
$title='Danh sách vấn đề';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Danh sách vấn đề <small>Liệt kê toàn bộ vấn đề</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Vấn đề</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Danh sách vấn đề</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa icon-wrench font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Danh sách vấn đề</span>
								<span class="caption-helper">Quản lý vấn đề</span>
							</div>
							<div class="actions">
								<a href="add-problem.php" class="btn btn-circle green-haze">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">Thêm vấn đề mới </span>
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
								<table class="table table-striped table-bordered table-hover" id="datatable_problems">
								<thead>
								<tr role="row" class="heading">
									<th width='1%'>
										<input type="checkbox" class="group-checkable">
									</th>
									<th width='10%'>
										 ID
									</th>
									<th>
										 Sách
									</th>
									<th width='10%'>
										 Thành viên
									</th>
									<th width='10%'>
										 Vấn đề
									</th>
									<th width='25%'>
										 Thời gian
									</th>
									<th width='1%'>
									</th>
								</tr>
								<tr role="row" class="filter">
									<td>
									</td>
									<td>
										<input type="number" class="form-control form-filter input-sm" name="problem_id">
									</td>
									<td>
										<input type="number" class="form-control form-filter input-sm" name="problem_book">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="problem_user">
									</td>
									<td>
										<select name="problem_type" class="form-control form-filter input-sm">
											<option value="0">...</option>
											<option value="1">Hỏng sách</option>
											<option value="2">Mất sách</option>
											<option value="3">Khác</option>
										</select>
									</td>
									<td>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="problem_time1" placeholder="Từ">
											<span class="input-group-btn">
											<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
										<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="problem_time2" placeholder="Đến">
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
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once('./lib/footer.php'); ?>