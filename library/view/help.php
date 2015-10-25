<?php
class help_view
{
	function config()
	{
		global $header_view;
		global $book_model;
		$header_view->title='Trợ giúp';
		$header_view->description='Trợ giúp';
		$header_view->keyword='tro giup';
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
		global $help_model;
		?>
		<div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><div itemscope itemtype='http://data-vocabulary.org/Breadcrumb'><a itemprop='url' href="../../trang-chu"><span itemprop='title'>Trang chủ</span></a></div></li>
            <li class="active">Trợ giúp</li>
        </ul>
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h1>Những câu hỏi thường gặp</h1>
            <div class="content-page">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="tab-content" style="padding:0; background: #fff;">
        <?php
        $help=$help_model->help;
        $i=0;
        foreach ($help as $data)
        {
        	$i++;
	        echo '<div class="panel panel-default" style="margin-bottom:10px">
	           <div class="panel-heading">
	              <h4 class="panel-title">
	                 <a href="#accor'.$i.'" data-toggle="collapse" class="accordion-toggle">
	                 '.$i.'. '.$data['title'].' 
	                 </a>
	              </h4>
	           </div>
	           <div class="panel-collapse collapse';
	        if ($i === 1) echo 'in';
	        echo '" id="accor'.$i.'">
	              <div class="panel-body">
	              	'.$data['content'].'
	              </div>
	           </div>
	        </div>';
   		}
        ?>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
		<?php
	}
}
?>