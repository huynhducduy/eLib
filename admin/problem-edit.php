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
$title='Xem vấn đề';
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
					<h1>Xem vấn đề phát sinh<small> Xem và sửa vấn đề phát sinh</small></h1>
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
					<a href="#">Xem</a>
				</li>
			</ul>
			<?php
			$sql="SELECT * FROM `problem` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated" id='prodata' onsubmit='return editProblem();'>
					<input type='hidden' value='<?=$row['id']?>' id='proid'/>
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-wrench font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Vấn đề phát sinh</span>
									<span class="caption-helper"><?=$row['id']?></span>
								</div>
								<div class="actions btn-set">
									<button type='button' class="btn btn-default btn-circle"><a href='problem-list'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<button type='button' class="btn red btn-circle"><i class="fa fa-remove" onclick='delProblem()'></i> Xóa</button>
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
													<input type="text" class="form-control" id="book" value="<?=$row['bid']?>">
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
												<label class="col-md-2 control-label">Thời gian:</label>
												<div class="col-md-10">
													<input type="text" class="form-control" id="time" readonly value="<?=ti_me($row['time'])?>">
												</div>
											</div>
											<div class="form-group" id='typediv'>
												<label class="col-md-2 control-label">Vấn đề: <span class="required">*</span></label>
												<div class="col-md-10">
												<div class='input-icon'>
													<i class='fa fa-info-circle tooltips' data-original-title='Mục này là bắt buộc' data-container='body' id='errtype'></i>
													<select class="table-group-action-input form-control input-medium" id="type">
														<option value="1" <?php if ($row['type'] == 1) echo 'checked'; ?>>Hỏng sách</option>
														<option value="2" <?php if ($row['type'] == 2) echo 'checked'; ?>>Mất sách</option>
														<option value="3" <?php if ($row['type'] == 3) echo 'checked'; ?>>Vấn đề khác</option>
													</select>
												</div>
												</div>
											</div>
											<div class="form-group" id='notediv'>
												<label class="col-md-2 control-label">Ghi chú:</label>
													<div class="col-md-10">
													<div class='input-icon right'>
														<i class='fa fa-info-circle tooltips' data-original-title='Mục này không bắt buộc' data-container='body' id='errnote'></i>
														<textarea class="form-control" id="note"><?=$row['note']?></textarea>
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
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Vấn đề này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>