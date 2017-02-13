<?php
namespace Home\Controller;
// use Home\FatherController;
class CustomerController extends FatherController {
    public function index($cid="0"){
		$cid = empty(I('get.cid'))?'0':I('get.cid');
		
		if($cid=='0'){
			$this->cuslist();
			$com = D('Company');
			$comdata = $com->getCompany();
			$this->assign('comdata',$comdata);
			$this->display('Index');
		}else{
			// dump($id);die;
			$this->cuslist($cid);
			$com = D('Company');
			$comdata = $com->getCompany();
			
			$this->assign('cid',$cid);
			$this->assign('comdata',$comdata);
			$this->display('Index');
		}
		
		
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
	
	public function editCus($cid='0',$id='0'){
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
			$cid = empty(I('get.cid'))?'0':I('get.cid');
			$com = D('Company');
			$comdata = $com->getCompany();
			$this->assign('comdata',$comdata);
			$this->cuslist($cid);
			$this->assign('cid',$cid);
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
	
	public function addCusPaper(){
		if($_POST){
			// echo I('post.paper_id');
			// dump($_POST);die;
			$cpdata=[];
			$cpdata['paper_id']=intval(I('post.paper_id'));
			$cpdata['sup_id']=intval(I('post.sup_id'));
			$cpdata['customer_id']=intval(I('post.customer_s'));
			$cpdata['cuspa_state']=intval(I('post.paper_state'));
			$cpdata['u_id']=cookie('ud');
			$cpdata['up_date']=time();
			// dump($cpdata);die;
			$cpobj = D('Cuspaper');
			$sflag = $cpobj->getCpaper($cpdata['paper_id'],$cpdata['customer_id']);
			if($sflag){
				$this->error('此客户已经有了该纸板！','/Home/Customer/cusPaper/',3);
			}else{
				$cpflag = $cpobj->insertCus($cpdata);
				if($cpflag){
					$this->success('添加成功', '/Home/Customer/cusPaper/',2);
				}else{
					$this->error('添加失败','/Home/Customer/cusPaper/',3);
				}
			}
			
		}else{
			$cus = D('Customer');
			$cusdata = $cus->getcusinfo();
			
			$sup = D('Supplier');
			
			$sdata=$sup->getAll();
			if($sdata){
				$this->assign('cusdata',$cusdata);
				$this->assign('suplist',$sdata);
				$this->display('Addcuspaper');
			}else{
				$this->error('加载数据失败！','/Home/Customer/cusPaper/',3);
			}
		}
	}
	public function editCusPaper(){
		$cus = D('Customer');
		$cusdata = $cus->getcusinfo();
		
		$sup = D('Supplier');
		
		$sdata=$sup->getAll();
		if($sdata){
			$this->assign('cusdata',$cusdata);
			$this->assign('suplist',$sdata);
			$this->display('Editcper');
		}else{
			$this->error('加载数据失败！','/Home/Customer/cusPaper/',3);
		}
		
		
		
	}
	public function cusPaper(){
		if($_GET['customer_s']){
			// dump($_POST);die;
			// $customer_code = 'D1';
			// $cuspaper = D('Cuspaper');
			// $cusdata = $cuspaper->getCusPaper();
			// dump($cusdata);die;
			
			$customer_id= I('get.customer_s');
			$customer_code= I('get.customer_t');
			$User = D('Customer');//对象
			$udata = $User->getAble();
			$cuspaper = D('Cuspaper');
			// $User = M('Customer');//对象
			$count      = $cuspaper->where('customer_id = "'.$customer_id.'"')->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$Page->setConfig('first','第一页');
			$Page->setConfig('last','最后一页');
			$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
			
			$list = $cuspaper
			->order('cpid desc')
			->field('cp.id as cpid,cp.cuspa_state,p.*,c.customer_name,c.customer_code,s.sup_name')
			->table('aodi_cuspaper as cp')
			->where('cp.`cuspa_state` = "1" and cp.`customer_id` = "'.$customer_id.'"')
			->join('aodi_paper as p ON p.id = cp.paper_id')
			->join('aodi_customer as c ON c.id = cp.customer_id')
			->join('aodi_supplier as s ON s.id = cp.sup_id')
			->limit($Page->firstRow.','.$Page->listRows)
			->select();
			
			$this->assign('customer_id',$customer_id);
			$this->assign('customer_code',$customer_code);
			$this->assign('page',$show);
			$this->assign('list',$list);
			$this->assign('cus',$udata);
			$this->display('Cuspaper');
				
			
			
			
		}else{
			$User = D('Customer');//对象
			$udata = $User->getAble();
			$cuspaper = D('Cuspaper');
			// $User = M('Customer');//对象
			$count      = $cuspaper->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$Page->setConfig('first','第一页');
			$Page->setConfig('last','最后一页');
			$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
			
			$list = $cuspaper->listCusPaper($Page->firstRow,$Page->listRows);
			
			$this->assign('page',$show);
			$this->assign('list',$list);
			$this->assign('cus',$udata);
			$this->display('Cuspaper');
		}
	}
	/**
	*
	*获取客户分页数据
	*
	*/
	public function cuslist($cid='0'){
		$User = M('Customer');//对象
		if($cid=='0'){
			$count      = $User->count();
		}else{
			$count      = $User->where('`company_id` = "'.$cid.'"')->count();
		}
		// 查询满足要求的总记录数
		
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','最后一页');
		$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		if($cid=='0'){
			$list = $User->order('id')->where('`customer_state` = "1"')->
			limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			$list = $User->order('id')->where('`customer_state` = "1" and `company_id` = "'.$cid.'"')->
			limit($Page->firstRow.','.$Page->listRows)->select();
		}
		
		// var_dump(array_keys($list[0])[0]); 
		// var_dump($list);die;
		// echo $show;
		// die;123
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
	}
	

}