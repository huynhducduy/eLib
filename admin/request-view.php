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
	});
</script>";
$title='Yêu cầu';
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
					<h1>Yêu cầu<small> Xem yêu cầu</small></h1>
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
					<a href="#">Yêu cầu</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Xem</a>
				</li>
			</ul>
			<?php
			$sql="SELECT * FROM `request` WHERE `id`='".$_GET['id']."'";
			$query=@mysql_query($sql);
			if (@mysql_num_rows($query) > 0)
			{
				$row=@mysql_fetch_assoc($query);
				switch ($row['status']) {
					case '0': $status='warning">Chưa xác nhận'; break;
					case '1': $status='default">Chưa đáp ứng'; break;
					case '2': $status='success">Đã đáp ứng'; break;
					case '3': $status='danger">Không đáp ứng'; break;
				}
			?>
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal form-row-seperated">
 						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-settings font-green-sharp"></i>
									<span class="caption-subject font-green-sharp bold uppercase">
									Yêu cầu</span>
									<span class="caption-helper"><?=$row['id']?>&nbsp;</span><span class="label label-<?php echo $status; ?></span>
								</div>
								<div class="actions btn-set">
									<button type='button' class="btn btn-default btn-circle"><a href='request-list.php'><i class="fa fa-angle-left"></i> Quay lại</a></button>
									<?php
									if ($row['status'] == '0')
									{
									?>
									<button type="button" onclick="acceptRequest(<?=$row['id']?>)" class="btn green-haze btn-circle"><i class="fa fa-check"></i> Xác nhận</button>
									<button type="button" onclick="dismissRequest(<?=$row['id']?>)" class="btn red btn-circle"><i class="fa fa-remove"></i> Không đáp ứng</button>
									<?php
									}
									if ($row['status'] == '1')
									{
									?>
									<button type="button" onclick="requested(<?=$row['id']?>)" class="btn purple btn-circle"><i class="fa fa-check"></i> Đã đáp ứng</button>
									<?php
									}
									?>
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
											<div class="form-group">
												<label class="col-md-2 control-label">Tên sách: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" readonly value="<?=$row['title']?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Tác giả: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" readonly value="<?=$row['author']?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Người yêu cầu: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" readonly value="<?=$row['userid']?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Thời gian: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" readonly value="<?=ti_me($row['time'])?>">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Hình ảnh: </label>
												<div class="col-md-10">
													<div class="fileinput-new thumbnail">
														<img src="<?=$row['image']?>">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Tình trạng: </label>
												<div class="col-md-10">
													<div style="font-size: 15px; padding: 6px 6px;" class="label label-sm label-<?=$status?></div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">ID Sách: </label>
												<div class="col-md-10">
													<input type="text" class="form-control" readonly value="<?=$row['idb']?>">
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
				echo '<div class="alert alert-danger alert-dismissable"><span class="alert-content">Yêu cầu này không có thật</span></div>';
			}
			?>
		</div>
	</div>
<?php
require_once('./lib/footer.php');
?>