<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/7 9:19
 * @name 	网站表单验证文件-两个值对比
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator;

class CompareValidator extends AbstractValidator
{
	protected $message = '{attribute}的比较结果不符合规则';
	protected $operator = '==';

	/**
	 * 验证必填项
	 * @param  [object]  $value 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则] 
	 *                           	['字段名','compare','compareValue'=>30,'compareAttribute'=>'password','operator'=>'>=','message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		$value = trim($value);
		if (isset($rule['compareAttribute'])) {
			$compareAttributeValue = $rule['compareAttribute'];
			if ($model->$compareAttributeValue) {
				# 如果需要比较的是2个字段
				$compareValue = $model->{$rule['compareAttribute']};
				$attributeLabels = $model->attributeLabels();
				$compareLabel = isset($attributeLabels[$rule['compareAttribute']]) ? $attributeLabels[$rule['compareAttribute']] : strtoupper($rule['compareAttribute']);
				$replaceLabel = $label.'与'.$compareLabel;
			} else {
				$this->errors[$rule[0]] = $label.'的比较数据不存在';
				return false;
			}
		} else if (isset($rule['compareValue'])) {
			# 如果是与给定的值比较
			$compareValue = $rule['compareValue'];
			$replaceLabel = $label.'与'.$rule['compareValue'];
		} else {
			$this->errors[$rule[0]] = $label.'缺少比较数据';
			return false;
		}

		$operator = isset($rule['operator']) ? $rule['operator'] : $this->operator;
		$operator = (string)$operator;
		switch ($operator) {
			case '>=':
				$compareRes = $value >= $compareValue;
			case '>':
				$compareRes = $value > $compareValue;
				break;
			case '<=':
				$compareRes = $value <= $compareValue;
			case '<':
				$compareRes = $value < $compareValue;
			
			default:
				$compareRes = $value == $compareValue;
				break;
		}
		if ( $compareRes ) {
			# 比较结果正确
			return true;
		} else {
			# 比较结果错误
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