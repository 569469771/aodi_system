<?php
namespace Home\Model;
use Think\Model;
class OrderModel extends Model {
	protected $tableName = 'orderone';
	protected $tableName2 = 'ordertwo';
	//实例化模型
	public function getUser(){
		$User = M("User"); // 实例化User对象
		$User->table('my_user')->where('name="ww1985"')->find();
		// $result=$User->result();
	
		return $User->data;
		// echo $this->getLastSql();die;
	}
	public function countNum(){
		$User = M('Orderone');//对象
		$count      = $User->table($tableName)
		->join('aodi_ordertwo ON aodi_orderone.id = aodi_ordertwo.orderone_id')
		// ->join('aodi_customer ON aodi_orderone.customer_id = aodi_customer.id')
		//->fetchSql(true)
		->count();
		return $count;
		// echo $this->getLastSql();die;
	}
	public function getPage($firstRow,$listRows){
		$User = M('Orderone');
		$list = $User
		->table($tableName)
		->join('aodi_ordertwo ON aodi_orderone.id = aodi_ordertwo.orderone_id')
		->order('id desc')->
		limit($firstRow.','.$listRows)->select();
		return $list;
	}
	public function getOrder($mantnum){
		$User = M("Orderone");
		$list = $User
		->table($tableName)
		->where("`mant_num` = '".$mantnum."'")->find();
		return $list;
		
	}
}