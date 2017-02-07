<?php
namespace Home\Model;
use Think\Model;
class PaperModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function getPaper($sup_id,$paper_property){
		$pa = M("Paper"); // 实例化User对象
		$flag=$pa->
		where("`sup_id` = '".$sup_id."' and `paper_property` = '".$paper_property."'")
		->find();
		// $result=$User->result();
		// echo $this->getLastSql();die;
		return $flag;
	}
	public function getById($id){
		$pa = M("Paper");
		$data=$pa->where("`id` = '".$id."'")->find();
		return $data;
	}
	public function addPaper($data){
		$pa = M("Paper");
		$flag=$pa->data($data)->add();
		return $flag;
	}
	public function editData($id,$data){
		$pa = M("Paper");
		$flag=$pa->where("`id` = '".$id."'")->data($data)->save();
		return $flag;
	}
	public function getPaCus(){
		$pa = M("Paper");
		$data = $pa
		->where('s.sup_state = "1"')
		->join('aodi_supplier as s on s.id = p.sup_id')
		->select();
		/** select p.*,s.sup_name from aodi_paper as p INNER join 
		*   aodi_supplier as s on s.id = p.sup_id where s.sup_state = "1"
		**/
		return $data;
	}
	public function getSupId($id){
		$pa = M("Paper");
		$data=$pa
		->field('id,paper_property,gram_weight,paper_name')
		->where("`sup_id` = '".$id."' and `paper_state` = '1'")->select();
		return $data;
	}
}