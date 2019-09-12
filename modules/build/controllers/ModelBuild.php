<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/13 10:17
 * @name 	网站后台文件-首页
 */
namespace modules\build\controllers;

use modules\build\classes\BaseController;
use modules\build\models\ModelBuildModel;
use classes\Security;

class ModelBuild extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new ModelBuildModel;
	}
	public function indexAction(){
		$this->params['page_title'] = '模型生成页';
		$this->have_script = 0;
		$this->params['aList'] = $this->model->select();
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增模型";
		// print_r($_POST);
		if ($this->model->load($_POST,'ModelBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['ModelBuild']);
			$this->redirectMsg('添加成功',['index'],3);
			exit;
		}
		if ($this->model->errors) {
			# 存在错误信息
			Web::app()->Session->setFlash('error',$this->model->errors);
		}
		# 新增页面
		$this->renderInclude();
	}

	public function editAction(){
		$this->have_script = 0;
		$this->params['page_title'] = '编辑模型';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'ModelBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['ModelBuild']);
			$this->redirectMsg('编辑成功',['view','id'=>$id],-1);
			exit;
		}
		if ($this->model->errors) {
			# 存在错误信息
			Web::app()->Session->setFlash('error',$this->model->errors);
		}
		# 新增页面
		$this->renderInclude();
	}

	public function viewAction(){
		$id = (int)$_GET['id'];
		if ($id) {
			$data = $this->model->findOneForPK($id);
			$this->params['data'] = $data;
			$this->renderInclude();
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	public function deleteAction(){
		$id = (int)$_GET['id'];
		if ($id) {
			$data = $this->model->findOneForPK($id);
			$res = $this->model->deleteForPK($id);
			$msg = '删除失败';
			if ($res) {
				$msg = '删除成功';
				@unlink('./'.$data['namespace'].'/'.$data['model_class'].'.php');
			}
			$this->redirectMsg($msg,['index']);
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	protected function build($data){
		$data = Security::stripslashes($data);
		$namespace = str_replace('\\','/',$data['namespace']);
		$url = './'.$namespace.'/'.$data['model_class'];
		$url .= '.php';
		if (!file_exists($url)) {
			# 如果文件不存在则创建文件
			$fp = @fopen($url,'w+');
			fclose($fp);
		}
		$from = './templates/build/models/defaultModel.txt';
		$temp = file_get_contents($from);
		foreach ($data as $key => $value) {
			$str = '';
			$str = '$'.$key.'$';
			if (is_array($value)) {
				$replaceStr = "\r\n";
				$i = 0;
				foreach ($value as $k => $v) {
					$i++;
					if (is_string($v)) {
						# labels
						$replaceStr .= $k ? "\t\t\t" : '';
						$replaceStr .= '"'.$k . '" => "' . $v . '"';
						$replaceStr .= $i==count($value) ? "\r\n\t\t" : ','."\r\n";
					}else {
						$replaceStr .= "\t\t\t".'[';
						foreach ($v as $kk => $vv) {
							# rules
							if (is_string($vv)) {
								$replaceStr .= '"'.$vv.'",';
							}else{
								# 譬如length=>[2,5]
								$replaceStr .= "'".$kk."' => [";
								foreach ($vv as $kkk => $vvv) {
									$replaceStr .= $vvv.',';
								}
								$replaceStr = rtrim($replaceStr,',');
								$replaceStr .= ']';
							}
						}
						$replaceStr = rtrim($replaceStr,',');
						$replaceStr .= $k==count($value)-1 ? ']'."\r\n\t\t" : '],'."\r\n";
					}
				}
				$temp = str_replace($str,$replaceStr,$temp);
			}else{
				$temp = str_replace($str,$value,$temp);
			}
		}
		// 基类名称，不包含命名空间
		$base_class = str_replace('\\','/',$data['base_class']);
		$pos = strrpos($base_class,"/");
		$base_class = substr($base_class,$pos+1);
		$temp = str_replace('$baseClassName$',$base_class,$temp);
		$temp = str_replace('$created_time$',date('Y/m/d H:i:s',time()),$temp);
		file_put_contents($url, $temp);
	}

	public function testAction(){
		$data = [];
		$data['model_class'] = 'GoodsModel';
		$data['namespace'] = 'common\models';
		$data['base_class'] = 'classes\ActiveRecord';
		$base_class = substr($data['base_class'],strrpos('\\', $data['base_class']));
		$data['baseClassName'] = $base_class;
		$data['rules'] = [
			['cate_name','required'],
			['cate_name','string','length'=>[2,10]],
			['keywords','string','length'=>[2,100]],
			['des','string','length'=>[2,250]],
			['style_url','string','length'=>[2,100]],
			['order_num','integer'],
			['price_range','integer']
		];
		$data['labels'] = [
			'cate_name' 	=> '分类名',
			'parent_id' 	=> '父级id',
			'order_num' 	=> '排序数字',
			'keywords' 		=> '关键字',
			'des' 			=> '描述',
			'measure_unit' 	=> '单位',
			'show_in_nav' 	=> '导航栏显示',
			'is_show' 		=> '前台显示',
			'price_range' 	=> '价格区间个数',
			'style_url' 	=> '样式路径',
			'filter_attr'	=> '筛选属性'
		];
		$this->build($data);
	}
}