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
		$data=$mcus->field('id,customer_name,customer_code')
		->where("`customer_state` = '1'")
		->select();
		return $data;
	}
	public function getAble(){
		$mcus = M("Customer");
		
		$data=$mcus->field('id,customer_name,customer_code')->
		where('`customer_state` = "1"')->select();

		return $data;
	}
	public function CusPaper($customer_code){
		$mcus = M("Customer");
		$data=$mcus->field('p.id,p.paper_property')
		->join('aodi_cuspaper as cp ON aodi_customer.id = cp.customer_id')
		->join('aodi_paper as p ON p.id = cp.paper_id')
		->where("aodi_customer.customer_state = '1' AND aodi_customer.customer_code ='".$customer_code."'")
		->select();
		/*
		select * from aodi_customer as c left join aodi_cuspaper as p on c.id = p.customer_id 
		left join aodi_paper pa on p.paper_id = pa.id
		
		*/
		// echo $this->getLastSql();die;
		return $data;
	}
}