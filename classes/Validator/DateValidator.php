<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 16:18
 * @name 	网站表单验证文件-验证日期格式
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class DateValidator extends AbstractValidator
{
	protected $message = '{attribute}的格式不正确';

	/**
	 * 验证必填项
	 * @param  [object]  $model 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','date','format'=>'yy-mm-dd H:i:s','message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		// $value = trim($value);
		$datetime = strtotime($value);
		if (!$datetime) {
			# 没有value值
			if (isset($rule['message'])) {
				$this->setError($rule[0],$rule['message'],$label);
			} else {
				$this->setErrorNoDefaultMsg($rule[0],$label);
			}
			return false;
		}

		# 按给定的格式重新设置该字段值
		$model->{$rule[0]} = date($rule['format'],$datetime);
		return true;
	}
}