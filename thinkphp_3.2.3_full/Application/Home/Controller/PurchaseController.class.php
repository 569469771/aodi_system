<?php
namespace Home\Controller;
// use Home\FatherController;
class PurchaseController extends FatherController {
    public function index(){

		$this->display('Qxian');
		
	}
	public function qxgroup(){
		if(I('post.qxname') && $_POST){
			
		}else{
			$this->display('Qxian');
		}
		
	}
	public function addqxian(){
		$this->display('Addqxian');
	}
}