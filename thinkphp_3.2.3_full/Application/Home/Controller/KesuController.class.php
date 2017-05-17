<?php
namespace Home\Controller;
// use Home\FatherController;
class KesuController extends FatherController {
    public function index(){

		$this->display('Index');
		
	}
	public function addKs(){
		
		if($_POST){
			dump(I('post'));
			dump($_POST);
		}else{
			$this->display('Kesuadd');
		}
		
	}
	public function addqxian(){
		$this->display('Addqxian');
	}
}