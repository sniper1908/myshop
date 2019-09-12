<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 9:17
 * @name 	网站表单验证文件-安全项不需要验证 
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class SafeValidator extends AbstractValidator
{
	protected $message = '该项不需要验证';

	/**
	 * 验证必填项
	 * @param  [object]  $value 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','safe','message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		# 跳过验证
		return true;
	}
}