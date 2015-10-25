<?php
class book_model
{
	var $error;
	var $cate1;
	var $cate2;
	var $book;
	function __construct()
	{
		$this->check_error();
		if ($this->error != 1)
		{
			$this->set_book();
			$this->up_view();
			$this->set_cate1_cate2();
		}
	}
	function check_error()
	{
		global $database;
		if (($_GET['id'] == NULL) || !is_number($_GET['id']) || ($database->clear_param()->select(array('*'),'book')->where(array('id' => array('=',$_GET['id'])))->num_rows() == 0))
		{
			$this->error = 1;
		}
	}
	function set_book()
	{
		global $database;
		$result=$database->clear_param()->select(array('*'),'book')->where(array('id' => array('=',$_GET['id'])))->fetch();
		$this->book=$result[0];
	}
	function up_view()
	{
		global $database;
		$viewbook=$this->book['view']+1;
		$database->clear_param()->update('book',array('view' => $viewbook))->where(array('id' => array('=',$_GET['id'])))->execute();
	}
	function set_cate1_cate2()
	{
		global $database;
		$result=$database->clear_param()->select(array('*'),'cate2')->where(array('id' => array('=',$this->book['cid'])))->fetch();
		$this->cate2=$result[0];
		$result2=$database->clear_param()->select(array('*'),'cate1')->where(array('id' => array('=',$this->cate2['id1'])))->fetch();
		$this->cate1=$result2[0];
	}
	function get_random()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'book')->where(array('cid' => array ('=',$this->book['cid'])))->add("and `id`!='".$this->book['id']."' and `id`>=(SELECT FLOOR(MAX(`id`)*RAND()) FROM `book` )")->limit(0,4)->fetch();
	}
	function get_review_nums()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'review')->where(array('idb' => array('=',$this->book['id'])))->num_rows();
	}
	function get_review()
	{
		global $database;
		$result = $database->clear_param()->select(array('*'),'review')->where(array('idb' => array('=',$this->book['id'])))->order('nthanks','DESC')->fetch();
		$database->clear_param()->select(array('*'),'user');
		$i=-1;
		foreach ($result as $data)
		{
			$i++;
			$result2 = $database->where(array('id' => array('=',$data['userid'])))->fetch();
			$result[$i]['data']=$result2[0];
			if ($_SESSION['userid'] != NULL) 
			{
				if ($data['nthanks'] != 0) 
				{
					$x=explode(',',$data['dthanks']);
					foreach ($x as $data2)
					{
						if ($data2 == $_SESSION['userid'])
						{
							$result[$i]['thanked']=1;
							break;
						}
					}
				}
			}
		}
		return $result;
	}
	function get_comment_nums()
	{
		global $database;
		return $database->clear_param()->select(array('*'),'comment')->where(array('idb' => array('=',$this->book['id'])))->num_rows();
	}
	function get_comment()
	{
		global $database;
		$result = $database->clear_param()->select(array('*'),'comment')->where(array('idb' => array('=',$this->book['id'])))->order('id','ASC')->fetch();
		$database->clear_param()->select(array('*'),'user');
		$i=-1;
		foreach ($result as $data)
		{
			$i++;
			$result2 = $database->where(array('id' => array('=',$data['userid'])))->fetch();
			$result[$i]['data']=$result2[0];
		}
		return $result;
	}
	function get_logging_user()
	{
		global $database;
		if ($_SESSION['userid'] != NULL) 
		{
			$result = $database->clear_param()->select(array('*'),'user')->where(array('id' => array('=',$_SESSION['userid'])))->fetch();
			return $result[0]; 
		}
	}
}
?>