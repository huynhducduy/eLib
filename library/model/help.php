<?php
class help_model
{
	var $help;
	function __construct()
	{
		$this->get_help();
	}
	function get_help()
	{
		global $database;
		$this->help=$database->clear_param()->select(['*'],'help')->fetch();
	}
}
?>