<?php
class database {
	var $sql;
	var $where;
	var $limit;
	var $order;
	function __construct() 
	{
		global $db_host,$db_name,$db_username,$db_password;
		$this->connect($db_host,$db_name,$db_username,$db_password,'UTF8','Asia/Ho_Chi_Minh');
	}
	
	function __destruct() 
	{
		$this->dis_connect();
	}
	
	function connect($db_host,$db_name,$db_username,$db_password,$db_charset,$db_timezone) 
	{
		@mysql_connect("{$db_host}", "{$db_username}", "{$db_password}");
		@mysql_select_db("{$db_name}");
		@mysql_query("SET NAMES '{$db_charset}'");
		date_default_timezone_set("{$db_timezone}");
		@mysql_query("SET character_set_results = '{$db_charset}', character_set_client = '{$db_charset}', character_set_database = '{$db_charset}', character_set_server = '{$db_charset}'");
	}
	
	function dis_connect()
	{
		mysql_close();
	}
	
	function select($data1,$data2) 
	{
		if (is_array($data1))
		{
		$cols=implode(',',$data1);
		$this->sql="SELECT {$cols} FROM `{$data2}` ";
		}
		return $this;
	}
	
	function insert($data1,$data2,$data3)
	{
		if (is_array($data1) && is_array($data2))
		{
			$field=implode("','",$data1);
			$field="'".$field."'";
			$content=implode("','",$data2);
			$content="'".$content."'";
			$this->sql="INSERT INTO `{$data3}`({$field}) VALUES ({$content}) ";
		}
		return $this;
	}
	
	function update($data1,$data2)
	{
		foreach ($data2 as $key => $value){
			$param.=",`{$key}`='{$value}'";
        }
		$param=trim($param,',');
		$this->sql="UPDATE `{$data1}` SET {$param} ";
		return $this;
	}
	
	function delete($data)
	{
		$this->sql="DELETE FROM `{$data}` ";
		return $this;
	}
	
	function where($data) 
	{
		$chk_comp_ele = array ('LIKE','=','!=','>','<','>=','<=','BETWEEN','NOT BETWEEN','IN','NOT IN','REGEXP');
		if (is_array($data))
		{
			foreach ($data as $key => $value) 
			{
				if (in_array(strtoupper($value[0]),$chk_comp_ele))
				{
					if ((strtoupper($value[0]) == 'BETWEEN') || (strtoupper($value[0]) == 'NOT BETWEEN'))
					{
						$param.="AND (`{$key}` {$value[0]} '{$value[1][0]}' AND '{$value[1][1]}') ";
					}
					else if ((strtoupper($value[0]) == 'IN') || (strtoupper($value[0]) == 'NOT IN'))
					{
						if (is_array($value[1]))
						{
						$content=implode(',',$value[1]);
						$param.="AND `{$key}` {$value[0]} ({$content})";
						}
					}
					else {
						$param.="AND `{$key}`{$value[0]}'{$value[1]}' ";
					}
				}
			}
		}
		$this->where="WHERE 1 {$param}";
		return $this;
	}
	function add($data)
	{
		$this->where.=$data.' ';
		return $this;
	}
	
	function order($data1,$data2) 
	{
		if ((strtoupper($data2) == 'ASC') || (strtoupper($data2) == 'DESC'))
		{
			$data2=strtoupper($data2);
			$this->order="ORDER BY `{$data1}` {$data2} ";
		}
		return $this;
	}
	
	function limit($data1,$data2) 
	{
		if ((preg_match('/^([0-9]+)$/',$data1) == 1) && (preg_match('/^([0-9]+)$/',$data2) == 1))
		{
			$this->limit="LIMIT {$data1},{$data2}";
		}
		return $this;
	}
	
	function execute() 
	{
		mysql_query($this->sql.$this->where);
	}
	
	function fetch() 
	{
		$query = mysql_query($this->sql.$this->where.$this->order.$this->limit);
		$result = array();
		while($row = mysql_fetch_assoc($query))
		{
			$result[] = $row;
		}
		mysql_free_result($query);
		return $result;
	}
	
	function num_rows()
	{
		$query = mysql_query($this->sql.$this->where.$this->limit);
		return mysql_num_rows($query);
	}
	function view_sql()
	{
		return $this->sql.$this->where.$this->order.$this->limit;
	}
	function clear_param()
	{
		$this->sql='';
		$this->where='';
		$this->limit='';
		$this->order='';
		return $this;
	}
}
?>