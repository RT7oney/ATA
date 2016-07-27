<?php
namespace User\Model;
use Think\Model;

class PublicModel extends Model {

	/**
	 * 用户登录认证
	 * @param  string  $username 用户名
	 * @param  string  $password 用户密码
	 * @return integer           登录成功-用户ID，登录失败-错误编号
	 */
	public function login($username, $password){
		$map = array();
		$map['username'] = $username;
		$map['status'] = 1;
		
		/* 获取用户数据 */
		$user = M('Users')->where($map)->find();
		if(is_array($user)){
			/* 验证用户密码 */
			if(think_ucenter_md5($password) === $user['password']){
				$this->autoLogin($user); //更新用户登录信息
				$this->upPlayLog($user['id']);
				return $user['id']; //登录成功，返回用户ID
			} else {
				return -2; //密码错误
			}
		} else {
			return -1; //用户不存在或被禁用
		}
	}
	
	 /**
     * 自动登录用户
     * @param  integer $user 用户信息数组
     */
    private function autoLogin($user){
        /* 更新登录信息 */
        $data = array(
            'id'             => $user['id'],
            'login'           => array('exp', '`login`+1'),
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        M("Users")->save($data);

        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $user['id'],
            'username'        => $user['username'],
            'last_login_time' => $user['last_login_time'],
        );

        session('user_auth', $auth);
        session('user_auth_sign', data_auth_sign($auth));
    }
	 /**
     * 注销当前用户
     * @return void
     */
	public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }
	
	public function reg(){
		if($data=D('Users')->create()){
			return M('Users')->add($data);
		} else {
			return $this->getError(); //错误详情见自动验证注释
		}
	}
	
	/*
	 * 获取用户信息
	 * @param  string  $uid         用户ID或用户名
	 * @param  boolean $is_username 是否使用用户名查询
	 * @return array                用户信息
	 */
	public function info($uid){
		$map['id'] = $uid;
		return M('Users')->where($map)->find();
	}
	
	public function upPlayLog($uid){
		$data['uid'] = $uid;
		if($log = M('PlayerLog')->where('uid='.$uid)->field('id,log')->find()){
			$data['id'] = $log['id'];
			$recordMovCookie =	json_decode(stripslashes(unescape(cookie('movHistory'))),true);
			$recordMovSql = json_decode($log['log'],true);
			if($recordMovCookie && $recordMovSql){
				$recordMov = a_array_unique(array_merge($recordMovCookie,$recordMovSql));
			}else{
				$recordMov = $recordMovCookie?$recordMovCookie:$recordMovSql;
			}
			if($recordMov){
				$data['log'] = json_encode($recordMov);
				cookie('movHistory',$data['log'],1000*3600*24*365);
				M('PlayerLog')->save($data);
			}
		}else{
			$data['log'] = json_decode(stripslashes(unescape(cookie('movHistory'))),true);
			$data['log'] = json_encode($data['log']);
			M('PlayerLog')->add($data);
		}		
	} 
}