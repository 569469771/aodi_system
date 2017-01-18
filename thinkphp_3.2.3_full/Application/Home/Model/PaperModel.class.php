<?php
namespace Home\Model;
use Think\Model;
class PaperModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function getUser(){
		$User = M("User"); // 实例化User对象
		$User->table('my_user')->where('name="ww1985"')->find();
		// $result=$User->result();
	
		return $User->data;
		// echo $this->getLastSql();die;
	}
}