<?php
$pagelv1='<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker.min.css"/>
<link href="../../assets/global/plugins/fancybox/source/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-summernote/summernote.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.css"/>
<style>
.radio {  min-height: 18px !important; padding-top: 0 !important; margin-bottom: 5px!important;   margin-right: 3px !important;}
</style>';
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'></script>
<script type='text/javascript' src='../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script src='../../assets/global/scripts/datatable.min.js'></script>
<script src='../../assets/global/plugins/bootstrap-summernote/summernote.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js' type='text/javascript'></script>
<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		$('#summernote').summernote();
		BookEdit.init();
	});
</script>";
$title='Chỉnh sửa sách';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Chỉnh sửa sách <small>Xem và chỉnh sửa thông tin sách</small></h1>
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
					<a href="#">Chỉnh sửa sách</a>
				</li>
			</ul>
			<?php
			$sql="SELECT * FROM `book` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" id='bookdata' onsubmit='return bookedit();'>
					<input type='hidden' id='bookid' name='book[id]' value="<?=$row['id']?>"/>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Chỉnh sửa sách </span>
									<span class="caption-helper"><?=$row['title']?></span>
								</div>
								<div class="actions btn-set">
									<button class="btn btn-default btn-circle"><a href='book-list.php'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<button type='button' onclick='delBook(<?=$row['id']?>)'class="btn red-haze btn-circle"><i class="fa fa-remove"></i> Xóa</button>
									<button type='submit' class="btn green-haze btn-circle"><i class="fa fa-check"></i> Lưu</button>
									<div class="btn-group">
									<a class="btn btn-default btn-circle" href="#" data-toggle="dropdown">
									<i class="fa fa-share"></i> Phát sinh <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										
											<li><a href="add-problem.php?book=<?=$row['id']?>&type=1">Hỏng sách</a></li>
											<li><a href="add-problem.php?book=<?=$row['id']?>&type=2">Mất sách</a></li>
											<li><a href="add-problem.php?book=<?=$row['id']?>&type=3">Vấn đề khác</a></li>
											<li class="divider"> </li>
											<li><a href="javascript:addMoreBook(<?=$row['id']?>)">Thêm sách</a></li>
									</ul>
								</div>
								</div>
							</div>
							<div class="portlet-body">
								<div class="tabbable">
									<ul class="nav nav-tabs" id='click'>
									<?php
									$sqlcount1="SELECT * FROM `review` WHERE `idb`=".$_GET['id']."";
									$querycount1=@mysql_query($sqlcount1);
									$count1=mysql_num_rows($querycount1);
									$sqlcount2="SELECT * FROM `comment` WHERE `idb`=".$_GET['id']."";
									$querycount2=@mysql_query($sqlcount2);
									$count2=mysql_num_rows($querycount2);
									$sqlcount3="SELECT * FROM `eachorder` WHERE `bid`=".$_GET['id']."";
									$querycount3=@mysql_query($sqlcount3);
									$count3=mysql_num_rows($querycount3);
									?>
										<li class="active" id='click_general'>
											<a href="#tab_general" data-toggle="tab">Thông tin chung </a>
										</li>
										<li>
											<a href="#tab_data" data-toggle="tab">Dữ liệu </a>
										</li>
										<li id='click_images'>
											<a href="#tab_images" data-toggle="tab">Hình ảnh </a>
										</li>
										<li>
											<a href="#tab_proofread" data-toggle="tab">Đọc thử </a>
										</li>
										<li>
											<a href="#tab_reviews" data-toggle="tab">Nhận xét <span class="badge badge-success"><?=$count1?></span></a>
										</li>
										<li>
											<a href="#tab_comments" data-toggle="tab">Bình luận <span class="badge badge-success"><?=$count2?></span></a>
										</li>
										<li>
											<a href="#tab_history" data-toggle="tab">Lịch sử <span class="badge badge-success"><?=$count3?></span></a>
										</li>
									</ul>
									<br/>
									<div class="tab-content no-space">
										<div class="tab-pane active" id="tab_general">
											<div class="form-body">
												<div class="form-group" id='namediv'>
													<label class="col-md-2 control-label">Tên sách: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errname'></i>
														<input type="text" class="form-control" name="book[name]" id="bookname" value="<?=$row['title']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='descriptiondiv'>
													<label class="col-md-2 control-label">Mô tả: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' style='bottom: 8px'data-original-title='Mục này là bắt buộc' data-container='body' id='errdescription'></i>
														<textarea class="form-control" name="book[description]" id="summernote"><?=$row['description']?></textarea>
													</div>
													</div>
												</div>
												<div class="form-group" id='shortdescriptiondiv'>
													<label class="col-md-2 control-label">Mô tả ngắn: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errshortdescription'></i>
														<textarea class="form-control" name="book[short-description]" id="bookshortdescription"><?=$row['des']?></textarea>
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
														<input class="form-control tags" name="book[keyword]" id="bookkeyword" value='<?=$row['keyword']?>'/>
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
																			if ($row3['id'] == $row['cid'])
																			{
																				echo "<li>
																				<label style='margin-bottom: 0;'><input type='radio' name='book[cate]' value='".$row3['id']."' checked>".$row3['title']."</label>
																				</li>";
																			}
																			else
																			{
																			echo "<li>
																				<label style='margin-bottom: 0;'><input type='radio' name='book[cate]' value='".$row3['id']."'>".$row3['title']."</label>
																				</li>";
																			}
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
														<input type="text" class="form-control" name="book[bcode]" id="bookbcode" value="<?=$row['bcode']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='numberdiv'>
													<label class="col-md-2 control-label">Tổng số sách: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errnumber'></i>
														<input type="text" class="form-control" name="book[number]" id="booknumber" value="<?=$row['number']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='authordiv'>
													<label class="col-md-2 control-label">Tác giả: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errauthor'></i>
														<input type="text" class="form-control" name="book[author]" id="bookauthor" value="<?=$row['author']?>">
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Nhà xuất bản:</label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errpublisher'></i>
														<input type="text" class="form-control" name="book[publisher]" value="<?=$row['publisher']?>">
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Ngày xuất bản:</label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errpublish-time'></i>
														<input type="text" class="form-control date-picker" data-date="<?=$row['publish-time']?>" data-date-format="yyyy-mm-dd" name="book[publish-time]" value="<?=$row['publish-time']?>">
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
														<input type="text" class="form-control" name="book[pagen]" id="bookpagen" value="<?=$row['pagen']?>">
													</div>
													</div>
												</div>
												<div class="form-group" id='langdiv'>
													<label class="col-md-2 control-label">Ngôn ngữ: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errlang'></i>
														<select class="table-group-action-input form-control input-medium" name="book[lang]" id="booklang">
															<option value="1" <?php if ($row['lang'] == 1) echo "checked";?>>Tiếng Việt</option>
															<option value="2" <?php if ($row['lang'] == 2) echo "checked";?>>Tiếng Anh</option>
															<option value="3" <?php if ($row['lang'] == 3) echo "checked";?>>Tiếng Pháp</option>
															<option value="4" <?php if ($row['lang'] == 4) echo "checked";?>>Tiếng Đức</option>
															<option value="5" <?php if ($row['lang'] == 5) echo "checked";?>>Tiếng Nhật</option>
															<option value="6" <?php if ($row['lang'] == 6) echo "checked";?>>Tiếng Trung</option>
															<option value="7" <?php if ($row['lang'] == 7) echo "checked";?>>Tiếng Hàn</option>
															<option value="0" <?php if ($row['lang'] == 0) echo "checked";?>>Ngôn ngữ khác</option>
														</select>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Nhãn: </label>
													<div class="col-md-10">
														<label><input type="checkbox" name="book[label][hot]" value="1" <?php if ($row['hot'] == 1) echo "checked";?>>Hot</label><Br/>
														<label><input type="checkbox" name="book[label][new]" value="1" <?php if ($row['new'] == 1) echo "checked";?>>New</label><br/>
														<label><input type="checkbox" name="book[label][rec]" value="1" <?php if ($row['recommended'] == 1) echo "checked";?>>Recommended</label>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_images">
										<?php
											$cbook='1';
											if ($row['img2'] != NULL) $cbook++;
											if ($row['img3'] != NULL) $cbook++;
											if ($row['img4'] != NULL) $cbook++;
											if ($row['img5'] != NULL) $cbook++;
											if ($row['img6'] != NULL) $cbook++;
										?>
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
												<?php
												if ($cbook <6) { 
													echo "<a href='javascript:addbookimage();' class='btn green-haze btn-sm' id='buttonaddbookimage'>
													<i class='fa fa-plus'></i> Thêm </a>"; 
												} else 
												{ 
													echo "<a style='display: none;' href='javascript:addbookimage();' class='btn green-haze btn-sm' id='buttonaddbookimage'>
													<i class='fa fa-plus'></i> Thêm </a>"; 
												}				
												?>
												</th>
											</tr>
											</thead>
											<tbody id='countbookimage'>
											<tr id='bookimage1tr'>
												<td>1</td>
												<td>
													<a href='../../<?=$row['img1']?>' class='fancybox-button' id='bookimagebig1'>
													<img class='img-responsive' id='bookimagethumb1' src='../../135x180/<?=$row['img1']?>'>
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
											<?php
											if ($row['img2'] != NULL) {
											?>
											<tr id='bookimage2tr'>
												<td>2</td>
												<td>
													<a href='../../<?=$row['img2']?>' class='fancybox-button' id='bookimagebig2'>
													<img class='img-responsive' id='bookimagethumb2' src='../../135x180/<?=$row['img2']?>'>
													</a>
												</td>
												<td>
													<input type='text' name='book[images][2]' id='bookimagetext2' style='margin-bottom: 5px;' class='form-control' value='<?=$row['img2']?>'>
													<div id='bookimage1div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage2'></i>
														<input type='file' id='bookimage2' class='form-control' onchange='uploadbookimage(2)'/>
													</div>
													</div>
												</td>
												<td>
													<div id='bookimagebutton2' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage(2)'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage(2)'>
															<i class='fa fa-ban'></i> Hủy</a>
														</div>
													</div>
													<a href='javascript:delbookimage(2);' class='btn default btn-sm'>
													<i class='fa fa-times'></i> Xóa </a>
												</td>
											</tr>
											<?php
											}
											if ($row['img3'] != NULL) {
											?>
											<tr id='bookimage3tr'>
												<td>3</td>
												<td>
													<a href='../../<?=$row['img3']?>' class='fancybox-button' id='bookimagebig3'>
													<img class='img-responsive' id='bookimagethumb3' src='../../135x180/<?=$row['img3']?>'>
													</a>
												</td>
												<td>
													<input type='text' name='book[images][3]' id='bookimagetext3' style='margin-bottom: 5px;' class='form-control' value='<?=$row['img3']?>'>
													<div id='bookimage1div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage3'></i>
														<input type='file' id='bookimage3' class='form-control' onchange='uploadbookimage(3)'/>
													</div>
													</div>
												</td>
												<td>
													<div id='bookimagebutton3' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage(3)'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage(3)'>
															<i class='fa fa-ban'></i> Hủy</a>
														</div>
													</div>
													<a href='javascript:delbookimage(3);' class='btn default btn-sm'>
													<i class='fa fa-times'></i> Xóa </a>
												</td>
											</tr>
											<?php
											}
											if ($row['img4'] != NULL) {
											?>
											<tr id='bookimage4tr'>
												<td>4</td>
												<td>
													<a href='../../<?=$row['img4']?>' class='fancybox-button' id='bookimagebig4'>
													<img class='img-responsive' id='bookimagethumb4' src='../../135x180/<?=$row['img4']?>'>
													</a>
												</td>
												<td>
													<input type='text' name='book[images][4]' id='bookimagetext4' style='margin-bottom: 5px;' class='form-control' value='<?=$row['img4']?>'>
													<div id='bookimage1div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage4'></i>
														<input type='file' id='bookimage4' class='form-control' onchange='uploadbookimage(4)'/>
													</div>
													</div>
												</td>
												<td>
													<div id='bookimagebutton4' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage(4)'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage(4)'>
															<i class='fa fa-ban'></i> Hủy</a>
														</div>
													</div>
													<a href='javascript:delbookimage(4);' class='btn default btn-sm'>
													<i class='fa fa-times'></i> Xóa </a>
												</td>
											</tr>
											<?php
											}
											if ($row['img5'] != NULL) {
											?>
											<tr id='bookimage5tr'>
												<td>5</td>
												<td>
													<a href='../../<?=$row['img5']?>' class='fancybox-button' id='bookimagebig5'>
													<img class='img-responsive' id='bookimagethumb5' src='../../135x180/<?=$row['img5']?>'>
													</a>
												</td>
												<td>
													<input type='text' name='book[images][5]' id='bookimagetext5' style='margin-bottom: 5px;' class='form-control' value='<?=$row['img5']?>'>
													<div id='bookimage1div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage5'></i>
														<input type='file' id='bookimage5' class='form-control' onchange='uploadbookimage(5)'/>
													</div>
													</div>
												</td>
												<td>
													<div id='bookimagebutton5' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage(5)'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage(5)'>
															<i class='fa fa-ban'></i> Hủy</a>
														</div>
													</div>
													<a href='javascript:delbookimage(5);' class='btn default btn-sm'>
													<i class='fa fa-times'></i> Xóa </a>
												</td>
											</tr>
											<?php
											}
											if ($row['img6'] != NULL) {
											?>
											<tr id='bookimage6tr'>
												<td>6</td>
												<td>
													<a href='../../<?=$row['img6']?>' class='fancybox-button' id='bookimagebig6'>
													<img class='img-responsive' id='bookimagethumb6' src='../../135x180/<?=$row['img6']?>'>
													</a>
												</td>
												<td>
													<input type='text' name='book[images][6]' id='bookimagetext6' style='margin-bottom: 5px;' class='form-control' value='<?=$row['img6']?>'>
													<div id='bookimage1div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errbookimage6'></i>
														<input type='file' id='bookimage6' class='form-control' onchange='uploadbookimage(6)'/>
													</div>
													</div>
												</td>
												<td>
													<div id='bookimagebutton6' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitbookimage(6)'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelbookimage(6)'>
															<i class='fa fa-ban'></i> Hủy</a>
														</div>
													</div>
													<a href='javascript:delbookimage(6);' class='btn default btn-sm'>
													<i class='fa fa-times'></i> Xóa </a>
												</td>
											</tr>
											<?php
											}
											?>
											<div id='lastbookimage'></div>
											</tbody>
											</table>
										</div>
										<div class="tab-pane" id="tab_proofread">
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
											<?php
											$x=explode('|',$row['proofread']);
											$i=0;
											foreach ($x as $data)
											{
												if ($data != '')
												{
												$i++;
												$y=explode(',', $data);
												echo "
												<tr id='proofread".$i."tr'>
												<td>".$i."</td>
												<td>
													<a href='../../".$y[0]."' class='fancybox-button' id='proofreadbig".$i."'>
													<img class='img-responsive' src='../../135x180/".$y[0]."' id='proofreadthumb".$i."'>
													</a>
												</td>
												<td>
													<input type='text' class='form-control' value='".$y[1]."' id='proofreaddes".$i."'>
												</td>
												<td>
													<input type='text' style='margin-bottom: 5px;' id='proofreadtext".$i."' class='form-control' value='".$y[0]."'>
													<div id='proofread".$i."div'>
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Chỉ cho phép các tệp dưới 3mb, định dạng jpg, jpeg ,png ,gif ,tiff ,bmp' data-container='body' id='errproofread".$i."'></i>
														<input type='file' id='proofread".$i."' class='form-control' onchange='uploadproofread(".$i.")'/>
													</div>
													</div>
												</td>
												<td>
													<div id='proofreadbutton".$i."' style='display: none;'>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm yellow filter-submit margin-bottom' href='javascript:submitproofread(".$i.")'>
															<i class='fa fa-check'></i> Chấp nhận</a>
														</div>
														<div class='margin-bottom-5'>
															<a class='btn btn-sm red filter-submit margin-bottom' href='javascript:cancelproofread(".$i.")'>
															<i class='fa fa-ban'></i> Hủy</a>
														</div>
													</div>
													<a href='javascript:delproofread(".$i.");' class='btn default btn-sm'>
													<i class='fa fa-times'></i> Xóa </a>
												</td>
											</tr>
												";
												}
											}
											?>
											<div id='lastproofread'></div>
											</tbody>
											</table>
											<textarea class="display-none" name="book[proofread]" id='proofreadmaintext'><?=$row['proofread']?></textarea>
										</div>
										<div class="tab-pane" id="tab_data">
										<div class="form-group">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-2 control-label">ID: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" readonly value="<?=$row['id']?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Số sách còn lại: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?=$row['remain']?>" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Đánh giá: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?=$row['rating']?>" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Lượt đánh giá: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?=$row['nrating']?>" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Dữ liệu đánh giá: </label>
													<div class="col-md-10">
														<textarea class="form-control" readonly=""><?=$row['drating']?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Lượt xem: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?=$row['view']?>" readonly="">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">Lượt mượn: </label>
													<div class="col-md-10">
														<input type="text" class="form-control" value="<?=$row['borrow']?>" readonly="">
													</div>
												</div>
											</div>
										</div>
										</div>
										<div class="tab-pane" id="tab_reviews">
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
												<table class="table table-striped table-bordered table-hover" id="datatable_reviews">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
														ID
													</th>
													<th width='20%'>
														Người gửi
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th width='1%'>
														Đánh giá
													</th>
													<th>
														Nội dung
													</th>
													<th width='1%'>
														Cảm ơn
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="review_id">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_user">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="review_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="review_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_rating">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_content">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="review_thanks">
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
										<div class="tab-pane" id="tab_comments">
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
												<table class="table table-striped table-bordered table-hover" id="datatable_comments">
												<thead>
												<tr role="row" class="heading">
													<th width='1%'>
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
														ID
													</th>
													<th width='20%'>
														Người gửi
													</th>
													<th width='15%'>
														Thời gian
													</th>
													<th>
														Nội dung
													</th>
													<th width='1%'>
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
													</td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="comment_id">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="comment_user">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="review_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="review_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="comment_content">
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
										<div class="tab-pane" id="tab_history">
											<div class="table-container">
												<table class="table table-striped table-bordered table-hover" id="datatable_history">
												<thead>
												<tr role="row" class="heading">
													<th width='1%' class="sorting_disabled">
														<input type="checkbox" class="group-checkable">
													</th>
													<th width='10%'>
													ID
													</th>
													<th width="25%">
														 Thời gian mượn
													</th>
													<th width="25%">
														 Thời gian trả
													</th>
													<th width="55%">
														 Người mượn
													</th>
													<th width="55%">
														 Đơn hàng
													</th>
													<th width="10%">
														 Trạng thái
													</th>
													<th width="10%">
													</th>
												</tr>
												<tr role="row" class="filter">
													<td></td>
													<td>
														<input type="number" class="form-control form-filter input-sm" name="history_id">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time1" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time2" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time11" placeholder="Từ">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="history_time22" placeholder="Đến">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="history_user"/>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="history_order"/>
													</td>
													<td>
														<select name="history_status" class="form-control form-filter input-sm">
															<option value="-1">...</option>
															<option value="0">Chưa xác nhận</option>
															<option value="1">Chưa mượn</option>
															<option value="2">Đang mượn</option>
															<option value="3">Đã trả</option>
															<option value="4">Đã bị hủy</option>
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
					</form>
				</div>
			</div>
			<?php
			}
			else {
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Sách này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>