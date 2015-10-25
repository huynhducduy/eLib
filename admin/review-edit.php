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
		CmtRvw.init();
	});
</script>";
$title='Xem nhận xét';
require_once('../assets/config.php');
require_once('./lib/header.php');
function ti_me($time_ago)
{
	if ($time_ago == '') return 'Không có';
	$cur_time=time();
	$time_elapsed = $cur_time - $time_ago;
	$seconds = $time_elapsed ;
	$minutes = round($time_elapsed / 60 );
	$hours = round($time_elapsed / 3600);
	$days = round($time_elapsed / 86400 );
	$weeks = round($time_elapsed / 604800);
	$months = round($time_elapsed / 2600640 );
	$years = round($time_elapsed / 31207680 );
	if ($seconds <= 60)
	{
		return $time_ago='Cách đây '.$seconds.' giây';
	}
	else if ($minutes <=60)
	{
		return $time_ago='Cách đây '.$minutes.' phút';
	}
	else if ($hours <=24)
	{
		return $time_ago="Cách đây $hours tiếng";
	}
	else if ($days <= 7)
	{
		return $time_ago='Cách đây '.$days.' ngày';
	}
	else if ($weeks <= 4.3)
	{
		return $time_ago='Cách đây '.$weeks.' tuần';
	}
	else if ($months <=12)
	{
		return $time_ago='Cách đây '.$months.' tháng';
	}
	else
	{
		return $time_ago='Cách đây '.$years.' năm';
	}
}
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Xem nhận xét<small> Xem và sửa nhận xét</small></h1>
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
					<a href="review-list.php">Nhận xét</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Xem/sửa</a>
				</li>
			</ul>
			<?php
			$sql="SELECT * FROM `review` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" id='prodata' onsubmit='return editReview();'>
					<input type='hidden' value='<?=$row['id']?>' id='proid'/>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Nhận xét</span>
									<span class="caption-helper"><?=$row['id']?></span>
								</div>
								<div class="actions btn-set">
									<button type='button' class="btn btn-default btn-circle"><a href='review-list.php'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<button type='button' class="btn red btn-circle"><i class="fa fa-remove" onclick='delReview()'></i> Xóa</button>
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
											<div class="form-group" id='bookdiv'>
												<label class="col-md-2 control-label">Sách: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errbook'></i>
													<input type="text" class="form-control" id="book" value="<?=$row['idb']?>">
												</div>
												</div>
											</div>
											<div class="form-group" id='userdiv'>
												<label class="col-md-2 control-label">Thành viên: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon right'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='erruser'></i>
													<input type="text" class="form-control" id="user" value="<?=$row['userid']?>">
												</div>
												</div>
											</div>
											<div class="form-group" id='timediv'>
												<label class="col-md-2 control-label">Thời gian: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="time" readonly value="<?=ti_me($row['time'])?>">
												</div>
											</div>
											<div class="form-group" id='ratingdiv'>
												<label class="col-md-2 control-label">Đánh giá: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errrating'></i>
														<input type="text" class="form-control" id="rating" value="<?=$row['rating']?>">
													</div>
												</div>
											</div>
											<div class="form-group" id='contentdiv'>
												<label class="col-md-2 control-label">Nội dung: <span class="required">*</span></label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errcontent'></i>
														<textarea class="form-control" id="content"><?=$row['content']?></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="form-actions form-actionlol">
											<div class="row">
												<div class="col-md-offset-2 col-md-10">
													<button type="submit" class="btn green"><i class="fa fa-check"></i> Sửa</button>
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
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Nhận xét này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>