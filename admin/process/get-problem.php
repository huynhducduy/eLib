<?php
require_once('../../assets/config.php');
if ($_SESSION["admin"] != 1) die();
$records = array(); // Tạo mảng
function is_number($s)
{
  if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
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
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  switch ($_REQUEST["customActionValue"]) {
  case '1':  
    $sqlaction="DELETE FROM `problem` WHERE `id` IN (";
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
    $records["customActionMessage"] = "Xóa ".$numrow." vấn đề thành công";
    break;
  }
}
$sql="SELECT * FROM `problem` WHERE 1";
	if ($_REQUEST['problem_id'] != NULL)
	{
		$sql.=" AND `id` LIKE '%".$_REQUEST['problem_id']."%'";
	}
	if ($_REQUEST['problem_book'] != NULL)
	{
		$sql.=" AND `bịd` LIKE '%".$_REQUEST['problem_book']."%'";
	}  
	if ($_REQUEST['problem_user'] != NULL)
	{
		$sql.=" AND `userid` LIKE '%".$_REQUEST['problem_user']."%'";
	}
	if (($_REQUEST['problem_type'] != NULL) && ($_REQUEST['problem_type'] != 0) && (is_number($_REQUEST['problem_type'])))
	{
		$sql.=" AND `type`='".$_REQUEST['problem_type']."'";
	}
	if ($_REQUEST['problem_time1'] != NULL)
	{
		$sql.=" AND `time` >= ".strtotime($_REQUEST['problem_time1'])."";
	}
	if ($_REQUEST['problem_time2'] != NULL)
	{
		$sql.=" AND `time` <= ".strtotime($_REQUEST['problem_time1'])."";
	}
	switch ($_REQUEST['order']['0']['column']) {
	case '1': $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
	case '2': $sql.=" ORDER BY `bid` ".$_REQUEST['order']['0']['dir']; break;
	case '3': $sql.=" ORDER BY `userid` ".$_REQUEST['order']['0']['dir']; break;
	case '4': $sql.=" ORDER BY `type` ".$_REQUEST['order']['0']['dir']; break;
	case '5': $sql.=" ORDER BY `time` ".$_REQUEST['order']['0']['dir']; break;
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
$records["sql"]=$sql; 
$query2=@mysql_query($sql." LIMIT ".$iDisplayStart.",".$end);
while ($row2=@mysql_fetch_assoc($query2))
{
  if ($row2['verify'] != '1')
  {
    $verify='<span class="label label-sm label-danger">Chưa xác nhận</span>';
  }
  else
  {
    $verify='<span class="label label-sm label-success">Đã xác nhận</span>';
  }
  switch ($row2['type'])
  {
	  case '1': $type='<span class="label label-sm label-warning">Hỏng sách</span>'; break;
	  case '2': $type='<span class="label label-sm label-danger">Mất sách</span>'; break;
	  case '3': $type='<span class="label label-sm label-default">Khác</span>'; break;
  }
    $records["data"][] = array(
    '<input type="checkbox" name="id[]" value="'.$row2['id'].'">',
    $row2['id'],
    $row2['bid'],
    $row2['userid'],
    $type,
    ti_me($row2['time']),
    '<a href="problem-edit.php?id='.$row2['id'].'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Xem</a>',
  );
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
die (json_encode($records));
?>