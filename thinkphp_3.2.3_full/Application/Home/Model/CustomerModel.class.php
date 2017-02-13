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
		// echo $this->getLastSql();die;
		return $flag;
	}
	public function checkcus($name,$code){
		$cus=M("Customer");
		if(empty($name)){
			$data=$cus->where("`customer_code` = '".$code."'")->find();
		}else{
			$data=$cus->where("`customer_name` = '".$name."'")->find();
		}
		 // echo $this->getLastSql();
		return $data;
	}
	public function getcusinfo(){
		$mcus = M("Customer");
		$data=$mcus->field('id,customer_name,customer_code')->select();
		return $data;
	}
	public function getAble(){
		$mcus = M("Customer");
		
		$data=$mcus->field('id,customer_name,customer_code')->
		where('`customer_state` = "1"')->select();

		return $data;
	}
}