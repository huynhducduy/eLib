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
		Book.init();
	});
</script>";
$title='Danh sách sách';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Danh sách sách <small>Liệt kê toàn bộ sách</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Sách</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="book-list.php">Danh sách sách</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa icon-list font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Danh sách sách</span>
								<span class="caption-helper">Quản lí sách</span>
							</div>
							<div class="actions">
								<a href="book-create.php" class="btn btn-circle green-haze">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">Thêm sách mới </span>
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
								<table class="table table-striped table-bordered table-hover" id="datatable_products">
								<thead>
								<tr role="row" class="heading">
									<th width='1%'>
										<input type="checkbox" class="group-checkable">
									</th>
									<th width='10%'>
										 ID
									</th>
									<th width='10%'>
										 Mã sách
									</th>
									<th>
										 Tên sách
									</th>
									<th>
										 Danh mục
									</th>
									<th width='1%'>
										 Tình trạng
									</th>
									<th width='1%'>
										 Đọc thử
									</th>
									<th width='1%'>
									</th>
								</tr>
								<tr role="row" class="filter">
									<td>
									</td>
									<td>
										<input type="number" class="form-control form-filter input-sm" name="book_id">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="book_code">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="book_title">
									</td>
									<td>
										<select name="book_cate" class="form-control form-filter input-sm">
											<option value="0">...</option>
									<?php
									$sql='SELECT * FROM `cate1`';
									$query=@mysql_query($sql);
									while ($row=@mysql_fetch_assoc($query))
									{
										echo "<option value='c1'>".$row['title']."</option>";
										$sql2="SELECT * FROM `cate2` WHERE `id1`='".$row['id']."'";
										$query2=mysql_query($sql2);
										while ($row2=@mysql_fetch_assoc($query2))
										{
											echo "<option value='".$row2['id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row2['title']."</option>";
										}
									}
									?>
										</select>
									</td>
									<td>
										<select name="book_remain" class="form-control form-filter input-sm">
											<option value="0">...</option>
											<option value="1">Còn sách</option>
											<option value="2">Hết sách</option>
										</select>
									</td>
									<td>
										<select name="book_proofread" class="form-control form-filter input-sm">
											<option value="0">...</option>
											<option value="1">Có</option>
											<option value="2">Không</option>
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