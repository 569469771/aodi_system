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
	public function getPaper(){
		
		$paper_py = I('post.paper_py');
		$sup_id = I('post.sup_id');
		
		if($paper_py){
			$pstr = D("Paper");
			$pdata = $pstr->getPaper($sup_id,$paper_py);
			if($pdata){
				echo json_encode($pdata);
			}else{
				echo '00';
			}
			
		}
	}
	public function getCusPaper(){
		// dump(I("get.customer_code"));
		// die('123');
		$check=D("Customer");
		if(I("post.customer_code")){
			// die('12355');
			$customer_code=I("post.customer_code")?I("post.customer_code"):null;
			$getcpd=$check->CusPaper($customer_code);
			if($getcpd){
				echo json_encode($getcpd);
			}else{
				echo '00';
			}
		}
		
	}
		
}