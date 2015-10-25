<?php
/*
// Require:
// database
*/
class wishlist_model
{
	function get()
	{
		global $database;
		$result=$database->clear_param()->select(array('*'),'user')->where(array('id' => array('=',$_SESSION['userid'])))->fetch();
		$x=explode('|',$result[0]['wishlist']);
		$c=-1;
		foreach ($x as $data)
		{
			if ($data != '')
			{
				$c++;
				$y=explode(',',$data);
				$tmp = $database->clear_param()->select(array('*'),'book')->where(array('id' => array('=',$y[0])))->fetch();
				$result2[$c]=$tmp[0];
				$result2[$c]['timeadd']=$y[1];
			}
		}
		return $result2;
	}
	function get_num()
	{
		global $database;
		$result=$database->clear_param()->select(array('*'),'user')->where(array('id' => array('=',$_SESSION['userid'])))->fetch();
		if ($result[0]['wishlist'] != NULL)
		{
			$x=explode($result[0]['wishlist'],',');
			return count($x);
		}
		else
		{
			return 0;
		}
	}
}
?>