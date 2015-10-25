<?php
/*
// Require:
// acc_sidebar_controller
// acc_sidebar_view
*/
class change_pass_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
            <li class='active'>Đổi mật khẩu</li>
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
		echo "<form class='form-horizontal form-without-legend' role='form' method='POST' action='' id='chpass' onsubmit='return changepass()'>
          <div class='form-group' id='pass1div'>
            <label for='pass1' class='col-lg-4 control-label'>Mật khẩu <span class='require'>*</span></label>
            <div class='col-lg-8'>
		  <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Mật khẩu hiện tại' data-container='body' id='errpass1'></i>
              <input type='password' class='form-control' id='pass1'>
		  </div>
            </div>
          </div>
          <div class='form-group' id='passworddiv'>
            <label for='password' class='col-lg-4 control-label'>Mật khẩu mới <span class='require'>*</span></label>
            <div class='col-lg-8'>
		  <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Mật khẩu mới' data-container='body' id='errpassword'></i>
              <input type='password' class='form-control' id='password'>
            </div>
		  </div>
          </div>
		<div class='form-group' id='confirmpassworddiv'>
              <label for='confirmpassword' class='col-lg-4 control-label'>Xác nhận lại <span class='require'>*</span></label>
              <div class='col-lg-8'>
			<div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Nhập lại mật khẩu mới' data-container='body' id='errconfirmpassword'></i>
                <input type='password' class='form-control' id='confirmpassword'>
              </div>
			</div>
            </div>
          <div class='row'>
            <div class='col-lg-8 col-md-offset-4 padding-left-0 padding-top-5'>
              <button type='submit' class='btn btn-primary'><i class='fa fa-lock'></i>&nbsp;&nbsp;Đổi mật khẩu</button>
            </div>
          </div>
		<br/>
		<div class='alert alert-success nodisplay' id='done'>
		Đổi mật khẩu thành công
		</div>
        </form>";
	}
	function show_not_login()
	{
		echo "<br/>
		<div class='alert alert-danger'>Bạn chưa đăng nhập, không thể đổi mật khẩu!</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_acc_sidebar();
		echo "<div class='col-md-9 col-sm-9'>
			<h1>Đổi mật khẩu</h1>
			<div class='content-form-page'>
				<div class='row'>
					<div class='col-md-7 col-sm-7'>";
		if ($_SESSION['userid'] != NULL) 
		{
			$this->show_main_content();
		}
		else
		{
			$this->show_not_login();
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
		$header_view->title='Đổi mật khẩu';
		$header_view->description='Đổi mật khẩu';
		$header_view->keyword='doi mat khau';
		$header_view->pagelv2="<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Metronic.init();
				Layout.init();
			});
		</script";
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