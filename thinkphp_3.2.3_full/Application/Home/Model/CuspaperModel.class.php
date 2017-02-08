<?php
namespace Home\Model;
use Think\Model;
class CuspaperModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function insertCus($data){
		$User = M("Cuspaper"); // 实例化User对象	
		$flag=$User->data($data)->add();
		// $result=$User->result();
		// echo $this->getLastSql();die;
		return $flag;
		
	}
	public function getCpaper($paper_id,$customer_id){
		$User = M("Cuspaper");
		$flag = $User->where('`paper_id` = "'.$paper_id.'" and `customer_id` = "'.$customer_id.'" and `cuspa_state` = "1"')
		->find();
		// echo $this->getLastSql();die;
		// dump($flag);die;
		return $flag;
	}
	
	
	
}