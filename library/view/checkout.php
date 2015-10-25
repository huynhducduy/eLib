<?php
class checkout_view
{
	function config()
	{
		global $header_view;
		global $book_model;
		$header_view->robots='1';
		$header_view->title='Đặt sách';
		$header_view->description='Đặt sách';
		$header_view->keyword='dat sach';
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
		if ($_SESSION['userid'] != NULL)
		{
			global $checkout_model;
			if ($checkout_model->num > 0)
			{
			echo "
			<div class='main'>
			<div class='container'>
				<ul class='breadcrumb'>
					<li><a href='index.html'>Trang chủ</a></li>
					<li><a href=''>Tài khoản</a></li>
					<li class='active'>Đặt sách</li>
				</ul>
				<!-- BEGIN SIDEBAR & CONTENT -->
				<div class='row margin-bottom-40'>
				<!-- BEGIN CONTENT -->
				<div class='col-md-12 col-sm-12'>
					<h1>Đặt sách</h1>
					<!-- BEGIN CHECKOUT PAGE -->
					<form role='form' method='POST' action='' id='chkout' onsubmit='return checkout();'>
					<div class='panel-group checkout-page accordion scrollable' id='checkout-page'>
					
					<!-- BEGIN agree-term -->
					<div id='agree-term' class='panel panel-default'>
						<div class='panel-heading'>
						<h2 class='panel-title'>
							<a data-toggle='collapse' data-parent='#checkout-page' href='#agree-term-content' class='accordion-toggle'>
							Bước 0: Đồng ý với quy định của thư viện
							</a>
						</h2>
						</div>
						<div id='agree-term-content' class='panel-collapse collapse in'>
						<div class='panel-body row'>
							<div class='col-md-12'>
							<h4>Quy định của thư viện</h4>
							<div class='form-group'>
								<div style='border: solid 1px #DBDBDB; padding: 6px 0px 6px 6px;'>
									<ul class='scroller' style='height: 250px; overflow: hidden; width: auto;'>
									".$checkout_model->term."
									</ul>
								</div>
							</div>
							<button class='btn btn-primary pull-right' type='button' id='button-payment-method' data-toggle='collapse' data-parent='#checkout-page' data-target='#confirm-password-content'>Tiếp tục</button>
							<div class='checkbox pull-right' style='margin-right: 10px;'>
								<label id='agree-term-checkbox'>
								<input type='checkbox' name='agree-term-value' value='1'> Tôi đã đọc và đồng ý với quy định của thư viện
								</label>
							</div>  
							</div>
						</div>
						</div>
					</div>
					<!-- END agree-term -->
		
					<!-- BEGIN confirm-password -->
					<div id='confirm-password' class='panel panel-default'>
						<div class='panel-heading'>
						<h2 class='panel-title'>
							<a data-toggle='collapse' data-parent='#checkout-page' href='#confirm-password-content' class='accordion-toggle'>
							Bước 1: Xác nhận mật khẩu
							</a>
						</h2>
						</div>
						<div id='confirm-password-content' class='panel-collapse collapse'>
						<div class='panel-body row'>
							<div class='col-md-12'>
							<div class='form-group' id='passdiv'>
								<label for='password'>Mật khẩu <span class='require'>*</span></label>
								<div class='input-icon right'>
								<i class='fa fa-info-circle tooltips' data-original-title='Mật khẩu của tài khoản' data-container='body' id='errpass'></i>
								<input type='password' id='pass' class='form-control' id='pass'>
								</div>
							</div>
							<button class='btn btn-primary  pull-right' type='button' data-toggle='collapse' data-parent='#checkout-page' data-target='#confirm-info-content' id='button-payment-address'>Tiếp tục</button>                      
							</div>
						</div>
						</div>
					</div>
					<!-- END confirm-password -->
		
					<!-- BEGIN confirm-info -->
					<div id='confirm-info' class='panel panel-default'>
						<div class='panel-heading'>
						<h2 class='panel-title'>
							<a data-toggle='collapse' data-parent='#checkout-page' href='#confirm-info-content' class='accordion-toggle'>
							Bước 2: Xác nhận thông tin
							</a>
						</h2>
						</div>
						<div id='confirm-info-content' class='panel-collapse collapse'>
						<div class='panel-body row'>
							<div class='col-md-12'>
							<div class='form-group'>
								<label for='password'>Họ và tên </label>
								<input type='text' class='form-control' value='".$checkout_model->info['name']."' readonly>
							</div>
							<div class='form-group'>
								<label for='password'>Email </label>
								<input type='text' class='form-control' value='".$checkout_model->info['email']."' readonly>
							</div>
							<div class='form-group'>
								<label for='password'>Lớp </label>
								<input type='text' class='form-control' value='".$checkout_model->info['class']."' readonly>
							</div>
							<div class='form-group'>
								<label for='password'>Ngày sinh </label>
								<input type='text' class='form-control' value='".$checkout_model->info['birthday']."' readonly>
							</div>
							<div class='form-group'>
								<label for='password'>Mã học sinh </label>
								<input type='text' class='form-control' value='".$checkout_model->info['scode']."' readonly>
							</div>
							<button class='btn btn-primary  pull-right' type='button' data-toggle='collapse' data-parent='#checkout-page' data-target='#borrow-method-content' id='button-payment-address'>Tiếp tục</button>                      
							<div class='checkbox pull-right' style='margin-right: 10px;'>
								<label id='confirm-info-checkbox'>
								<input type='checkbox' name='confirm-info-value' value='1'> Thông tin này chính xác
								</label>
							</div>
							</div>
						</div>
						</div>
					</div>
					<!-- END confirm-info -->
		
					<!-- BEGIN borrow-method -->
					<div id='borrow-method' class='panel panel-default'>
						<div class='panel-heading'>
						<h2 class='panel-title'>
							<a data-toggle='collapse' data-parent='#checkout-page' href='#borrow-method-content' class='accordion-toggle'>
							Bước 3: Chọn hình thức mượn
							</a>
						</h2>
						</div>
						<div id='borrow-method-content' class='panel-collapse collapse'>
						<div class='panel-body row'>
							<div class='col-md-12'>
							<h4>Hình thức mượn</h4>
							<div class='radio-list' id='borrow-method-radio'>
								<label>
								<input type='radio' name='borrow-method-value' value='1'/> Đọc tại chỗ <br/>
								</label>
								<label>
								<input type='radio' name='borrow-method-value' value='2'/> Mượn về
								</label>
							</div>
							<div class='form-group'>
								<h4>Ghi chú</h4>
								<textarea id='borrow-note' rows='8' class='form-control'></textarea>
							</div>
							<button class='btn btn-primary  pull-right' type='button' id='button-shipping-method' data-toggle='collapse' data-parent='#checkout-page' data-target='#confirm-content'>Tiếp tục</button>
							</div>
						</div>
						</div>
					</div>
					<!-- END borrow-method -->
		
					<!-- BEGIN CONFIRM -->
					<div id='confirm' class='panel panel-default'>
						<div class='panel-heading'>
						<h2 class='panel-title'>
							<a data-toggle='collapse' data-parent='#checkout-page' href='#confirm-content' class='accordion-toggle'>
							Bước 4: Xác nhận giỏ sách
							</a>
						</h2>
						</div>
						<div id='confirm-content' class='panel-collapse collapse'>
						<div class='panel-body row'>
							<div class='col-md-12 clearfix'>
							<div class='table-wrapper-responsive'>
								<table summary='shopping cart'>
									<tbody>
									<tr>
										<th class='checkout-image'>Hình ảnh</th>
										<th class='checkout-title'>Tên sách</th>
										<th class='checkout-description' colspan='2'>Mô tả</th>
									</tr>";
									$result=$checkout_model->cart;
									foreach ($result as $data)
									{
										echo "<tr id='cart14".$data['id']."'>
											<td class='checkout-image'>
												<a href='../../".sf($data['title'],0).".".$data['id'].".html'><img src='../../135x180/".$data['img1']."'></a>
											</td>
											<td class='checkout-description'>
												<h3><a href='../../".sf($data['title'],0).".".$data['id'].".html'>".$data['title']."</a></h3>
											</td>
											<td class='checkout-description'>
												<em>".$data['des']."</em>
											</td>
										</tr>";
									}
									echo "
									</tbody>
								</table>
							</div>
							<div class='checkout-total-block'>
								<ul>
								<li class='checkout-total-price'>
									<em>Số sách</em>
									<strong class='price'>".$checkout_model->num." <span>Cuốn</span></strong>
								</li>
								</ul>
							</div>
							<div class='clearfix'></div>
							<button class='btn btn-primary pull-right' type='submit' id='button-confirm'>Xác nhận đặt sách</button>
							<button type='button' class='btn btn-default pull-right margin-right-20'>Hủy</button>
							</div>
						</div>
						</div>
					</div>
					<!-- END CONFIRM -->
					</div>
					</form>
					<!-- END CHECKOUT PAGE -->
				</div>
				<!-- END CONTENT -->
				</div>
				<!-- END SIDEBAR & CONTENT -->
			</div>
			</div>
			";
			}
			else
			{
				echo '
				<div class="main">
				<div class="container">
					<ul class="breadcrumb">
						<li><a href="index.html">Trang chủ</a></li>
						<li><a href="">Tài khoản</a></li>
						<li class="active">Đặt sách</li>
					</ul>
					<!-- BEGIN SIDEBAR & CONTENT -->
					<div class="row margin-bottom-40">
					<!-- BEGIN CONTENT -->
					<div class="col-md-12 col-sm-12">
						<h1>Đặt sách</h1>
						<!-- BEGIN CHECKOUT PAGE -->
							<p>Bạn không có sách nào trong giỏ sách, không thể đặt sách</p>
						<!-- END CHECKOUT PAGE -->
					</div>
					<!-- END CONTENT -->
					</div>
					<!-- END SIDEBAR & CONTENT -->
				</div>
				</div>
				';
			}
		}
		else
		{
			echo '
			<div class="main">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.html">Trang chủ</a></li>
					<li><a href="">Tài khoản</a></li>
					<li class="active">Đặt sách</li>
				</ul>
				<!-- BEGIN SIDEBAR & CONTENT -->
				<div class="row margin-bottom-40">
				<!-- BEGIN CONTENT -->
				<div class="col-md-12 col-sm-12">
					<h1>Đặt sách</h1>
					<!-- BEGIN CHECKOUT PAGE -->
						<p>Bạn chưa đăng nhập, không thể đặt sách</p>
					<!-- END CHECKOUT PAGE -->
				</div>
				<!-- END CONTENT -->
				</div>
				<!-- END SIDEBAR & CONTENT -->
			</div>
			</div>
			';
		}
	}
}
?>