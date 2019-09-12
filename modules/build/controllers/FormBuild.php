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
use modules\build\models\FormBuildModel;
use classes\Security;

class FormBuild extends BaseController
{
	protected $model = null;

	public function __construct(){
		parent::__construct();
		$this->model = new FormBuildModel;
	}
	public function indexAction(){
		$this->params['page_title'] = '表单生成页';
		$this->have_script = 0;
		$this->params['aList'] = $this->model->select();
		$this->renderInclude();
	}

	public function addAction(){
		$this->params['page_title'] = "新增表单";
		if ($this->model->load($_POST,'FormBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['FormBuild']);
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
		$this->params['page_title'] = '编辑表单';
		$id = (int)$_GET['id'];
		if (!$id) {
			$this->redirectMsg('没有数据ID',['index']);
		}
		$this->model->setModel($id);
		// $this->model->scenario = 'update';
		$this->params['model'] = $this->model;
		
		if ($this->model->load($_POST,'FormBuild') && $this->model->save()) {
			// 生成模型文件
			$this->build($_POST['FormBuild']);
			$this->redirectMsg('编辑成功',['view','id'=>$id],3);
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
				@unlink('./modules/'.$data['module_name'].'/views/'.strtolower($data['controller_class']).'/form.php');
			}
			$this->redirectMsg($msg,['index']);
		}else{
			$this->redirectMsg('没有数据ID',['index']);
		}
	}

	protected function build($data){
		$data = Security::stripslashes($data);
		// $model_class = str_replace('\\','/',$data['model_class']);
		$dir = './modules/'.strtolower($data['module_name']).'/views/'.strtolower($data['controller_class']);
		$url = $dir.'/form.php';
		$from = './templates/build/forms/defaultForm.php';
		if (!file_exists($dir)) {
			# 文件夹不存在则创建
			mkdir($dir);
			chmod($dir, 0777);
		}
		if (!file_exists($from)) {
			# 如果文件不存在则创建文件
			$fp = fopen($from,'w');
			@fclose($fp);
		}
		$model = new $data['model_class'];
		$data['labels'] = $model->attributeLabels();
		$temp = file_get_contents($from);
		$inputStr = '';
		foreach ($data['labels'] as $key => $value) {
			$inputStr .= $this->buildInput($data['controller_class'],$key,$value);
		}
		$temp = str_replace('$inputStr$',$inputStr,$temp);
		$temp = str_replace('$created_time$',date('Y/m/d H:i:s',time()),$temp);
		file_put_contents($url, $temp);
	}

	protected function buildInput($controller_class,$key,$value){
		$repStr = str_repeat("\t",11);
		$str = "\r\n".$repStr;
		$str .= "<div class='form-group'>\r\n";
		$str .= $repStr;
		$str .= "\t<label class='col-sm-3 control-label no-padding-right' for='".$key."'>".$value."</label>\r\n";
		$str .= $repStr;
		$str .= "\t<div class='col-sm-9'>\r\n";
		$str .= $repStr;
		$str .= "\t\t<div class='clearfix'>\r\n";
		$str .= $repStr;
		$name = '"'.$controller_class.'['.$key.']"';
		$str .= "\t\t\t<input type='text' name=".$name." id='".$key."'";
		// 添加用placeholder
		// 编辑用value
		$add = " placeholder='请输入".$value."'";
		$edit = ' value="<?=isset($model) ? $model->'.$key.' : ""?>"';
		/*
		$edit = ' value="<?=isset($model->attributes["'.$key.'"]) ? $model->'.$key.' : ""?>"';
		*/
		$str .= $add.$edit;
		// $str .= " class='col-xs-10 col-sm-5'\r\n";
		$str .= " class='col-xs-10 col-sm-5'";
		$str .= " />";
		$str .= "\r\n";
		$str .= $repStr;
		$str .= "\t\t</div>\r\n";
		$str .= $repStr;
		$str .= "\t</div>\r\n";
		$str .= $repStr;
		$str .= "</div>\r\n";
		$str .= $repStr;
		$str .= "<div class='space-4'></div>";
		return $str;
	}

	public function testAction(){
		$data = [];
		// $data['model_class'] = 'common\models\CategoryModel';
		$data['module_name'] = 'admin';
		$data['controller_class'] = 'Category';
		$data['model_class'] = "common\models\CategoryModel";
		$data2['labels'] = [
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