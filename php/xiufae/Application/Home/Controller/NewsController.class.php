<?php
namespace Home\Controller;
class NewsController extends HomeController {
    public function index(){
		$id=I('id');
		$info=D("News")->detail($id);
		if(!$info){
			$error = D("News")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$info=D("Tag")->movieChange($info,'news',1);
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
		$this->ajaxReturn(D('News')->hits(I('id')));
	}
	
	public function digg(){
		$this->ajaxReturn(D('News')->digg(I('id')));
	}
}