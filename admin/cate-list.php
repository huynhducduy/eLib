<?php
$pagelv1="<link rel='stylesheet' type='text/css' href='../../assets/global/plugins/select2/select2.min.css'/>
<link rel='stylesheet' type='text/css' href='../../assets/admin/pages/css/easy-tree.min.css'/>";
$pagelv2="<script type='text/javascript' src='../../assets/global/plugins/select2/select2.min.js'></script>
<script src='../../assets/global/scripts/metronic.min.js' type='text/javascript'></script>
<script src='../../assets/admin/layout/scripts/layout.min.js' type='text/javascript'></script>
<script>
	jQuery(document).ready(function() {    
		Metronic.init();
		Layout.init();
		$('.easy-tree').EasyTree({
			addable: true,
			editable: true,
			deletable: true
		});
	});
</script>";
$title='Danh mục sách';
require_once('../assets/config.php');
require_once('./lib/header.php');
?>
	<div class="page-content-wrapper">
		<div class="page-content">
			<div class="page-head">
				<div class="page-title">
					<h1>Danh mục sách <small>Liệt kê toàn bộ danh mục sách</small></h1>
				</div>
			</div>
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="dash.php">Bảng điều khiển quản trị</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="#">Danh mục sách</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="cate-list.php">Danh sách danh mục sách</a>
				</li>
			</ul>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa icon-list font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Danh mục sách</span>
								<span class="caption-helper">Quản lí danh mục sách</span>
							</div>
							<div class="actions btn-set">
								<div class="easy-tree-toolbar"></div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
							<div class="easy-tree">
							<ul>
							<?php
							$sql='SELECT * FROM `cate1`';
							$query=@mysql_query($sql);
							while ($row=@mysql_fetch_assoc($query))
							{
								echo "<li data-type='1' data-id='".$row['id']."'>".$row['title']."
								<ul>";
								$sql2="SELECT * FROM `cate2` WHERE `id1`='".$row['id']."'";
								$query2=@mysql_query($sql2);
								while ($row2=@mysql_fetch_assoc($query2))
								{
									echo "<li data-type='2' data-id='".$row2['id']."'>".$row2['title']."</li>";
								}
								echo "</ul></li>";
							}
							?>
							</ul>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php require_once('./lib/footer.php'); ?>