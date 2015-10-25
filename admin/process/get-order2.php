<?php
require_once('../../assets/config.php');
if ($_SESSION["admin"] != 1) die();
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
$records = array(); // Tạo mảng
function is_number($s)
{
  if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  switch ($_REQUEST["customActionValue"]) {
  case '1':  
    $sqlaction="DELETE FROM `order` WHERE `id` IN (";
    $i=1;
    foreach ($_REQUEST[id] as $id)
    {
      if ($i == 1) { $sqlaction.="'".$id."'"; }
      else { $sqlaction.=",'".$id."'"; }
      $i=2;
    }
    $sqlaction.=")";
    $queryaction=@mysql_query($sqlaction);
    $records["customActionStatus"] = "OK";
    $numrow = @mysql_affected_rows(); 
    $records["customActionMessage"] = "Xóa ".$numrow." đơn sách thành công";
    break;
  case '2':
	$sqlaction="UPDATE `order` SET `status` = '4' WHERE `id` IN (";
    $i=1;
    foreach ($_REQUEST[id] as $id)
    {
      if ($i == 1) { $sqlaction.="'".$id."'"; }
      else { $sqlaction.=",'".$id."'"; }
      $i=2;
    }
    $sqlaction.=")";
	$queryaction=@mysql_query($sqlaction);
    $records["customActionStatus"] = "OK";
    $numrow = @mysql_affected_rows(); 
    $records["customActionMessage"] = "Hủy ".$numrow." đơn sách thành công";
    break;
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
$sql="SELECT * FROM `order` WHERE 1";
if ($_REQUEST['order_id'] != NULL)
{
	$sql.=" AND `id` LIKE '%".$_REQUEST['order_id']."%'";
}
if ($_REQUEST['order_count'] != NULL)
{
	$sql.=" AND `count` LIKE '%".$_REQUEST['order_count']."%'";
}
if ($_REQUEST['order_time1'] != NULL)
{
  $sql.=" AND `time` >= ".strtotime($_REQUEST['order_time1'])."";
}
if ($_REQUEST['order_time2'] != NULL)
{
  $sql.=" AND `time` <= ".strtotime($_REQUEST['order_time2'])."";
}
if ($_REQUEST['order_time11'] != NULL)
{
  $sql.=" AND `timestart` >= ".strtotime($_REQUEST['order_time11'])."";
}
if ($_REQUEST['order_time12'] != NULL)
{
  $sql.=" AND `timestart` <= ".strtotime($_REQUEST['order_time12'])."";
}
if ($_REQUEST['order_time21'] != NULL)
{
  $sql.=" AND `timestop` >= ".strtotime($_REQUEST['order_time21'])."";
}
if ($_REQUEST['order_time22'] != NULL)
{
  $sql.=" AND `timestop` <= ".strtotime($_REQUEST['order_time22'])."";
}
if ($_REQUEST['order_user'] != NULL)
{
  $sql4="SELECT * FROM `user` WHERE `name` LIKE '%".$_REQUEST['order_user']."%'";
  $query4=@mysql_query($sql4);
  $i=1;
  $sql.=" AND `userid` in (";
  while($row4=@mysql_fetch_assoc($query4))
  {
  	if ($i != 1) { $sql.=",'".$row4['id']."'"; }
  	else { $sql.="'".$row4['id']."'"; }
  	$i=2;
  }
  $sql.=")";
}
if ($_REQUEST['order_status'] != NULL)
{
  switch ($_REQUEST['order_status']) {
  case '0': $sql.=" AND `status` = '0'"; break;	  
  case '1': $sql.=" AND `status` = '1'"; break;
  case '2': $sql.=" AND `status` = '2'"; break;
  case '3': $sql.=" AND `status` = '3'"; break;
  case '4': $sql.=" AND `status` = '3'"; break;
	}
}
switch ($_REQUEST['order']['0']['column']) {
  case '1': $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
  case '2': $sql.=" ORDER BY `count` ".$_REQUEST['order']['0']['dir']; break;
  case '3': $sql.=" ORDER BY `time` ".$_REQUEST['order']['0']['dir']; break;
  case '4': $sql.=" ORDER BY `userid` ".$_REQUEST['order']['0']['dir']; break;
  case '5': $sql.=" ORDER BY `timestart` ".$_REQUEST['order']['0']['dir']; break;
  case '6': $sql.=" ORDER BY `timestop` ".$_REQUEST['order']['0']['dir']; break;
  case '7': $sql.=" ORDER BY `status` ".$_REQUEST['order']['0']['dir']; break;
  default: $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
}
$query=@mysql_query($sql);
$iTotalRecords = @mysql_num_rows($query); // Tổng số sách lấy được
$iDisplayLength = intval($_REQUEST['length']); // Số sách trên 1 trang
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; // Kiểm tra
$iDisplayStart = intval($_REQUEST['start']); // Bắt đầu lấy
$sEcho = intval($_REQUEST['draw']); // Số lần get (Đéo cần quan tâm)
$records["data"] = array(); 
$end = $iDisplayStart + $iDisplayLength; // Kết thúc lấy
$end = $end > $iTotalRecords ? $iTotalRecords : $end; // Kiểm tra
$query2=@mysql_query($sql." LIMIT ".$iDisplayStart.",".$end);
while ($row2=@mysql_fetch_assoc($query2))
{
	$status='<span class="label label-';
	switch ($row2['status']) {
		case '0': $status.='warning">Chưa xác nhận'; break;
		case '1': $status.='default">Chưa mượn'; break;
		case '2': $status.='primary">Đang mượn'; break;
		case '3': $status.='success">Đã trả'; break;
		case '4': $status.='danger">Đã hủy'; break;
	}
	if ($row2['status'] == 0)
	{
		if ($row2['reconfirm'] == 1) 
		{
			$status.=' - Đang xác nhận lại';
		}
		else if ($row2['reconfirm'] == 2)
		{
			$status.=' - Đã xác nhận lại';
		}
	}
	$status.='</span>';
	$sql5="SELECT * FROM `user` WHERE `id`='".$row2['userid']."'";
	$query5=@mysql_query($sql5);
	$row5=@mysql_fetch_assoc($query5);
    $records["data"][] = array(
    '<input type="checkbox" name="id[]" value="'.$row2['id'].'">',
    $row2['id'],
    $row2['count'],
    ti_me($row2['time']),
	$row5['name'],
	ti_me($row2['timestart']),
	ti_me($row2['timestop']),
    $status,
    '<a href="order-view.php?id='.$row2['id'].'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Chi tiết</a>',
  );
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
$records['sql']=$sql;
die (json_encode($records));
?>