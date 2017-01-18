<?php
namespace Home\Model;
use Think\Model;
class CustomerModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function insertCus($data){
		$User = M("Customer"); // 实例化User对象
		$flag=$User->add($data);
		// $result=$User->result();
	
		return $flag;
		// echo $this->getLastSql();die;
	}
	public function getCus($code,$name,$id='0'){
		$customer = M("Customer"); // 实例化User对象
		if($id=='0'){
			$flag=$customer->where('`customer_code` ="'.$code.'" or `customer_name` = "'.$name.'"')->find();
		}else{
			$flag=$customer->
			where('`customer_code` ="'.$code.'" or `customer_name` = "'.$name.'" and `$id` != "'.$id.'"')->find();
		}
			
		// $result=$User->result();
	
		return $flag;
	}
	public function getById($id){

		$customer = M('Customer');
		$arr=$customer->where('`id` = "'.$id.'"')->find();
		return $arr;
	}
	
	public function saveById($id,$date){
		$customer = M('Customer');
		$flag=$customer->where('`id` = "'.$id.'"')->save($date);
		return $flag;
	}
	
}