<?php
/*
// Require:
// acc_sidebar_controller
*/ 
class acc_sidebar_view
{
	function show()
	{
		global $acc_sidebar_controller; 
		echo "<div class='sidebar col-md-3 col-sm-3'>
		<ul class='list-group margin-bottom-25 sidebar-menu'>";
		$acc_sidebar=$acc_sidebar_controller->handle();
		foreach ($acc_sidebar as $data1 => $data2)
		{
			echo "<li class='list-group-item clearfix'><a href='".$data1."'><i class='fa fa-angle-right'></i>".$data2."</a></li>";
		}
		echo "</ul>
		</div>";
	}
}
?>