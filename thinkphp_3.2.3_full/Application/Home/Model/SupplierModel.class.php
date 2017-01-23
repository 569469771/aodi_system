<?php
namespace Home\Model;
use Think\Model;
class SupplierModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function getById($id){
		$User = M("Supplier"); // 实例化User对象
		$data = $User->where('`id` = "'.$id.'"')->find();
		
		// echo $this->getLastSql();die;
		return $data;
		
	}
	public function addsup($data){
		$msup=M('Supplier');
		$mflag = $msup->add($data);
		return $mflag;
	}
}