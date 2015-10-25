<?php
/*
// Require:
// form_info_controller
*/ 
class form_info_view
{
	function show()
	{
		global $form_info_controller;
		$data = $form_info_controller->handle();
		echo "
		<div class='col-md-4 col-sm-4 pull-right'>
			<div class='form-info'>
				<h2><em>Thông tin</em><br/>cần biết</h2>
				<p>".$data[0]."</p>
				<a href='".$data[1]."'><button type='button' class='btn btn-default'><i class='fa fa-plus' style='color:#000'></i>&nbsp;&nbsp;Xem thêm</button></a>
			</div>
		</div>";
	}
}
?>
