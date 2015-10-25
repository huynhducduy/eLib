<?php
/*
// Require:
// acc_sidebar_controller
// acc_sidebar_view
*/
class register_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
            <li class='active'>Đăng ký</li>
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
		echo "<form class='form-horizontal' role='form' method='POST' action='' id='register' onsubmit='return register()'>
          <fieldset>
            <legend>Thông tin cá nhân</legend>
            <div class='form-group' id='namediv'>
              <label for='name' class='col-lg-4 control-label'>Họ và tên <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Tên đầy đủ' data-container='body' id='errname'></i>
              <input type='text' class='form-control' id='name'>
              </div>
			</div>
            </div>
		  <div class='form-group' id='classdiv'>
              <label for='class' class='col-lg-4 control-label'>Lớp <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Lớp hiện tại' data-container='body' id='errclass'></i>
              <input type='text' class='form-control' id='class' >
              </div>
			</div>
            </div>
		  <div class='form-group' id='birthdaydiv'>
              <label for='birthday' class='col-lg-4 control-label'>Ngày sinh <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Ngày sinh' data-container='body' id='errbirthday'></i>
              <input type='date' class='form-control' id='birthday'>
              </div>
			</div>
            </div>
            <div class='form-group' id='emaildiv'>
              <label for='email' class='col-lg-4 control-label'>Email <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Email dùng để đăng ký' data-container='body' id='erremail'></i>
              <input type='email' class='form-control' id='email'>
              </div>
			</div>
            </div>
		  <div class='form-group' id='scodediv'>
              <label for='scode' class='col-lg-4 control-label'>Mã học sinh <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Mã học sinh được cun cấp' data-container='body' id='errscode'></i>
              <input type='text' class='form-control' id='scode'>
              </div>
			</div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Mật khẩu</legend>
            <div class='form-group' id='passworddiv'>
              <label for='password' class='col-lg-4 control-label'>Mật khẩu <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Mật khẩu tài khoản' data-container='body' id='errpassword'></i>
              <input type='password' class='form-control' id='password'>
              </div>
			</div>
            </div>
            <div class='form-group' id='confirmpassworddiv'>
              <label for='confirmpassword' class='col-lg-4 control-label'>Xác nhận lại <span class='require'>*</span></label>
              <div class='col-lg-8'>
                <div class='input-icon right'>
		    <i class='fa fa-info-circle tooltips' data-original-title='Nhập lại mật khẩu' data-container='body' id='errconfirmpassword'></i>
              <input type='password' class='form-control' id='confirmpassword'>
              </div>
			</div>
            </div>
          </fieldset>
          <fieldset>
            <legend>Theo dõi <input type='checkbox' id='sub' value='sub' checked></legend>
          </fieldset>
          <div class='row'>
            <div class='col-lg-8 col-md-offset-4 padding-left-0 padding-top-20'>                        
              <button type='submit' class='btn btn-primary'><i class='fa fa-check-circle'></i>&nbsp;&nbsp;Tạo tài khoản</button>
            </div>
          </div>
		<br/>
		<div class='alert alert-success nodisplay' id='done'>
		Tạo tài khoản thành công. BQT sẽ xác minh tài khoản của bạn sớm nhất có thể
		</div>
        </form>";
	}
	function show_already_login()
	{
		echo "<br/>
		<div class='alert alert-danger'>Bạn đã có tài khoản rồi!</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_acc_sidebar();
		echo "<div class='col-md-9 col-sm-9'>
			<h1>Đăng ký</h1>
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
		$header_view->title='Đăng ký';
		$header_view->description='Đăng ký';
		$header_view->keyword='dang ky';
		$header_view->pagelv1="<link href='../../assets/global/plugins/uniform/css/uniform.default.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/uniform/jquery.uniform.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
		<script src='../../assets/global/plugins/jquery.pulsate.min.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Metronic.init();
				Layout.init();
				Layout.initUniform();
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