<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/26 9:27
 * @name 	网站核心文件-模型类的扩展类
 * @desc 	继承自Model类，执行数据库的CURD操作
 *        	通过数据库具体的操作类（如DbMysqli）执行数据库CURD操作
 */
namespace classes;

use classes\Model;

class ActiveRecord extends Model
{
	protected 	$_db;
    public 	    $errors;
    protected   $_pk = 'id';
    protected   $_attributes = [];

	public function __construct(){
		$app = Web::app();
		$dbClass = $app->Config->getOne('dbclass','db');
		$dbClass = ucfirst($dbClass);
        $this->_db = $app->$dbClass;
    }

    public function __get($name){
        if (isset($this->attributes[$name])) 
        {
            return $this->attributes[$name];
        }
        return null;
    }

    public function __set($key,$value){
        $this->attributes[$key] = $value;
    }

    /**
     * 将类名转化为表名
     * @param $className string 类名
     * 将类名中大写字母改成 _小写字母 形式
     * 譬如 tmpAd 转换为 tmp_ad的形式
     *
     * */
    private function _classNameToTableName($className){
        $len = strlen($className);
        $_upper = array();
        for ($i = 0; $i < $len; $i++) 
        {
             if (preg_match('/^[A-Z]$/' , $className[$i])) 
             {
                 $_upper[] = $className[$i];
             }
        }
        foreach ($_upper as $v) 
        {
            $className = str_replace($v , '_'.strtolower($v) , $className);
        }
        return $className;
    }

	public function getClassName()
    {
        $reflector = new \ReflectionClass($this);
        return $reflector->getShortName();
    }

    public function getModelName()
    {
        $modelClassName = $this->getClassName();
        // $modelClassName = 'SysMenuModel';
        // return str_replace('Model','',$modelClassName);
        $num = strrpos($modelClassName, 'Model');
        return substr($modelClassName,0,$num);
    }

    public function getTableName2(){
        $modelName = $this->getModelName();
        // echo $modelName;
        $tableName = $this->_classNameToTableName($modelName);
        $tableName = ltrim($tableName,'_');
        return $tableName;
    }

    /**
     * 获取表名
     * 如果该模型设置了表名，则返回设置的表名
     * 否则根据获得的类名获取表名
     * @return 小写的表名
     *
     * */
    public function getTableName(){
        if (isset($this->tableName)) 
        {
            $tableName = $this->tableName;
        }else{
            $tableName = strrchr(get_class($this),'\\');
            $tableName = ltrim($tableName,'\\');
            $tableName = $this->_classNameToTableName($tableName);
        }
        return strtolower($tableName);
    }

    /**
     * 获取表的全名
     * 如果该模型设置了表名则返回设置的表名
     * 如果没设置，则根据类名获取表的全名
     * 返回表全名的小写形式
     *
     * */
    public function getFullTableName(){
        if (isset($this->tableName)) 
        {
            return $this->_db->getFullTableName($this->tableName);
        }else{
            $tableName = strrchr(get_class($this) , '\\');
            $tableName = ltrim($tableName , '\\');
            $tableName = $this->_classNameToTableName($tableName);
            $tableName = strtolower($tableName);
            $tableName = ltrim($tableName , '_');
            return $this->_db->getFullTableName($tableName);
        }
    }

    public function getFullTableName2(){
        $tableName = $this->getTableName2();
        return $this->_db->getFullTableName($tableName);
    }

    // public static function getTableSchema()
    // {
    //     $tableSchema = static::getDb()
    //         ->getSchema()
    //         ->getTableSchema(static::tableName());

    //     if ($tableSchema === null) {
    //         throw new InvalidConfigException('The table does not exist: ' . static::tableName());
    //     }

    //     return $tableSchema;
    // }

    public static function getTableSchema(){
        $this->_db->getTableSchema(static::tableName());
    }

    public static function primaryKey()
    {
        return static::getTableSchema()->primaryKey;
    }

    public function attributes(){
        // return static::getTableSchema()->columns;
        return $this->attributes;
    }

