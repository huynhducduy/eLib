<?php
$pagelv1="<link rel='stylesheet' type='text/css' href='../../assets/global/plugins/select2/select2.min.css'/>";
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
	});
</script>";
$title='Dashboard';
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
					<h1>Dashboard <small>Thống kê và báo cáo</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Dashboard</a>
				</li>
			</ul>
			<?php
			$sql='SELECT `id` FROM `order`';
			$order_count=@mysql_num_rows(@mysql_query($sql));
			$sql='SELECT `id` FROM `user`';
			$user_count=@mysql_num_rows(@mysql_query($sql));
			$sql='SELECT `id` FROM `book`';
			$book_count=@mysql_num_rows(@mysql_query($sql));
			$sql='SELECT `id` FROM `cate2`';
			$cate_count=@mysql_num_rows(@mysql_query($sql));
			$sql='SELECT `view` FROM `setting`';
			$view=@mysql_fetch_assoc(@mysql_query($sql));
			$view=$view['view'];
			$sql='SELECT `count` FROM `order` WHERE `status`=2 OR `status`=3';
			$query=@mysql_query($sql);
			$borrow_count=0;
			while ($row=@mysql_fetch_assoc($query))
			{
				$borrow_count+=$row['count'];
			}
			$sql='SELECT `id` FROM `comment`';
			$comment_count=@mysql_num_rows(@mysql_query($sql));
			$sql='SELECT `id` FROM `review`';
			$review_count=@mysql_num_rows(@mysql_query($sql));
			?>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-green-sharp"><?php echo $order_count; ?></h3>
								<small>Đơn sách</small>
							</div>
							<div class="icon">
								<i class="icon-basket"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-red-haze"><?php echo $user_count; ?></h3>
								<small>Thành viên</small>
							</div>
							<div class="icon">
								<i class="icon-users"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-blue-sharp"><?php echo $book_count; ?></h3>
								<small>Đầu sách</small>
							</div>
							<div class="icon">
								<i class="icon-book-open"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-purple-soft"><?php echo $cate_count; ?></h3>
								<small>Danh mục</small>
							</div>
							<div class="icon">
								<i class="icon-list"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-purple-soft"><?php echo $view; ?></h3>
								<small>Lượt xem</small>
							</div>
							<div class="icon">
								<i class="icon-bar-chart"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-blue-sharp"><?php echo $borrow_count; ?></h3>
								<small>Lượt mượn</small>
							</div>
							<div class="icon">
								<i class="icon-pie-chart"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-green-sharp"><?php echo $comment_count; ?></h3>
								<small>Bình luận</small>
							</div>
							<div class="icon">
								<i class="icon-bubble"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat2" style='height:88px;'>
						<div class="display">
							<div class="number">
								<h3 class="font-red-haze"><?php echo $review_count; ?></h3>
								<small>Nhận xét</small>
							</div>
							<div class="icon">
								<i class="icon-like"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<?php
					$sql="SELECT DISTINCT `ip`,`userid` FROM `online`";
					$query=@mysql_query($sql);
					$online_count=@mysql_num_rows($query);
					?>
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Đang online</span>
								<span class="badge badge-success"><?php echo $online_count; ?></span>
							</div>
						</div>
						<div class="portlet-body" style="margin-top:-20px;padding-top:1px;">
							<div class="table-scrollable table-scrollable-borderless">
							<div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<table class="table table-hover table-light">
								<thead>
								<tr class="uppercase">
									<th>
										 Thành viên
									</th>
									<th>
										 IP
									</th>
									<th>
										Nơi truy cập
									</th>
								</tr>
								</thead>
								<?php
								while ($online=@mysql_fetch_assoc($query))
								{
									$sql="SELECT `local` FROM `online` WHERE `ip`='".$online['ip']."' AND `userid`='".$online['userid']."'";
									$data=@mysql_fetch_assoc(@mysql_query($sql));
									echo "<tr>
										<td><a href='user-edit.php?id=".$online['userid']."'>".$online['userid']."</a></td>
										<td>".$online['ip']."</td>
										<td><a href='".$data['local']."'><span class='bold theme-font-color'>".$data['local']."</span></a></td>
									</tr>";
								}
								?>
								</table>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<?php
					$sql='SELECT `id`,`time` FROM `order` WHERE `status`=0';
					$query=mysql_query($sql);
					$neworder_count=mysql_num_rows($query);
					?>
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Đơn sách mới</span>
								<span class="badge badge-success"><?php echo $neworder_count; ?></span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
									<ul class="feeds">
										<?php
										if ($neworder_count >0)
										{
											while ($neworder=mysql_fetch_assoc($query))
											{
												echo '<li>
													<a href="order-view.php?id='.$neworder['id'].'">
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-success">
																	<i class="fa fa-shopping-cart"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	#'.$neworder['id'].'
																</div>
															</div>
														</div>
													</div>
													<div class="col2">
														<div class="date">
															'.ti_me($neworder['time']).'
														</div>
													</div>
												</a>
												</li>';
											}
										}
										else echo "<center>Không có</center>";
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<?php
					$sql='SELECT `id` FROM `user` WHERE `verify`=0';
					$query=mysql_query($sql);
					$newuser_count=mysql_num_rows($query);
					?>
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Tài khoản mới</span>
								<span class="badge badge-success"><?php echo $newuser_count; ?></span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
									<ul class="feeds">
										<?php
										if ($newuser_count >0)
										{
											while ($newuser=mysql_fetch_assoc($query))
											{
												echo '<li>
													<a href="user-edit.php?id='.$newuser['id'].'">
													<div class="col1">
														<div class="cont">
															<div class="cont-col1">
																<div class="label label-sm label-default">
																	<i class="fa fa-users"></i>
																</div>
															</div>
															<div class="cont-col2">
																<div class="desc">
																	'.$newuser['id'].'
																</div>
															</div>
														</div>
													</div>
												</a>
												</li>';
											}
										}
										else echo "<center>Không có</center>";
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<?php
				$sql='SELECT `limitdayorder` FROM `setting`';
				$limitdayorder=@mysql_fetch_assoc(@mysql_query($sql));
				$limitdayorder=$limitdayorder['limitdayorder'];
				$timelimit=time()-60*60*24*$limitdayorder;
				$sql='SELECT `id`,`count`,`timestart`,`userid` FROM `order` WHERE `status` =2 AND `timestart`<'.$timelimit.'';
				$query=@mysql_query($sql);
				$expedorder_count=@mysql_num_rows($query);
				?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-bar-chart font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Đơn sách quá hạn trả</span>
								<span class="badge badge-success"><?php echo $expedorder_count; ?></span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="tabbable-line">
									<?php if ($expedorder_count > 0)
									{
									?>
									<div class="table-responsive">
										<table class="table table-striped table-hover table-bordered">
										<thead>				
										<tr>
											<th>
												#
											</th>
											<th>
												Số sách
											</th>
											<th>
												Thời gian mượn
											</th>
											<th>
												Người mượn
											</th>
											<th width='1%'>
											</th>
										</tr>
										</thead>
										<tbody>
										<?php
										while ($expedorder=@mysql_fetch_assoc($query))
										{
											echo '<tr>
												<td><a href="order-view.php?id='.$expedorder['id'].'">#'.$expedorder['id'].'</a></td>
												<td>'.$expedorder['count'].'</td>
												<td>'.ti_me($expedorder['timestart']).'</td>
												<td>'.$expedorder['userid'].'</td>
												<td><a href="order-view.php?id='.$expedorder['id'].'"><button type="button" class="btn btn-xs btn-primary">Xem</button></a></td>
											</tr>';
										}
										?>
										</tbody>
										</table>
									</div>
									<?php
									}
									else
									{
										?>
										<center>Không có</center>
										<?php
									}
									?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<?php
					$sql='SELECT `id`,`time` FROM `contribute` WHERE `status`=0';
					$query=@mysql_query($sql);
					$newcontribute_count=@mysql_num_rows($query);
					?>
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Đóng góp mới</span>
								<span class="badge badge-success"><?php echo $newcontribute_count; ?></span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
									<ul class="feeds">
									<?php
									if ($newcontribute_count>0)
									{
										while ($newcontribute=@mysql_fetch_assoc($query))
										{
											echo '<li>
											<a href="contribute-view.php?id='.$newcontribute['id'].'">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-primary">
																<i class="fa fa-suitcase"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																#'.$newcontribute['id'].'
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														'.ti_me($newcontribute['time']).'
													</div>
												</div>
											</a>
											</li>';
										}
									}
									else
									{
										echo '<center>Không có</center>';
									}
									?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<?php
					$sql='SELECT `id`,`time` FROM `request` WHERE `status`=0';
					$query=@mysql_query($sql);
					$newrequest_count=@mysql_num_rows($query);
					?>
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Yêu cầu mới</span>
								<span class="badge badge-success"><?php echo $newrequest_count; ?></span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
									<ul class="feeds">
										<?php
									if ($newrequest_count>0)
									{
										while ($newrequest=@mysql_fetch_assoc($query))
										{
											echo '<li>
											<a href="request-view.php?id='.$newrequest['id'].'">
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-warning">
																<i class="fa fa-flag"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																#'.$newrequest['id'].'
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														'.ti_me($newrequest['time']).'
													</div>
												</div>
											</a>
											</li>';
										}
									}
									else
									{
										echo '<center>Không có</center>';
									}
									?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<?php
					$sql='SELECT `id`,`userid`,`time`,`content` FROM `comment` ORDER BY `id` DESC LIMIT 0,10';
					$query=@mysql_query($sql);
					?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Bình luận mới</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<div class="general-item-list">
								<?php
								while ($newcomment=@mysql_fetch_assoc($query))
								{
									echo '<div class="item">
										<div class="item-head">
											<div class="item-details">
												<a href="user-edit.php?id='.$newcomment['userid'].'" class="item-name primary-link">'.$newcomment['userid'].'</a>
												<span class="item-label">'.ti_me($newcomment['time']).'</span>
											</div>
											<span class="item-status"><a href="comment-edit.php?id='.$newcomment['id'].'"><span class="badge badge-success">Xem</span></a></span>
										</div>
										<div class="item-body">'.$newcomment['content'].'</div>
									</div>';
								}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<?php
					$sql='SELECT `id`,`userid`,`time`,`content`,`rating` FROM `review` ORDER BY `id` DESC LIMIT 0,10';
					$query=@mysql_query($sql);
					?>
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font-color hide"></i>
								<span class="caption-subject theme-font-color bold uppercase">Nhận xét mới</span>
								<span class="badge badge-success">0</span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
								<div class="general-item-list">
								<?php
								while ($newreview=@mysql_fetch_assoc($query))
								{
									echo '<div class="item">
										<div class="item-head">
											<div class="item-details">
												<a href="user-edit.php?id='.$newreview['userid'].'" class="item-name primary-link">'.$newreview['userid'].'</a>
												<span class="item-label">'.ti_me($newreview['time']).'</span>&nbsp;
												<span class="item-label"><b>'.$newreview['rating'].'</b></span>
											</div>
											<span class="item-status"><a href="review-edit.php?id='.$newreview['id'].'"><span class="badge badge-success">Xem</span></a></span>
										</div>
										<div class="item-body">
											 '.$newreview['content'].'</div>
									</div>';
								}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once('./lib/footer.php'); ?>