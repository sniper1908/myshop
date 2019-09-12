<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/11 9:29
 * @name 	网站核心文件-数据库操作类-mysql
 */
namespace classes\Db;

class Db
{
	private $_aConfig = [];
	private $_link = null;

	public function init(){
		$this->_aConfig = \classes\Web::app()->Config->getAll('db');
		$this->_link = mysql_connect($this->_aConfig['host'],$this->_aConfig['user'],$this->_aConfig['pass']);
		mysql_connect_db($this->_aConfig['dbname'],$this->_link);
		$this->_query("set names '".$this->_aConfig['dbcharset']."'");
	}

	/**
     * 执行sql语句
     * @param $sql string sql语句
     * @return false/影响行数
     *
     * */
    public function excute($sql){
        if ($this->_query($sql) === false) 
        {
            return false;
        }
        return mysql_affected_rows($this->_link);
    }

    /**
     * 执行sql语句
     * @param $sql string sql语句
     * @return mix 执行结果
     *
     * */
    private function _query($sql){
        $rs = mysql_query($sql , $this->_link) or die(mysql_error($this->_link));
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
        while($row=mysql_fetch_assoc($rs)){
            $aData[] = $row;
        }
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
        $aData = mysql_fetch_assoc($rs);
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
        return mysql_result($rs,0,0);
    }

    /**
     * 获取添加数据的id值
     *
     * */
    public function get_insert_id(){
        return mysql_insert_id($this->_link);
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
        return $this->excute($sql);
    }

    // 获取数据库版本
    public function getSqlVersion(){
    	return mysql_get_server_info();
    }
}