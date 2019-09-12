<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 13:59
 * @name 	网站表单验证文件-设置缺省值 
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class DefaultValidator extends AbstractValidator
{
	protected $message = '{attribute}缺省值设置失败';

	/**
	 * 验证必填项
	 * @param  [object]  $model 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','default','value'=>'默认值','message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$field = $rule[0];
		if (isset($rule['value']) && $rule['value']) {
			# 设置缺省值
			$model->$field = $model->$field ? $model->$field : $rule['value'];
			return true;
		}else{
			# 没有value值
			if (isset($rule['message'])) {
				$this->setError($rule[0],$rule['message'],$label);
			} else {
				$this->setErrorNoDefaultMsg($rule[0],$label);
			}
			return false;
		}
	}
}