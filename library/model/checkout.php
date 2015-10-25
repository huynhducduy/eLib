<?php
class checkout_model
{
	public $user_info;
	public $term;
	public $cart;
	public $num = 0;
	function __construct()
	{
		if ($_SESSION['userid'] != NULL)
		{
			$this->get_term();
			$this->get_info();
			$this->get_cart();
		}
	}
	function get_term()
	{
		global $database;
		$result = $database->clear_param()->select(array('term'),'setting')->fetch();
		$this->term= $result[0]['term'];
	}
	function get_info()
	{
		global $database;
		$result = $database->clear_param()->select(array('*'),'user')->where(array('id' => array ('=',$_SESSION['userid'])))->fetch();
		$this->info=$result[0];
	}
	function get_cart() {
		global $database;
		if (isset($_SESSION['cart']))
		{
			$c=0;
			foreach ($_SESSION['cart'] as $data1=>$data2)
			{
				$item[]=$data1;
				if ($data2 == '1') { $c++; }
			}
			$this->cart=$database->clear_param()->select(array('*'),'book')->where(array('id' => array('in',$item)))->order('id','DESC')->fetch();
			$this->num=$c;
		}
	}
}
?>