<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/10 10:21
 * @name 	获取配置文件内容
 */
namespace classes;

class Config
{
	private $_aConfig = [];

	/**
	 * [从配置文件中查找一条配置信息]
	 * @param  [string] $item     [配置项名称]
	 * @param  [string] $fileName [配置文件名]
	 * @return [mixed]            [配置信息]
	 */
	// 此处需要修改#####################################################
	public function getOne($item,$fileName,$module='public'){
		$moduleConfig = [];
		// if (@!isset($this->_aConfig[$fileName][$item])) {
			# 如果当前数组中不存在查找项，则从文件中查找
			# 获取公共的配置信息
			$this->_aConfig[$fileName] = @include ROOT . '/configs/' . $fileName . '.php';
			if ($module!='public') {
				$path = ROOT . '/modules/' . $module . '/configs/params.php';
				if (file_exists($path)) {
					# 模块配置文件
					$moduleConfig = @include $path;
				}
			}
		// }

		return isset($moduleConfig[$item]) ? $moduleConfig[$item] : $this->_aConfig[$fileName][$item];
	}

	/**
	 * [获取配置文件中的全部配置项]
	 * @param  [string] $fileName [配置文件名]
	 * @return [array]            [配置数组]
	 */
	public function getAll($fileName,$module='public'){
		$configs = @include ROOT . '/configs/'.$fileName.'.php';
		$mergeConfig = $configs;
		if ($module!='public') {
			$path = ROOT . '/modules/' . $module . '/configs/params.php';
			if (file_exists($path)) {
				# 模块配置文件
				$moduleConfig = @include $path;
				$mergeConfig = array_merge($configs , $moduleConfig);
			}
		}
		return $mergeConfig;
	}
}