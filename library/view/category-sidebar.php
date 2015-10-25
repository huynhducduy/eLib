<?php
class category_sidebar_view
{
	function show($x1,$x2)
	{
		global $category_sidebar_model;
		$result=$category_sidebar_model->get_data();
		foreach ($result as $data)
		{
			if ($data['id'] == $x1) {
				echo "<li class='list-group-item clearfix dropdown active'>
				<a href='../../".sf($data['title'],0).".".$data['id']."'>
				<i class='fa fa-angle-right'></i>".$data['title']."</a>
				<ul class='dropdown-menu' style='display: block'>
				";
			} else {
				echo "<li class='list-group-item clearfix dropdown'>
				<a href='../../".sf($data['title'],0).".".$data['id']."'>
				<i class='fa fa-angle-right'></i>".$data['title']."</a>
				<ul class='dropdown-menu'>
				";
			}
			foreach ($data['data'] as $data2)
			{
				if ($data2['id'] == $x2)
				{
					echo "<li class='active'><a href='../".sf($data['title'],0)."/".sf($data2['title'],0).".".$data2['id']."'><i class='fa fa-angle-right'></i>".$data2['title']."</a></li>";
				}
				else
				{
					echo "<li><a href='../".sf($data['title'],0)."/".sf($data2['title'],0).".".$data2['id']."'><i class='fa fa-angle-right'></i>".$data2['title']."</a></li>";
				}
			}
			echo "</ul>
			</li>";
		}
	}
}
?>