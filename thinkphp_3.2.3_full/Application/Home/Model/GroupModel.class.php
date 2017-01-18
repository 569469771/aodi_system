<?php
namespace Home\Model;
use Think\Model;
class GroupModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function getGroup(){
		$group = D("Group"); // 实例化User对象
		$data=$group->where("`group_state` = '1'")->select();
		// $result=$User->result();
	
		return $data;
		// echo $this->getLastSql();die;
	}
}