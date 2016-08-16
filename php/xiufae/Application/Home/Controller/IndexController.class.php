<?php
namespace Home\Controller;

class IndexController extends HomeController {

	//系统首页
    public function index(){
		$this->assign('pos',4);
        $this->display(C("TPL_PATH").C("DEFAULT_TPl")."/index.html");
    }
}