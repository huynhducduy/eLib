<?php
require_once('../../assets/config.php');
if ($_SESSION["admin"] != 1) die();
$records = array(); // Tạo mảng
function is_number($s)
{
  if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
}
function class_check($s) {
	if(preg_match('/^([0-9]{2,2})+([a-dA-d]{1,1})+([1-5]{1,1})$/',$s) == 1) {return true;} else {return false;}
}
if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
  switch ($_REQUEST["customActionValue"]) {
  case '1':  
    $sqlaction="DELETE FROM `subscribe` WHERE `id` IN (";
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
    $records["customActionMessage"] = "Xóa ".$numrow." đăng ký theo dõi thành công";
    break;
  }
}
$sql="SELECT * FROM `subscribe` WHERE 1";
	if ($_REQUEST['sub_id'] != NULL)
	{
		$sql.=" AND `id` LIKE '%".$_REQUEST['sub_id']."%'";
	}
	if ($_REQUEST['sub_code'] != NULL)
	{
		$sql.=" AND `email` LIKE '%".$_REQUEST['sub_email']."%'";
	}  
	switch ($_REQUEST['order']['0']['column']) {
	case '1': $sql.=" ORDER BY `id` ".$_REQUEST['order']['0']['dir']; break;
	case '2': $sql.=" ORDER BY `email` ".$_REQUEST['order']['0']['dir']; break;
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
    $row2['email'],
    '<a href="user-edit.php?id='.$row2['id'].'" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Sửa</a>',
  );
}
$records["draw"] = $sEcho;
$records["recordsTotal"] = $iTotalRecords;
$records["recordsFiltered"] = $iTotalRecords;
die (json_encode($records));
?>