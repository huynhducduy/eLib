<?php
class term_model
{
	var $term;
	function __construct()
	{
		$this->get_term();
	}
	function get_term()
	{
		global $setting;
		$this->term=$setting->get('term');
	}
}