    // 添加数据
    public function add(){
        $tableName = $this->getTableName2();
        if (isset($this->attributes) && !empty($this->attributes)) 
        {
            unset($this->attributes[$this->_pk]);
            // unset($this->attributes[$this->primary]);
            return $this->_db->insert($tableName , $this->attributes);
        }
        return false;
    }

    public function save($enableBackstageValidation=1){
        $res = false;
        if ($enableBackstageValidation==1) {
            // 场景
            $this->scenarios();
            # 自动验证
            $isValid = $this->validate($enableBackstageValidation);
            if (!$isValid) {
                # 自动验证失败
                $this->errors = $this->_aValidateErrors;
                // print_r($this->errors);
                return false;
            }
        }
        // 执行操作之前的动作
        $this->beforeSave();
        // 将跳过的字段从属性中删除
        $this->skipAttribute();
        // print_r($this->attributes);
        // return 1;
        // 如果id有值是更新，否则是插入
        if ($this->{$this->_pk}) {
            # 更新
            $res = $this->updateForPK();
        } else {
            # 插入
            $res = $this->add();
        }
        
        return $res;
    }

    public function scenarios(){
        if ( !isset($this->attributes['scenario']) ) {
            return true;
        }
        $this->_attributes = $this->attributes;
        $rules = $this->rules();
        if (!empty($rules)) {

            foreach ($rules as $key => $row) {
                // 如果规则中设置了场景
                if (isset($row['on']) && $row['on']) {
                    $scenarios = $row['on'];
                    // 如果控制器中设置了场景，并且该场景不在规则中设置的场景中
                    if ( (is_string($scenarios) && $this->attributes['scenario']!=$scenarios) || (is_array($scenarios) && !in_array($this->attributes['scenario'],$scenarios)) ) {
                        // 删除该字段的值
                        if (isset($this->attributes[$row[0]])) {
                            $this->_attributes[$row[0]] = $this->attributes[$row[0]];
                            unset($this->attributes[$row[0]]);
                        }

                    }

                }
                // 如果存在skip的字段，就删除该字段值
                // if (isset($row['skip']) && $row['skip']==1) {
                //     if (isset($this->attributes[$row[0]])) {
                //         unset($this->attributes[$row[0]]);
                //     }
                // }
            }
            $scenario = $this->attributes['scenario'];
            unset($this->attributes['scenario']);
            $this->_attributes['scenario'] = $scenario;
        }
    }

    // 将带有skip的字段删除
    protected function skipAttribute(){
        $rules = $this->rules();
        if (!empty($rules)) {
            foreach ($rules as $key => $value) {
                // if (isset($value['skip']) && $value['skip']==1) {
                if($value[1]=='skip'){
                    if (isset($this->attributes[$value[0]])) {
                        $this->_attributes[$value[0]] = $this->attributes[$value[0]];
                        unset($this->attributes[$value[0]]);
                    }
                }
            }
        }
    }

    // 执行插入/更新数据库操作之前进行的动作
    protected function beforeSave(){
        // 如果有场景设置，并且规则中有time
        $rules = $this->rules(); 
        if (!empty($rules)) {
             foreach ($rules as $key => $row) {
                 if ($row[1]=='time' && isset($row['on']) && ( (is_array($row['on']) && in_array($this->_attributes['scenario'],$row['on'])) || (is_string($row['on']) && $this->_attributes['scenario'] == $row['on']) ) ) {
                     # 如果规则为time，并且场景值在on中设置了
                     $this->attributes{$row[0]} = time();
                 }else if ($row[1]=='time' && !isset($row['on'])){
                    # 如果规则为time，并且没有场景设置
                     $this->attributes{$row[0]} = time();
                 }
             }
        }
    }

    // 编辑数据 根据primary id更新数据
    public function updateForPK($pk='id'){
        $tableName = $this->getTableName2();
        if (isset($this->attributes[$pk])) 
        {
            $where = "`".$pk."`='".$this->attributes[$pk]."'";
            unset($this->attributes[$pk]);
            return $this->_db->update($tableName , $this->attributes , $where);
        }
        return false;
    }

    // 编辑数据 根据给定条件
    public function update($data,$where){
        $tableName = $this->getTableName2();
        return $this->_db->update($tableName , $data, $where);
        return false;
    }

