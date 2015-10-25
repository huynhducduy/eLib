<?php
class order_controller
{
	var $check_owner=false;
	var $check_exist=false;
	function __construct()
	{
		if ($_SESSION['userid'] != NULL)
		{
			if ($_GET['id'] != NULL)
			{
				$this->check1();
				$this->check2();
			}
		}
	}
	function check1()
	{
		global $order_model;
		$order = $order_model->order;
		if ($order['userid'] == $_SESSION['userid'])
		{
			$this->check_owner=true;
		}
	}
	function check2()
	{
		global $order_model;
		if (isset($order_model->order))
		{
			$this->check_exist=true;
		}
	}
}
?>