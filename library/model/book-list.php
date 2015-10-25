<?php
class book_list_model
{
	var $error;
	var $record;
	var $type;
	var $c;
	var $cate1;
	var $cate2;
	function __construct()
	{
		$this->check_error();
		$this->set_record();
		$this->set_cate_info();
	}
	function check_error()
	{
		global $check;
		global $database;
		if (isset($_GET['c2']) && $check->number($_GET['c2'])) 
		{
			if($database->clear_param()->select(array('*'),'cate2')->where(array ('id' => array('=',$_GET['c2'])))->num_rows() == 0)
			{
				$this->error=1; 
			}
			else
			{
				$this->type=2;
				$this->c=$_GET['c2'];
			}
		}
		else if (isset($_GET['c1']) && is_number($_GET['c1']))
		{
			if($database->clear_param()->select(array('*'),'cate1')->where(array ('id' => array('=',$_GET['c1'])))->num_rows() == 0)
			{
				$this->error=1; 
			}
			else
			{
				$this->type=1;
				$this->c=$_GET['c1'];
			}
		}
		else 
		{
			$this->error=1;
		}
	}
	function set_record()
	{
		global $database;
		global $check;
		if ($this->type == 2)
		{
			$where = array ('cid' => array('=',$this->c));
		}
		else if ($this->type == 1)
		{
			$id_list = array();
			$result = $database->clear_param()->select(array('*'),'cate2')->where(array('id1' => array('=',$this->c)))->fetch();
			foreach ($result as $data)
			{
				$id_list[] = $data['id'];
			}			
			$where = array ('cid' => array('IN',$id_list));
		}
		//////// Check Tùy chọn /////////////////////////////////////////////////////////////
		if (($_GET['conSach'] == 'on') && ($_GET['hetSach'] == NULL)) 
		{
			$where['remain'] = array('>',0);
		} else if (($_GET['conSach'] == NULL) && ($_GET['hetSach'] == 'on')) 
		{
			$where['remain'] = array('=',0);
		}
		if (($_GET['coTheDocThu'] == 'on') && ($_GET['khongTheDocThu'] == NULL)) 
		{
			$where['proofread'] = array('!=','');
		} else if (($_GET['coTheDocThu'] == NULL) && ($_GET['khongTheDocThu'] == 'on')) 
		{
			$where['proofread'] = array('=','');
		}
		if (($_GET['tiengViet'] == 'on') && ($_GET['tiengAnh'] == 'on') && ($_GET['ngonNguKhac'] == NULL)) 
		{
			$where['lang'] = array('!=','0');
		} else if (($_GET['tiengViet'] == 'on') && ($_GET['tiengAnh'] == NULL) && ($_GET['ngonNguKhac'] == 'on')) 
		{
			$where['lang'] = array('!=','2');
		} else if (($_GET['tiengViet'] == NULL) && ($_GET['tiengAnh'] == 'on') && ($_GET['ngonNguKhac'] == 'on')) 
		{
			$where['lang'] = array('!=','1');
		} else if (($_GET['tiengViet'] == 'on') && ($_GET['tiengAnh'] == NULL) && ($_GET['ngonNguKhac'] == NULL)) 
		{
			$where['lang'] = array('=','1');
		} else if (($_GET['tiengViet'] == NULL) && ($_GET['tiengAnh'] == NULL) && ($_GET['ngonNguKhac'] == 'on')) 
		{
			$where['lang'] = array('=','0');
		} else if (($_GET['tiengViet'] == NULL) && ($_GET['tiengAnh'] == 'on') && ($_GET['ngonNguKhac'] == NULL)) 
		{
			$where['lang'] = array('=','2');
		}
		if ($_GET['soTrang'] != '1 đến 1000') 
		{
			$npage=explode(' ',$_GET['soTrang']);
			if ($check->number($npage['0']) && $check->number($npage['2'])) 
			{
				$where['pagen'] = array('between',array($npage['0'],$npage['2']));
			} 
			else 
			{
				$_GET['soTrang']='1 đến 1000'; 
			}
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////
		if ($_GET['tim-kiem'] != '')
		{
			$addmoresql="AND (`title` LIKE '%".$_GET['tim-kiem']."%' OR `description` LIKE '%".$_GET['tim-kiem']."%' OR `keyword` LIKE '%".$_GET['tim-kiem']."%' OR `author` LIKE '%".$_GET['tim-kiem']."%' OR `bcode` LIKE '%".$_GET['tim-kiem']."%' OR `publisher` LIKE '%".$_GET['tim-kiem']."%')";
		}
		$this->record=$database->clear_param()->select(array('*'),'book')->where($where)->add($addmoresql)->num_rows();
	}
	function get_data($start,$num)
	{
		global $database;
		global $check;
		if ($this->type == 2)
		{
			$where = array ('cid' => array('=',$this->c));
		}
		else if ($this->type == 1)
		{
			$id_list= array ();
			$result = $database->clear_param()->select(array('*'),'cate2')->where(array('id1' => array('=',$this->c)))->fetch();
			foreach ($result as $data)
			{
				$id_list[] = $data['id'];
			}			
			$where = array ('cid' => array('IN',$id_list));
		}
		//////// Check Tùy chọn /////////////////////////////////////////////////////////////
		if (($_GET['conSach'] == 'on') && ($_GET['hetSach'] == NULL)) 
		{
			$where['remain'] = array('>',0);
		} else if (($_GET['conSach'] == NULL) && ($_GET['hetSach'] == 'on')) 
		{
			$where['remain'] = array('=',0);
		}
		if (($_GET['coTheDocThu'] == 'on') && ($_GET['khongTheDocThu'] == NULL)) 
		{
			$where['proofread'] = array('!=','');
		} else if (($_GET['coTheDocThu'] == NULL) && ($_GET['khongTheDocThu'] == 'on')) 
		{
			$where['proofread'] = array('=','');
		}
		if (($_GET['tiengViet'] == 'on') && ($_GET['tiengAnh'] == 'on') && ($_GET['ngonNguKhac'] == NULL)) 
		{
			$where['lang'] = array('!=','0');
		} else if (($_GET['tiengViet'] == 'on') && ($_GET['tiengAnh'] == NULL) && ($_GET['ngonNguKhac'] == 'on')) 
		{
			$where['lang'] = array('!=','2');
		} else if (($_GET['tiengViet'] == NULL) && ($_GET['tiengAnh'] == 'on') && ($_GET['ngonNguKhac'] == 'on')) 
		{
			$where['lang'] = array('!=','1');
		} else if (($_GET['tiengViet'] == 'on') && ($_GET['tiengAnh'] == NULL) && ($_GET['ngonNguKhac'] == NULL)) 
		{
			$where['lang'] = array('=','1');
		} else if (($_GET['tiengViet'] == NULL) && ($_GET['tiengAnh'] == NULL) && ($_GET['ngonNguKhac'] == 'on')) 
		{
			$where['lang'] = array('=','0');
		} else if (($_GET['tiengViet'] == NULL) && ($_GET['tiengAnh'] == 'on') && ($_GET['ngonNguKhac'] == NULL)) 
		{
			$where['lang'] = array('=','2');
		}
		if ($_GET['soTrang'] != '1 đến 1000') 
		{
			$npage=explode(' ',$_GET['soTrang']);
			if ($check->number($npage['0']) && $check->number($npage['2'])) 
			{
				$where['pagen'] = array('between',array($npage['0'],$npage['2']));
			}
		}
		/////////////////////////////////// Check Sắp xếp ///////////////////////////////////////////////////////////////////////////////////
		if ($_GET['sapXep'] == NULL) {
			$order1='id';
			$order2='DESC';
		}
		else
		{
			switch($_GET['sapXep'])
			{
				case 'a-z':
					$order1='title';
					$order2='ASC';
				break;
				case 'z-a':
					$order1='title';
					$order2='DESC';
				break;
				case 'danhGia':
					$order1='rating';
					$order2='DESC';
				break;
				case 'danhGia2':
					$order1='rating';
					$order2='ASC';
				break;
				case 'thoiGian':
					$order1='id';
					$order2='DESC';
				break;
				case 'thoiGian2':
					$order1='id';
					$order2='ASC';
				break; 
				case 'soTrang':
					$order1='pagen';
					$order2='DESC';
				break;
				case 'soTrang2':
					$order1='pagen';
					$order2='ASC';
				break;
				case 'luotXem':
					$order1='view';
					$order2='DESC';
				break;
				case 'luotXem2':
					$order1='view';
					$order2='ASC';
				break;
				case 'luotMuon':
					$order1='borrow';
					$order2='DESC';
				break;
				case 'luotMuon2':
					$order1='borrow';
					$order2='ASC';
				break;
				default: 
					$order1='id';
					$order2='DESC';
				break;
			}
		}
		/////////////////////////////////////////////////////////////////////////////////////////////////
		if ($_GET['tim-kiem'] != '')
		{
			$addmoresql="AND (`title` LIKE '%".$_GET['tim-kiem']."%' OR `description` LIKE '%".$_GET['tim-kiem']."%' OR `keyword` LIKE '%".$_GET['tim-kiem']."%' OR `author` LIKE '%".$_GET['tim-kiem']."%' OR `bcode` LIKE '%".$_GET['tim-kiem']."%' OR `publisher` LIKE '%".$_GET['tim-kiem']."%')";
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		return $database->clear_param()->select(array('*'),'book')->where($where)->add($addmoresql)->order($order1,$order2)->limit($start,$num)->fetch();
	}
	function get_data_random()
	{
		global $database;
		if ($this->type == 2)
		{
			return $database->clear_param()->select(array('*'),'book')->where(array('cid' => array('=',$this->c)))->add('and `id`>=(SELECT FLOOR(MAX(`id`)*RAND()) FROM `book`)')->limit(0,4)->fetch();
		}
		else if ($this->type == 1)
		{
			$id_list = array();
			$result = $database->clear_param()->select(array('*'),'cate2')->where(array('id1' => array('=',$this->c)))->fetch();
			foreach ($result as $data)
			{
				$id_list[] = $data['id'];
			}			
			$where = array ('cid' => array('IN',$id_list));
			return $database->clear_param()->select(array('*'),'book')->where($where)->add('and `id`>=(SELECT FLOOR(MAX(`id`)*RAND()) FROM `book`)')->limit(0,4)->fetch();
		}
	}
	function get_data_cate1($c)
	{
		global $database;
		return $database->clear_param()->select(array('*'),'cate1')->where(array('id'=> array('=',$c)))->fetch();
	}
	function get_data_cate2($c)
	{
		global $database;
		return $database->clear_param()->select(array('*'),'cate2')->where(array('id'=> array('=',$c)))->fetch();
	}
	function set_cate_info()
	{
		global $database;
		if ($this->type == 2)
		{
			$result = $database->clear_param()->select(array('*'),'cate2')->where(array ('id' => array('=',$_GET['c2'])))->fetch();
			$this->cate2 =$result[0];
			$result2 = $database->clear_param()->select(array('*'),'cate1')->where(array ('id' => array('=',$this->cate2['id1'])))->fetch();
			$this->cate1 =$result2[0];
		}
		else if ($this->type == 1)
		{
			$result = $database->clear_param()->select(array('*'),'cate1')->where(array ('id' => array('=',$_GET['c1'])))->fetch();
			$this->cate1 =$result[0];
		}
	}
}
?>