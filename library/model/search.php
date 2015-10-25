<?php
class search_model
{
	var $record;
	var $key = 'AIzaSyCVAXiUzRYsML1Pv6RwSG1gunmMikTzQqY';
	var $cx = '009233608606446996455:gxkfopg7xg4';
	function __construct()
	{
		$this->get_key_cx();
		$this->set_record();
	}
	function get_key_cx()
	{
		global $setting;
		$this->key=$setting->get('gkey');
		$this->cx=$setting->get('gcseid');
	}
	function set_record()
	{
		if ($_GET['q'] != '')
		{
		$url='https://www.googleapis.com/customsearch/v1element?prettyPrint=false&key='.$this->key.'&cx='.$this->cx.'&q='.rawurlencode($_GET['q']);
		//$url2='https://www.googleapis.com/customsearch/v1?key='.$this->key.'&cx='.$this->cx.'&q='.rawurlencode($_GET['q']);
		$result = json_decode(file_get_contents($url),true);
		$this->record=$result['cursor']['estimatedResultCount'];
		//$this->record=$result['searchInformation']['totalResults'];
		}
	}
	function get_data($start)
	{
		if ($_GET['q'] != '')
		{
		$url='https://www.googleapis.com/customsearch/v1element?prettyPrint=false&key='.$this->key.'&cx='.$this->cx.'&q='.rawurlencode($_GET['q']).'&start='.$start;
		//$url2='https://www.googleapis.com/customsearch/v1?key='.$this->key.'&cx='.$this->cx.'&q='.rawurlencode($_GET['q']).'&start='.$start;
		$result = json_decode(@file_get_contents($url),true);
		foreach ($result['results'] as $data)
		{
			$c++;
			$result2[$c]['url']=$data['formattedUrl'];
			$result2[$c]['des']=$data['content'];
			$result2[$c]['title']=$data['title'];
			$result2[$c]['link']=$data['url'];
			$image_header = @get_headers($data['richSnippet']['cseThumbnail']['src']);
			if(strpos($headers[0],'404') === false)
			{
				$result2[$c]['image']=$data['richSnippet']['cseThumbnail']['src']; //$data['richSnippet']['cseImage']['src'];
			}
		}
		/*foreach ($result['items'] as $data)
		{
			$c++;
			$result2[$c]['url']=$data['htmlFormattedUrl'];
			$result2[$c]['des']=$data['htmlSnippet'];
			$result2[$c]['link']=$data['link'];
			$image_header = @get_headers($data['pagemap']['cse_thumbnail'][0]['src']);
			if(strpos($headers[0],'404') === false)
			{
				$result2[$c]['image']=$data['pagemap']['cse_thumbnail'][0]['src']; //$data['pagemap']['cse_image'][0]['src'];
			}
			$result2[$c]['title']=$data['htmlTitle'];
		}*/
		return $result2;
		}
	}
}
?>