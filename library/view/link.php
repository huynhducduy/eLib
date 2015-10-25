<?php
class link_view
{
	function show()
	{
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	global $sitemap_model,$setting;
	$domain=$setting->get('domain');
	$sitemap=$sitemap_model->sitemap;
		foreach ($sitemap as $data)
		{
			echo '<a href="http://'.$domain.$data['0'].'">http://'.$domain.$data['0'].'</a><br/>';
		}
	}
}
?>