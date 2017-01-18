<?php
namespace Home\Model;
use Think\Model;
class CompanyModel extends Model {
	// protected $tableName = 'categories';
	
	//实例化模型
	public function getCompany(){
		$company = D("Company"); // 实例化User对象
		$data=$company->where("`company_state` = '1'")->select();
		// $result=$User->result();
	
		return $data;
		// echo $this->getLastSql();die;
	}
}