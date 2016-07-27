<?php
namespace Home\Controller;
class MovieController extends HomeController {
    public function index(){
		$id=I('id');
		$info=D("Movie")->detail($id);
		if(!$info){
			$error = D("Movie")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$info=D("Tag")->movieChange($info,"movie",1);
		$tpl=D("Category")->getTpl($info['cid'],'template_detail');
		if(!$tpl){
			$error = D("Category")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$this->assign('pos',1);
		$this->assign($info);
        $this->display(C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
    }
	
	public function hist(){
		$this->ajaxReturn(D('Movie')->hits(I('id')));
	}
	
	public function digg(){
		$this->ajaxReturn(D('Movie')->digg(I('id')));
	}
}