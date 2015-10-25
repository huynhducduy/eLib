<?php
/*
// Require:
// database
*/
class order_model
{
	var $order;
	var $eachorder;
	function __construct()
	{
		if ($_GET['id'] != NULL)
		{
			if ($_SESSION['userid'] != NULL)
			{
				$this->get_order();
				$this->get_eachorder();
			}
		}
	}
	function get_order()
	{
		global $database;
		$result = $database->clear_param()->select(['*'],'order')->where(['id'=>['=',$_GET['id']]])->fetch();
		$this->order = $result[0]; 
	}
	function get_eachorder()
	{
		global $database;
		$result	= $database->clear_param()->select(['*'],'eachorder')->where(['oid'=>['=',$_GET['id']]])->fetch();
		$c=-1;
		foreach ($result as $data1=>$data2)
		{
			$c++;
			$result2=$database->clear_param()->select(['*'],'book')->where(['id'=>['=',$data2['bid']]])->fetch();
			$result[$c]['book']=$result2[0];
		}
		$this->eachorder=$result;
	}
}
?>