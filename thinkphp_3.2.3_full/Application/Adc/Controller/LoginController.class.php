<?php
namespace Adc\Controller;
//use Home\FatherController;
class LoginController extends FatherController {
    // public function index(){
        // var_dump($_SERVER);
		// $this->show('<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} body{ background: #fff; font-family: "微软雅黑"; color: #333;font-size:24px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.8em; font-size: 36px } a,a:hover{color:blue;}</style><div style="padding: 24px 48px;"> <h1>:)</h1><p>欢迎使用 11<b>ThinkPHP</b>！</p><br/>版本 V{$Think.version}</div><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_55e75dfae343f5a1"></thinkad><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script>','utf-8');
		// $this->login();
		
	// }
	public function login(){
		$User = D('User');
		// 相当于 $User = new \Home\Model\UserModel();
		// 执行具体的数据操作
		$data=$User->getUser();
		$this->assign('data',$data);
		if($_POST==null)
			$this->display();
		else{
			print_r($_POST);
		}
		
	}
	public function verify(){
		$Verify = new \Think\Verify();
		$Verify->length   = 4;
		// $Verify->useZh = true; 
		// 设置验证码字符
		//$Verify->zhSet = '们以我到他会作时要动国部民可出能方进在了不和有大这';
		$Verify->entry();
	}
}