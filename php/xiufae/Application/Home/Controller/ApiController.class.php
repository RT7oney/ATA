<?php
namespace Home\Controller;
class ApiController extends HomeController {
	// api数据共享
    public function index(){
		$data=D('Api')->listMovie();
        $this->ajaxReturn($data);
    }

}