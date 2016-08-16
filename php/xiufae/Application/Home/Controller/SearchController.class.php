<?php
namespace Home\Controller;
class SearchController extends HomeController {
    public function index(){
		$this->keyword=I('keyword');
		$this->count=D('Tag')->searchCount();
        $this->display(C("TPL_PATH").C("DEFAULT_TPl")."/search.html");
    }
}