    /**
     * 查找数据
     * @param $condition array 条件数组
     * $condition = array(
     *      'select' => '*'/'查找的列名',
     *      'where' => '1/条件语句',
     *      'group' => '分组条件',
     *      'order' => '排序条件+排序规则',
     *      'limit' => '限定语句'
     * )
     *
     * */
    public function select($condition = array()){
        $tableName = $this->getFullTableName2();
        if (empty($condition)) 
        {
            $sql = "SELECT * FROM `".$tableName."`";
        }else{
            $sql = "SELECT ";
            $sql .= isset($condition['select']) ? $condition['select'].' ' : '*';
            $sql .= " FROM " . $tableName;
            $sql .= isset($condition['where']) ? " WHERE ".$condition['where'] : '';
            $sql .= isset($condition['group']) ? " GROUP BY ".$condition['group'] : '';
            $sql .= isset($condition['order']) ? " ORDER BY ".$condition['order'] : ' ORDER BY `id`';
            $sql .= isset($condition['limit']) ? " LIMIT ".$condition['limit'] : '';
        }
		// echo $sql;
        $data = $this->_db->getAll($sql);
        return $data;
    }

    // 获取某种条件下的数据的条目数
    public function count($where = 1){
        $sql = "SELECT COUNT(*) FROM ". $this->getFullTableName2() . " WHERE ". $where;
        return $this->_db->getOne($sql);
    }

    // 删除数据
    public function delete($where=1){
        $tableName = $this->getFullTableName2();
        $sql = "DELETE FROM ". $tableName . " WHERE ".$where;
        return $this->_db->excute($sql);
    }

    // 根据pk值删除数据
    public function deleteForPK($id){
        $tableName = $this->getFullTableName2();
        $where = "`".$this->_pk."`='".$id."'";
        $sql = "DELETE FROM ". $tableName . " WHERE ".$where;
        return $this->_db->excute($sql);
    }

    // 获取一条数据
    public function findOne($where=1 , $cols='*'){
        $sql = "SELECT " . $cols . " FROM ". $this->getFullTableName2() . " WHERE ". $where . " LIMIT 1";
        return $this->_db->getRow($sql);
    }

    // 根据pk获取一条数据
    public function findOneForPK($id , $cols='*'){
        $where = "`".$this->_pk."`='".$id."'";
        $sql = "SELECT " . $cols . " FROM ". $this->getFullTableName2() . " WHERE ". $where . " LIMIT 1";
        return $this->_db->getRow($sql);
    }

    // 根据pk获取某列数据
    public function fetchColumnForPK($id , $col){
        $where = "`".$this->_pk."`='".$id."'";
        $sql = "SELECT " . $col . " FROM ". $this->getFullTableName2() . " WHERE ". $where . " LIMIT 1";
	    //echo $sql;
        $aRes = $this->_db->getRow($sql);
        return empty($aRes) ? '' : $aRes[$col];
    }

    // 获取某列数据
    public function fetchColumn($where , $col){
        $sql = "SELECT " . $col . " FROM ". $this->getFullTableName2() . " WHERE ". $where . " LIMIT 1";
	    // echo $sql;
        $aRes = $this->_db->getRow($sql);
        return empty($aRes) ? '' : $aRes[$col];
    }


    // 事务处理 开始 提交 回滚操作
    public function queryTrans($sql){
        return $this->_db->excute($sql);
    }

    // 获取数据库版本
    public function getSqlVersion(){
    	return $this->_db->getSqlVersion();
    }

    // 通过自定义sql语句查询
    public function joinSql($condition,$aTableName,$select='*',$order='',$limit=30,$innerType='inner'){
	    $sql = "SELECT ".$select." FROM ".$aTableName[0]['tableName']." as ".$aTableName[0]['as']." ".$innerType." join ".$aTableName[1]['tableName']." as ".$aTableName[1]['as']." on ".$condition;
	    if($order){
	    	$sql .= " order by ".$order;
	    }
	    if($limit){
	    	$sql .= " limit ".$limit;
	    }
	    //echo $sql;
	    return $this->_db->getAll($sql);
    }

