<?php
/*
// Require:
// database
*/
class header_model {
	function __construct()
	{
		$this->up_view();
	}
	function up_view()
	{
		global $database;
		$view=$database->clear_param()->select(['view'],'setting')->fetch();
		$view=$view['0']['view'];
		$database->clear_param()->update('setting',['view'=>$view+1])->execute();
	}
	function get_cart() {
		global $database;
		if (isset($_SESSION['cart']))
		{
			foreach ($_SESSION['cart'] as $data1=>$data2)
			{
				if ($data2 == '1')
				{
					$item[]=$data1;
				}
			}
			if ($item != NULL)
			{
			return $database->clear_param()->select(array('*'),'book')->where(array('id' => array('in',$item)))->order('id','DESC')->fetch();
			}
		}
	}
	
	function get_cart_num() {
		$c=0;
		if (isset($_SESSION['cart']))
		{
			foreach($_SESSION['cart'] as $data1=>$data2)
			{
				if ($data2 == '1') { $c++; }
			}
		}
		return $c;
	}
	
	function get_noti() {
		global $database;
		return $database->clear_param()->select(array('*'),'notification')->where(array('userid' => array('=',$_SESSION['userid']), 'seen' => array('=','0')))->fetch();
	}
	
	function get_noti_num() {
		global $database;
		return $database->clear_param()->select(array('*'),'notification')->where(array('userid' => array('=',$_SESSION['userid']), 'seen' => array('=','0')))->num_rows();
	}
	
	function get_cate() {
		global $database;
		$result = $database->clear_param()->select(array('*'),'cate1')->fetch();
		$c=-1;
		foreach ($result as $data)
		{
			$c++;
			$result[$c]['cate2'] = $database->clear_param()->select(array('*'),'cate2')->where(array('id1' => array('=',$result[$c]['id'])))->fetch();
		}
		return $result;
	}
	
	function get_logging_user($data)
	{
		global $database;
		$result = $database->clear_param()->select(array('*'),'user')->where(array('id' => array ('=',$_SESSION['userid'])))->fetch();
		return $result[0][$data];
	}
}
?>