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
$title='Thiết lập xã hội';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Thiết lập xã hội <small>Thông tin xã hội của thư viện</small></h1>
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
					<a href="social.php">Xã hội</a>
				</li>
			</ul>
			<?php
			$sql='SELECT * FROM `setting`';
			$query=@mysql_query($sql);
			$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" onsubmit='return social();'>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-social-facebook font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Xã hội </span>
									<span class="caption-helper">Thông tin xã hội của thư viện</span>
								</div>
								<div class="actions btn-set">
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Lưu</button>
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<div class="form-group" id='admindiv'>
										<label class="col-md-2 control-label">FB Admin ID: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='erradmin'></i>
											<input type="text" class="form-control" id="admin" value="<?=$row['fb_id_admin']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='pagediv'>
										<label class="col-md-2 control-label">FB Page ID: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errpage'></i>
											<input type="text" class="form-control" id="page" value="<?=$row['fb_id_page']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='appdiv'>
										<label class="col-md-2 control-label">FB App ID: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errapp'></i>
											<input type="text" class="form-control" id="app" value="<?=$row['fb_id_app']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='gcseiddiv'>
										<label class="col-md-2 control-label">Google Custom Search ID: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errgcseid'></i>
											<input type="text" class="form-control" id="gcseid" value="<?=$row['gcseid']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='gkeydiv'>
										<label class="col-md-2 control-label">Google API Key: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errgkey'></i>
											<input type="text" class="form-control" id="gkey" value="<?=$row['gkey']?>">
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