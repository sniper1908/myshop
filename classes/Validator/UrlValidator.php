<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/6 16:17
 * @name 	网站表单验证文件-验证url
 */
namespace classes\Validator;

use classes\Validator\AbstractValidator

class UrlValidator extends AbstractValidator
{
	protected $message = '请输入一个正确的url地址';

	/**
	 * 验证必填项
	 * @param  [object]  $value 	[模型类]
	 * @param  [array] 	 $rule  	[验证规则]
	 *                           	['字段名','url','message'=>'可选']
	 * @param  [string]  $label  	[字段标签名]
	 * @return [Boolean]        	[是否验证通过]
	 */
	public function checkData($model,$rule,$label=''){
		$value = $model->{$rule[0]};
		$value = trim($value);
		// $regExp = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%
		// =~_|]/";
		// $regExp = "/(http|ftp)s? ://(www\.)?.+(com|net|org)/";
		// $regExp = "/http:[\/]{2}[a-z]+[.]{1}[a-z\d\-]+[.]{1}[a-z\d]*[\/]*[A-Za-z\d]*[\/]*[A-Za-z\d]*[.]*html/";
		// $regExp = "/(http|https|ftp):[\/]{2}[a-z]+[.]{1}[a-z\d\-]+[.]{1}[a-z\d]*[\/]*[A-Za-z\d]*[\/]*[A-Za-z\d]*[.]*[a-z]{2,3}/";
		$regExp = "/(http|https|ftp):[\/]{2}[a-z]+[.]{1}[a-z\d\-]+[.]{1}[a-z\d]+/";
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