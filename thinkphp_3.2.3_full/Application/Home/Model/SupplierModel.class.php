<?php
namespace Home\Model;
use Think\Model;
class SupplierModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function getById($id){
		$User = M("Supplier"); // 实例化User对象
		$data=$User->where('`id` = "'.$id.'"')->find();
		// $result=$User->result();
	
		return $data;
		// echo $this->getLastSql();die;
	}
}