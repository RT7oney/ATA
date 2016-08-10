<?php
$customerUrl = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$appid = 'wx7881c17aef87a60f';
$appsecret = 'a4fb52d843a2c71973402d9826f33e3e';

if (!isset($_GET['code'])) {
	$scope = 'snsapi_userinfo';
	$oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($customerUrl) . '&response_type=code&scope=' . $scope . '&state=oauth#wechat_redirect';
	header('Location:' . $oauthUrl);
	//die($oauthUrl);
}
if (isset($_GET['code']) && isset($_GET['state']) && ($_GET['state'] == 'oauth')) {
	$rt = curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
	//var_dump($rt);exit;
	$jsonrt = json_decode($rt, true);
	$openid = $jsonrt['openid'];
	$access_token = $jsonrt['access_token'];
	//$this->wechat_id = $openid;
	if (empty($openid)) {
		echo '错误:' . $jsonrt['errcode'];
		exit();
	} else {
		//获取微信用户基本信息
		$wxuserUrl = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
		$rts = curlGet($wxuserUrl);
		$userinfo = json_decode($rts, 1);
		print_r($userinfo);die;
	}
	//echo $openid;exit;
}

function curlGet($url) {
	$ch = curl_init();
	$header = "Accept-Charset: utf-8";
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$temp = curl_exec($ch);
	return $temp;
}