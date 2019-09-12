<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 15:29
 * @name 	网站核心文件-数据库操作类-mysqli
 */
namespace classes\Db;

use Mysqli\Schema;

class DbMysqli
{
	private $_aConfig = [];
	private $_link = null;

	public function init(){
		$this->_aConfig = \classes\Web::app()->Config->getAll('db');
        // print_r($this->_aConfig);
		$this->_link = mysqli_connect($this->_aConfig['host'] , $this->_aConfig['user'] , $this->_aConfig['pass']);

		if (mysqli_connect_errno()) {
			die(mysqli_connect_error());
		}

		$this->_link->select_db($this->_aConfig['dbname']);
		$this->_link->set_charset($this->_aConfig['dbcharset']);
	}

	/**
     * 执行sql语句
     * @param $sql string sql语句
     * @return false/影响行数
     *
     * */
    public function excute($sql){
        if ($this->_link->query($sql) === false) 
        {
            return false;
        }

		return $this->_link->affected_rows;
    }

    /**
     * 执行sql语句
     * @param $sql string sql语句
     * @return mix 执行结果
     *
     * */
    private function _query($sql){
        $rs = $this->_link->query($sql) or die($this->_link->error);
        return $rs;
    }

    /**
     * 获取全部数据
     * @param $sql string sql语句
     * @return $aData array
     *
     * */
    public function getAll($sql){
        $rs = $this->_query($sql);
        $aData = [];
        while($row=$rs->fetch_assoc()){
            $aData[] = $row;
		}

		$this->free($rs);

        return $aData;
    }

    /**
     * 获取一条数据
     * @param $sql string sql语句
     * @return $aData array
     *
     * */
    public function getRow($sql){
        $rs = $this->_query($sql);
        $aData = [];
        $aData = $rs->fetch_assoc();
		$this->free($rs);

        return $aData;
    }

    /**
     * 获取某个字段值
     * @param $sql string sql语句
     * @return mix 字段值
     *
     * */
    public function getOne($sql){
        $rs = $this->_query($sql);
		$row = [];
		$row = $rs->fetch_row();
		$this->free($rs);
		return $row[0];
		//return $row[0][0];
    }

    /**
     * 获取添加数据的id值
     *
     * */
    public function get_insert_id(){
        return $this->_link->insert_id;
    }

    /**
     * 获取表的完整名称
     * @param  $tableName string 没有前缀的表名
     * @return $tableName string 带有前缀的表名
     *
     * */
    public function getFullTableName($tableName){
        $prefix = $this->_aConfig['dbprefix'];
        return $prefix . $tableName;
    }

    /**
     * 添加数据
     * @param $tableName string 表名
     * @param $data array 添加的数据组成的数组
     * @return 添加结果 mix false/添加的数据id
     *
     * */
    public function insert($tableName,$data){
        $tableName = $this->getFullTableName($tableName);
        $aKeys = array_keys($data);
        $aValues = array_values($data);
        $sKeys = implode('`,`',$aKeys);
        $sKeys = '`'.$sKeys.'`';
        $sValues = implode("','",$aValues);
        $sValues = "'".$sValues."'";
        $sql = "INSERT INTO `" . $tableName . "` (" . $sKeys . ") VALUES (" . $sValues . ")";
		// echo $sql;
        // return true;
        if ($this->excute($sql) === false) 
        {
            return false;
        }

        return $this->get_insert_id();
    }

    /**
     * 更新数据
     * @param $tableName string 表名
     * @param $data array 更新数据数组
     * @param $where string where条件
     * @return mix false/影响行数
     *
     * */
    public function update($tableName,$data,$where){
        $tableName = $this->getFullTableName($tableName);
        $sql = "UPDATE `".$tableName."` SET ";
        foreach ($data as $key=>$value) 
        {
            $sql .= "`".$key."`='".$value."',";
        }
        $sql = rtrim($sql,',');
        $sql .= " WHERE " . $where;
        // echo $sql;
        $res = $this->excute($sql);
        return $res===false ? false : true;
    }

    // 释放结果集所占用资源
    public function free($rs){
    	@$rs->free();
    }

    // 关闭数据库连接
    protected function close(){
    	$this->_link->close();
    }

    // 获取数据库版本
    public function getSqlVersion(){
    	//return $this->_link->client_version;
    	return $this->_link->client_info;
    }

    public function getSchema(){
        return new Schema(self);
    }
}