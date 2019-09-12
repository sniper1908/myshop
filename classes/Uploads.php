<?php
namespace classes;
/**
 * 上传类
 * @author 山鹰sniper
 * @time 2016-5-16
 * */

class Uploads
{
    // 上传目录
    private $upload_dir;
    // 最大上传尺寸
    private $max_size;
    // 允许上传类型
    private $allow_types;
    // 失败原因
    protected $error_info;
    // 图片的mime类型
    protected $aImgMime = array('image/jpeg','image/png','image/gif','image/tiff');
    // filename
    protected $filename;
    // file数组
    protected $file;

    public function __construct($upload_dir,$max_size=2000000,$allow_types=array('image/jpeg','image/png','image/gif')){
        $this->upload_dir = $upload_dir;
        $this->max_size = $max_size;
        $this->allow_types = empty($allow_types) ? array('image/jpeg','image/png','image/gif','image/tiff') : $allow_types;
    }

    public function __set($p_name,$p_value){
        if(in_array($p_name,array('upload_dir','max_size','allow_types'))){
            $this->$p_name = $p_value;
        }
    }

    public function __get($p_name){
        if (isset($this->$p_name)) 
        {
            return $this->$p_name;
        }
    }

    /*********************************
     * 上传文件
     * 判断其合理和合法性，移动到指定目标
     * @param $file array 包含了5个上传文件信息的数组
     * @param $prefix string 生成文件的前缀
     * @return mix 成功返回目标文件名，失败返回false
     * */
    public function upload($file,$prefix='upload_'){
    	$this->file = $file;
    	// 判断是否上传有错误
    	if(!$this->checkError()){
    		return false;
    	}
    	// 判断类型
    	if(!$this->checkType()){
    		return false;
    	}
    	// 如果上传的是图片，则判断是否是真实的图片类型
    	if(!$this->checkRealImg()){
    		return false;
    	}
    	// 判断大小
    	if(!$this->checkSize()){
    		return false;
    	}
    	// 出于安全考虑，判断是否是一个真正的上传文件
    	// 不是通过 HTTP POST 方式上传上来的
    	if(!$this->checkPost()){
    		return false;
    	}

        // 移动，通常都会为目标文件重命名
    	// 命名原则：不重名，没有特殊字符，有一定的意义
    	$dst_file = $this->getUniName($prefix);
        // 形成子目录
        $file_dir = $this->makedirForUpload();
        if (move_uploaded_file($this->file['tmp_name'],$file_dir . '/' . $dst_file)) 
        {
            // 上传成功
            $upload_file = $file_dir . '/' . $dst_file;
            return $upload_file;
        }else{
            $this->error_info = '文件移动出错';
            return false;
        }
    }

    // 判断上传文件的error类型
    protected function checkError(){
    	// 判断file是否是个空数组
    	if(is_null($this->file)){
    		$this->error_info = '上传错误';
    		return false;
    	}
    	// 判断是否有错误
        if($this->file['error']!=0){
            // 文件上传错误
            switch ($this->file['error']) 
            {
                case '1':
                    $this->error_info = '文件太大，超出php.ini的限制';
                    break;
                case '2':
                    $this->error_info = '文件太大，超出表单内的MAX_FILE_SIZE的限制';
                    break;
                case '3':
                    $this->error_info = '文件没有上传完';
                    break;
                case '4':
                    $this->error_info = '文件没有上传';
                    break;
                case '6':
                    $this->error_info = '临时文件夹错误';
                    break;
                case '7':
                    $this->error_info = '文件写入失败';
                    break;
                case '8':
                    $this->error_info = '上传的文件被PHP扩展程序中断';
                    break;
            }
            return false;
	   }
	   return true;
    }

    // 判断上传文件是否是允许的类型
    protected function checkType(){
    	if(!is_array($this->allow_types)){
            $this->error_info = '文件类型限定错误';
            return false;
    	}
    	if (!in_array($this->file['type'],$this->allow_types)) 
        {
            $this->error_info = '上传文件类型不对';
            return false;
    	}
    	return true;
    }

    // 如果上传文件为图片，则判断是否是真实的图片
    protected function checkRealImg(){
    	if(in_array($this->file['type'],$this->aImgMime)){
    		if(!getimagesize($this->file['tmp_name'])){
    		    $this->error_info = '上传的不是真实图片';
    		    return false;
    		}
    	}
    	return true;
    }

    // 判断上传文件大小
    protected function checkSize(){
    	if((int)$this->max_size<=0){
            $this->error_info = '文件最大值设置错误';
            return false;
        }
        if ($this->file['size']>$this->max_size) 
        {
            $this->error_info = '文件超出了限制';
            return false;
        }
        return true;
    }

    // 判断是否是通过POST方式上传的文件
    protected function checkPost(){
    	if (!is_uploaded_file($this->file['tmp_name'])) 
        {
            $this->error_info = '上传文件可疑';
            return false;
        }
        return true;
    }

    // 获取错误信息
    public function getError(){
    	return $this->error_info;
    }

    // 获取唯一的文件名
    protected function getUniName($prefix){
        $dst_file = uniqid($prefix) . date('YmdHis') . strrchr($this->file['name'],'.');
        return $dst_file;
    }

    // 如果子文件夹不存在，则创建
    protected function makedirForUpload(){
    	$sub_dir = date('Ymd');
        if (substr($this->upload_dir,-1)!='/') {
            # 如果$this->upload_dir最后字符不是/，则添加上
            $this->upload_dir .= '/';
        }
        if (!is_dir($this->upload_dir . $sub_dir)) 
        {
            // 目录不存在，则创建
            mkdir($this->upload_dir . $sub_dir,0777,true);
            // 判断是否是windows主机 如果是非windows主机，则修改文件夹权限
            chmod($this->upload_dir . $sub_dir , 0777);
        }
        $file_dir = $this->upload_dir . $sub_dir;
        return $file_dir;
    }

    private function isWin(){
    	return strtoupper(substr(PHP_OS,0,3))=='WIN' ? 1 : 0;
    }
}
?>
