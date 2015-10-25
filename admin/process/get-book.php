<?php
require_once('../../assets/config.php');
if ($_SESSION["admin"] != 1) die();
$records = array(); // Tạo mảng
function is_number($s)
{
  if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  switch ($_REQUEST["customActionValue"]) {
  case '1':  
    $sqlaction="DELETE FROM `book` WHERE `id` IN (";
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
    $numrow = @mysql_affected_rows(); // Tổng số sách lấy được
    $records["customActionMessage"] = "Xóa ".$numrow." sách thành công";
    break;
  }
}
$sql="SELECT * FROM `book` WHERE 1";
	if ($_REQUEST['book_id'] != NULL)
	{
		$sql.=" AND `id` LIKE '%".$_REQUEST['book_id']."%'";
	}
	if ($_REQUEST['book_code'] != NULL)
	{
		$sql.=" AND `bcode` LIKE '%".$_REQUEST['book_code']."%'";
	}  
	if ($_REQUEST['book_title'] != NULL)
	{
		$sql.=" AND `title` LIKE '%".$_REQUEST['book_title']."%'";
	}
	if ($_REQUEST['book_cate'] != '0' && $_REQUEST['book_cate'] != NULL)
  {
    if (is_number($_REQUEST['book_cate']))
    {
      $sql.=" AND `cid` LIKE '%".$_REQUEST['book_cate']."%'";
    }
    else
    {
      $x=explode('c',$_REQUEST['book_cate']);
      $sql2="SELECT * FROM `cate2` where `id1`='".$x[1]."'"; 
      $query2=@mysql_query($sql2);
      $i=1;
      $sql.=" AND `cid` in (";
      while($row2=@mysql_fetch_assoc($query2))
      {
        if ($i != 1) { $sql.=",'".$row2['id']."'"; }
        else { $sql.="'".$row2['id']."'"; }
        $i=2;
      }
      $sql.=")";
    }
  }
  if ($_REQUEST['book_remain'] != '0' && $_REQUEST['book_remain'] != NULL)
  {
    if ($_REQUEST['book_remain'] == '1')
    {
      $sql.=" AND `remain` >= 1";
    }
    else
    {
      $sql.=" AND `remain` = 0";
    }
  }
  if ($_REQUEST['book_proofread'] != '0' && $_REQUEST['book_proofread'] != NULL)
  {
    if ($_REQUEST['book_proofread'] == '1')
    {
      $sql.=" AND `proofread` != ''";
    }
    else
    {
      $sql.=" AND `proofread` = ''";
    }
  }
switch ($_REQUEST['order']['0']['column']) {
  case '1': $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
  case '2': $sql.=" ORDER BY `bcode` ".$_REQUEST['order']['0']['dir']; break;
  case '3': $sql.=" ORDER BY `title` ".$_REQUEST['order']['0']['dir']; break;
  case '4': $sql.=" ORDER BY `cid` ".$_REQUEST['order']['0']['dir']; break;
  case '5': $sql.=" ORDER BY `remain` ".$_REQUEST['order']['0']['dir']; break;
  case '6': $sql.=" ORDER BY `proofread` ".$_REQUEST['order']['0']['dir']; break;
  default: $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
}
$query=@mysql_query($sql);
$iTotalRecords = @mysql_num_rows($query); // Tổng số sách lấy được
$iDisplayLength = intval($_REQUEST['length']); // Số sách trên 1 trang
$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; // Kiểm tra
$iDisplayStart = intval($_REQUEST['start']); // Bắt đầu lấy
$sEcho = intval($_REQUEST['draw']); // Số lần get (Đéo cần quan tâm)
$records["data"] = array(); 
$records["sql"]=$sql;
$end = $iDisplayStart + $iDisplayLength; // Kết thúc lấy
$end = $end > $iTotalRecords ? $iTotalRecords : $end; // Kiểm tra
$query2=@mysql_query($sql." LIMIT ".$iDisplayStart.",".$end);
while ($row2=@mysql_fetch_assoc($query2))
{
  $sql3="SELECT * FROM `cate2` WHERE `id`='".$row2['cid']."'";
  $query3=@mysql_query($sql3);
  $row3=@mysql_fetch_assoc($query3);
  if ($row2['remain'] == '0')
  {
    $remain='<span class="label label-sm label-danger">Hết sách</span>';
  }
  else
  {
    $remain='<span class="label label-sm label-success">Còn sách</span>';
  }
  if ($row2['proofread'] == NULL)
  {
    $proofread='<span class="label label-sm label-danger">Không thể</span>';
  }
  else
  {
    $proofread='<span class="label label-sm label-success">Có thể</span>';
  }
    $records["data"][] = array(
    '<input type="checkbox" name="id[]" value="'.$row2['id'].'">',
    $row2['id'],
    $row2['bcode'],
    $row2['title'],
    $row3['title'],
    $remain,
    $proofread,
    '<a href="book-edit.php?id='.$row2['id'].'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Sửa</a>',
  );
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
die (json_encode($records));
?>