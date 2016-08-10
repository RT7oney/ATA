<?php
/**
 * 微信初始化接入的方法
 * By Ryan
 */
include_once './include/wxsdk/jssdk.class.php';
global $_SC, $_SG;
$_SG['wechat'] = new JSSDK();

//1.将timestamp,nonce,token按照字典排序
$timestamp = $_GET['timestamp'];
$nonce = $_GET['nonce'];
$signature = $_GET['signature'];

/*****************模拟******************/
// $timestamp = 123124151231;
// $nonce = 1234123512342;
// $signature = 'asdfawefasdfe8234008';
/***************************************/

$token = $_SC['wechat_token'];
if (isset($_REQUEST['echostr'])) {
	$echostr = $_REQUEST['echostr'];
}
$array = array($timestamp, $nonce, $token);
sort($array); //需要对以上信息进行字典排序
common_log('字典排序之后的数组-------' . json_encode($array));
//2.将排序后的三个参数拼接后用sha1加密
$tmpstr = implode('', $array);
$tmpstr = sha1($tmpstr);

//3.将加密后的字符串与signature进行对比，判断该请求是否来自于微信
if ($tmpstr === $signature && isset($echostr)) {
	common_log('wecaht-echostr------' . $echostr);
	echo $echostr;
	exit;
} else {
	responseMsg();
}

