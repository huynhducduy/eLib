<?php
class index_model
{
	function get_hot_new()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'book')->add('where `hot`=1 or `new`=1')->fetch();
	}
	function get_rec()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'book')->add('where `recommended`=1')->fetch();
	}
}
?>