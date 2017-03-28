<?php
namespace Home\Controller;
// use Home\FatherController;
class OrderController extends FatherController {
	/**
	*订单表
	*
	*
	*
	*/
    public function index(){
		// dump($suplist);die;
		$User = D('Order');//对象
		$count      = $User->countNum();
		// dump($count);die;
	
		// count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','最后一页');
		$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->getPage($Page->firstRow,$Page->listRows);
		// dump($list);die;
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出

		$this->display('Index');
	}
	public function schOrder(){
		
		dump($_POST);die;
		
	}
	public function addOrder(){
		if($_POST){
			dump($_POST);die;
	
		}else{
			$o_cus = D('Customer');
			$cusinfo = $o_cus->getAble();
			// dump($cusinfo);die;
			$this->assign('cus',$cusinfo);
			$this->display("Addorder");
		}
		
	}
	public function editOrder(){
		dump($_GET);die;
	}
}