<?php
namespace Home\Controller;
// use Home\FatherController;
class CustomerController extends FatherController {
    public function index(){

		$this->cuslist();
		$this->display('Index');
		
	}
	public function addCus($id='0'){
		
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
				$cusfind=$cus->getById(intval($id));
				if($cusfind){
					$cusflag=$cus->saveById(intval($id),$cusinfo);
					if($cusflag){
						$this->success('修改成功', '/Home/Customer/index/',2);
					}else{
						$this->error('添加失败','/Home/Customer/index/',3);
					}
				}else{
					$this->error('没有此客户id','/Home/Customer/index/',3);
					
				}
			
			}else{
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
		}else{
			$this->cuslist();
			$this->display('Customer');
			// $this->error('操作失败','/Home/Customer/index/',3);
		}
	}
	public function addcit(){
		if($_POST){
			if(cookie('name') && cookie('ud')){
				// dump($_POST);die;
				$cusid=I('post.customer_id');
				$cusdata['customer_credit']=I('post.new_credit');
				$cus_code=I('post.customer_code');
				$cusdata["u_cit"]=cookie('ud');
				$cus = D('Customer');
				$idflag=$cus->getById($cusid);
				if($idflag){
					$cusflag = $cus->saveById($cusid,$cusdata);
					if($cusflag){
							$this->success('修改成功', '/Home/Customer/index/',2);
					}else{
						$this->error('添加失败','/Home/Customer/index/',3);
					}
				}else{
					$this->error('没有此客户！','/Home/Customer/index/',3);
				}
				
				
			}else{
				$this->error('cookie过期！','/Home/Customer/index/',3);
			}
		}else{
			$cus = D('Customer');
			$cusdata=$cus->getcusinfo();
			$this->assign('arrs',$cusdata);
			$this->display('Addcit');
		}
	}
	/**
	获取客户分页数据
	**/
	public function cuslist(){
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
		// die;123
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
	}
}