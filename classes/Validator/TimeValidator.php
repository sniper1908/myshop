<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/12/1 9:51
 * @name 	网站表单验证文件-将当前的时间戳赋给该字段
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class TimeValidator extends AbstractValidator
{
	protected $message = '{attribute}的格式不正确';

	/**
	 * 验证必填项
	 * @param  [object]  $model 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		// $value = $model->{$rule[0]};		
		# 将当前的时间戳赋给该字段
		$model->{$rule[0]} = time();
		return true;
	}
}