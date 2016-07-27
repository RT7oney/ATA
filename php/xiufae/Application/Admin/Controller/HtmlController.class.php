<?php
namespace Admin\Controller;
use Think\Controller;

class HtmlController extends AdminController {
    public function index(){
		$this->meta_title = '生成html';
		$this->checkhtml();
		$this->assign('category', D('Movie')->getTree());
		$this->assign('news', D('Movie')->getTree(2));
		$this->display();
    }
	
	protected function checkhtml(){	
	    if (C('WEB_PATTEM')!=2) {
		    $this->error('动态运行模式,不需要生成静态网页！',U('Config/group','id=4'));
		}
	}		
}