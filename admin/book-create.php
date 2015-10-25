<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.min.css"/>
<link href="../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.css"/>
<style>
.radio {  min-height: 18px !important; padding-top: 0 !important; margin-bottom: 5px!important;   margin-right: 3px !important;}
</style>';
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/bootstrap-summernote/summernote.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js' type='text/javascript'></script>
<script type='text/javascript' src='../../assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		$('#summernote').summernote();
		FormWizard.init();
	});
</script>";
$title='Thêm sách mới';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Thêm sách mới <small>Thêm sách mới cho thư viện</small></h1>
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
					<a href="book-create.php">Thêm sách mới</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa icon-note"></i> Thêm sách mới - <span class="step-title">
								Bước 1/4 </span>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form" method="POST">
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps" id='click'>
											<li>
												<a href="#tab1" data-toggle="tab" class="step">
												<span class="number">1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Thông tin </span>
												</a>
											</li>
											<li>
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Hình ảnh </span>
												</a>
											</li>
											<li>
												<a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Đọc thử </span>
												</a>
											</li>
											<li>
												<a href="#tab4" data-toggle="tab" class="step">
												<span class="number">4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Xác nhận </span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success"></div>
										</div>
										<div class="tab-content">
											<div class="tab-pane active" id="tab1">
												<div class="form-body">
												<div class="form-group" id='namediv'>
													<label class="col-md-2 control-label">Tên sách: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errname'></i>
														<input type="text" class="form-control" name="book[name]" id="bookname">
													</div>
													</div>
												</div>
												<div class="form-group" id='descriptiondiv'>
													<label class="col-md-2 control-label">Mô tả: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' style='bottom: 8px'data-original-title='Mục này là bắt buộc' data-container='body' id='errdescription'></i>
														<textarea class="form-control" name="book[description]" id="summernote"></textarea>
													</div>
													</div>
												</div>
												<div class="form-group" id='shortdescriptiondiv'>
													<label class="col-md-2 control-label">Mô tả ngắn: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errshortdescription'></i>
														<textarea class="form-control" name="book[short-description]" id="bookshortdescription"></textarea>
														<span class="help-block">
														Hiển thị trong "Xem nhanh" </span>
													</div>
													</div>
												</div>
												<div class="form-group" id='keyworddiv'>
													<label class="col-md-2 control-label">Từ khóa: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errkeyword'></i>
														<input class="form-control tags" name="book[keyword]" id="bookkeyword"/>
														<span class="help-block">Hỗ trợ cho tìm kiếm, SEO,... </span>
													</div>
													</div>
												</div>
												<?php
												$sql2="SELECT * FROM `cate1`";
												$query2=@mysql_query($sql2);
												?>
												<div class="form-group" id='catediv'>
													<label class="col-md-2 control-label">Danh mục: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errcate'></i>
														<div class="form-control height-auto" id="bookcate">
															<div class="scroller" style="height:275px;" data-always-visible="1">
																<ul class="list-unstyled">
																	<li>
																	<?php
																	while ($row2=@mysql_fetch_assoc($query2))
																	{
																		echo "<label>".$row2['title']."</label>
																		<ul class='list-unstyled'>";
																		$sql3="SELECT * FROM `cate2` WHERE `id1`='".$row2['id']."'";
																		$query3=@mysql_query($sql3);
																		while ($row3=@mysql_fetch_assoc($query3))
																		{
																			echo "<li>
																			<label style='margin-bottom: 0;'><input type='radio' name='book[cate]' value='".$row3['id']."' data-title='".$row2['title']." / ".$row3['title']."'>".$row3['title']."</label>
																			</li>";
																		}
																		echo "</ul>";
																	}
																	?>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													</div>
												</div>
												<div class="form-group" id='bcodediv'>
													<label class="col-md-2 control-label">Mã sách: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errbcode'></i>
														<input type="text" class="form-control" name="book[bcode]" id="bookbcode">
													</div>
													</div>
												</div>
												<div class="form-group" id='numberdiv'>
													<label class="col-md-2 control-label">Tổng số sách: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errnumber'></i>
														<input type="text" class="form-control" name="book[number]" id="booknumber">
													</div>
													</div>
												</div>
												<div class="form-group" id='authordiv'>
													<label class="col-md-2 control-label">Tác giả: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errauthor'></i>
														<input type="text" class="form-control" name="book[author]" id="bookauthor">
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Nhà xuất bản:</label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errpublisher'></i>
														<input type="text" class="form-control" name="book[publisher]">
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Ngày xuất bản:</label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errpublish-time'></i>
														<input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="book[publish-time]">
													<span class="help-block">
													Định dạng: YYYY-MM-DD </span>
													</div>
													</div>
												</div>
												<div class="form-group" id='pagendiv'>
													<label class="col-md-2 control-label">Số trang: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errpagen'></i>
														<input type="text" class="form-control" name="book[pagen]" id="bookpagen">
													</div>
													</div>
												</div>
												<div class="form-group" id='langdiv'>
													<label class="col-md-2 control-label">Ngôn ngữ: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errlang'></i>
														<select class="table-group-action-input form-control input-medium" name="book[lang]" id="booklang">
															<option value="1">Tiếng Việt</option>
															<option value="2">Tiếng Anh</option>
															<option value="3">Tiếng Pháp</option>
															<option value="4">Tiếng Đức</option>
															<option value="5">Tiếng Nhật</option>
															<option value="6">Tiếng Trung</option>
															<option value="7">Tiếng Hàn</option>
															<option value="0">Ngôn ngữ khác</option>
														</select>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Nhãn: </label>
													<div class="col-md-10">
														<label><input type="checkbox" name="book[label][hot]" value="1">Hot</label><Br/>
														<label><input type="checkbox" name="book[label][new]" value="1">New</label>
													</div>
												</div>
											</div>
											</div>
											<div class="tab-pane" id="tab2">
												<table class="table table-bordered table-hover">
											<thead>
											<tr role="row" class="heading">
												<th width="1%">
													 Id
												</th>
												<th width="15%">
													 Ảnh
												</th>
												<th>
													 Đường dẫn
												</th>
												<th width="1%">
													<a href='javascript:addbookimage();' class='btn green-haze btn-sm' id='buttonaddbookimage'>
													<i class='fa fa-plus'></i> Thêm </a>
												</th>
											</tr>
											</thead>
											<tbody id='countbookimage'>
											<tr id='bookimage1tr'>
												<td>1</td>
												<td>
													<a href='../../assets/global/img/no-image.gif' class='fancybox-button' id='bookimagebig1'>
													<img class='img-responsive' id='bookimagethumb1' src='../../135x180/assets/global/img/no-image.gif'>
													</a>
												</td>
												<td>
												<div id='bookimages1div' >
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errbookimages1'></i>
														<input type='text' name='book[images][1]' id='bookimagetext1' style='margin-bottom: 5px;' class='form-control' value='<?=$row['img1']?>'>
													</div>
												</div>
												<div id='bookimage1div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage1'></i>
														<input type='file' id='bookimage1' class='form-control' onchange='uploadbookimage(1)'/>
													</div>
												</div>
												</td>
												<td>
													<div id='bookimagebutton1' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage(1)'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage(1)'>
														<i class='fa fa-ban'></i> Hủy</a>
													</div>
												</td>
											</tr>
											</tbody>
											</table>
											</div>
											<div class="tab-pane" id="tab3">
												<table class="table table-bordered table-hover">
											<thead>
											<tr role="row" class="heading">
												<th width="1%">
													 Id
												</th>
												<th width="15%">
													 Ảnh
												</th>
												<th width="25%">
													 Mô tả
												</th>
												<th>
													 Đường dẫn
												</th>
												<th width="1%">
												<a href='javascript:addproofread();' class='btn green-haze btn-sm' id='buttonaddbookimage'>
													<i class='fa fa-plus'></i> Thêm </a>
												</th>
											</tr>
											</thead>
											<tbody id='countproofread'>
											</tbody>
											</table>
											<textarea class='display-none' name="book[proofread]" id='proofreadmaintext'></textarea>
											</div>
											<div class="tab-pane" id="tab4">
												<h4 class="form-section">Thông tin sách</h4>
												<div class="form-group">
													<label class="control-label col-md-3">Tên sách:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[name]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Mô tả:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[description]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Mô tả ngắn:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[short-description]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Từ khóa:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[keyword]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Danh mục:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[cate]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Mã sách:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[bcode]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Tổng số sách:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[number]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Tác giả:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[author]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Nhà xuất bản:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[publisher]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Ngày xuất bản:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[publish-time]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Số trang:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[pagen]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Ngôn ngữ:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[lang]">
														</p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Nhãn:</label>
													<div class="col-md-4">
														<p class="form-control-static" data-display="book[label]">
														</p>
													</div>
												</div>
												<h4 class="form-section">Hình ảnh</h4>
												<div class="form-group">
													<label class="col-md-1"></label>
													<div class="col-md-11" id='bookimageconfirm'>
													</div>
												</div>
												<h4 class="form-section">Đọc thử</h4>
												<div class="form-group">
													<label class="col-md-1"></label>
													<div class="col-md-11" id='bookproofreadconfirm'>
														<div class="thumbnail" style="display: inline-block; margin: 5px 2px;">
														<img src="../../135x180/upload/1244904baf3401327a043cc6d27f1ede1014b6db834422160142cc07030d9510.jpg" width="135px" height="180px"></img>
														<div class="caption" style="width: 135px;">Không có chú thích</div>
														</div>
														<div class="thumbnail" style="display: inline-block; margin: 5px 2px;">
														<img src="../../135x180/upload/15e0aa47923b78f8c48152097063f794654cbd3d28e3114cb9611a2be0a193cd.jpg" width="135px" height="180px"></img>
														<div class="caption" style="width: 135px;">Không có chú thích</div>
														</div></div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<a href="javascript:;" class="btn default button-previous" style='display: none;'><i class="m-icon-swapleft"></i> Quay lại </a>
												<a href="javascript:;" class="btn blue button-next"> Tiếp theo <i class="m-icon-swapright m-icon-white"></i></a>
												<a href="javascript:;" class="btn green button-submit" style='display: none;'> Xác nhận <i class="m-icon-swapright m-icon-white"></i></a>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>