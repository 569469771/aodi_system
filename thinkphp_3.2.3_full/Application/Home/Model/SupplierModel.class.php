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
	public function insup($id,$data){
		$msup=M('Supplier');
		$inflag = $msup->where("`id` = '".$id."'")->save($data);
		return $inflag;
	}
	public function getAll(){
		$msup=M('Supplier');
		$data = $msup->field('id,sup_name')->where("`sup_state` = '1' ")->select();
		return $data;
	}
}