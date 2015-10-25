<?php
/*
// Require:
// database
*/
class hot_new_book_model
{
	function get_new()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'book')->where(array('new' => array('=','1')))->fetch();
	}
	function get_hot()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'book')->where(array('hot' => array('=','1')))->fetch();
	}
}
?>