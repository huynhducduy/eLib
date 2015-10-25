<?php
class book_list_controller
{
	var $d;
	var $range = 7;
	var $str_uri;
	var $str_uri_p;
	var $page;
	var $p;
	var $start;
	var $start2;
	var $end;
	var $min;
	var $max;
	var $qstr;
	var $qstr2;
	function __construct()
	{
		$this->handle_d();
		$this->handle_page();
		$this->handle_p();
		$this->set_qstr();
		$this->set_uri();
		$this->handle_uri();
		$this->handle_start_end();
		$this->handle_min_max();
	}
	
	function handle_d()
	{
		if (isset($_GET['hienThi']) && in_array($_GET['hienThi'],array(12,16,20,24,28))) 
		{
			$this->d=+$_GET['hienThi'];
		} 
		else 
		{
			$this->d=12;
		}
	}
	function handle_page()
	{
		global $book_list_model;
		$this->page=ceil($book_list_model->record/$this->d); 
	}
	
	function handle_p()
	{
		if (isset($_GET['p']) 
			&& is_number($_GET['p']) 
			&& +$_GET['p'] > 0 
			&& +$_GET['p'] <= $this->page) 
			{
				$this->p=+$_GET['p'];
			} 
			else 
			{
				$this->p=1;
			}
	}
	
	function set_qstr()
	{
		$querystring=explode('&',$_SERVER['QUERY_STRING']);
		$count=-1;
		foreach ($querystring as $data)
		{
			++$count;
			$y=explode('=',$data);
			if (($y['0'] == 'c2') || ($y['0'] == 'c1') || ($y['0'] == 'p'))
			{
				unset($querystring[$count]);
			}
		}
		$this->qstr=implode('&',$querystring);
	}
	
	function set_uri()
	{
		global $book_list_model;
		if ($book_list_model->type == 2)
		{
			$this->str_uri="/".sf($book_list_model->cate1['title'],0)."/".sf($book_list_model->cate2['title'],0).".".$book_list_model->cate2['id'];
		}
		else if ($book_list_model->type == 1)
		{
			$this->str_uri="/".sf($book_list_model->cate1['title'],0).".".$book_list_model->cate1['id'];
		}
		$this->str_uri_p=$this->str_uri.'/trang-';
	}
	
	function handle_uri()
	{
		global $book_list_model;
		if ($book_list_model->error == 0)
		{
			$uri=$_SERVER['REQUEST_URI'];
			$kt=$this->str_uri;
			$kt2=$this->str_uri_p.$this->p;
			if ($this->qstr != NULL)
			{ 
				$kt=$kt."?".$this->qstr; 
				$kt2=$kt2."?".$this->qstr;
				$this->qstr2="?".$this->qstr;
			}
			if ($this->p == 1 && $uri != $kt) { header("refresh: 0; url=".$kt); }
			else if ($this->p != 1 && $uri != $kt2) { header("refresh: 0; url=".$kt2); }
		}
	}
	
	function handle_start_end()
	{
		global $book_list_model;
		$this->start=($this->p-1)*$this->d;
		$this->start2=$this->start+1;
		$this->end=($this->p<$this->page)?$this->p*$this->d:$book_list_model->record;
	}
	
	function handle_min_max()
	{
		$middle = ceil($this->range / 2);
        if ($this->page < $this->range)
		{
            $this->min = 1;
            $this->max = $this->page;
        }
        else
        {
            $this->min = $this->p - $middle + 1;
            $this->max = $this->p + $middle - 1;
            if ($this->min < 1)
			{
                $this->min = 1;
                $this->max = $this->range;
            }
            else if ($this->max > $this->page)
            {
                $this->max = $this->page;
                $this->min = $this->page - $this->range + 1;
            }
        }
	}
}
?>