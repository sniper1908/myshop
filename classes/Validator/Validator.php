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
	protected $_validates 		= [];
	protected $_attributes 		= [];
	protected $_attributeLabels = [];
	protected $_errors 			= [];
	protected $_model 			= null;

	public function __construct($model){
		$this->_model 	= $model;
		$this->_validates = $model->rules();
		$this->_attributeLabels = $model->attributeLabels();
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

	
	public function validate(){
		$res = true;
		if (empty($this->_validates)) {
			# 如果验证规则为空，则不需要验证，返回true
			return true;
		}

		foreach ($this->_validates as $_val) {
			if ($_val[1]=='skip') {
				# 如果存在skip的字段，则跳过验证
				continue;
			}
			# 验证规则第一项为字段名
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
				# 如果该字段在模型的属性值中不存在，则跳过验证
				if (!in_array($_val[0],$this->_model->attributes())) {
					$res = true;
					continue;
				}
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
		// $value = $this->_attributes[$rule[0]];
		$value = $this->_model->{$rule[0]};
		$value = trim($value);
		// if (!$value) {
		// 	# 如果没有需要验证的值，则返回错误
		// 	$this->_errors[$rule[0]] = '没有需要验证的值';
		// 	return false;
		// }
		# 将验证数组的第二项首字母大写
		# 与Validator相连，形成如RequiredValidator的形式
		# 连接后的名字即为验证类的名称
		$className = ucfirst($rule[1]).'Validator';
		$className = "\\classes\\Validator\\$className";
		$validatorClass = new $className;
		// print_r($rule);
		// echo $value;
		$label = isset($this->_attributeLabels[$rule[0]]) ? $this->_attributeLabels[$rule[0]] : strtoupper($rule[0]);
		$res = $validatorClass->checkData($this->_model,$rule,$label);
		// $res = $validatorClass->checkData($value,$rule,$label);
		if (!$res) {
			# 验证结果为false，则将错误信息保存到errors数组
			$this->addError($validatorClass->errors);
			// print_r($this->_errors);
		}
		return $res;
	}

	/**
     * 将错误信息添加到错误信息数组
     * @param $errorMsg string 错误信息
     *
     * */
    protected function addError($errorMsg){
        $key = key($errorMsg);
        if (isset($this->_errors[$key])) {
        	$this->_errors[$key] .= ';'.$errorMsg[$key];
        	# 如果该字段已经存在了错误提示信息，则添加到该错误信息数组中
        	// if (is_string($this->_errors[$key])) {
        	// 	echo 'have'.$this->_errors[$key].'<br/>';
        	// 	# 如果该字段只存在一个错误提示
        	// 	// $oldError = $this->_errors[$key];
        	// 	// $this->_errors[$key] = [];
        	// 	// $this->_errors[$key][0] = $oldError;
        	// 	// $this->_errors[$key][1] = $errorMsg[$key];
        	// }else{
        	// 	echo 'arr2333<br/>';
        	// 	array_push($this->_errors[$key],$errorMsg[$key]);
        	// }
        }else{
        	$this->_errors[$key] = $errorMsg[$key];
        }
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