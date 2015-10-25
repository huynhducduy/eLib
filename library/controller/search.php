<?php
class search_controller
{
	var $d = 10;
	var $range = 7;
	var $str_uri = '/tim-kiem/';
	var $str_uri_p;
	var $page;
	var $p;
	var $start;
	var $start2;
	var $end;
	var $min;
	var $max;
	function __construct()
	{
		if ($_GET['q'] != '')
		{
		$this->handle_str_uri(); // Gán URI
		$this->handle_page(); // Tổng số trang
		$this->handle_p(); // Trang cần đến
		$this->handle_uri(); // URI
		$this->handle_start_end(); // Dữ liệu cần lấy
		$this->handle_min_max(); // Pag
		}
	}
	function handle_str_uri()
	{
		$this->str_uri.=rawurlencode($_GET['q']);
		$this->str_uri_p=$this->str_uri.'/trang-';
	}
	function handle_uri()
	{
		$uri=$_SERVER['REQUEST_URI'];
		$kt=$this->str_uri;
		$kt2=$this->str_uri_p.$this->p;
		if ($this->p == 1 && $uri != $kt) { header("refresh: 0; url=".$kt); }
		else if ($this->p != 1 && $uri != $kt2) { header("refresh: 0; url=".$kt2); }
	}
	
	function handle_page()
	{
		global $search_model;
		$this->page=ceil($search_model->record/$this->d); 
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
	
	function handle_start_end()
	{
		global $search_model;
		$this->start=($this->p-1)*$this->d+1;
		$this->start2=$this->start;
		$this->end=($this->p<$this->page)?$this->p*$this->d:$search_model->record;
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