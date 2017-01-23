<?php
namespace Home\Controller;
	
class LoginController extends FatherController{
    protected $seKey2 = 'ThinkPHP.CN';
	public function login(){
		// die('222');
		// $User = D('User');
		// 相当于 $User = new \Home\Model\UserModel();
		// 执行具体的数据操作
		// die('2222222x');
		// $data=$User->getUser();
		// $this->assign('data',$data);
		$this->display();
	}
	public function verify(){
		$Verify = new \Think\Verify();
		$Verify->length   = 4;
		// $Verify->useZh = true; 
		// 设置验证码字符
		//$Verify->zhSet = '们以我到他会作时要动国部民可出能方进在了不和有大这';
		// $value = session('verify_code');
		// echo value;
		$Verify->entry();
		
		
	}
	public function jieshou(){		
		
		if(!empty(cookie('name'))&&!empty(cookie('gd'))){
				
				// $this->assign('usname',cookie('name'));
				$this->display('Index:main');
	
		}
		elseif($this->check_verify(I('post.code')) && $_POST){
			$user = D('User');
			$username=I('post.u');
			$user_pass_str=I('post.p');
			
			
			$user_pass_str      = substr_replace($user_pass_str, '', 0, 1);//破坏原始数据
			$user_pass_str      = substr_replace($user_pass_str, '', -1, 1);//破坏原始数据
			$user_pass_input    = md5(md5($user_pass_str).'Bs7RmJ');
			$userinfo  = $user->getUser($username);
			// echo $user_pass_input.'</br>';
			// echo $userinfo['u_passward'];
			// die('sss');
			if($userinfo && $userinfo['u_passward'] == $user_pass_input && $this->check_ip($_SERVER['REMOTE_ADDR'])){
				// exit('333333');
				// echo $userinfo['full_name'];die('2211');
				cookie('name',$userinfo['full_name'],array('expire'=>3600));
				cookie('gd',$userinfo['group_id'],array('expire'=>3600));
				cookie('cd',$userinfo['company_id'],array('expire'=>3600));
				cookie('ud',$userinfo['id'],array('expire'=>3600));
				$logdata=D('Log');
				// dump($_SERVER);die;
				$loginfo=[];
				$loginfo['log_ip']=$_SERVER['REMOTE_ADDR'];
				$loginfo['log_name']=$userinfo['full_name'];
				$loginfo['u_id']=$userinfo['id'];
				$loginfo['up_date'] = time();
				$logdata->addLog($loginfo);
				$this->assign('usname',$userinfo['full_name']);
				$this->display('Index:main');

			}else{
				redirect('/Home/Login/login/');
			}
			
		}else{
				
			// die('111');
			//$this->error("验证码错误！");
			redirect('/Home/Login/latOut/');
		}
		
		
		
	}
	public function latOut(){
		cookie('name',null); 
		cookie('ud',null); 
		cookie('gd',null); 
		cookie('cd',null); 
		// redirect('/Home/Login/login/');
		echo '<script type="text/javascript">window.top.location.href="'.PUB.'";</script>';
	}
	private function logInfo(){
		
	}
	public function ajaxVerify(){
		$code=I('post.code');
		
		$key        =   $this->authcode($this->seKey2);
		$secode = session($key);
		if($this->authcode(strtoupper($code)) == $secode['verify_code']){
			echo '11';
		}else{
			echo '00';
		}	
	}
	public function check_verify($code, $id = ''){
		$verify = new \Think\Verify();
		return $verify->check($code, $id);
	}
	
	public function top(){
		// $this->display();
		var_dump(session('verify_code')); die;
	}
	private function authcode($str){
        $key = substr(md5($this->seKey2), 5, 8);
        $str = substr(md5($str), 8, 10);
        return md5($key . $str);
    }
	
}