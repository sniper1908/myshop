<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 15:44
 * @name 	网站表单验证文件-验证是否是字符串
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class StringValidator extends AbstractValidator
{
	protected $message = '{attribute}该项为字符串';

	/**
	 * 验证必填项
	 * @param  [object]  $model 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','string','length'=>[2,10],'message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		$value = trim($value);
		if (!is_string($value)) {
			# 没有value值
			if (isset($rule['message'])) {
				$this->setError($rule[0],$rule['message'],$label);
			} else {
				$this->setErrorNoDefaultMsg($rule[0],$label);
			}
			return false;
		}
		$len = mb_strlen($value);
		$min = $rule['length'][0];
		$max = $rule['length'][1];
		if ($len<$min || $len>$max) {
			# 字符串长度不对
			$this->message = '{attribute}长度在'.$min.'-'.$max.'之间';
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