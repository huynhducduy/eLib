<?php
/*
// Require:
// database
*/
class cart_model
{
	function get_cart() {
		global $database;
		if (isset($_SESSION['cart']))
		{
			foreach ($_SESSION['cart'] as $data1=>$data2)
			{
				$item[]=$data1;
			}
			if ($item != '')
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
}
?>