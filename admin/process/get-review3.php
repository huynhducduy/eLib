<?php
require_once('../../assets/config.php');
if ($_SESSION["admin"] != 1) die();
$records = array(); // Tạo mảng
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
function is_number($s)
{
  if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  switch ($_REQUEST["customActionValue"]) {
  case '1':  
    $sqlaction="DELETE FROM `review` WHERE `id` IN (";
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
    $records["customActionMessage"] = "Xóa ".$numrow." bình luận thành công";
    break;
  }
}
$sql="SELECT * FROM `review` WHERE 1";
	if ($_REQUEST['review_id'] != NULL)
	{
		$sql.=" AND `id` LIKE '%".$_REQUEST['review_id']."%'";
	}
	if ($_REQUEST['review_user'] != NULL)
	{
		$sql.=" AND `userid` LIKE '%".$_REQUEST['review_user']."%'";
	}  
	if ($_REQUEST['review_book'] != NULL)
	{
		$sql.=" AND `idb` LIKE '%".$_REQUEST['review_book']."%'";
	}
	if ($_REQUEST['review_content'] != NULL)
	{
		$sql.=" AND `content` LIKE '%".$_REQUEST['review_content']."%'";
	}
	if ($_REQUEST['review_time1'] != NULL)
	{
	$sql.=" AND `time` >= ".strtotime($_REQUEST['review_time1'])."";
	}
	if ($_REQUEST['review_time2'] != NULL)
	{
	$sql.=" AND `time` <= ".strtotime($_REQUEST['review_time2'])."";
	}
	if ($_REQUEST['review_rating'] != NULL)
	{
		$sql.=" AND `rating` LIKE '%".$_REQUEST['review_rating']."%'";
	}
	switch ($_REQUEST['order']['0']['column']) {
		case '1': $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
		case '2': $sql.=" ORDER BY `userid` ".$_REQUEST['order']['0']['dir']; break;
		case '3': $sql.=" ORDER BY `idb` ".$_REQUEST['order']['0']['dir']; break;
		case '4': $sql.=" ORDER BY `content` ".$_REQUEST['order']['0']['dir']; break;
		case '5': $sql.=" ORDER BY `rating` ".$_REQUEST['order']['0']['dir']; break;
		case '6': $sql.=" ORDER BY `time` ".$_REQUEST['order']['0']['dir']; break;
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
//$records["sql"]=$sql; 
$query2=@mysql_query($sql." LIMIT ".$iDisplayStart.",".$end);
while ($row2=@mysql_fetch_assoc($query2))
{
    $records["data"][] = array(
    '<input type="checkbox" name="id[]" value="'.$row2['id'].'">',
    $row2['id'],
    $row2['userid'],
    $row2['idb'],
    $row2['content'],
	$row2['rating'],
    ti_me($row2['time']),
    '<a href="review-edit.php?id='.$row2['id'].'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Sửa</a>',
  );
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
die (json_encode($records));
?>