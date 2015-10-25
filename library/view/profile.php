<?php
/*
// Require:
// acc_sidebar_controller
// acc_sidebar_view
// profile_model
*/
class profile_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
            <li class='active'>Xem thông tin cá nhân</li>
        </ul>";
	}
	function show_acc_sidebar()
	{
		global $acc_sidebar_view;
		$acc_sidebar_view->show();
		
	}
	function show_form_info()
	{
		global $form_info_view;
		$form_info_view->show();
		
	}
	function show_main_content()
	{
		global $profile_model;
		$data=$profile_model->get();
		echo "<form class='form-horizontal form-without-legend' role='form' method='POST' action='' id='chpass'>
          <div class='form-group'>
            <label for='name' class='col-lg-4 control-label'>Họ và tên</span></label>
            <div class='col-lg-8'>
              <input type='text' class='form-control' id='name' value='".$data['name']."' readonly>
            </div>
          </div>
          <div class='form-group'>
            <label for='email' class='col-lg-4 control-label'>Email</span></label>
            <div class='col-lg-8'>
              <input type='text' class='form-control' id='email' value='".$data['email']."' readonly>
            </div>
          </div>
          <div class='form-group'>
            <label for='class' class='col-lg-4 control-label'>Lớp</span></label>
            <div class='col-lg-8'>
              <input type='text' class='form-control' id='class' value='".$data['class']."' readonly>
            </div>
          </div>
		<div class='form-group'>
            <label for='birthday' class='col-lg-4 control-label'>Ngày sinh</span></label>
            <div class='col-lg-8'>
              <input type='text' class='form-control' id='birthday' value='".$data['birthday']."' readonly>
            </div>
          </div>
		<div class='form-group'>
            <label for='scode' class='col-lg-4 control-label'>Mã học sinh</span></label>
            <div class='col-lg-8'>
              <input type='text' class='form-control' id='scode' value='".$data['scode']."' readonly>
            </div>
          </div>
        </form>";
	}
	function show_require_login()
	{
		echo "<br/>
		<div class='alert alert-danger'>Bạn phải đăng nhập để xem thông tin cá nhân!</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_acc_sidebar();
		echo "<div class='col-md-9 col-sm-9'>
			<h1>Xem thông tin cá nhân</h1>
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
		$header_view->title='Xem thông tin cá nhân';
		$header_view->description='Xem thông tin cá nhân';
		$header_view->keyword='xem thong tin ca nhan';
		$header_view->pagelv2="<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
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