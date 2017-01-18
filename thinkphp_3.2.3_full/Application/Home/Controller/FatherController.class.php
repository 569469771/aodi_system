<?php
namespace Home\Controller;
use Think\Controller;

class FatherController extends Controller{
	protected $groupname;
	public function __construct(){
		parent::__construct();
		
		if(!$this->pregURL($_SERVER['REQUEST_URI'])){
			
		
					if(cookie('name')!=null){
						$qxian = D('Qxian');
						$this->groupname=$qxian->getQxian();
					}else{
						echo '<script type="text/javascript">top.location.href="'.PUB.'";</script>';
						
					}
		}
	}
	function pregURL($test){  
        /** 
            匹配url 
            url规则： 
                例 
                协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名 
                http://zhidao.baidu.com/question/535596723.html 
                协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名?参数 
                www.lhrb.com.cn/portal.php?mod=view&aid=7412 
                协议://域名（www/tieba/baike...）.名称.后缀/文件路径/文件名/参数 
                http://www.xugou.com.cn/yiji/erji/index.php/canshu/11 
                 
                协议：可有可无，由大小写字母组成；不写协议则不应存在://，否则必须存在:// 
                域名：必须存在，由大小写字母组成 
                名称：必须存在，字母数字汉字 
                后缀：必须存在，大小写字母和.组成 
                文件路径：可有可无，由大小写字母和数字组成 
                文件名：可有可无，由大小写字母和数字组成 
                参数:可有可无，存在则必须由?开头，即存在?开头就必须有相应的参数信息 
				$rule = '/^(([a-zA-Z]+)(:\/\/))?([a-zA-Z]+)\.(\w+)\.([\w.]+)(\/([\w]+)\/?)*(\/[a-zA-Z0-9]+\.(\w+))*(\/([\w]+)\/?)*(\?(\w+=?[\w]*))*((&?\w+=?[\w]*))*$/';  

        */ 
		if(strlen($test)==1){
			
		
			// in_array($_SERVER['REQUEST_URI'],$G_URL);
			// $G_URL=['/','/Home/Login/login/','/index.php/Home/Login/verify','/Home/Login/login'];
			$rule = '/^\/$/';  
			preg_match($rule,$test,$result);  
			return $result;  
		}else{
			$rule = '/^\/Home\/Login\//';  
			preg_match($rule,$test,$result);  
			return $result; 
		}
    }
	public function _empty($name){
		
		$this->error('操作失败','/',3);
		// echo '当前城市' . $name;
        //把所有城市的操作解析到city方法
		
        // redirect('/Home/Login/login/');
    }
	public function check_ip($ip){
		if(ip2long($ip)) return true;
		return false;
	}	
}