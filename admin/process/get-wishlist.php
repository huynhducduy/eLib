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
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Thực hiện tác vụ
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  switch ($_REQUEST["customActionValue"]) {
  case '1':  
    foreach ($_REQUEST[id] as $id)
    {
		$sqluser="SELECT * FROM `user` WHERE `id`='".$_REQUEST['userid']."'";
		$queryuser=@mysql_query($sqluser);
		$rowuser=@mysql_fetch_assoc($queryuser);
		$x=explode('|',$rowuser['wishlist']);
		foreach ($x as $data)
		{
			$y=explode(',',$data);
			if ($y['0'] == $id)
			{
				$c=-1;
				foreach ($x as $data2)
				{
					$c++;
					$y2=explode(',',$data2);
					if ($y2['0'] == $id)
					{
						unset($x[$c]);
						break;
					}
				}
				$kq=implode($x,'|');
				$sqlupdatewish="UPDATE `user` SET `wishlist`='".$kq."' WHERE `id`='".$_REQUEST['userid']."'";
				$queryupdatewish=@mysql_query($sqlupdatewish);
				$numrow++;
				break;
			}
		}
	}
	$records["customActionStatus"] = "OK";
	$records["customActionMessage"] = "Xóa ".$numrow." sách yêu thích thành công";
    break;
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// Lấy dữ liệu
$sqluser="SELECT * FROM `user` WHERE `id`='".$_REQUEST['userid']."'";
$queryuser=@mysql_query($sqluser);
$rowuser=@mysql_fetch_assoc($queryuser);
$x=explode('|',$rowuser['wishlist']);
$wishlist = array();
foreach ($x as $data)
{
	if ($data != '')
	{
		$y=explode(',',$data);
		$sqlbook="SELECT * FROM `book` where `id`='".$y[0]."'";
		$querybook=@mysql_query($sqlbook);
		$rowbook=@mysql_fetch_assoc($querybook);
		if ((($_REQUEST['wishlist_id'] == NULL) || ($_REQUEST['wishlist_id'] == $y[0])) 
		&& (($_REQUEST['wishlist_title'] == NULL) or (strlen(strstr($rowbook['title'],$_REQUEST['wishlist_title'])) >0))
		&& (($_REQUEST['wishlist_time1'] == NULL) or ($y[1] >= strtotime($_REQUEST['wishlist_time1'])))
		&& (($_REQUEST['wishlist_time2'] == NULL) or ($y[1] <= strtotime($_REQUEST['wishlist_time2']))))
		{
			$wishlist[] = array($y[0],$rowbook['title'],$y[1]);
		}
	}
}
switch ($_REQUEST['order']['0']['column']) {
  case '1': 
	function compare($in1, $in2)
	{
		if ((($in1['0'] > $in2['0']) && ($_REQUEST['order']['0']['dir'] == 'asc')) || (($in1['0'] < $in2['0']) && ($_REQUEST['order']['0']['dir'] == 'desc')))
		{
			return 1;
		}
		else if ($in1['0'] == $in2['0'])
		{
			return 0;
		}
		else
		{
			return -1;
		}
	}
	break;
  case '2':
	function compare($in1, $in2)
	{
		if ((($in1['1'] > $in2['1']) && ($_REQUEST['order']['0']['dir'] == 'asc')) || (($in1['1'] < $in2['1']) && ($_REQUEST['order']['0']['dir'] == 'desc')))
		{
			return 1;
		}
		else if ($in1['1'] == $in2['1'])
		{
			return 0;
		}
		else
		{
			return -1;
		}
	}
	break;
  case '3': 
	function compare($in1, $in2)
	{
		if ((($in1['2'] > $in2['2']) && ($_REQUEST['order']['0']['dir'] == 'asc')) || (($in1['2'] < $in2['2']) && ($_REQUEST['order']['0']['dir'] == 'desc')))
		{
			return 1;
		}
		else if ($in1['2'] == $in2['2'])
		{
			return 0;
		}
		else
		{
			return -1;
		}
	}
	break;
  default: 
	function compare($in1, $in2)
	{
		if ((($in1['2'] > $in2['2']) && ($_REQUEST['order']['0']['dir'] == 'asc')) || (($in1['2'] < $in2['2']) && ($_REQUEST['order']['0']['dir'] == 'desc')))
		{
			return 1;
		}
		else if ($in1['2'] == $in2['2'])
		{
			return 0;
		}
		else
		{
			return -1;
		}
	}
	break;
}
usort($wishlist, 'compare');
$iTotalRecords = count($x)-1; // Tổng số sách lấy được
$iDisplayLength = intval($_REQUEST['length']); // Số sách trên 1 trang
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; // Kiểm tra
$iDisplayStart = intval($_REQUEST['start']); // Bắt đầu lấy
$sEcho = intval($_REQUEST['draw']); // Số lần get (Đéo cần quan tâm)
$records["data"] = array(); 
$end = $iDisplayStart + $iDisplayLength; // Kết thúc lấy
$end = $end > $iTotalRecords ? $iTotalRecords : $end; // Kiểm tra
for ($i = $iDisplayStart; $i < $end; $i++){
	if ($wishlist[$i] != NULL)
	{
	$records["data"][] = array(
		'<input type="checkbox" name="id[]" value="'.$wishlist[$i][0].'">',
		$wishlist[$i][0],
		$wishlist[$i][1],
		ti_me($wishlist[$i][2]),
		'<a href="book-edit.php?id='.$row2['id'].'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Sửa</a>',
	);
	}
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
die (json_encode($records));
?>