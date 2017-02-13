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
		if($_POST && cookie('name')){
			// dump($_POST);die;
			$data=[];
			$data['sup_id']=I('post.sup_id');
			$data['paper_property']=I('post.paper_property');
			$data['paper_name']=I('post.paper_name');
			$data['paper_price']=floatval(I('post.paper_price'));
			$data['gram_weight']=floatval(I('post.gram_weight'));
			$data['paper_state']=I('post.paper_state');
			$data['up_date'] = time();
			// dump($data);die;
			$pap= D('Paper');
			$pflag=$pap->getPaper($data['sup_id'],$data['paper_property']);
			if($pflag){
				$this->error('已有相同数据！','/Home/Paper/index/',3);
			}else{
				$inflag=$pap->addPaper($data);
				if($inflag){
					$this->success('添加成功', '/Home/Paper/index/',1);	
				}else{
					$this->error('添加失败！','/Home/Paper/index/',3);
				}
			}
		}else{
			$sup = D('Supplier');
			$suplist = $sup->getAll();
			$this->assign('suplist',$suplist);
			$this->display('Addpaper');
		}
	}
	public function editPaper($id='0'){
		$id=intval(I('get.id'));
		if($id=='0'){
			$this->error('ID不存在！','/Home/Paper/index/',3);
		}else{
			if(empty($_POST)){
				$pap= D('Paper');
				$arr = $pap->getById($id);
				if($arr){
					$sup = D('Supplier');
					$suplist = $sup->getAll();
					$this->assign('suplist',$suplist);
					$this->assign('arr',$arr);
					$this->display('Editpaper');
				}else{
					$this->error('ID不存在！','/Home/Paper/index/',3);
				}
			}else{
				$data=[];
				$state=[];
				$data['sup_id']=I('post.sup_id');
				$data['paper_property']=I('post.paper_property');
				$data['paper_name']=I('post.paper_name');
				$data['paper_price']=floatval(I('post.paper_price'));
				$data['gram_weight']=floatval(I('post.gram_weight'));
				$data['paper_state']=I('post.paper_state');
				$data['up_date'] = time();
				$state['cuspa_state']=I('post.paper_state');
				$pap= D('Paper');
				$pflag=$pap->getById($id);
				if($pflag){
					$inflag=$pap->editData($id,$data);
					if($inflag){
						
						$cuspap= D('Cuspaper');
						$cpdata = $cuspap->getPaperId($id);
						
						if($cpdata!=null){
							if($cpdata['cuspa_state']!=$data['paper_state']){
								$cpflag = $cuspap->editCusPaper($id,$state);
								if($cpflag){
									$this->success('修改成功', '/Home/Paper/index/',1);
								}else{
									$this->error('修改cuspaper表cuspa_state数据失败！','/Home/Paper/index/',3);
								}	
							}else{
								$this->success('修改成功', '/Home/Paper/index/',1);
							}

						}else{
							$this->success('修改成功', '/Home/Paper/index/',1);
						}
					}else{
						$this->error('修改失败！','/Home/Paper/index/',3);
					}
			
				
				}else{
					$this->error('ID不存在！','/Home/Paper/index/',3);
				}
			}
		}
	}
	public function schPaper(){
		if($_POST){
			// dump($_POST);die;
			$pdata=['sup_id'=>'0','paper_property'=>'0'];
			if(I('post.sup_id')=='0'&& I('post.paper_property')!=''){
				unset($pdata['sup_id']);
				$pdata['paper_property']=I('post.paper_property');
			}elseif(I('post.paper_property')==''&& I('post.sup_id')!='0'){
				unset($pdata['paper_property']);
				$pdata['sup_id']=intval(I('post.sup_id'));
			}elseif(I('post.paper_property')!=''&& I('post.sup_id')!='0'){
				$pdata['sup_id']=intval(I('post.sup_id'));
				$pdata['paper_property']=I('post.paper_property');
			}else{
				$this->error('请提交数据！','/Home/Paper/index/',3);
			}
			// dump($pdata);die;
			$sup = D('Supplier');
			$suplist = $sup->getAll();
			// dump($suplist);die;
			$User = M('Paper');//对象
			$count      = $User->where($pdata)->count();// 查询满足要求的总记录数
			$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)

			$Page->setConfig('first','第一页');
			$Page->setConfig('last','最后一页');
			$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$list = $User->where($pdata)->order('id desc')->
			limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('suplist',$suplist);
			$this->assign('pdata',$pdata);
			$this->display('Spaper');
		}else{
			$this->error('请提交数据！','/Home/Paper/index/',3);
		}
		
	}
	
}