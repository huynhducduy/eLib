<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.css"/>';
$pagelv2="<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/bootstrap-summernote/summernote.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		Basic.init();
	});
</script>";
$title='Thiết lập cơ bản';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Thiết lập cơ bản <small>Thông tin cơ bản của thư viện</small></h1>
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
					<a href="basic.php">Cơ bản</a>
				</li>
			</ul>
			<?php
			$sql='SELECT * FROM `setting`';
			$query=@mysql_query($sql);
			$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" onsubmit='return basic();'>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-equalizer font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Cơ bản </span>
									<span class="caption-helper">Thông tin cơ bản của thư viện</span>
								</div>
								<div class="actions btn-set">
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Lưu</button>
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<div class="form-group" id='titlediv'>
										<label class="col-md-2 control-label">Tên thư viện: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errtitle'></i>
											<input type="text" class="form-control" id="title" value="<?=$row['title']?>">
										</div>
										</div>
									</div>
									<div class="form-group" id='descriptiondiv'>
										<label class="col-md-2 control-label">Mô tả: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' style='bottom: 8px'data-original-title='Mục này là bắt buộc' data-container='body' id='errdescription'></i>
											<textarea class="form-control" id="summernote"><?=$row['description']?></textarea>
										</div>
										</div>
									</div>
									<div class="form-group" id='introducediv'>
										<label class="col-md-2 control-label">Giới thiệu: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' style='bottom: 8px'data-original-title='Mục này là bắt buộc' data-container='body' id='errintroduce'></i>
											<textarea class="form-control" id="summernote2"><?=$row['introduce']?></textarea>
										</div>
										</div>
									</div>
									<div class="form-group" id='termdiv'>
										<label class="col-md-2 control-label">Quy định: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' style='bottom: 8px'data-original-title='Mục này là bắt buộc' data-container='body' id='errterm'></i>
											<textarea class="form-control" id="summernote3"><?=$row['term']?></textarea>
										</div>
										</div>
									</div>
									<div class="form-group" id='keyworddiv'>
										<label class="col-md-2 control-label">Từ khóa: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errkeyword'></i>
											<input class="form-control tags" id="keyword" value='<?=$row['keyword']?>'/>
											<span class="help-block">Hỗ trợ cho tìm kiếm, SEO,... </span>
										</div>
										</div>
									</div>
									<div class="form-group" id='domaindiv'>
										<label class="col-md-2 control-label">Tên miền: <span class="required">*</span></label>
										<div class="col-md-10">
										<div class='input-icon right'>
											<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errdomain'></i>
											<input type="text" class="form-control" id="domain" value="<?=$row['domain']?>">
											<span class="help-block">Ví dụ: yourdomain.com</span>
										</div>
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