<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/typeahead/typeahead.min.css">';
$pagelv2="<script src='../../assets/global/plugins/typeahead/handlebars.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/typeahead/typeahead.bundle.min.js' type='text/javascript'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		Problem.init();
	});
</script>";
$title='Thêm vấn đề phát sinh';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Vấn đề phát sinh<small> Thêm vấn đề phát sinh</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="problem-list.php">Vấn đề phát sinh</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Thêm</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" id='prodata' onsubmit='return addProblem();'>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-note font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Thêm vấn đề phát sinh</span>
									<span class="caption-helper"><?=$row['title']?></span>
								</div>
								<div class="actions btn-set">
									<button type='button' class="btn btn-default btn-circle"><a href='problem-list.php'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Thêm</button>
								</div>
							</div>
							<div class="portlet-body">
								<div class="tabbable">
									<div class="tab-content no-space">
										<div class="form-body">
											<div class="form-group" id='bookdiv'>
												<label class="col-md-2 control-label">Sách: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errbook'></i>
													<input type="text" class="form-control" id="book" value="<?=$_GET['book']?>">
												</div>
												</div>
											</div>
											<div class="form-group" id='userdiv'>
												<label class="col-md-2 control-label">Thành viên: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='erruser'></i>
													<input type="text" class="form-control" id="user" value="<?=$_GET['user']?>">
												</div>
												</div>
											</div>
											<div class="form-group" id='typediv'>
												<label class="col-md-2 control-label">Vấn đề: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errtype'></i>
													<select class="table-group-action-input form-control input-medium" id="type">
														<option value="1" <?php if ($_GET['type'] == 1) echo 'checked'; ?>>Hỏng sách</option>
														<option value="2" <?php if ($_GET['type'] == 2) echo 'checked'; ?>>Mất sách</option>
														<option value="3" <?php if ($_GET['type'] == 3) echo 'checked'; ?>>Vấn đề khác</option>
													</select>
												</div>
												</div>
											</div>
											<div class="form-group" id='notediv'>
												<label class="col-md-2 control-label">Ghi chú:</label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errnote'></i>
														<textarea class="form-control" id="note"><?=$_GET['note']?></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions form-actionlol">
											<div class="row">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Thêm</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>