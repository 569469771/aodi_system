<?php
namespace Home\Controller;
// use Home\FatherController;
class QxianController extends FatherController {
    public function index($id="0"){	
		$User = D('qxian');//对象
		// 查询满足要求的总记录数
		if($id!='0'){
			$count = $User->where('`p_id` ="'.$id.'"')->order('id')->
			limit($Page->firstRow.','.$Page->listRows)->count();
		}else{
			$count=$User->count();
		}
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','最后一页');
		if($id=='0'){	
			$list = $User->order('id')->
			limit($Page->firstRow.','.$Page->listRows)->select();
		}else{
			// $count      = $User->count();		
			$list = $User->where('`p_id` ="'.$id.'"')->order('id')->
			limit($Page->firstRow.','.$Page->listRows)->select();
			$this->assign('pval',$id);
		}
		$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性		
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('names',$this->groupname);// 赋值分页输出
		// var_dump(array_keys($list[0])[0]); 
		// var_dump($list);
		// echo $show;
		// die;
		$this->display('Index');	
	}
	public function qxadd(){
		if($_POST){
			if(cookie('ud')){
				$data =[];
				$data['qx_name']=I('post.qxname');
				$data['p_id']=I('post.p_id');
				$data['action']=I('post.action');
				$data['state']=I('post.state');
				$data['u_id'] = cookie('ud');
				$data['up_date'] = time();
				
				$updata = D('Qxian');
				
				$fg=$updata->getName($data['qx_name'],$data['action']);
				if(!$fg){
					$flag=$updata->inserQxian($data);
					if($flag){
						
						$this->success('新增成功', 'Home/Qxian/qxadd/');
						
					}else{
						$this->error('操作失败','/Home/Qxian/qxadd/',3);
					}
				}else{
					$flag=$updata->upQxian($data,$fg['id']);
					if($flag){
						$this->success('修改成功', 'Home/Qxian/qxadd/');
					}
					// $this->error('输入重名了！','/Home/Qxian/qxadd/',3);
				}
			}else{
				redirect('/Home/Login/latOut/');
			}
			
			// var_dump($_POST);die;
		
		}else{
			// $getdata = D('Qxian');
			// $arrs=$getdata ->getQxian();
			// var_dump($this->groupname);die;
			$this->assign('qx_name',$this->groupname);
			$this->display('Qxian');
		}
		
	}
	public function qxedit($id = '0'){
		if($id!='0'){
			$qxian=D('Qxian');
			$iddata=$qxian->getQxian($id);
			if($iddata){
				$this->assign('qx_name',$this->groupname);
				$this->assign('qxdata',$iddata);
				$this->display('Qxedit');
			}else{
				redirect('/Home/Qxian/index/');
			}
			
		}else{
			$User = D('qxian');//对象
			// 查询满足要求的总记录数
			if($id!='0'){
				$count = $User->where('`p_id` ="'.$id.'"')->order('id')->
				limit($Page->firstRow.','.$Page->listRows)->count();
			}else{
				$count=$User->count();
			}
			$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
			$Page->setConfig('first','第一页');
			$Page->setConfig('last','最后一页');
			if($id=='0'){	
				$list = $User->order('id')->
				limit($Page->firstRow.','.$Page->listRows)->select();
			}else{
				// $count      = $User->count();		
				$list = $User->where('`p_id` ="'.$id.'"')->order('id')->
				limit($Page->firstRow.','.$Page->listRows)->select();
				$this->assign('pval',$id);
			}
			$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性		
			$this->assign('list',$list);// 赋值数据集
			$this->assign('page',$show);// 赋值分页输出
			$this->assign('names',$this->groupname);// 赋值分页输出
			// var_dump(array_keys($list[0])[0]); 
			// var_dump($list);
			// echo $show;
			// die;
			$this->display('Show');
		}
		
	}
	public function modify(){
		$this->display();
	}
}