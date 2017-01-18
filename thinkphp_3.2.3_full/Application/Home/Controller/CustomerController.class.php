<?php
namespace Home\Controller;
// use Home\FatherController;
class CustomerController extends FatherController {
    public function index(){

		$User = M('Customer');//对象
		$count      = $User->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','最后一页');
		
		$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->order('id')->where('`customer_state` = "1"')->
		limit($Page->firstRow.','.$Page->listRows)->select();
		

		// var_dump(array_keys($list[0])[0]); 
		// var_dump($list);die;
		// echo $show;
		// die;
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display('Customer');
		
	}
	public function addCus($id='0'){
		if($id=='0'){


			if($_POST && cookie('name')){
				// dump($_POST);die;
				$cusinfo['customer_name']=strtr(I('post.customer_name'), array(' '=>''));
				$cusinfo['customer_code']=strtr(I('post.customer_code'), array(' '=>''));
				$cusinfo['customer_adress']=I('post.customer_adress');
				$cusinfo['customer_fname']=I('post.customer_fname');
				$cusinfo['u_id'] = cookie('ud');
				$cusinfo['company_id'] = cookie('cd');
				$cusinfo['customer_state']=I('post.customer_state');
				$cusinfo['up_date'] = time();
				$cus=D('Customer');
				$cusfind=$cus->getCus($cusinfo['customer_code'],$cusinfo['customer_name']);
				if(!$cusfind){
					$cusflag=$cus->insertCus($cusinfo);
					if($cusflag){
						$this->success('添加成功', '/Home/Customer/index/',1);	
					}else{
						$this->error('操作失败','/Home/Customer/addCus/',3);
					}			
				}else{
					$this->error('客户已存在！','/Home/Customer/index/',3);
				}
			
			}else{
				$this->display('Addcus');
			}
		}else{
			
			// echo $id;die;
			$id=I('get.id');
			// echo $id;die;
			$cus=D('Customer');
			$cusfind=$cus->getById($id);
			// dump($cusfind);die;
			if($cusfind){
				$this->assign('customer',$cusfind);
				$this->display('Editcus');
			}else{
				$this->error('客户ID不存在','/Home/Customer/addCus/',3);
			}
		}
	}
	public function delCus(){
		$this->display('Addqxian');
	}
	
	public function editCus($id='0'){
		if($id!='0'){


			if($_POST && cookie('name')){
				// dump($_POST);die;
				$cusinfo['customer_name']=strtr(I('post.customer_name'), array(' '=>''));
				$cusinfo['customer_code']=strtr(I('post.customer_code'), array(' '=>''));
				$cusinfo['customer_adress']=I('post.customer_adress');
				$cusinfo['customer_fname']=I('post.customer_fname');
				$cusinfo['u_id'] = cookie('ud');
				$cusinfo['company_id'] = cookie('cd');
				$cusinfo['customer_state']=I('post.customer_state');
				$cusinfo['up_date'] = time();
				$cus=D('Customer');
				$cusfind=$cus->getCus($cusinfo['customer_code'],$cusinfo['customer_name'],$id);
				if($cusfind){
					
					$this->error('与其他客户重名','/Home/Customer/index/',3);
								
				}else{
					$cusflag=$cus->addById($cusfind['id'],$cusinfo);
					$this->success('添加成功', '/Home/Customer/index/',2);
				}
			
			}else{
				$this->display('Addcus');
			}
		}else{
			
			$this->error('操作失败','/Home/Customer/index/',3);
		}
	}
}