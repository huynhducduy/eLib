<?php
/*
// Require:
// database
*/
class orderlist_model
{
	function get()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'order')->where(array('userid' => array('=',$_SESSION['userid'])))->order('time','desc')->fetch();
	}
	function get_num()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'order')->where(array('userid' => array('=',$_SESSION['userid'])))->num_rows();
	}
}
?>