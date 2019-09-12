<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 9:01
 * @name 	网站表单验证文件-正则表达式验证
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class MatchValidator extends AbstractValidator
{
	protected $message = '{attribute}的输入不符合规则';

	/**
	 * 验证必填项
	 * @param  [object]  $model 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','match','pattern'=>'正则表达式','message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		$value = trim($value);
		if (!preg_match($rule['pattern'],$value)) {
			$replaceLabel = '您';
			if (isset($label) && $label!=null) {
				$replaceLabel = $label;
			}
			if (isset($rule['message'])) {
				$this->setError($rule[0],$rule['message'],$replaceLabel);
			} else {
				$this->setErrorNoDefaultMsg($rule[0],$replaceLabel);
			}
			return false;
		}
		return true;
	}
}