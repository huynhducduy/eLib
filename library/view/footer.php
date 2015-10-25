<?php
/*
// Require:
// setting
*/ 
class footer_view
{
	function show_about()
	{
		global $setting;
		echo "<div class='col-md-3 col-sm-6 pre-footer-col'>
        <h2>Về chúng tôi</h2>
        ".$setting->get('introduce')."
        </div>";
	}
	function show_info()
	{
		global $footer_controller;
		echo "<div class='col-md-3 col-sm-6 pre-footer-col'>
          <h2>Thông tin</h2>
          <ul class='list-unstyled'>";
		$info=$footer_controller->handle_info();
		foreach ($info as $data1 => $data2)
		{
            echo "<li><i class='fa fa-angle-right'></i> <a href='".$data1."'>".$data2."</a></li>";
		}
		echo "
          </ul>
        </div>";
	}
	function show_feeds()
	{
		echo "<div class='col-md-3 col-sm-6 pre-footer-col'>
        <h2 class='margin-bottom-0'>Luồng tin mới</h2>
        </div>";
	}
	function show_contact()
	{
		global $footer_controller;
		echo "<div class='col-md-3 col-sm-6 pre-footer-col'>
          <h2>Liên hệ</h2>
          <address class='margin-bottom-40'>";
		  $contact=$footer_controller->handle_contact();
		  foreach ($contact as $data1 => $data2)
		  {
			  if ($data2[1] == NULL)
			  {
				echo $data1.": ".$data2[0]."<br/>";
			  }
			  else
			  {
				echo $data1.": <a href='".$data2[1]."'>".$data2[0]."</a><br/>";
			  }
		  }
        echo "</address>
        </div>";
	}
	function show_row1()
	{
		echo "<div class='row'>";
		$this->show_about();
		$this->show_info();
		$this->show_feeds();
		$this->show_contact();
		echo "</div>";
	}
	function show_subscribe()
	{
		echo "<div class='col-md-6 col-sm-6 pull-right'>
          <div class='pre-footer-subscribe-box pull-right'>
            <h2>Đăng ký theo dõi</h2>
            <form action='../../theo-doi'>
              <div class='input-group'>
                <input type='text' placeholder='youremail@yourmail.com' class='form-control' name='email' required>
                <span class='input-group-btn'>
                  <button class='btn btn-primary' type='submit'>Theo dõi</button>
                </span>
              </div>
            </form>
          </div> 
        </div>";
	}
	function show_row2()
	{
		echo "<div class='row'>";
		$this->show_subscribe();
		echo "</div>";
	}
	function show_pre_footer()
	{
		echo "<div class='pre-footer'>
		<div class='container'>";
		$this->show_row1();
		$this->show_row2();
		echo "</div>
		</div>";
	}
	function show_footer()
	{
		echo "<div class='footer'>
		<div class='container'>
			<div class='row'>
			<!-- BEGIN COPYRIGHT -->
			<div class='col-md-6 col-sm-6 padding-top-10'>
				2015 © Huỳnh Đức Duy. All Rights Reserved. 
			</div>
			<!-- END COPYRIGHT -->
			</div>
		</div>
		</div>";
	}
	function show()
	{
		$this->show_pre_footer();
		$this->show_footer();
		echo "</body>
		</html>";
	}
}
?>