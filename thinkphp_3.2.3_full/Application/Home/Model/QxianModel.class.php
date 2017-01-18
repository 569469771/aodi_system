<?php
namespace Home\Model;
use Think\Model;
class QxianModel extends Model {
	protected $tableName = 'qxian';
	
	//实例化模型
	public function getQxian($id='0'){
		$data = D("Qxian");
		// $data->query("SELECT * FROM `aodi_qxian` WHERE ( p_id=0 ) LIMIT 10");
		if($id=='0'){
			$arr=$data->where("`state` = '1'")->select(); 
		}else{
			$arr=$data->where("`id` = '".$id."'")->find(); 
		}
		
		// echo $this->getLastSql()."</br>";
		// $result=$User->result();
		// dump($arr);die;
	
		return $arr;
		// echo $this->getLastSql();die;
	}
	public function inserQxian($data){
		$qxian = D("Qxian");
		$data = $qxian->add($data);
		// $sql = $qxian->fetchSql(true)->add($data);
		// echo $sql;die;
		// var_dump($data);die;
		return $data;
	}
	public function getName($name,$action){
		$data = D('Qxian');
		
		$arr=$data->where('`qx_name` = "'.$name.'" or `action` = "'.$action.'"')->find();
		// echo $this->getLastSql()."</br>";die;
		return $arr;
		
	}
	public function getById($id){
		
	}
	public function upQxian($data,$id){
		$qxian = D("Qxian");
		$data = $qxian->where('`id` = "'.$id.'"')->save($data);
		// $sql = $qxian->fetchSql(true)->add($data);
		// echo $sql;die;
		// var_dump($data);die;
		return $data;
	}
}