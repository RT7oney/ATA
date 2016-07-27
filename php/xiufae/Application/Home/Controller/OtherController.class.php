<?php
namespace Home\Controller;
class OtherController extends HomeController {
    public function index(){
		$tpl=I('tpl');
        $this->display(C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
    }
}