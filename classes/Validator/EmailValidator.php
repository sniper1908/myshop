<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/6 16:17
 * @name 	网站表单验证文件-验证Email
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class EmailValidator extends AbstractValidator
{
	protected $message = '请输入一个正确的邮箱地址';

	/**
	 * 验证必填项
	 * @param  [object] 	$model 	[模型类]
	 * @param  [array] 	 	$rule  	[验证规则]
	 *                            	['字段名','email','message'=>'可选']
	 * @param  [string]  	$label  [字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		$value = trim($value);
		$regExp = "/([\w\-]+\@[\w\-]+\.[\w\-]+)/";
		if (!preg_match($regExp,$value)) {
			if (isset($rule['message'])) {
				$this->setError($rule[0],$rule['message'],$label);
			} else {
				$this->setErrorNoDefaultMsg($rule[0],$label);
			}
			return false;
		}
		return true;
	}
}