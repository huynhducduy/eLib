<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.min.css"/>
<link href="../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<style>
.radio {  min-height: 18px !important; padding-top: 0 !important; margin-bottom: 5px!important;   margin-right: 3px !important;}
</style>';
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js' type='text/javascript'></script>
<script type='text/javascript' src='../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.min.js'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		CreateCate.init();
	});
</script>";
$title='Chỉnh sửa danh mục';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Chỉnh sửa danh mục<small> Thiết lập danh mục sách của thư viện</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="cate-list.php">Danh mục sách</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Chỉnh sửa danh mục</a>
				</li>
			</ul>
			<?php
			if ($_GET['type'] == '2') { $string='2'; } else { $string='1'; }
			$sql="SELECT * FROM `cate".$string."` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" id='catedata' onsubmit='return editCate();'>
					<input type='hidden' id='cateid' name='cateid' value="<?=$row['id']?>"/>
					<input type='hidden' id='catetype' name='catetype' value="<?=$string?>"/>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Chỉnh sửa danh mục</span>
									<span class="caption-helper"><?=$row['title']?></span>
								</div>
								<div class="actions btn-set">
									<button type='button' class="btn btn-default btn-circle"><a href='cate-list.php'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<button type='button' onclick='delCate(<?=$row['id']?>,<?=$string?>)'class="btn red-haze btn-circle"><i class="fa fa-remove"></i> Xóa</button>
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Lưu</button>
								</div>
							</div>
							<div class="portlet-body">
								<div class="tabbable">
									<div class="tab-content no-space">
										<div class="form-body">
											<div class="form-group">
												<label class="col-md-2 control-label">ID: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" readonly value="<?=$row['id']?>">
												</div>
											</div>
											<div class="form-group" id='titlediv'>
												<label class="col-md-2 control-label">Tên danh mục: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errtitle'></i>
													<input type="text" class="form-control" name="catetitle" id="catetitle" value="<?=$row['title']?>">
												</div>
												</div>
											</div>
											<div class="form-group" id='descriptiondiv'>
												<label class="col-md-2 control-label">Mô tả: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errdescription'></i>
													<textarea class="form-control" name="catedescription" id="catedescription"><?=$row['description']?></textarea>
												</div>
												</div>
											</div>
											<div class="form-group" id='keyworddiv'>
												<label class="col-md-2 control-label">Từ khóa: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errkeyword'></i>
													<input class="form-control tags" name="catekeyword" id="catekeyword" value='<?=$row['keyword']?>'/>
													<span class="help-block">Hỗ trợ cho tìm kiếm, SEO,... </span>
												</div>
												</div>
											</div>
											<?php
											if ($string == '2')
											{
											$sql2="SELECT * FROM `cate1`";
											$query2=@mysql_query($sql2);
											?>
											<div class="form-group" id='catediv'>
												<label class="col-md-2 control-label">Danh mục: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errcate'></i>
													<div class="form-control height-auto" id="catecate">
														<div class="scroller" style="height:280px;" data-always-visible="1">
															<ul class="list-unstyled">
																<?php
																while ($row2=@mysql_fetch_assoc($query2))
																{
																	if ($row['id1'] == $row2['id'])
																	{
																		echo "<li>
																		<label style='margin-bottom: 0;'><input type='radio' name='catecate' value='".$row2['id']."' checked>".$row2['title']."</label>
																		</li>";
																	}
																	else
																	{
																		echo "<li>
																		<label style='margin-bottom: 0;'><input type='radio' name='catecate' value='".$row2['id']."'>".$row2['title']."</label>
																		</li>";
																	}
																}
																?>
															</ul>
														</div>
														</div>
												</div>
												</div>
											</div>
											<?php
											}
											?>
											<div class="form-group last" id='imagediv'>
												<label class="col-md-2 control-label">Ảnh </label>
												<div class="col-md-10">
												<div style='margin-top: 5px;margin-bottom: 4px;'><input onchange="handleCateImage()" value='1' type="checkbox" name='cateimagestatus' id='cateimagestatus' class="make-switch" data-on-text="BẬT" data-off-text="TĂT" data-size="small" <?php if ($row['title-wrapper'] != NULL) { echo 'checked'; };?>></div>
												<div class='input-icon left' id='hidecateimage'<?php if ($row['title-wrapper'] == NULL) { echo 'style="display: none;"'; } ?>>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errimage'></i>
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-new thumbnail">
														<?php
														if ($row['title-wrapper'] == NULL) { $string2='../../900x165/assets/global/img/no-image2.gif'; }
														else { $string2=$row['title-wrapper']; }
														?>
															<img src="../../900x165/<?=$string2?>" />
														</div>
														<div class="fileinput-preview fileinput-exists thumbnail"></div>
														<div>
															<span class="btn default btn-file">
																<span class="fileinput-new">Chọn ảnh</span>
																<span class="fileinput-exists">Thay đổi</span>
																<input type="file" name="cateimage" id='cateimage'>
															</span>
															<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">Xóa</a>
														</div>
													</div>
													<span class="help-block">Chỉ cho phép ảnh kích thước lớn hơn hoặc bằng 1500x280 và tỉ lệ với 1500x280</span>
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
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			}
			else {
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Danh mục này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>