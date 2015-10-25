<?php
class contact_view
{
	function config()
	{
		global $header_view;
		global $book_model;
		$header_view->title='Liên hệ';
		$header_view->description='Liên hệ';
		$header_view->keyword='lien he';
		$header_view->pagelv1="<link href='../../assets/global/plugins/uniform/css/uniform.default.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/uniform/jquery.uniform.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
		<script src='http://maps.google.com/maps/api/js?sensor=true' type='text/javascript'></script>
   		<script src='../../assets/global/plugins/gmaps/gmaps.js' type='text/javascript'></script>
		<script type='text/javascript'>
			jQuery(document).ready(function() {
				Metronic.init();
				Layout.init();
				Layout.initUniform();
			  	map = new GMaps({
				div: '#map',
	            lat: 16.057911,
				lng: 108.233059,
			  	});
			  	 var marker = map.addMarker({
		            lat: 16.057911,
					lng: 108.233059,
		            title: 'Trường THPT Chuyên Lê Quý Đôn',
		            infoWindow: {
		                content: '<div style=margin-left:22px><center style=margin-bottom:5px><img width=60px style=margin-bottom:5px src=https://scontent-sjc2-1.xx.fbcdn.net/hphotos-xfp1/v/t1.0-9/10696217_959567747393142_3237873046401344554_n.jpg?oh=39d1afe2ee8c682c279cc2d30e4b941d&oe=561C079C><br/><b>Trường THPT Chuyên Lê Quý Đôn</b></center>01 Vũ Văn Dũng, An Hải Tây, Sơn Trà, Đà Nẵng, Việt Nam</div>'
		            }
		        });
			   	marker.infoWindow.open(map, marker);
			});
		</script>";
	}
	function show()
	{
		global $setting;
	?>
	<script>
	function sendMess()
	{
		bootbox.alert('Gửi thành công!');
		return false;
	}
	</script>
	<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href="../../trang-chu"><span itemprop='title'>Trang chủ</span></a></div></li>
            <li class="active">Liện hệ</li>
        </ul>
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <h1>Liên hệ</h1>
            <div class="content-page">
              <div class="row">
                <div class="col-md-12">
                  <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
                </div>
                <div class="col-md-9 col-sm-9">
                  <h2>Gửi thông điệp</h2>
                  <p>Nếu muốn liên hệ với BQT thư viện, bạn có thể gửi ở dưới đây.</p>
                  <!-- BEGIN FORM-->
                  <form role="form" onsubmit='return sendMess();'>
                    <div class="form-group">
                      <label for="contacts-name">Tên</label>
                      <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                      <label for="contacts-email">Email</label>
                      <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                      <label for="contacts-message">Thông điệp</label>
                      <textarea class="form-control" rows="5" id="message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>&nbsp;&nbsp;Gửi</button>
                  </form>
                  <!-- END FORM-->
                </div>
                <div class="col-md-3 col-sm-3 sidebar2">
                  <h2>Thông tin liên hệ</h2>
                  <address>
                    <strong>Địa chỉ: </strong><?php echo $setting->get('admin_address'); ?><br/>
                    <strong>Điện thoại: </strong><?php echo $setting->get('admin_phone'); ?>
                  </address>
                  <address>
                    <strong>Email: </strong><a href="mailto:<?php echo $setting->get('admin_email'); ?>"><?php echo $setting->get('admin_email'); ?></a><br/>
                    <strong>Skype: </strong><a href="skype:<?php echo $setting->get('admin_skype'); ?>"><?php echo $setting->get('admin_skype'); ?></a><br/>
                    <strong>Yahoo!: </strong><a href="yahoo:<?php echo $setting->get('admin_yahoo'); ?>"><?php echo $setting->get('admin_yahoo'); ?></a><br/>
                  </address>
                  <h2 class="padding-top-30">Về chúng tôi</h2>
                  <p><?php echo $setting->get('introduce'); ?></p>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
      </div>
    </div>
	<?php
	}
}
?>