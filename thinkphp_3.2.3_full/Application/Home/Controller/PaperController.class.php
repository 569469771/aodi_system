<?php
namespace Home\Controller;
// use Home\FatherController;
class PaperController extends FatherController {
    public function index(){
		$sup = D('Supplier');
		$suplist = $sup->getAll();
		// dump($suplist);die;
		$User = M('Paper');//对象
		$count      = $User->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','最后一页');
		
		$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->order('id desc')->
		limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('suplist',$suplist);
		
		$this->display('Paper');
		
	}
	public function addPaper(){

		$this->display('Addpaper');
		
	}
	public function editPaper(){

		$this->display('Editpaper');
		
	}
	
}