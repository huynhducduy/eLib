<?php
/*
// Require:
// acc_sidebar_controller
// acc_sidebar_view
*/
class forgot_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
            <li class='active'>Quên mật khẩu</li>
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
		echo "<form class='form-horizontal form-without-legend' role='form' method='POST' action='' id='forgot' onsubmit='return forgot()'>                    
          <div class='form-group' id='emaildiv'>
            <label for='email' class='col-lg-4 control-label'>Email</label>
            <div class='col-lg-8'>
              <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Email đã dùng để đăng ký' data-container='body' id='erremail'></i>
              <input type='text' class='form-control' id='email'>
			</div>
            </div>
          </div>
          <div class='row'>
            <div class='col-lg-8 col-md-offset-4 padding-left-0 padding-top-5'>
              <button type='submit' class='btn btn-primary'><i class='fa fa-envelope'></i>&nbsp;&nbsp;Gửi</button>
            </div>
          </div>
		<br/>
		<div class='alert alert-success nodisplay' id='done'>
		Lấy lại mật khẩu thành công, mật khẩu mới đã được gửi tới email của bạn
		</div>
        </form>";
	}
	function show_already_login()
	{
		echo "<br/>
		<div class='alert alert-danger'>Bạn có chắc là đã quên mật khẩu ?!</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_acc_sidebar();
		echo "<div class='col-md-9 col-sm-9'>
			<h1>Quên mật khẩu</h1>
			<div class='content-form-page'>
				<div class='row'>
					<div class='col-md-7 col-sm-7'>";
		if ($_SESSION['userid'] == NULL) 
		{
			$this->show_main_content();
		}
		else
		{
			$this->show_already_login();
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
		$header_view->title='Quên mật khẩu';
		$header_view->description='Quên mật khẩu';
		$header_view->keyword='quen mat khau';
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