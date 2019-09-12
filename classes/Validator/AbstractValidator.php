<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 14:18
 * @name 	网站表单验证文件-具体的验证类的抽象类
 */
namespace classes\Validator;

abstract class AbstractValidator
{
	public $errors;
	protected $message;

	abstract public function checkData($value,$rule,$label='');

	protected function setError($field,$ruleMessage='',$label=''){
		$this->message = $this->replaceMessage($this->message,$label);
		$ruleMessage = $this->replaceMessage($ruleMessage,$label);
		$message = isset($ruleMmessage) ? $ruleMmessage : $this->message;
		$this->errors[$field] = $message;
	}

	protected function setErrorNoDefaultMsg($field,$label=''){
		$this->message = $this->replaceMessage($this->message,$label);
		$this->errors[$field] = $this->message;
	}

	protected function replaceMessage($message,$label){
		$message = str_replace('{attribute}',$label,$message);
		return $message;
	}
}