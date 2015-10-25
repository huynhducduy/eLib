<?php
class requested_controller
{
	var $d = 12;
	var $range = 7;
	var $str_uri = '/sach-duoc-yeu-cau';
	var $str_uri_p = '/sach-duoc-yeu-cau/trang-';
	var $page;
	var $p;
	var $start;
	var $start2;
	var $end;
	var $min;
	var $max;
	function __construct()
	{
		$this->handle_page();
		$this->handle_p();
		$this->handle_uri();
		$this->handle_start_end();
		$this->handle_min_max();
	}
	
	function handle_page()
	{
		global $requested_model;
		$this->page=ceil($requested_model->record/$this->d); 
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
	
	function handle_uri()
	{
		$uri=$_SERVER['REQUEST_URI'];
		$kt=$this->str_uri;
		$kt2=$this->str_uri_p.$this->p;
		if ($this->p == 1 && $uri != $kt) { header("refresh: 0; url=".$kt); }
		else if ($this->p != 1 && $uri != $kt2) { header("refresh: 0; url=".$kt2); }
	}
	
	function handle_start_end()
	{
		global $requested_model;
		$this->start=($this->p-1)*$this->d;
		$this->start2=$this->start+1;
		$this->end=($this->p<$this->page)?$this->p*$this->d:$requested_model->record;
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