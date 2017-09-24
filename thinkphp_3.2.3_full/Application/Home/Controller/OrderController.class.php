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
	/*
	*搜索订单
	*
	*/
	public function schOrder(){
		
		dump($_POST);die;
		
	}
	/*
	**
	*添加订单
	*	
	*/
	/*  */
	public function addOrder(){
		if($_POST){
			dump($_POST);die;
			//表1
			// $customer_code = I("post.customer_code");
			// $customer_id = I("post.customer_s");
			// $customer_name = I("post.cus_name");
			// $company_id = cookie('cd');
			// $mant_num = I("post.mant_num");
			// $job_num =
			// $order_urgent = I("post.order_urgent");
			// $order_state =
			// $order_num = I("post.order_num");
			// $order_price =
			// $order_otherprice =
			// $is_paper =
			// $up_uid =
			// $del_date = 
			//表2
			// $orderone_id =
			// $shg_name =
			// $today_price =
			// $box_long =
			// $box_height =
			// $box_width =
			// $paper_property
			// $box_prop =
			// $box_volume =
			// $map_color =
			// $in_uid =
			// $up_date =
			// $order_map =
	
		}else{
			$o_cus = D('Customer');
			$cusinfo = $o_cus->getAble();
			// dump($cusinfo);die;
			$this->assign('cus',$cusinfo);
			$this->display("Addorder");
		}
		
	}
	/* 
	*
	*修改订单
	*/
	public function editOrder(){
		dump($_GET);die;
	}
}