<?php
class setting {
	var $result = array ();
	function __construct() 
	{
		global $database;
		$this->result=$database->clear_param()->select(array('*'),'setting')->limit('0','1')->fetch();
	}
	function get($data)
	{
		return $this->result[0][$data];
	}
}
?>
