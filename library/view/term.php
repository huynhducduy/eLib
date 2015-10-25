<?php
class term_view
{
	function config()
	{
		global $header_view;
		global $book_model;
		$header_view->title='Quy định';
		$header_view->description='Quy định';
		$header_view->keyword='quy dinh';
		$header_view->pagelv1="<link href='../../assets/global/plugins/uniform/css/uniform.default.min.css' rel='stylesheet' type='text/css'>";
		$header_view->pagelv2="<script src='../../assets/global/plugins/uniform/jquery.uniform.min.js' type='text/javascript'></script>
		<script src='../../assets/frontend/layout/scripts/layout.min.js' type='text/javascript'></script>
		<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
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
		global $term_model;
		echo '<div class="main">
		<div class="container">
			<ul class="breadcrumb">
				<li><div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="../../trang-chu"><span itemprop="title">Trang chủ</span></a></div></li>
				<li class="active">Quy định</li>
			</ul>
			<!-- BEGIN SIDEBAR & CONTENT -->
			<div class="row margin-bottom-40">
			<!-- BEGIN CONTENT -->
			<div class="col-md-12 col-sm-12">
			<h1>Quy định của thư viện</h1>
			<div class="content-form-page">
				<!-- BEGIN term PAGE -->
					<p>'.$term_model->term.'</p>
				<!-- END term PAGE -->
			</div>
			</div>
			<!-- END CONTENT -->
			</div>
			<!-- END SIDEBAR & CONTENT -->
		</div>
		</div>';
	}
}
?>