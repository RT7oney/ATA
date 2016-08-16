<?php
namespace Home\Controller;
class PlayerController extends HomeController {
    public function index(){
		$id=D("Movie")->getmid(I('pid'));
		$info=D("Movie")->detail($id);
		if(!$info){
			$error = D("Movie")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$info=D("Tag")->movieChange($info,'movie',2);
		$tpl=D("Category")->getTpl($info['cid'],'template_play');
		if(!$tpl){
			$error = D("Category")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$this->assign('pos',1);
		$this->assign($info);
        $this->display(C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
    }
	
	public function player(){
		$pid=I('pid');
		$id=D("Movie")->getmid($pid);
		$n=I('n');
		$info=D("Movie")->detail($id);
		if(C('USER_ALLOW_PLAY')==1 && C('USER_PLAY_COUNT')>1 && UID){
			$map['user_id']=UID;
			$map['type']=2;
			$map['action_id']=M('Action')->getFieldByName('users_play','id');
			$map['create_time']=array('gt', strtotime("-24 hours"));
			$count=M('ActionLog')->where($map)->count();
			if($count<=C('USER_PLAY_COUNT')){
				$this->player_recom=1;
			}
		}
		$info['url']=url_change("movie/index",array("id"=>$id,"name"=>'movie'));
		$this->assign("movie",$info);
		$this->assign("player",D('Movie')->getPlayerUrl($id,$pid,$n));
		$this->display("Public/Player/player.html");
	}
}