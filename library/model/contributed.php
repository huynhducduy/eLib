<?php
class contributed_model
{
	var $id_list = array ('0');
	var $record;
	function __construct()
	{
		$this->set_id_list();
		$this->set_record();
	}
	function set_id_list()
	{
		global $database;
		$result=$database->clear_param()->select(array('idb'),'contribute')->where(['status'=>['=','2']])->fetch();
		foreach ($result as $data)
		{
			$this->id_list[]=$data['idb'];
		}
	}
	function set_record()
	{
		global $database;
		$this->record=$database->clear_param()->select(array('*'),'book')->where(array('id' => array('IN',$this->id_list)))->num_rows();
	}
	function get_data($start,$num)
	{
		global $database;
		return $database->clear_param()->select(array('*'),'book')->where(array('id' => array('IN',$this->id_list)))->order('id','DESC')->limit($start,$num)->fetch();
	}
}
?>