<?php

function user_info($id){
	$map['id'] = $id;
	$map['status']=1;
	$info=M('users')->where($map)->field('id,username,email,path,introduction,integral')->find();
	$info['userurl']=U('User/Index/index');
	$info['userlogin']=U('/User/Public/login');
	$info['userreg']=U('/User/Public/reg');
	$info['userlogout']=U('/User/Public/logout');
	return $info;
}
?>