<?php
class check {
	function number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == 1) {return true;} else {return false;}
	}
	function email($s) 
	{
		if(preg_match('/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',$s) == 1) {return true;} else {return false;}
	}
	function klass($s) 
	{
		if(preg_match('/^([0-9]{2,2})+([a-dA-d]{1,1})+([1-5]{1,1})$/',$s) == 1) {return true;} else {return false;}
	}
	function birthday($s) 
	{
		if(preg_match('/^([0-9]{4,4})+\-([0-9]{2,2})+\-([0-9]{2,2})$/',$s) == 1) {return true;} else {return false;}
	}
}
?>