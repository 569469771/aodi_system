<?php
namespace Home\Model;
use Think\Model;
class LogModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function addLog($data){
		$User = M("Log"); // 实例化User对象
		$flag=$User->add($data);
		// $result=$User->result();
	
		return $flag;
		// echo $this->getLastSql();die;
	}
	public function getId($id){
		$User = M("Log"); // 实例化User对象
		$flag=$User->where('`id` = "'.$id.'"')->find();
		return $flag;
	}
}