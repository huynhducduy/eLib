<?php
class sitemap_view
{
	function show()
	{
	header("Content-type: application/xml");  
	?><?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9  http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"><?php
	global $sitemap_model,$setting;
	$domain=$setting->get('domain');
	$sitemap=$sitemap_model->sitemap;
	$now=getdate();
	if (strlen($now['mon']) < 2)
	{
		$now['mon']='0'.$now['mon'];
	}
	if (strlen($now['mday']) < 2)
	{
		$now['mday']='0'.$now['mday'];
	}
	$date=$now["year"]."-".$now["mon"]."-".$now["mday"]; 
	foreach ($sitemap as $data)
	{
		echo '<url><loc>http://'.$domain.$data['0'].'</loc><changefreq>'.$data['1'].'</changefreq><priority>'.$data['2'].'</priority><lastmod>'.$date.'</lastmod></url>';
 	}
	?></urlset><?php
	}
}
?>