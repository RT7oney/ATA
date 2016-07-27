<?php
namespace Home\Model;
use Think\Model;

class ApiModel extends Model{

	public function listMovie(){
		$map['status']= 1;
		$map['display']=1;
		if($_GET["t"]) $map['category']=array('in', explode(',',D('Tag')->getId(I('t'))));
		if($_GET["ids"]) $map['id']=I('ids');
		if($_GET["h"]){
			$current = Date('Y-m-d',strtotime("-".I('h')." hour"));
			echo $current;
			$current_date = strtotime($current);
			$map['create_time'] = array('gt', $current_date);
		}
		$limit = I('limit') ? I('limit') : 30;
		$pg =  I('pg') ? I('pg') : 1;
		if($_GET['wd']){
			$where['title']  = array('like', '%'.I('wd').'%');
			$where['also_known_as']  = array('like', '%'.I('wd').'%');
			$where['_logic'] = 'or';
			$map['_complex'] = $where;
		}
		if(!$mlist=S(implode("-",$map))){
			$movieCount=M("Movie")->where($map)->limit($limit)->count("id");
			$totalPages = ceil($movieCount / $limit);
			$lists = M("Movie")->field("id,category,title,actors,area,language,year,cover_id,content,also_known_as,rating,directors,serialize,update_time")->where($map)->limit($limit)->page($pg)->order('hits desc')->select();
			foreach ($lists as $v){
				$mlist['video'][]=$this->movieChange($v);
			}
			$mlist["list"]=array('page' => $pg, 'pagecount'=>$totalPages,'pagesize'=>$limit,'recordcount'=>$movieCount);
			$mlist["class"]=$this->type();
			$mlist["player"]=$this->player();
			S(implode("-",$map),$mlist,array('expire'=>36000));
		}
		return $mlist;
	}

	protected function movieUrl($id){
		$prefix = C('DB_PREFIX');
		$urllist = M("movie_url")->table($prefix.'movie_url url,'.$prefix.'player play')->where('url.movie_player_id=play.id and url.movie_id='.$id.' and play.display>0')->field('play.title as name,url.movie_url as url')->order("play.sort asc")->select();	
		return $urllist;
	}

	//影片数据
	protected function movieChange($data){
		$data["mid"]=$data["id"];
		$data["tid"]=$data["category"];
		$data["type"]=get_category($data["category"]);
		$data["pic"]=get_cover($data["cover_id"],"path");
		$data["last"]=time_format($data["update_time"],'Y-m-d');
		$data["content"]=strip_tags($data["content"]);
		$data["reurl"]=C("WEB_URL").url_change("movie/index",array("id"=>$data["id"],"name"=>"movie"));
		$data["play"]=$this->movieUrl($data["id"]);
		if(false===strpos(strtolower($data["pic"]), 'http://')){
			$data["pic"]=C("WEB_URL").get_cover($data["cover_id"],"path");
		}
		unset($data["category"],$data["id"],$data["cover_id"],$data["update_time"]);
		return $data;
	}

	protected function type(){
		$map["status"] = 1;
		$map["display"] = 1;
		return M("Category")->field('id,title')->where($map)->order('sort')->select();
	}

	protected function player(){
		$map["display"] = 1;
		return M("Player")->field('id,title')->where($map)->order('sort')->select();
	}
}
