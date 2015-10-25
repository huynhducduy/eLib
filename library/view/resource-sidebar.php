<?php
/*
// Require:
// resource_sidebar_controller
*/
class resource_sidebar_view
{
	function show_item()
	{
		global $resource_sidebar_controller;
		$result = $resource_sidebar_controller->handle();
		foreach ($result as $data1 => $data2)
		{
			echo "<li class='list-group-item clearfix'><a href='".$data1."'><i class='fa fa-angle-right'></i>".$data2."</a></li>";
		}
	}
	function show()
	{
		echo "<div class='sidebar col-md-3 col-sm-3'>
		<ul class='list-group margin-bottom-25 sidebar-menu'>";
		$this->show_item();
		echo "</ul>
		</div>";
	}
}
?>