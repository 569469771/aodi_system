<?php
namespace Home\Controller;
// use Home\FatherController;
class UserController extends FatherController {
    public function index(){
		
		$User = M('User');//对象
		$count      = $User->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		
		$Page->setConfig('first','第一页');
		$Page->setConfig('last','最后一页');
		
		$show       = $Page->show();// 分页显示输出   共 %TOTAL_ROW% 条记录
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->order('id')->
		limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出

		// var_dump(array_keys($list[0])[0]); 
		// var_dump($list);
		// echo $show;
		// die;
		$this->display('User');
		
	}
	
	public function uadd($id = '0'){
		// var_dump($_POST);die;
		// echo $id;die;
		
		if(empty($_POST)){
			// die('00000');
			if($id == '0'){
				$company=D('Company');
				$group=D('Group');
				$com=$company->getCompany();
				$gp=$group->getGroup();
				// var_dump($gp);die;
				$this->assign('com',$com);
				$this->assign('gp',$gp);
				$this->display('Useradd');
			}else{
				$user=D('User');
				$info=$user->getId($id);
				
				$company=D('Company');
				$group=D('Group');
				$com=$company->getCompany();
				$gp=$group->getGroup();
				// var_dump($gp);die;
				$this->assign('com',$com);
				$this->assign('gp',$gp);
				
				
				// var_dump($arrs);die;
				$this->assign('info',$info);
				$this->display('Useradd');
			}
		}else{
			if(I('post.psw1')==I('post.psw2')&& strlen(I('post.psw1'))>3){
				// var_dump($_POST);
				$userinfo=[];
				$userinfo['company_id']=I('post.company_id');
				$userinfo['group_id'] = I('post.group_id');
				$userinfo['user_state'] = I('post.user_state');
				$userinfo['u_name']=strtr(I('post.name'), array(' '=>''));
				$userinfo['full_name']=strtr(I('post.full_name'), array(' '=>''));
				
				$user_pass_str =strtr(I('post.psw1'), array(' '=>''));
				$user_pass_str      = substr_replace($user_pass_str, '', 0, 1);//破坏原始数据
				$user_pass_str      = substr_replace($user_pass_str, '', -1, 1);//破坏原始数据
				$userinfo['u_passward']   = md5(md5($user_pass_str).'Bs7RmJ');
				
				
				$userinfo['u_id'] = cookie('ud');
				$userinfo['up_date'] = time();
				// var_dump($userinfo);die;
				$userup=D('User');
				$finduser=$userup->getUser(I('post.name'),$flagid='1');
				if($finduser){
						$this->error('操作失败,系统已经有该用户','/Home/User/index/',3);		
				}else{
					$inflag=$userup->inserInfo($userinfo);
					if($inflag){
						 $this->success('新增成功', '/Home/User/uadd/',3);
					}else{
						$this->error('操作失败','/Home/User/index/',3);
					}
				}
			}else{	
				$this->error('操作失败','/Home/User/uadd/',3);
			}
		}	
	}
	public function uedit($id='0'){
		if(empty($_POST)){
			$user=D('User');
			$info=$user->getId($id);
			
			$company=D('Company');
			$group=D('Group');
			$com=$company->getCompany();
			$gp=$group->getGroup();
			// var_dump($gp);die;
			$this->assign('com',$com);
			$this->assign('gp',$gp);
			
			
			// var_dump($arrs);die;
			$this->assign('info',$info);
			$this->display('Useredit');
		}else{
			if(I('post.psw1')==I('post.psw2')&& strlen(I('post.psw1'))>3){
				// var_dump($_POST);
				$userinfo=[];
				$userinfo['company_id']=I('post.company_id');
				$userinfo['group_id'] = I('post.group_id');
				$userinfo['user_state'] = I('post.user_state');
				$userinfo['u_name']=strtr(I('post.name'), array(' '=>''));
				$userinfo['full_name']=strtr(I('post.full_name'), array(' '=>''));
				
				$user_pass_str =strtr(I('post.psw1'), array(' '=>''));
				$user_pass_str      = substr_replace($user_pass_str, '', 0, 1);//破坏原始数据
				$user_pass_str      = substr_replace($user_pass_str, '', -1, 1);//破坏原始数据
				$userinfo['u_passward']   = md5(md5($user_pass_str).'Bs7RmJ');
				
				
				$userinfo['u_id'] = cookie('ud');
				$userinfo['up_date'] = time();
				// var_dump($userinfo);die;
				$userup=D('User');
				$finduser=$userup->getUser(I('post.name'),$flagid='1');
				if($finduser){
					$inflag=$userup->upInfo($userinfo,$finduser['id']);
					if($inflag){
						$this->success('修改成功', '/Home/User/index/',3);
					}else{
						$this->error('操作失败','/Home/User/index/',3);
					}
						
				}else{
						$this->error('操作失败，没有该用户','/Home/User/index/',3);	
				}
			}else{	
				$this->error('操作失败，两密码不服规则','/Home/User/uadd/',3);
			}
		}
	}
	public function udel($id){
		// echo $id;die;
		if((int)($id)>0){
			// die('111');
			$infodel['user_state']='0';
			$userdel=D('User');
			$delflag=$userdel->upInfo($infodel,$id);
			if($delflag){
				$this->success('删除成功', '/Home/User/index/',3);
			}else{
				$this->error('删除失败','/Home/User/index/',3);
			}
		}else{
			$this->error('非法操作','/Home/User/index/',3);
		}
	}
}