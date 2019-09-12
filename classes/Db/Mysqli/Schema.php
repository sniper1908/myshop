<?php

namespace classes\Db\Mysqli;

class Schema
{
	protected $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	// 获取表名
	public function getTableName(){
		
	}

	//获取表字段名  
	public function getTableSchema(){

	}
}