<?php
namespace Home\Controller;
use Think\Controller;

class AjaxController extends Controller{

	public function checkcode(){
	// dump($_POST);die;
		$check=D("Customer");
		$customer_name=I("post.name")?I("post.name"):null;
		$customer_code=I("post.code")?I("post.code"):null;
		$checkdata=$check->checkcus($customer_name,$customer_code);
		if(empty($customer_code) && $checkdata){
			echo 'name';
		}
		if(empty($customer_name) && $checkdata){
			echo 'code';
		}
		if(empty($customer_code) && !$checkdata){
			echo 'name1';
		}
		if(empty($customer_name) && !$checkdata){
			echo 'code1';
		}
		
	}
	public function getCustomer(){
		$check=D("Customer");
		if(I("post.code")){
			$customer_name=I("post.name")?I("post.name"):null;
			$customer_code=I("post.code")?I("post.code"):null;
			$checkdata=$check->checkcus($customer_name,$customer_code);
			if($checkdata){
				echo json_encode($checkdata);
			}else{
				echo '00';
			}
		}
		if(I('post.id')){
			$getdata = $check->getById(I('post.id'));
			if($getdata){
				echo json_encode($getdata);
			}else{
				echo '00';
			}	
			
		}
		
	}
	public function getSupId(){
		
		// echo json_encode($_POST);die;
		$sup_id = intval(I('post.sup_id'));
		if($sup_id){
			$apa = D('Paper');
			$adata = $apa->getSupId($sup_id);
			if($adata){
				echo json_encode($adata);
			}else{
				echo '00';
			}
		}
	}

		
}