    /**
     * 通过自定义sql语句查询
     * @param 	$condition string 查询条件
     * @param 	$aTable array 多张表信息
     * @param 	$aTable[0]['tableName'] : 表名 
     * 		$aTable[0]['as'] : 表别名 
     * 		$aTable[0]['on'] : 联合条件
     * 		$aTable[0]['type'] : 联合类型 inner/left/right
     * 	@param 	$select string 查询字段
     * 	@param 	$group string 合并查询条件
     * 	@param 	$order string 排序条件
     * 	@param 	$limit string 分页查询数量
     *
     * */
    public function joinSqlForData($condition,$aTable,$select='*',$group='',$order='',$limit=30){
	    $sql = "SELECT ".$select." FROM ";
	    $sql .= $aTable[0]['tableName']." AS ".$aTable[0]['as'];
	    for($i=1;$i<count($aTable);$i++){
		    $sql .= " ".$aTable[$i]['type']." JOIN ".$aTable[$i]['tableName']." AS ".$aTable[$i]['as'];
		    $sql .= " ON ".$aTable[$i]['on'];
	    }
	    $sql .= $condition ? " WHERE ".$condition : '';
	    $sql .= $group ? " GROUP BY ".$group : '';
	    $sql .= " ORDER BY ";
	    $sql .= $order ? $order : $aTable[0]['as'].'.id DESC';
	    $sql .= " LIMIT ".$limit;
	    //echo $sql;
	    return $this->_db->getAll($sql);
    }

    // 根据sql语句查询
    public function getDataForSql($sql){
    	return $this->_db->getAll($sql);
    }

    public function getTree($parent_id=0,$col='*',$level=0){
        $tree = [];
        $tree = $this->getBranch($parent_id,$col);
        // print_r($tree);
        if (!empty($tree)) {
            ++$level;
            # 递归
            foreach ($tree as $key => $value) {
                $tree[$key]['level'] = $level;
                if (isset($value['json_data'])) {
                    $tree[$key]['json_data'] = json_decode($value['json_data'],true);
                }
                # 获取该类别下的子类别
                $pk = $this->_pk;
                $tmp = $this->getTree($value[$pk],$col,$level);
                $tree[$key]['children'] = null;
                if (!empty($tmp)) {
                    $tree[$key]['children'] = $tmp;
                }
            }
        }
        return $tree;
    }

    public function getTree2($parent_id=0,$col='*',$level=0,$parent_col_name=''){
        $parent_name = '';
        if ($parent_col_name) {
            $parent_name = $this->fetchColumnForPK($parent_id,$parent_col_name);
        }
        $tree = $branch = [];
        $branch = $this->getBranch($parent_id,$col);
        // print_r($tree);
        if (!empty($branch)) {
            ++$level;
            # 递归
            foreach ($branch as $key => $value) {
                $branch[$key]['level'] = $level;
                $branch[$key]['parent_name'] = $parent_name;
                $tree[] = $branch[$key];
                # 获取该类别下的子类别
                $pk = $this->_pk;
                $tmp = $this->getTree2($value[$pk],$col,$level,$parent_col_name);
                if (!empty($tmp)) {
                    // $tree = $tmp;
                    foreach ($tmp as $k => $v) {
                        $tree[] = $v;
                    }
                }
            }
        }
        return $tree;
    }

    public function getBranch($parent_id=0,$col='*'){
        $parent_id = $parent_id ? $parent_id : 0;
        $tableName = $this->getFullTableName2();
        $sql = "select $col from $tableName";
        // $sql .= $parent_id ? " where parent_id='".$parent_id."'" : '';
        $sql .= " where parent_id='".$parent_id."' order by order_num";
        // echo $sql;
        $res = $this->_db->getAll($sql);
        return $res;
    }

    public function getParentId($id){
        $data = $this->findOneForPK($id);
        if (!empty($data)) {
            if ($data['parent_id']) {
                $pid = $this->getParentId($data['parent_id']);
                return $pid ? $pid : $data['parent_id'];
            }
            return $data[$this->_pk];
        }
        return 0;
    }

    public function setModel($id){
        $data = $this->findOneForPK($id);
        $this->{$this->_pk} = $id;
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}