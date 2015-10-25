<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.css"/>';
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/bootstrap-summernote/summernote.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
	});
</script>";
$title='Thiết lập chi tiết';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Thiết lập chi tiết <small>Thông tin chi tiết của thư viện</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Thiết lập</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="info.php">Chi tiết</a>
				</li>
			</ul>
			<?php
			$sql='SELECT * FROM `setting`';
			$query=@mysql_query($sql);
			$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" onsubmit='return info();'>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-wrench font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Chi tiết </span>
									<span class="caption-helper">Thông tin chi tiết của thư viện</span>
								</div>
								<div class="actions btn-set">
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Lưu</button>
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<div class="form-group" id='maildiv'>
										<label class="col-md-2 control-label">Email: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errmail'></i>
											<input type="text" class="form-control" id="mail" value="<?=$row['admin_mail']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='phonediv'>
										<label class="col-md-2 control-label">Điện thoại: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errphone'></i>
											<input type="text" class="form-control" id="phone" value="<?=$row['admin_phone']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='addrdiv'>
										<label class="col-md-2 control-label">Địa chỉ: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='erraddr'></i>
											<input type="text" class="form-control" id="addr" value="<?=$row['admin_address']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='skypediv'>
										<label class="col-md-2 control-label">Skype: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errskype'></i>
											<input type="text" class="form-control" id="skype" value="<?=$row['admin_skype']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='yhdiv'>
										<label class="col-md-2 control-label">Yahoo: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='erryh'></i>
											<input type="text" class="form-control" id="yh" value="<?=$row['admin_yahoo']?>">
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
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>