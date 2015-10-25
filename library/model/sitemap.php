<?php
class sitemap_model
{
	var $sitemap;
	function __construct()
	{
		$this->get_sitemap();
	}
	function get_sitemap()
	{
		$this->sitemap[]=['/trang-chu','daily','1.00'];
		$this->get_sitemap_book();
		$this->get_sitemap_booklist();
		$this->sitemap[]=['/lien-he','monthly','0.70'];
		$this->sitemap[]=['/tro-giup','monthly','0.70'];
		$this->sitemap[]=['/quy-dinh','yearly','0.70'];
		$this->sitemap[]=['/dang-nhap','monthly','0.65'];
		$this->sitemap[]=['/dang-ky','monthly','0.65'];
		$this->sitemap[]=['/quen-mat-khau','monthly','0.65'];
		$this->get_sitemap_contributed();
		$this->get_sitemap_requested();
		$this->sitemap[]=['/tim-kiem','monthly','0.55'];
		$this->sitemap[]=['/theo-doi','monthly','0.50'];
		$this->sitemap[]=['/huy-theo-doi','monthly','0.50'];
	}
	function get_sitemap_book()
	{
		global $database;
		$book=$database->clear_param()->select(array('id','title'),'book')->fetch();
		foreach ($book as $data)
		{
			$this->sitemap[]=['/'.sf($data['title'],0).'.'.$data['id'].'.html','daily','0.90'];
		}
	}
	function get_sitemap_booklist()
	{
		global $database;
		$cate1 = $database->clear_param()->select(array('id','title'),'cate1')->fetch();
		foreach ($cate1 as $data1)
		{
			$this->sitemap[]=['/'.sf($data1['title'],0).'.'.$data1['id'],'weekly','0.80'];
			$id_list=[];
			$cate2=$database->clear_param()->select(array('id','title'),'cate2')->where(array('id1' => array('=',$data1['id'])))->fetch();
			foreach ($cate2 as $data2)
			{
				$this->sitemap[]=['/'.sf($data1['title'],0).'/'.sf($data2['title'],0).'.'.$data2['id'],'weekly','0.80'];
				$id_list[]=$data2['id'];
				$num2=$database->clear_param()->select(array('id'),'book')->where(['cid' => ['=',$data2['id']]])->num_rows();
				$page2=ceil($num2/12);
				if ($page2>1)
				{
					for ($i2=1;$i2<=$page2;$i2++)
					{
						$this->sitemap[]=['/'.sf($data1['title'],0).'/'.sf($data2['title'],0).'.'.$data2['id'].'/trang-'.$i2,'weekly','0.80'];
					}
				}
			}
			$num=$database->clear_param()->select(array('id'),'book')->where(['cid' => ['IN',$id_list]])->num_rows();
			$page=ceil($num/12);
			if ($page>1)
			{
				for ($i=1;$i<=$page;$i++)
				{
					$this->sitemap[]=['/'.sf($data1['title'],0).'.'.$data1['id'].'/trang-'.$i,'weekly','0.80'];
				}
			}
		}
	}
	function get_sitemap_contributed()
	{
		global $database;
		$this->sitemap[]=['/sach-duoc-dong-gop','weekly','0.60'];
		$result=$database->clear_param()->select(array('idb'),'contribute')->where(['status'=>['=','2']])->fetch();
		foreach ($result as $data)
		{
			$id_list[]=$data['idb'];
		}
		$num=$database->clear_param()->select(array('id'),'book')->where(array('id' => array('IN',$this->id_list)))->num_rows();
		if ($page>1)
		{
			for ($i=1;$i<=$page;$i++)
			{
				$this->sitemap[]=['/sach-duoc-dong-gop/trang-'.$i,'weekly','0.60'];
			}
		}
	}
	function get_sitemap_requested()
	{
		global $database;
		$this->sitemap[]=['/sach-duoc-yeu-cau','weekly','0.60'];
		$result=$database->clear_param()->select(array('idb'),'request')->where(['status'=>['=','2']])->fetch();
		foreach ($result as $data)
		{
			$id_list[]=$data['idb'];
		}
		$num=$database->clear_param()->select(array('id'),'book')->where(array('id' => array('IN',$this->id_list)))->num_rows();
		if ($page>1)
		{
			for ($i=1;$i<=$page;$i++)
			{
				$this->sitemap[]=['/sach-duoc-yeu-cau/trang-'.$i,'weekly','0.60'];
			}
		}
		
	}
}
?>