function responseMsg() {
	//响应微信消息的方法
	//1.获取到微信推送过来的post数据（xml 格式）
	if (version_compare(PHP_VERSION, '5.6.0', '<')) {
		if (!empty($GLOBALS['HTTP_RAW_POST_DATA'])) {
			$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
		} else {
			$postArr = file_get_contents('php://input');
		}
	} else {
		$postArr = file_get_contents('php://input');
	}
/*********************模拟***********************************/
	// $postArr = "<xml>
	// 	            <ToUserName><![CDATA[gh_738d4b50d9c5]]></ToUserName>
	// 	            <FromUserName><![CDATA[oW6IEuF9oUP00Ja7P4LJzvFGvEmY]]></FromUserName>
	// 	            <CreateTime>" . time() . "</CreateTime>
	// 	            <MsgType><![CDATA[event]]></MsgType>
	// 	            <Event><![CDATA[subscribe]]></Event>
	// 	            <EventKey><![CDATA[]]></EventKey>
	//                </xml>";

	// $postArr = "<xml>
	// 		    <ToUserName><![CDATA[gh_738d4b50d9c5]]></ToUserName>
	// 		    <FromUserName><![CDATA[oW6IEuF9oUP00Ja7P4LJzvFGvEmY]]></FromUserName>
	// 		    <CreateTime>" . time() . "</CreateTime>
	// 		    <MsgType><![CDATA[text]]></MsgType>
	// 		    <Content><![CDATA[18801912170+aj4ku60p]]></Content>
	// 		    <MsgId>1234567890123456</MsgId>
	// 	      </xml>";

	// $postArr = "<xml>
	// 	            <ToUserName><![CDATA[gh_738d4b50d9c5]]></ToUserName>
	// 	            <FromUserName><![CDATA[oW6IEuF9oUP00Ja7P4LJzvFGvEmY]]></FromUserName>
	// 	            <CreateTime>" . time() . "</CreateTime>
	// 	            <MsgType><![CDATA[event]]></MsgType>
	// 	            <Event><![CDATA[CLICK]]></Event>
	// 	            <EventKey><![CDATA[http://subs.wechat.test.]]></EventKey>
	//                </xml>";

	// $postArr = '<xml>
	// 	        <ToUserName><![CDATA[toUser]]></ToUserName>
	// 	        <FromUserName><![CDATA[xixixix]]></FromUserName>
	// 	        <CreateTime>123456789</CreateTime>
	// 	        <MsgType><![CDATA[event]]></MsgType>
	// 	        <Event><![CDATA[VIEW]]></Event>
	// 	        <EventKey><![CDATA[www.qq.com]]></EventKey>
	// 	      </xml>';

/************************************************************/
	//2.处理消息类型，并设置回复类型和内容

	common_log('wechat-postArr------' . $postArr);
	$postObj = simplexml_load_string($postArr);
	$fromUser = $postObj->ToUserName;
	$toUser = $postObj->FromUserName;
	$openid = (string) $toUser;
	$lifeTime = 365 * 24 * 3600;
	common_log('wechat-openid------' . $openid);
	session_id(md5($openid));
	session_set_cookie_params($lifeTime);
	// session_start();
	$_SESSION['openid'] = $openid;
	// Session::put("openid",$openid);
	//使用Cache缓存用户的openid，到时候注册的时候去取得头像
	$time = $postObj->CreateTime;
	$msgType = strtolower($postObj->MsgType);

	switch ($msgType) {
	//判断消息类型
	case 'event':
		$event = strtolower($postObj->Event);
		if ($event == 'subscribe') {
			$reg_url = $_SC['reg_url'];
			$content = "亲爱的，小肥终于把您给盼来了！\n\n现在加入CCPP消费养老计划即送100小金！点击<a href='{$url}'>【100小金】</a>立即领取！\n\n常见问题，输入数字编号可自助查看：\n【1】什么是CCPP消费养老？\n【2】什么是小金？\n【3】如何将小金转换为消费养老金？\n\n您如果还有更多问题，可直接在微信咨询，小肥等着您哦~\n如果文字太过平淡，您还想通过声音跟小肥交流，那就拨打400-807-2611专属热线吧~\n微信客服、电话客服在线时间：10:00-18:00。";
			$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
			echo $template;
			exit;
		} elseif ($event == 'click') {
			$event_key = strtolower($postObj->EventKey);
			if ($event_key == 'needkefu') {
				$tmptime = time();
				$day = date("w", $tmptime);
				$hour = date("H", $tmptime);
				if (in_array($day, [1, 2, 3, 4, 5]) && $hour >= 10 && $hour <= 17) {
					// $msg = "您已进入人工客服频道，请直接输入文字或图片与客服交流。";
					$kefu = $_SC['KEFU'];
					$talk = ['kf_account' => $kefu, 'openid' => $openid, 'text' => '有用户接入，请及时处理！'];
					$res = $_SG['wechat']->toKefu(json_encode($talk, JSON_UNESCAPED_UNICODE));
					common_log('wechat-客服接口返回------' . json_encode($res, JSON_UNESCAPED_UNICODE));
					// 3.回一条xml数据给用户
					if ($res['errcode'] == 0) {
						$content = '您已经进入客服频道，请直接输入您的问题与客服交流';
						$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
						echo $template;
					} elseif ($res['errcode'] == 61458) {
						// 客户正在被其他客服接待
						$content = '客服将很快联系您！谢谢您的理解~';
						$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
						echo $template;
					} elseif ($res['errcode'] == 61459) {
						// 客服目前离线，当客服在线后，我们会第一时间联系您
						$content = '客服目前离线，当客服在线后，我们会第一时间联系您！谢谢您的理解~O(∩_∩)O~';
						$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
						echo $template;
					} else {
						// /(ㄒoㄒ)/~~服务器出了点问题，请稍后再试，如果你参与活动成功您的中奖信息不会丢失，客服将会联系您，给您带来的不便我们非常抱歉
						$content = '/(ㄒoㄒ)/~~服务器出了点问题，请稍后再试，如果你参与活动成功您的中奖信息不会丢失，客服将会联系您，给您带来的不便我们非常抱歉';
						$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
						echo $template;
					}
				} else {
					$msg = "亲爱的用户，人工客服工作时间为工作日的10：00—18:00。现人工客服不在工作时间内，您可以直接输入问题反馈或意见，人工客服在线后会第一时间回复您！";
					$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $msg . "]]></Content></xml>";
					echo $template;
				}
			} else {
				wechatJump($event_key, $toUser, $fromUser);
			}
		}
		break;
	case 'image':
		$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		echo $template;
		break;
	case 'voice':
		$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		echo $template;
		break;
	case 'video':
		$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		echo $template;
		break;
	case 'shortvideo':
		$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		echo $template;
		break;
	case 'location':
		$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		echo $template;
		break;
	case 'link':
		$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		echo $template;
		break;
	case 'text':
		$content = $postObj->Content;
		$content = trim($content);
		if (!empty($DBres)) {
			//如果是关键字就关键字回复
			$content = '关键字回复';
			$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
			echo $template;
		} else {
			//没有设置关键字回复，询问用户是否与客服对话客服
			// $template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[transfer_customer_service]]></MsgType></xml>";
			$content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
			$template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
			echo $template;
		}
		break;
	default:
		// $content = '您是否想与我们的客服进行联系，如果是的话，您可以点击菜单栏中的“联系客服”与客服对话';
		// $template = "<xml><ToUserName><![CDATA[" . $toUser . "]]></ToUserName><FromUserName><![CDATA[" . $fromUser . "]]></FromUserName><CreateTime>" . time() . "</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[" . $content . "]]></Content></xml>";
		// echo $template;
		break;
	}
}

