<?php
class category_sidebar_model
{
	function get_data()
	{
		global $database;
		$result = $database->clear_param()->select(array('*'),'cate1')->fetch();
		$i=-1;
		foreach ($result as $cate1)
		{
			$i++;
			$result[$i]['data']=$database->clear_param()->select(array('*'),'cate2')->where(array('id1' => array('=',$cate1['id'])))->fetch();
		}
		return $result;
	}
}
?>