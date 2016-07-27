<?php
namespace Home\Controller;

class RssController extends HomeController {

    public function index(){
        $this->display('Public/Xml/'.I('type').'.html');
    }
}