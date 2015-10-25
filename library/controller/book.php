<?php
class book_controller
{
	var $rating;
	var $wished;
	function __construct()
	{
		$this->handle_uri();
		$this->handle_rating();
		$this->handle_wish();
	}
	function handle_uri()
	{
		global $book_model;
		if ($book_model->error != 1)
		{
			$book = $book_model->book;
			$uri=$_SERVER['REQUEST_URI'];
			$kt="/".sf($book['title'],0).".".$book['id'].".html";
			if ($uri != $kt) { header("refresh: 0; url=".$kt."" ); }
		}
	}
	function handle_rating()
	{
		global $book_model;
		$book = $book_model->book;
		if ($book['rating'] == NULL) 
		{
			$this->rating=0;
		}
		else
		{
			$this->rating=$book['rating'];
		}
		if ($_SESSION['userid'] != NULL) 
		{
			$x=explode('|',$book['drating']);
			foreach ($x as $data)
			{
				$y=explode(',',$data);
				if ($y['0'] == $_SESSION['userid'])
				{
					$this->rating=$y['1'];
					break;
				}
			}	
		}
	}
	function handle_wish()
	{
		global $book_model;
		$this->wished=0;
		if ($book_model->error != 1)
		{
			if ($_SESSION['userid'] != NULL) 
			{
				$user = $book_model->get_logging_user();
				if ($user['wishlist'] != NULL) 
				{
					$x=explode('|',$user['wishlist']);
					foreach ($x as $data)
					{
						$y=explode(',',$data);
						if ($y['0'] == $book_model->book['id'])
						{
							$this->wished=1;
							break;
						}
					}
				}
			}
		}
	}
	function get_lang()
	{
		global $book_model;
		$book_lang = $book_model->book['lang'];
		$lang = array(
			'Ngôn ngữ khác'=>'0' , 
			'Tiếng Việt'=>'1', 
			'Tiếng Anh'=>'2', 
			'Tiếng Pháp'=>'3', 
			'Tiếng Đức'=>'4', 
			'Tiếng Nhật'=>'5', 
			'Tiếng Trung'=>'6', 
			'Tiếng Hàn'=>'7' 
		);
		foreach ($lang as $lang2=>$n){
			$book_lang = preg_replace("/($n)/i", $lang2, $book_lang);
		}
		return $book_lang;
	}
}
?>