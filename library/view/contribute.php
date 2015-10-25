<?php
/*
// Require:
// resource_sidebar_controller
// resource_sidebar_view
*/
class contribute_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-nguyen'><span itemprop='title'>Tài nguyên</span></a></div></li>
            <li class='active'>Đóng góp sách</li>
        </ul>";
	}
	function show_resource_sidebar()
	{
		global $resource_sidebar_view;
		$resource_sidebar_view->show();
		
	}
	function show_form_info()
	{
		global $form_info_view;
		$form_info_view->show();
		
	}
	function show_main_content()
	{
		echo "<form class='form-horizontal form-without-legend' role='form' method='POST' action='' id='request' onsubmit='return contribute()' enctype='multipart/form-data'>
                    <div class='form-group' id='titlediv'>
                      <label for='title' class='col-lg-4 control-label'>Tên sách <span class='require'>*</span></label>
                      <div class='col-lg-8'>
					  <div class='input-icon right'>
                        <i class='fa fa-info-circle tooltips' data-original-title='Tên sách bạn muốn đóng góp cho thư viện' data-container='body' id='errtitle'></i>
                        <input type='text' class='form-control' id='title' name='title'>
					  </div>
                      </div>
                    </div>
                    <div class='form-group' id='authordiv'>
                      <label for='author' class='col-lg-4 control-label'>Tác giả <span class='require'>*</span></label>
                      <div class='col-lg-8'>
					  <div class='input-icon right'>
                        <i class='fa fa-info-circle tooltips' data-original-title='Tác giả của cuốn sách' data-container='body' id='errauthor'></i>
                        <input type='text' class='form-control' id='author' name='author'>
					  </div>
                      </div>
                    </div>
					<div class='form-group' id='imagediv'>
                      <label for='image' class='col-lg-4 control-label'>Hình ảnh</label>
					  <div class='col-lg-8'>
					  <select class='form-control' id='imagemethod' name='imagemethod' onchange='changeimagemethod()' style='float:left;width:20%;padding-left: 2px;'>
                      <option value='1' selected>File</option>
                      <option value='2'>Link</option>
					  <option value='3'>No</option>
					  </select>
					  <div class='input-icon right' style='float: right; width: 78%;'>
                        <i class='fa fa-info-circle tooltips' data-original-title='Hình ảnh của cuốn sách mà bạn muốn đóng góp' data-container='body' id='errimage'></i>
                        <input type='file' class='form-control' name='image' id='image' style='padding-left: 5px;padding-top: 5px;'>
					  </div>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-8 col-md-offset-4 padding-left-0'>
                        <a href='../../yeu-cau-sach'>Bạn muốn yêu cầu sách ở thư viện?</a>
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-lg-8 col-md-offset-4 padding-left-0 padding-top-20'>
                        <button type='submit' class='btn btn-primary'><i class='fa fa-share-square'></i>&nbsp;&nbsp;Đóng góp</button>
                      </div>
                    </div>
					<br/>
					<div class='alert alert-success nodisplay' id='done'>
					Yêu cầu sách thành công, ban quản trị sẽ xem xét và liên hệ với bạn sớm nhất có thể.
					</div>
                  </form>";
	}
	function show_require_login()
	{
		echo "<br/>
		<div class='alert alert-danger'>Bạn phải đăng nhập để đóng góp sách!</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_resource_sidebar();
		echo "<div class='col-md-9 col-sm-9'>
			<h1>Đóng góp sách</h1>
			<div class='content-form-page'>
				<div class='row'>
					<div class='col-md-7 col-sm-7'>";
		if ($_SESSION['userid'] != NULL) 
		{
			$this->show_main_content();
		}
		else
		{
			$this->show_require_login();
		}
		echo "</div>";
		$this->show_form_info();
		echo "
					</div>
				</div>
			</div>
		</div>";
	}
	function config()
	{
		global $header_view;
		$header_view->robots='1';
		$header_view->title='Đóng góp sách';
		$header_view->description='Đóng góp sách';
		$header_view->keyword='dong gop sach';
		$header_view->pagelv2="<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Metronic.init();
				Layout.init();
			});
		</script>";
	}
	function show()
	{
		echo "
		<div class='main'>
			<div class='container'>";
		$this->show_breadcrumb();
		$this->show_content();
		echo "
			</div>
		</div>";
	}
}
?>