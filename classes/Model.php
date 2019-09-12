<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/26 9:30
 * @name 	网站核心文件-模型类
 * @desc 	进行业务逻辑判断或封装其他的方法
 */
namespace classes;

use classes\Validator\Validator;

class Model
{
    const SCENARIO_DEFAULT = 'default';
    const EVENT_BEFORE_VALIDATE = 'beforeValidate';
    const EVENT_AFTER_VALIDATE = 'afterValidate';

    protected 	$_scenario 	= self::SCENARIO_DEFAULT;
    protected 	$attributes = [];
    protected 	$_validate 	= [];
    public 	    $errors;
    protected   $_aValidateErrors = [];

    public function __construct(){
    	parent::__construct();
    }

    public function rules(){
    	return [];
    }

    public function attributeLabels(){
        return [];
    }

    public function getAttributeLabel($attribute){
        $labels = $this->attributeLabels();
        $labels = empty($labels) ? $this->getTableSchema() : $labels;
        return isset($labels[$attribute]) ? $labels[$attribute] : $this->getDefaultAttributeLabel($attribute);
    }

    protected function getDefaultAttributeLabel($attr_label){
        return ucfirst($attr_label);
    }

    public function scenarios(){
    	$scenarios = [self::SCENARIO_DEFAULT=>[]];
    }

    public function load($data,$formName=null){
        // 如果没有给定表单名称，则查找出表名赋给tableName变量
    	$tableName = $formName === null ? $this->getTableName2() : $formName;
        $app = Web::app();
        $dbMaps = $app->Config->getOne('maps','db');
        // 如果配置信息中该表有映射的表名，则查出映射的表名
        $tableMapFormName = isset($dbMaps[$tableName]) ? $dbMaps[$tableName] : $tableName;
        // 如果$tableMapFormName首字母大写，则首字母变小写
        $first = substr($tableMapFormName,0,1);
        $last = substr($tableMapFormName,1);
        $upperTableMapFormName = strtoupper($first).$last;
        // 将形如goods_type的表名设置成GoodsType形式
        $form_name_arr = explode('_', $upperTableMapFormName);
        $formNameStr = '';
        foreach ($form_name_arr as $value) {
            $formNameStr .= ucfirst($value);
        }

    	if ($tableMapFormName == '' && !empty($data) && !isset($data[$tableMapFormName])) {
            // echo 1;
    	 	# 如果没有表名，但是有数据，则设置属性值为$data
    	 	$this->setAttributes($data);
    	 	return true;
    	 } else if(!empty($data[$tableMapFormName]) && isset($data[$tableMapFormName])){
            // echo 2;
    	 	# 如果数据不为空，并且数据中存在该表的表单数据
            # 此处form提交的名称为首字母小写
    	 	$this->setAttributes($data[$tableMapFormName]);
    	 	return true;
    	 } else if(!empty($data[$upperTableMapFormName]) && isset($data[$upperTableMapFormName])){
            // echo 3;
            # 如果数据不为空，并且数据中存在该表的表单数据
            # 此处form提交的名称为首字母大写
            $this->setAttributes($data[$upperTableMapFormName]);
            return true;
         } else if(!empty($data[$formNameStr]) && isset($data[$formNameStr])){
            // echo 4;
            # 如果数据不为空，并且数据中存在该表的表单数据
            # 此处form提交的名称为首字母大写
            $this->setAttributes($data[$formNameStr]);
            return true;
         } else if(!empty($data)){
            // echo 5;
            # 如果存在数据
            $this->setAttributes($data);
            return true;
         }
    	 
    	 return false;
    }

    public static function loadMultiple($models,$data,$formName=null){
    	if ($formName==null) {
    		# 重置指针
    		$fp = reset($models);
    		if ($fp===false) {
    			return false;
    		}

    		$formName = $this->formName();
    	}

    	$res = false;

    	foreach ($models as $i => $model) {
    		if ($formName==null) {
    			if (!empty($data[$i])) {
    				$model->load($data[$i]);
    				$res = true;
    			}
    		} 

    		if(!empty($data[$formName][$i])){
    			$model->load($data[$formName][$i]);
    			$res = true;
    		}
    		
    		return $res;
    	}
    }

    public function setAttributes($data){
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function validate($enableBackstageValidation=1){
        $this->beforeValidate();
        // enableBackstageValidation=1 后台自动验证
        if ($enableBackstageValidation==1) {
            $oValidator = new Validator($this);
            $res = $oValidator->validate();
            $this->_aValidateErrors = $oValidator->getErrors();
            return $res;
        }
        // 不用自动验证
        return true;
    }

    protected function beforeValidate(){
    	// 
    }
}