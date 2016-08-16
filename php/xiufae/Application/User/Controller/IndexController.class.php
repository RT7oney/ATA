<?php
namespace User\Controller;
use Think\Controller;

class IndexController extends UserController {
    public function index(){
		$info=D('Users')->newLogin();
		$prize=D('Prize')->lists();
		$this->assign('u_l_list',$info);
		$this->assign('prize',$prize);
		$this->display();
    }
}