function wechatJump($event_key, $toUser, $fromUser) {
	global $_SC;
	switch ($event_key) {
	case 'pension':
		# code...
		$picurl = $_SC['pension']['picurl'];
		$url = $_SC['pension']['url'];
		$title = '我的消费养老金';
		$description = '我的消费养老金';
		$template = template($toUser, $fromUser, $title, $description, $picurl, $url);
		echo $template;
		break;
	case 'vcard':
		# code...
		$picurl = $_SC['vcard']['picurl'];
		$url = $_SC['vcard']['url'];
		$title = '我的虚拟卡';
		$description = '我的虚拟卡';
		$template = template($toUser, $fromUser, $title, $description, $picurl, $url);
		echo $template;
		break;
	case 'bank':
		# code...
		$picurl = $_SC['bank']['picurl'];
		$url = $_SC['bank']['url'];
		$title = '我的银行卡';
		$description = '我的银行卡';
		$template = template($toUser, $fromUser, $title, $description, $picurl, $url);
		echo $template;
		break;
	case 'voucher':
		# code...
		$picurl = $_SC['voucher']['picurl'];
		$url = $_SC['voucher']['url'];
		$title = '我的券库';
		$description = '我的券库';
		$template = template($toUser, $fromUser, $title, $description, $picurl, $url);
		echo $template;
		break;
	case 'info':
		# code...
		$picurl = $_SC['info']['picurl'];
		$url = $_SC['info']['url'];
		$title = '我的资料';
		$description = '我的资料';
		$template = template($toUser, $fromUser, $title, $description, $picurl, $url);
		echo $template;
		break;
	case 'merchant':
		# code...
		$picurl = $_SC['merchant']['picurl'];
		$url = $_SC['merchant']['url'];
		$title = '会员专享';
		$description = '会员专享';
		$template = template($toUser, $fromUser, $title, $description, $picurl, $url);
		echo $template;
		break;
	}
}

function template($toUser, $fromUser, $title, $description, $picurl, $url) {
	common_log('wechat-推送图文------[图片url--' . $picurl . '][访问url--' . $url . ']');
	$template = "<xml>
    <ToUserName><![CDATA[" . $toUser . "]]></ToUserName>
    <FromUserName><![CDATA[" . $fromUser . "]]></FromUserName>
    <CreateTime>" . time() . "</CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <ArticleCount>1</ArticleCount>
    <Articles>
    <item>
    <Title><![CDATA[" . $title . "]]></Title>
    <Description><![CDATA[" . $description . "]]></Description>
    <PicUrl><![CDATA[" . $picurl . "]]></PicUrl>
    <Url><![CDATA[" . $url . "]]></Url>
    </item>
    </Articles>
    </xml>";
	return $template;
}

function getAccessToken() {
	$file_path = "./include/wxsdk/access_token.txt";
	//判断是否有这个文件
	if (file_exists($file_path)) {
		// 有这个文件
		if ($fp = fopen($file_path, "a+")) {
			//读取文件
			$conn = fread($fp, filesize($file_path));
			//替换字符串
			// echo $conn . "<br/>";die;
			$conn_arr = json_decode($conn, true);
			if ($conn_arr['expire_time'] < time()) {
				$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
				$res = json_decode($this->https_request($url), true);
				if (isset($res['access_token'])) {
					$this->access_token = $res["access_token"];
					$arr = array(
						'access_token' => $res['access_token'],
						'expire_time' => time() + 7000,
					);
					$fp = fopen($file_path, "a");
					$str = json_encode($arr);
					fwrite($fp, $str . "\n");
				} else {
					//微信接口返回有误
					common_log('wechat-access_token接口报错------' . json_encode($res, JSON_UNESCAPED_UNICODE));
				}
			} else {
				$this->access_token = $conn_arr["access_token"];
			}
		} else {
			// echo "文件打不开";
			common_log('wechat-access_token------文件打不开');
		}
	} else {
		// echo "没有这个文件";
		// $fp = fopen($file_path, "w");
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
		$res = json_decode($this->https_request($url), true);
		if (isset($res['access_token'])) {
			$this->access_token = $res["access_token"];
			$arr = array(
				'access_token' => $res['access_token'],
				'expire_time' => time() + 7000,
			);
			$fp = fopen($file_path, "a");
			$str = json_encode($arr);
			fwrite($fp, $str . "\n");
		} else {
			//微信接口返回有误
			common_log('wechat-access_token接口报错------' . json_encode($res, JSON_UNESCAPED_UNICODE));
		}
	}
	fclose($fp);
}
