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
	public function getPaperId($id){
		$pa = M("Cuspaper");
		$flag=$pa->field("cuspa_state")->where("`paper_id` = '".$id."'")->find();
		return $flag;
	}
	public function editCusPaper($id,$data){
		$pa = M("Cuspaper");
		$flag=$pa->where("`paper_id` = '".$id."'")->data($data)->save();
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
	
	public function getCusPaper($code='0'){
		$cusp = M("Cuspaper");
		if($code!='0'){
			$data = $cusp
			->field('cp.id as cpid,cp.cuspa_state,p.*,c.customer_name,c.customer_code,s.sup_name')
			->table('aodi_cuspaper as cp')
			->where('cp.`cuspa_state` = "1" and c.`customer_code` = "'.$code.'"')
			->join('aodi_paper as p ON p.id = cp.paper_id')
			->join('aodi_customer as c ON c.id = cp.customer_id')
			->join('aodi_supplier as s ON s.id = cp.sup_id')
			->select();
		}else{
			$data = $cusp
			->field('cp.id as cpid,cp.cuspa_state,p.*,c.customer_name,c.customer_code,s.sup_name')
			->table('aodi_cuspaper as cp')
			->where('cp.`cuspa_state` = "1"')
			->join('aodi_paper as p ON p.id = cp.paper_id')
			->join('aodi_customer as c ON c.id = cp.customer_id')
			->join('aodi_supplier as s ON s.id = cp.sup_id')
			->select();
		}
		
		// echo $this->getLastSql();die;
		return $data;
	}
	public function listCusPaper($firstrow,$listrows){
		$cuspaper = M('Cuspaper');
		$list = $cuspaper
		->order('cpid desc')
		->field('cp.id as cpid,cp.cuspa_price,cp.cuspa_state,p.*,c.customer_name,c.customer_code,s.sup_name')
		->table('aodi_cuspaper as cp')
		->where('cp.`cuspa_state` = "1"')
		->join('aodi_paper as p ON p.id = cp.paper_id')
		->join('aodi_customer as c ON c.id = cp.customer_id')
		->join('aodi_supplier as s ON s.id = cp.sup_id')
		->limit($firstrow.','.$listrows)
		->select();
		return $list;
	}
	public function getById($id){
		$cuspaper = M('Cuspaper');
		$list = $cuspaper
		
		->field('cp.id as cpid,cp.customer_id,cp.cuspa_price,cp.cuspa_state,p.*,c.customer_name,c.customer_code,s.sup_name')
		->table('aodi_cuspaper as cp')
		->where('cp.`id` = "'.$id.'"')
		->join('aodi_paper as p ON p.id = cp.paper_id')
		->join('aodi_customer as c ON c.id = cp.customer_id')
		->join('aodi_supplier as s ON s.id = cp.sup_id')
		
		->find();
		return $list;
	}
	
}