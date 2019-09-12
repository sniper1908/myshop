<?php
/**
 * @version [1.0] [重写版本]
 * @author  山鹰<[19088382@qq.com]>
 * @apply 	>=PHP5.4 适用版本
 * @date 	2017/10/13 8:45
 * @name 	网站核心文件-公共函数类
 */
namespace classes;

class Helper
{
	private static $_lockFp = [];

	/**
     * 获取url地址
     * @param $url   string 模块/类名/方法名
     * @param $paras array  键值对 id=1,cate_id=1
     * @return string 完整的url地址
     *
     * */
	public static function U($url,$params=[]){
		if (strpos($url, 'http') !== false) {
			return $url;
		}

		$oApp = Web::app();
		$oRoute = $oApp->Route;
		if ($oRoute->getConfig('urlMode')==0) {
			$pstr = '';
			if (!empty($params)) {
				foreach ($params as $key => $value) {
					$pstr .= '&'.$key.'='.$value;
				}
			}

			return $_SERVER['SCRIPT_NAME'].'?'.$oRoute->getRouteVarName().'='.$url.$pstr;
		}
	}
    
    // JSON
    public static function json($data , $type='encode'){
        if ($type=='encode') 
        {
            $data = json_encode($data);
        }else{
            $data = json_decode($data);
        }
        return $data;
    }

    // 设置文件锁
    public static function startLock($lockFileName){
        self::$_lockFp[$lockFileName] = $fp = fopen(ROOT . '/data/lock/' . $lockFileName , 'r' );
        if (!$fp) 
        {
            return false;
        }
        // 尝试连接次数
        $iTry = 10;
        $lock = false;
        do 
        {
            $lock = flock($fp , LOCK_EX);
            if (!$lock) 
            {
                usleep(5000);// 0.05秒
            }
        } while (!$lock && --$iTry>0);
        // } while ($lock && --$iTry>0); 此处$lock应该为false，连续尝试$iTry次
        return $lock;
    }

    // 取消文件锁
    public static function endLock($lockFileName){
        if (isset(self::$_lockFp[$lockFileName])) 
        {
            @flock(self::$_lockFp[$lockFileName] , LOCK_UN);
            @fclose(self::$_lockFp[$lockFileName]);
        }
    }

    // 加密密码
    public static function setPwd($username,$passwd){
		$jiami = md5($username);
		$res = md5($passwd.$jiami);
		return $res;
    }
}