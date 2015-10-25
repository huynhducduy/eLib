<?php
/*
// Require:
// acc_sidebar_controller
// acc_sidebar_view
*/
class login_view
{
	function show_breadcrumb()
	{
		echo "<ul class='breadcrumb'>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../trang-chu'><span itemprop='title'>Trang chủ</span></a></div></li>
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href='../../tai-khoan'><span itemprop='title'>Tài khoản</span></a></div></li>
            <li class='active'>Đăng nhập</li>
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
		echo "<form class='form-horizontal form-without-legend' role='form' method='POST' action='' id='login' onsubmit='return login()'>
        <input type='hidden' id='ref' value='".$_SERVER['HTTP_REFERER']."'>
          <div class='form-group' id='scodediv'>
            <label for='scode' class='col-lg-4 control-label'>Mã học sinh <span class='require'>*</span></label>
            <div class='col-lg-8'>
		  <div class='input-icon right'>
              <i class='fa fa-info-circle tooltips' data-original-title='Mã học sinh được cung cấp' data-container='body' id='errscode'></i>
              <input type='text' class='form-control' id='scode'>
		  </div>
            </div>
          </div>
          <div class='form-group' id='passworddiv'>
            <label for='password' class='col-lg-4 control-label'>Mật khẩu <span class='require'>*</span></label>
            <div class='col-lg-8'>
		  <div class='input-icon right'>
              <i class='fa fa-info-circle tooltips' data-original-title='Mật khẩu ứng với mã học sinh đã đăng ký' data-container='body' id='errpassword'></i>
              <input type='password' class='form-control' id='password'>
		  </div>
            </div>
          </div>
		<div class='form-group'>
            <label for='remember' class='col-lg-4 control-label'></label>
            <div class='col-lg-8'>
              <input type='checkbox' id='remember' value='remember' checked> Nhớ tôi
            </div>
          </div>
          <div class='row'>
            <div class='col-lg-8 col-md-offset-4 padding-left-0'>
              <a href='../../quen-mat-khau'>Quên mật khẩu?</a>
            </div>
          </div>
          <div class='row'>
            <div class='col-lg-8 col-md-offset-4 padding-left-0 padding-top-20'>
              <button type='submit' class='btn btn-primary'><i class='fa fa-sign-in'></i>&nbsp;&nbsp;Đăng nhập</button>
            </div>
          </div>
		<br/>
		<div class='alert alert-success nodisplay' id='done'>
		Đăng nhập thành công
		</div>
          <div class='row'>
            <div class='col-lg-8 col-md-offset-4 padding-left-0 padding-top-10 padding-right-30'>
              <hr>
              <div class='login-socio'>
                  <p class='text-muted'>hoặc đăng nhập bằng (Comming soon...):</p>
                  <ul class='social-icons'>
                      <li><a href='#' data-original-title='facebook' class='facebook' title='facebook'></a></li>
                      <li><a href='#' data-original-title='Twitter' class='twitter' title='Twitter'></a></li>
                      <li><a href='#' data-original-title='Google Plus' class='googleplus' title='Google Plus'></a></li>
                      <li><a href='#' data-original-title='Linkedin' class='linkedin' title='LinkedIn'></a></li>
                  </ul>
              </div>
            </div>
          </div>
        </form>";
	}
	function show_already_login()
	{
		echo "<br/>
		<div class='alert alert-danger'>Bạn đã đăng nhập rồi!</div>";
	}
	function show_content()
	{
		echo "<div class='row margin-bottom-40'>";
		$this->show_acc_sidebar();
		echo "<div class='col-md-9 col-sm-9'>
			<h1>Đăng nhập</h1>
			<div class='content-form-page'>
				<div class='row'>
					<div class='col-md-7 col-sm-7'>";
		if ($_SESSION['userid'] == NULL) 
		{
			echo $_SESSION['userid'];
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
		$header_view->title='Đăng nhập';
		$header_view->description='Đăng nhập';
		$header_view->keyword='dang nhap';
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