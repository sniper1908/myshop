<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/11/3 9:00
 * @name 	网站模型文件-菜单模型 
 */
namespace common\models;

use classes\Web;
use classes\ActiveRecord;

class AdminModel extends ActiveRecord
{
	// 验证规则
	public function rules(){
		return [
			// [['username','admin_pass','chkpassword','email'],'required','message'=>'该项为必填项'],
			['username','required'],
			['admin_pass','required'],
			['chkpassword','required'],
			['email','required'],
			['username','string','length'=>[2,7],'on'=>'insert'],
			['admin_pass','compare','compareAttribute'=>'chkpassword','operator'=>'=='],
			['admin_pass','string','length'=>[7,14],'on'=>['insert','editPwd']],
			// ['chkpassword','string','length'=>[7,14],'on'=>['insert','editPwd']],
			// ['chkpassword','string','length'=>[7,14],'skip'=>1],
			['chkpassword','skip'],
			['email','email','on'=>['insert','update']],
			['status','number','on'=>['insert','update']],
			['created_time','time','on'=>'insert']
		];
	}

	// 字段对应名称
	public function attributeLabels(){
		return [
			'username' 		=> '用户名',
			'admin_pass' 	=> '密码',
			'chkpassword' 	=> '再次输入密码',
			'email' 		=> '邮箱',
			'status' 		=> '状态',
			'created_time'	=> '创建时间'
		];
	}

	public function login(){
		if (!$this->username) {
			# 用户名不能为空
			$this->errors['username'] = '用户名不能为空';
			return false;
		}
		if (!$this->admin_pass) {
			# 用户名不能为空
			$this->errors['admin_pass'] = '密码不能为空';
			return false;
		}
		$passwordValidationKey = $this->getPasswordValidationKey();
		$this->admin_pass = $this->generatePassword($this->username,$this->admin_pass,$passwordValidationKey);
		$data = $this->findOne("`username`='".$this->username."'");
		if (empty($data)) {
			# 数据库中没有该账号
			$this->errors['username'] = '该账号不存在';
			return false;
		}
		else if ($data['admin_pass']!=$this->admin_pass) {
			# 密码不正确
			$this->errors['admin_pass'] = '密码错误';
			return false;
		}
		else if (!$data['status']) {
			# 没有激活
			$this->errors['status'] = '该账号没有权限';
			return false;
		}
		// 设置session
		$Session = Web::app()->session;
		$admin = [];
		$admin['admin_id'] = $data['id'];
		$admin['username'] = $this->username;
		$admin['admin_level'] = $data['admin_level'];
		$admin['status'] = $data['status'];
		$Session->set('admin',$admin);
		return true;
	}

	public function generatePassword($username,$pass,$passwordValidationKey=''){
		$username = md5($username);
		$password = md5($pass);
		$passwordValidationKey = md5($passwordValidationKey);
		$res = md5($username.$password.$passwordValidationKey);
		return $res;
	}

	protected function getPasswordValidationKey(){
        $oApp = Web::app();
        $Config = $oApp->Config;
        $Route = $oApp->Route;
        $_module = $Route->getModule();
        $passwordValidationKey = $Config->getOne('passwordValidationKey','params',$_module);
		return $passwordValidationKey;
	}

	protected function beforeValidate(){
		parent::beforeValidate();
		if (in_array($this->_attributes['scenario'],['insert','editPwd']) && isset($_POST['chkpassword'])) {
			# 如果提交的数据中有验证密码
			$this->chkpassword = $_POST['chkpassword'];
		}
	}

	protected function beforeSave(){
		parent::beforeSave();
		if (in_array($this->_attributes['scenario'],['insert','editPwd'])) {
	        // 生成密码
	        $passwordValidationKey = $this->getPasswordValidationKey();
	        $this->attributes['admin_pass'] = $this->generatePassword($this->_attributes['username'],$this->attributes['admin_pass'],$passwordValidationKey);
	        // exit;
	        // 插入时间
	        // if (!isset($this->attributes[$this->_pk])) {
	        	// $this->attributes['created_time'] = time();
	        	// print_r($this->attributes);
	        // }
	        // print_r($this->attributes);
		}
	}
}