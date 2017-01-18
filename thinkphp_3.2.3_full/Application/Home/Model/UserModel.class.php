<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	protected $tableName = 'user';
	
	//实例化模型
	public function getUser($username,$flagid='0'){
		$User = D("User"); // 实例化User对象
		$state['user_state']='1';
		if($flagid=='0'){
			$data=$User->where($state)->where('u_name = "'.$username.'"')->find();
		}else{
			$data=$User->where('u_name = "'.$username.'"')->find();
		}
		
		// echo $this->getLastSql();die;
		// $result=$User->result();
	
		return $data;
		// echo $this->getLastSql();die;
	}
	
	public function getId($id){
		$User = D('User');
		$data=$User->where("id = '{$id}'")->find();
		return $data;
	}
	public function inserInfo($info){
		$userdata=D('User');
		
		$data = $userdata->add($info);
		
		return $data;
		
	}
	public function upInfo($info,$id){
		$userdata=D('User');
		
			$data = $userdata->where('`id` = "'.$id.'"')->save($info);
		
			// echo $this->getLastSql();die;

		return $data;
	}
}