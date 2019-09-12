<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/31 15:12
 * @name 	网站核心文件-表单验证类
 * @desc 	进行表单验证的方法
 *        	验证规则
 *        	[
 *        		
 *          	[
 *      		   '字段名称',
 *      		   '额外信息',
 *      		   '错误信息',
 *      		   'regex|callback',
 *      		   'insert|update|both'
 *      		],
 *        	]
 */
namespace classes\Validator;

class Validator
{
	protected $_validates 	= [];
	protected $_attributes 	= [];
	protected $_errors 		= [];
	protected $_model 		= null;

	// public function __construct($validates,$attributes=[]){
	// 	$this->_validates 	= $validates;
	// 	$this->_attributes 	= $attributes;
	// }
	 
	public function __construct($model){
		$this->_model 	= $model;
		$this->_validates = $model->rules();
	}

	public function __get($name){
		if (isset($this->_attributes[$name])) {
			return $this->_attributes[$name];
		}

		return null;
	}

	public function __set($name,$value){
		$this->_attributes[$name] = $value;
	}

	/**
	 * 设置attribute值
	 * @param [array] $data [需要验证的数组]
	 */
	public function setAttribute($data){
		$this->_attributes = $data;
	}

	// public function validate($type='insert'){
	// 	$res = true;

	// 	foreach ($this->_validate as $_rule) {
	// 		# $value[4] 可选值为 insert/update/both
	// 		if (isset($_rule[4]) && $_rule[4]!=$type) {
	// 			continue;
	// 		}

	// 		// $_rule[0] 字段名称
	// 		// $_value 需要验证的数组中字段对应的值
	// 		$_value = $this->_attributes[$_rule[0]];

	// 		# $_rule[3] 可选值为 regex|callback
	// 		if (isset($_rule[3]) && $_rule[3] == 'callback') {
	// 			# $_rule[3] 是callback则调用自定义函数
	// 			if (!$this->$_rule[1]($_value)) {
	// 				# 调用函数失败或没有自定义的函数
	// 				$this->addError($_rule[2]);
	// 				$res = false;
	// 			}
	// 		} else {
	// 			# 非调用函数方式，用正则判断
	// 			if ($_rule[1] == 'require') {
	// 				# 必填项
	// 				$_regexp = '/.+/';
	// 			}elseif ($_rule[1] == 'int') {
	// 				# 数字
	// 				$_regexp = '/\d+/';
	// 			}else{
	// 				$_regexp = '/{$_rule[1]}/';
	// 			}
	// 			if (!preg_match($_regexp,$_value)) {
	// 				# 验证失败，则添加自定义错误
	// 				$this->addError($_rule[2]);
	// 				$res = false;
	// 			}
	// 		}
	// 		if (isset($_rule[3])) {
	// 			switch ($_rule[3]) {
	// 				case 'callback':
	// 					# $_rule[3] 是callback则调用自定义函数
	// 					if (!$this->$_rule[1]($_value)) {
	// 						# 调用函数失败或没有自定义的函数
	// 						$this->addError($_rule[2]);
	// 						$res = false;
	// 					}
	// 					break;
					
	// 				case 'regex':
	// 					# 非调用函数方式，用正则判断
	// 					if ($_rule[1] == 'require') {
	// 						# 必填项
	// 						$_regexp = '/.+/';
	// 					}elseif ($_rule[1] == 'int') {
	// 						# 数字
	// 						$_regexp = '/\d+/';
	// 					}else{
	// 						$_regexp = '/{$_rule[1]}/';
	// 					}
	// 					if (!preg_match($_regexp,$_value)) {
	// 						# 验证失败，则添加自定义错误
	// 						$this->addError($_rule[2]);
	// 						$res = false;
	// 					}
	// 					break;
	// 			}
	// 		}
	// 	}
			
	// 	return $res;
	// }
	
	public function validate(){
		$res = true;
		if (empty($this->_validates)) {
			# 如果验证规则为空，则不需要验证，返回true
			return true;
		}

		foreach ($this->_validates as $_val) {
			# 如果验证规则第一项（字段名）是数组
			if (is_array($_val[0])) {
				foreach ($_val[0] as $fieldName) {
					# 将验证数组的第一项改成当前的字段名
					$tmp = [];
					$tmp = $_val;
					$tmp[0] = $fieldName;
					$returnBool = $this->_validate($tmp);
					if (!$returnBool) {
						$res = false;
					}
				}
			}else{
				$returnBool = $this->_validate($_val);
				if (!$returnBool) {
					$res = false;
				}
			}
		}

		return $res;
	}

	// $attributes = ['menu_name'=>'test','test_request'=>'abc','route'=>'admin/test/index','parent_id'=>1,'order_num'=>1]
	// $rules = [
	// 		[
	// 			['menu_name','test_request'],'required','requiredValue'=>'必填项','message'=>'提示信息'
	//		],
	//		['email','email'],
	//		['url','url','defaultScheme'=>'http'],
	//		[['字段名'],'match','pattern'=>'正则表达式','message'=>'提示信息']
	// ]
	protected function _validate($rule){
		$res = false;
		$value = $this->_attributes[$rule[0]];
		$value = trim($value);
		if (!$value) {
			# 如果没有需要验证的值，则返回错误
			$this->_errors[$rule[0]] = '没有需要验证的值';
			return false;
		}
		# 将验证数组的第二项首字母大写
		# 与Validator相连，形成如RequiredValidator的形式
		# 连接后的名字即为验证类的名称
		$className = ucfirst($rule[1]).'Validator';
		$returnArr = $className::checkData($value,$rule);
		return $res;
	}

	/**
     * 将错误信息添加到错误信息数组
     * @param $errorMsg string 错误信息
     *
     * */
    protected function addError($errorMsg){
        array_push($this->_errors , $errorMsg);
    }

    // 获取一个错误信息
    public function getError(){
        return $this->_errors[0];
    }

    // 获取所有错误信息
    public function getErrors(){
        return $this->_errors;
    }
}