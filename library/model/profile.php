<?php
/*
// Require:
// database
*/
class profile_model
{
	var $result;
	function __construct()
	{
		if (isset($_SESSION['userid']))
		{
			global $database;
			$this->result=$database->clear_param()->select(array('*'),'user')->where(array('id' => array('=',$_SESSION['userid'])))->fetch();
		}
	}
	function get()
	{
		return $this->result[0];
	}
}
?>