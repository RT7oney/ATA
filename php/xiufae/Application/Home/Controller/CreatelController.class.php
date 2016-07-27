<?php
namespace Home\Controller;

class CreatelController extends HomeController {

    public function index(){
        $this->checklogin();
		define('HTML_CONTROLLER','Index');
		$this->assign('pos',4);
		$this->buildHtml('index','./',C("TPL_PATH").C("DEFAULT_TPl").'/index.html');
		$video['video'][]=array('title'=>'首页','content'=>'生成完毕');
		$return=array('video'=>$video['video'],'num'=>array('pagesize'=>1,'i'=>1,'count'=>1,'page'=>1),'url'=>$video['url']);
		$this->ajaxReturn($return,'JSON');
    }
	
	public function lists(){
		global $limit;
		$this->checklogin();
		define('HTML_CONTROLLER','Lists');
		S("html",array('url' =>__SELF__ ,'page'=>I('p'),'all'=>I('all')));
		$createl_num=C('HTML_NUM');
		$id=I('id');
		if($_GET['id']=="all"){
			$n = I('n')?I('n'):0;
			$map = array('status'=>1,'type'=>1,'display'=>1);
        	$list = M("Category")->where($map)->field('id')->order('pid asc,sort asc')->select();
			$id=$list[$n]['id'];
		}
		$limit = !empty($limit)?$limit:0;
		$info=D("Category")->info($id);
		$this->cid=intval($info["id"]);
		$this->pid=$info["pid"];
		$this->ctitle=$info["title"];
		$this->cname=$info["name"];
		$this->list_webtitle=empty($info["meta_title"]) ? C("WEB_SITE_TITLE") : $info["meta_title"];
		$this->list_keywords=empty($info["keywords"]) ? C("WEB_SITE_KEYWORD") : $info["keywords"];
		$this->list_description=empty($info["description"]) ? C("WEB_SITE_DESCRIPTION") :$info["description"];
		if($info["pid"]>0){
			$this->assign('pos',1);
		}else{
			$this->assign('pos',2);
		}
		$tpl=D("Category")->getTpl($id,'template_index');
		if(!$tpl){
			$error = D("Category")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$count=D('Tag')->listCount($id);
		$this->count=$count;
		$p=$_GET['p']?($_GET['p']-1):0;
		for($i=1; $i<($createl_num+1); $i++){
			$_GET['p']=$createl_num*$p+$i;
			if(C('HTML_TIME')>0){
				usleep(C('HTML_TIME')*1000); //生成间隔毫秒为单位 解决生成占用资源问题
			}
			$this->buildHtml(url_change('lists/index',array("id"=>$info["id"],"name"=>$info["name"],"p"=>(I('p')==1)?"":I('p')),true),'./',C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
			if(ceil($count/$limit)==$_GET['p'] or $limit==0 or $count==0){
				$video['video'][]=array('title'=>$info["title"],'content'=>'生成完毕');
				if(isset($n)){
					$n++;
					unset($limit);
					if(count($list)<=$n)
						unset($n);
				}
				break;
			}
		}
		$totalPages=ceil($count/$limit/$createl_num)?ceil($count/$limit/$createl_num):1;
		if($_GET["all"]=="all"){
			$video['url']=U('Home/Createl/news','id=all&all=all');
		}
		$return=array('video'=>$video['video'],'num'=>array('pagesize'=>0,'i'=>intval(I('p')),'count'=>ceil($count/$limit)?ceil($count/$limit):1,'page'=>$totalPages,'n'=>$n),'url'=>$video['url']);
		$this->ajaxReturn($return,'JSON');
    }
	
	public function movie(){
        $this->checklogin();
		define('HTML_CONTROLLER','Movie');
		S("html",array('url' =>__SELF__ ,'page'=>I('p'),'all'=>I('all')));
		$createl_num=C('HTML_NUM');
		$p=I('p')?I('p'):1;
		$map['status'] =1;
		$map['display'] =1;
		if($_GET['id']!='all'){
			$category=D('Tag')->getId(I('pid'));
			if(!empty($category)){
				if(is_numeric($category)){
					$map['category'] = $category;
				} else {
					$map['category'] = array('in', $this->str2arr($category));
				}
			}
		}
		if($_GET['time']!='all' && $_GET['time']){
			$map['update_time'] = array('gt',$this->getxtime(I('time')));
		}
		$count = M("movie")->where($map)->count("id");
        $movie = M("movie")->where($map)->field('id')->order('id desc')->page($p,$createl_num)->select();
		foreach ($movie as $k=>$v){
			$id=$v['id'];
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
			$this->buildHtml(url_change('movie/index',array("id"=>$info["id"],"name"=>"movie"),true),'./',C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
			if(C('HTML_TIME')>0){
				usleep(C('HTML_TIME')*1000); //生成间隔毫秒为单位 解决生成占用资源问题
			}
			if(C('HTML_PLAYER')>0){
				$playertpl=D("Category")->getTpl($info['cid'],'template_play');
				$this->buildHtml(url_change('player/index',array("id"=>$info["id"],"name"=>"player"),true),'./',C("TPL_PATH").C("DEFAULT_TPl")."/".$playertpl);
			}
			$video['video'][]=array('title'=>$info["title"],'content'=>'生成完毕');
		}
		$totalPages=ceil($count/$createl_num)?ceil($count/$createl_num):1;
		if($_GET["all"]=="all"){
			$video['url']=U('Home/Createl/lists',"id=all&all=all");
		}
		$return=array('video'=>$video['video'],'num'=>array('pagesize'=>$createl_num,'i'=>$k+1,'count'=>$count,'page'=>$totalPages),'url'=>$video['url']);
		$this->ajaxReturn($return,'JSON');
    }
	
	public function newslists(){
		global $limit;
		$this->checklogin();
		define('HTML_CONTROLLER','Lists');
		S("html",array('url' =>__SELF__ ,'page'=>I('p'),'all'=>I('all')));
		$createl_num=C('HTML_NUM');
		$id=I('id');
		if($_GET['id']=="all"){
			$n = I('n')?I('n'):0;
			$map = array('status'=>1,'type'=>2,'display'=>1);
        	$list = M("Category")->where($map)->field('id')->order('pid asc,sort asc')->select();
			$id=$list[$n]['id'];
		}
		$limit = !empty($limit)?$limit:0;
		$info=D("Category")->info($id);
		$this->cid=intval($info["id"]);
		$this->pid=$info["pid"];
		$this->ctitle=$info["title"];
		$this->cname=$info["name"];
		$this->list_webtitle=empty($info["meta_title"]) ? C("WEB_SITE_TITLE") : $info["meta_title"];
		$this->list_keywords=empty($info["keywords"]) ? C("WEB_SITE_KEYWORD") : $info["keywords"];
		$this->list_description=empty($info["description"]) ? C("WEB_SITE_DESCRIPTION") :$info["description"];
		if($info["pid"]>0){
			$this->assign('pos',1);
		}else{
			$this->assign('pos',2);
		}
		$tpl=D("Category")->getTpl($id,'template_index');
		if(!$tpl){
			$error = D("Category")->getError();
        	$this->error(empty($error) ? '未知错误！' : $error);
		}
		$count=D('Tag')->newsCount($id);
		$this->count=$count;
		$p=$_GET['p']?($_GET['p']-1):0;
		for($i=1; $i<($createl_num+1); $i++){
			$_GET['p']=$createl_num*$p+$i;
			if(C('HTML_TIME')>0){
				usleep(C('HTML_TIME')*1000); //生成间隔毫秒为单位 解决生成占用资源问题
			}
			$this->buildHtml(url_change('lists/index',array("id"=>$info["id"],"name"=>$info["name"],"p"=>(I('p')==1)?"":I('p')),true),'./',C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
			if(ceil($count/$limit)==$_GET['p'] or $count==0){
				$video['video'][]=array('title'=>$info["title"],'content'=>'生成完毕');
				if(isset($n)){
					$n++;
					if(count($list)<=$n)
						unset($n);
				}
				break;
			}
		}
		$totalPages=ceil($count/$limit/$createl_num)?ceil($count/$limit/$createl_num):1;
		if($_GET["all"]=="all"){
			$video['url']=U('Home/Createl/rss','all=all');
		}
		$return=array('video'=>$video['video'],'num'=>array('pagesize'=>0,'i'=>intval(I('p')),'count'=>ceil($count/$limit)?ceil($count/$limit):1,'page'=>$totalPages,'n'=>$n),'url'=>$video['url']);
		$this->ajaxReturn($return,'JSON');
    }
	
	public function news(){
        $this->checklogin();
		define('HTML_CONTROLLER','News');
		S("html",array('url' =>__SELF__ ,'page'=>I('p'),'all'=>I('all')));
		$createl_num=C('HTML_NUM');
		$p=I('p')?I('p'):1;
		$map['status'] =1;
		$map['display'] =1;
		if($_GET['pid']!='all'){
			$category=D('Tag')->getId(I('pid'));
			if(!empty($category)){
				if(is_numeric($category)){
					$map['category'] = $category;
				} else {
					$map['category'] = array('in', $this->str2arr($category));
				}
			}
		}
		if($_GET['time']!='all' && $_GET['time']){
			$map['update_time'] = array('gt',$this->getxtime(I('time')));
		}
		$count = M("News")->where($map)->count("id");
        $movie = M("News")->where($map)->field('id')->order('id desc')->page($p,$createl_num)->select();
		foreach ($movie as $k=>$v){
			$id=$v['id'];
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
			$this->buildHtml(url_change('news/index',array("id"=>$info["id"],"name"=>"news"),true),'./',C("TPL_PATH").C("DEFAULT_TPl")."/".$tpl);
			if(C('HTML_TIME')>0){
				usleep(C('HTML_TIME')*1000); //生成间隔毫秒为单位 解决生成占用资源问题
			}
			$video['video'][]=array('title'=>$info["title"],'content'=>'生成完毕');
		}
		$totalPages=ceil($count/$createl_num)?ceil($count/$createl_num):1;
		if($_GET["all"]=="all"){
			$video['url']=U('Home/Createl/newslists',"id=all&all=all");
		}
		$return=array('video'=>$video['video'],'num'=>array('pagesize'=>$createl_num,'i'=>$k+1,'count'=>$count,'page'=>$totalPages),'url'=>$video['url']);
		$this->ajaxReturn($return,'JSON');
    }
	
	public function rss(){
        $this->checklogin();
		C('html_file_suffix','.xml');
		$rss=array('baidu','google','rss');
		foreach ($rss as $k=>$v){
			$this->buildHtml($v,'./','Public/Xml/'.$v.'.html');
			$video['video'][]=array('title'=>$v.'地图','content'=>'生成完毕');
		}
		if($_GET["all"]=="all"){
			$video['url']=U('Home/Createl/index');
		}
		$return=array('video'=>$video['video'],'num'=>array('pagesize'=>3,'i'=>3,'count'=>3,'page'=>1),'url'=>$video['url']);
		$this->ajaxReturn($return,'JSON');
    }

    public function delHtml(){
		S("html",null);
	}
	
	protected function checklogin(){	
	    C('SESSION_PREFIX','lf_admin');
		C('VAR_SESSION_ID','session_id');
        if(!is_login()){
            $this->redirect('Admin/Public/login');
        }
	}
	private function str2arr($str, $glue = ','){
    	return explode($glue, $str);
	}
	private function getxtime($day){
		$day = intval($day);
		return mktime(23,59,59,date("m"),date("d")-$day,date("y"));
	}
}