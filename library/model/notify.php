<?php
class notify_model
{
	var $data;
	var $record;
	function __construct()
	{
		if ($_SESSION['userid'] != NULL)
		{
			$this->get_data();
		}
	}
	function get_data()
	{
		global $database;
		$this->data= $database->clear_param()->select(array('*'),'notification')->where(array('userid' => array('=',$_SESSION['userid'])))->order('id','DESC')->limit(0,11)->fetch();
		$this->record=count($this->data);
	}
}
?>