<?php
namespace Home\Controller;
// use Home\FatherController;
class SupplierController extends FatherController {
    public function index(){
		
		$User = M('Supplier');//对象
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
		
		$this->display('Index');
	}
	public function addsup(){
		if( cookie('ud')&& $_POST){
				// redirect('/Home/Login/latOut/');die;
				$supdata =[];
				$supdata['sup_name']=I('post.sup_name');
				$supdata['sup_adress']=I('post.sup_adress');
				$supdata['sup_des']=I('post.sup_des');
				$supdata['sup_state']=I('post.sup_state');
				$supdata['u_id'] = cookie('ud');
				$supdata['up_date'] = time();
				// dump($supdata);die;
				$sup=D("Supplier");
				$supflag=$sup->addsup($supdata);
				if($supflag){
					$this->success('新增成功', '/Home/Supplier/addsup/',3);
				}else{
					$this->error('操作失败','/Home/Supplier/addsup/',3);
				}
		}else{
			$this->display('Addsup');
		}
	}
	public function editsup($id='0'){
		if($id=='0'){
			$this->display('Addsup');
		}else{
			$id=I('get.id');
			if($_POST){
				
			}else{
				$supplier=D('Supplier');
				$sflag=$supplier->getById($id);
				if($sflag){
					$this->assign("data",$sflag);
					$this->display('Editsup');
				}else{
					$this->error('ID不存在','/Home/Supplier/index/',3);
				}
			}
		}
	}
	
}