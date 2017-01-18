<?php
namespace Home\Controller;
// use Home\FatherController;
class LogController extends FatherController {
    public function index(){
		$User = M('Log');//对象
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

		// var_dump(array_keys($list[0])[0]); 
		// var_dump($list);
		// echo $show;
		// die;
		
		$this->display('Log');
		
	}
	public function addLog($id='0'){
		if(empty($_POST)){
			if($id!='0'){
				$log = D('Log');
				$loginfo=$log->getId($id);
				if($loginfo){
					$this->assign('loginfo',$loginfo);
					
				}else{
					redirect('/Home/Login/latOut/');
				}
			}
			$this->display('Addlog');
		}else{
			// dump($_POST);die;
			if($this->check_ip(I('post.log_ip'))){
				$nologdata['log_ip']=I('post.log_ip');
				$nologdata['up_date']=time();
				$nolog = D('Notlog');
				$seldata = $nolog->where('`log_ip` = "'.$nologdata['log_ip'].'"')->find();
				if(!$seldata){
					$noflag=$nolog->add($nologdata);
					if($noflag){
						$this->success('新增成功', '/Home/Log/index/',3);
					}else{
						$this->error('操作失败','/Home/Log/addLog/',3);
					}
				}else{
					$this->error('已经添加过','/Home/Log/addLog/',3);
				}
			}else{
				$this->error('IP地址不合法','/Home/Log/addLog/',3);
			}
			
		}
	}
	
}