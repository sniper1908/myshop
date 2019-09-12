<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 14:18
 * @name 	网站表单验证文件-验证是否在数组中
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class InValidator extends AbstractValidator
{
	protected $message = '{attribute}的值不在给定范围内';

	/**
	 * 验证必填项
	 * @param  [object]  $model 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','in','range'=>[1,2,3...],'message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		$value = trim($value);
		if (!in_array($value,$rule['range'])) {
			# 没有value值
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