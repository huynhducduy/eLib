<?php
class fast_view_box_view
{
	static function show()
	{
		echo "<div id='product-pop-up' style='display: none; width: 700px;'>
		<div id='loading3'>
			<center>
			<div class='vuload' id='vuload' style='top: 176.5px;'>
				<div class='vuitems' id='vuitems_1'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_2'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_3'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_4'><div class='comp'></div></div>
				<div class='vuitems' id='vuitems_5'><div class='comp'></div></div>
			</div>
			</center>
		</div>
			<div class='product-page product-pop-up'>
			<div class='row'>
				<div class='col-md-6 col-sm-6 col-xs-3'>
				<div style='margin-bottom: 0;'>
					<img class='img-responsive' id='img0' src='' style='width:330px;height:443px;'>
				</div>
				</div>
				<div class='col-md-6 col-sm-6 col-xs-9'>
				<h1><span id='title0'></span><br/><span class='author' id='author0'></span></h1>
				<div class='price-availability-block clearfix'>
					<div class='availability'>
					Số sách còn lại: <strong id='remain0'></strong>
					</div>
				</div>
				<div class='description' style='border-bottom: 1px solid #f4f4f4;margin-bottom: 17px;'>
					<p id='des0'></p>
				</div>
				<div class='product-page-cart'>
					<button class='btn btn-primary' style='padding: 7px 10px;' type='submit' id='btnborrow0'><i class='fa fa-legal'></i>&nbsp;&nbsp;Mượn</button>
					<a style='float: right;position: relative;top: 10px;'><span id='borrow0'></span> lượt mượn</a></div>
				<div class='review' style='margin-bottom:0;border-bottom:0;padding-bottom:2px'><table><tr><td>
				<input type='range' value='0' step='0.25' id='rating0'>
					<div id='rating1' class='rateit' data-rateit-backingfld='#rating0' data-rateit-ispreset='true' data-rateit-readonly='true' data-rateit-min='0' data-rateit-max='5'>
					</div></td>
					<td align='right' width='100%'><a><span id='nrating0'></span> lượt đánh giá</a></td></table>
				</div>
				</div>
			</div>
			</div>
		</div>";
	}
}
?>