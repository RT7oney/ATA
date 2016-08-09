<?php
header('content-type:text/html;charset=utf-8');
//显示在线用户
$disonline = 1;
//新登陆时显示最近内容的条数(默认为30条)
$leastnum = 30;
//默认的房间名(默认是每天换一个文件)，如果去掉d，则是每月换一个文件
$room = date("Y-m-d");
//房间保存路径,必须仿quot;/"结尾,可以丿quot;../"，等
$roomdir = "rooms/";
//编码方式
$charset = "UTF-8";
//客户端最大显示内容条数(建议不要太大)
$maxdisplay = 300;
//语言包
$lang = array(
//聊天室描述
"description"=>"聊天室.", 
//聊天室标题
"title"=>"Welcome...!",
//第一个到聊天室的欢迎
"firstone"=>"<span style='font-size:16px;color:blue;'>Welcome...!</span>", 
//当信息有禁止内容时显示
"ban" => array('法轮功', '共产党', '李洪志', 'fuck', '叼', '你妈的', '他妈的'),
//关键字
"keywords"=>"Welcome...!",
//发言提示
"hereyourwords" => "在这里发言!"
);

$touchs = 10;
$title = $lang["title"];
$earlier = 10;
$description = $lang["description"];
$origroom = $room;
$least = ($_GET["dis"])?intval($_GET["dis"]):$leastnum;
if ($_GET["room"]) $room = $_GET["room"];
$room = checkfilename($room);
if (!$room) $room = $origroom;
$filename = $roomdir.$room.".dat.php";
$datafile = $roomdir.$room.".php";

if (!is_dir($roomdir)) {
	@mkdir($roomdir, 0777) or exit('no this dir.');
}
if(file_exists($filename)){
	if ((int)filemtime($filename) + 1800 < time()) {
		unlink($filename);
	}
}

if (!file_exists($filename)) @file_put_contents($filename,'<?php die();?>'."\n".time()."|".$lang["firstone"]."\n");
if (!file_exists($datafile)) @file_put_contents($datafile,'<?php die();?>'."\n");
$action = $_GET["action"];

if (!function_exists("file_get_contents"))
{
	function file_get_contents($path)
	{
		if (!file_exists($path)) return false;
		$fp=@fopen($path,"r");
		$all=fread($fp,filesize($path));
		fclose($fp);
		return $all;
	}
}

if (!function_exists("file_put_contents"))
{
	function file_put_contents($path,$val)
	{
		$fp=@fopen($path,"w");
		fputs($fp,$val);
		fclose($fp);
		return true;
	}
}

function checkfilename($file)
{
	if (!$file) return "";
	$file = trim($file);
	$a = substr($file,-1);
	$file = eregi_replace("^[.\\\/]*","",$file);
	$file = eregi_replace("[.\\\/]*$","",$file);
	$arr = array("../","./","/","\\","..\\",".\\");
	$file = str_replace($arr,"",$file);
	return $file;
}

function get_ip()
{
	global $_SERVER;
	if ($_SERVER)
	{
		if ( $_SERVER[HTTP_X_FORWARDED_FOR] )
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		else if ( $_SERVER["HTTP_CLIENT_ip"] )
			$realip = $_SERVER["HTTP_CLIENT_ip"];
		else
			$realip = $_SERVER["REMOTE_ADDR"];
	}
	else
	{
		if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
			$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
		else if ( getenv( 'HTTP_CLIENT_ip' ) ) 
			$realip = getenv( 'HTTP_CLIENT_ip' );
		else
			$realip = getenv( 'REMOTE_ADDR' );
	}
	return $realip;
}

function array2json($arr)
{
	if (function_exists('json_encode')) return json_encode($arr);
	$keys = array_keys($arr);
	$isarr = true;
	$json = "";
	for($i=0;$i<count($keys);$i++)
	{
		if ($keys[$i] !== $i)
		{
			$isarr = false;
			break;
		}
	}
	$json = $space;
	$json.= ($isarr)?"[":"{";
	for($i=0;$i<count($keys);$i++)
	{
		if ($i!=0) $json.= ",";
		$item = $arr[$keys[$i]];
		$json.=($isarr)?"":$keys[$i].':';
		if (is_array($item))
			$json.=array2json($item);
		else if (is_string($item))
			$json.='"'.str_replace(array("\r","\n"),"",$item).'"';
		else $json.=$item;
	}
	$json.= ($isarr)?"]":"}";
	return $json;
}

if ($action == "write")
{
	$color = $_GET['color'];
	if (!eregi("[0-9a-fA-F]{6}",$color) || $color == "#000000") $color = "";
	$color = "#".$color;
	$size = intval($_GET["size"]);
	$arr = @file("php://input");
	$name = str_replace(array("\n","\r"),"",$arr[0]);
	$ip = get_ip();
	if ($disonline)
	{
		$onlines = @file_get_contents($datafile);
		$s1 = "|{$name}|{$ip}|";
		if (strpos($onlines,$s1) === false)
		{
			if (strpos($onlines,"|".$name."|") === false)
			{
				$fp = @fopen($datafile,"a+");
				if ($fp)
				{
					if (@flock($fp, LOCK_EX))
					{
						@fputs($fp,time()."|".time().$s1."\n");
						@flock($fp, LOCK_UN);
					}
					@fclose($fp);
				}
			}
			else
			{
				echo "NAME";
				die();
			}
		}
	}

	$s = "";
	$style = "";
	$font = $_GET["font"];
	if ($font == "songti") $font = "宋体";
	else if ($font == "heiti") $font = "黑体";
	else if ($font == "kaiti") $font = "楷体_GB2312";
	else $font = "";
	$style .= (!$font)?"":"font-family:".$font.";";
	$style .= (!$_GET["bold"])?"":"font-weight:bold;";
	$style .= (!$color || $color == "#")?"":"color:{$color};";
	$style .= (!$size || $size == "16")?"":"font-size:{$size}px;";
	$t = time();
	for($i = 1;$i<count($arr);$i++)
	{
		$content = $arr[$i];
		$content = str_replace(array("\n","\r"),"",$content);
		if ($content == "") continue;
		$content = preg_replace("!<img\s+(.*?)/>!i", "[img $1/]", $content);
		$content = str_replace(array('<', '>'), array('&lt;', '&gt;'), $content);
		$content = preg_replace("!\[img (.*?)/\]!i", "<img $1/>", $content);
		$content = str_replace($lang['ban'], '', $content);
		$content = ($style)?"<span style='{$style}'>{$content}</span>":$content;
		$ubbarray = array('[:ani_wink:]',
		'[:big_eyes:]',
		'[:cool:]',
		'[:cry:]',
		'[:eye_roll:]',
		'[:grin:]',
		'[:happy:]',
		'[:not_impressed:]',
		'[:smile:]',
		'[:smile_eyes:]',
		'[:stickout:]',
		'[:straight:]',
		'[:surprised:]',
		'[:unhappy:]',
		'[:wink:]');
		$content = str_replace($ubbarray, 
			array('<img src="smilies/ani_wink.gif" />',
			'<img src="smilies/big_eyes.gif" />',
			'<img src="smilies/cool.gif" />',
			'<img src="smilies/cry.gif" />',
			'<img src="smilies/eye_roll.gif" />',
			'<img src="smilies/grin.gif" />',
			'<img src="smilies/happy.gif" />',
			'<img src="smilies/not_impressed.gif" />',
			'<img src="smilies/smile.gif" />',
			'<img src="smilies/smile_eyes.gif" />',
			'<img src="smilies/stickout.gif" />',
			'<img src="smilies/straight.gif" />',
			'<img src="smilies/surprised.gif" />',
			'<img src="smilies/unhappy.gif" />',
			'<img src="smilies/wink.gif" />'), 
			$content);
		$s.= $t."|".$name.":".$content."\n";
	}
	if (!$name) die("No Name!!");
	if (!$s) die("No Content!!");
	$fp = @fopen($filename,"a+");
	if (!$fp) die("repeat");
	if (@flock($fp, LOCK_EX))
	{
		@fputs($fp,$s);
		@flock($fp, LOCK_UN);
	}
	else die("repeat");
	@fclose($fp);
	echo "OK";
}
else if (trim($action) == "read")
{
	if (get_magic_quotes_runtime()) {
		set_magic_quotes_runtime(0);
	}
	$first = $_GET["first"];
	$lastmod = intval($_GET["lastmod"]);
	$alastmod = @filemtime($filename);
	$name = file_get_contents("php://input");
	$name = str_replace("\n","",$name);
	$ip = get_ip();
	$json = array();
	$json["lastmod"] = $alastmod;
	$item = array();
	$newonline = array();
	$offline = array();

	$lines = @file($filename);
	if ($alastmod > $lastmod && !$first)
	{
		foreach($lines as $l)
		{
			$item2 = array();
			$l = str_replace(array("\n","\r"),"",$l);
			if (strpos($l,"|") === false) continue;
			$arr = explode("|",$l);
			$t = intval($arr[0]);
			if ($t > $lastmod)
			{
				$item2["time"] = date("H:i:s",$t);
				$item2["word"] = stripslashes($arr[1]);
				$item[] = $item2;
			}
		}
	}
	else if ($first)
	{
		$item = array();
		$total = count($lines);
		for($i=$total-1;$i>=$total-$least;$i--)
		{
			if ($i<=0) break;
			$item2 = array();
			$l = str_replace(array("\n","\r"),"",$lines[$i]);
			if (strpos($l,"|") === false) continue;
			$arr = explode("|",$l);
			$t = intval($arr[0]);
			$item2["time"] = (date("m-d",time()) == date("m-d",$t))?date("H:i:s",$t):date("m-d H:i",$t);
			$item2["word"] = stripslashes($arr[1]);
			$item[] = $item2;
		}
		$item = array_reverse($item);
	}

	$s = "";
	$nt = time();
	$onlines = array();
	if($disonline)
	{
		$users = @file($datafile);
		foreach($users as $l)
		{
			$l = str_replace(array("\r","\n"),"",$l);
			if (strpos($l,"|") === false)
			{
				$s.=$l."\n";
				continue;
			}
			$arr = explode("|",$l);
			if ($nt - intval($arr[1]) < $touchs*2+1)
			{
				if (trim($name) == trim($arr[2]))
				{
					$s.= $arr[0]."|".time()."|".$name."|".get_ip()."|\n";
				}
				else $s.=$l."\n";
				$onlines [] = $arr[2];
			}
		}
		@file_put_contents($datafile,$s);
		$json["onlines"] = $onlines;
	}
	$json["lines"] = $item;
	echo array2json($json);
	if (!get_magic_quotes_runtime()) {
		set_magic_quotes_runtime(1);
	}
}
else
{
?>
<html>
<head>
<title><?php echo $title;?></title>
<meta http-equiv='Pragma' content='no-cache' />
<meta http-equiv=Content-Type content="text/html; charset=<?php echo $charset;?>" />
<meta name="keywords" content="<?php echo $lang["keywords"];?>">
<meta name="description" content="<?php echo $description;?>">

<style type='text/css'>
body	{ text-align:center; color:#333333; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;}
a	{ text-decoration:none; color:#a2b700; }
.mydiv	{ text-align:left; margin:5px; padding:5px; border:1px solid #FF9999; background-color:#FFCCCC; width:600px; }
.inputtext	{ border:0px; border:1px solid #FF9999; background-color:transparent;}
.submit	{ border:1px solid #FF9999; background-color:transparent; }
.contents	{ border:1px solid #FF9999;margin:5px; margin-top:10px;background-color:#ffffff; overflow:auto;word-break:break-all;word-wrap :break-word;}
.bg	{ background-color:#ffffff; }
.content	{ border:0px;background-color:transparent;width:auto; font-size:16px; font-family:Fixedsys; margin:2px; padding:1px; }
.time	{ color:#aaaaaa; font-size:10px; font-family:Arial;}
.online	{ margin:5px; padding:0px; display:inline; }
.mybut	{ width:20px; height:20px; background-color:#FF9999; text-align:center; font-size:12px; color: #333333; border:1px solid #000;padding:2px;font-family:Verdana, Arial, Helvetica, sans-serif;}
</style>

<script>
function $(obj)
{
	return document.getElementById(obj);
}

function setCookie(name,value,t)
{
	var cookieexp = 5*30*24*60*60*1000; //5 months
	var cookiestr=name+"="+escape(value)+";";
	var expires = "";
	var d = new Date();
	var t2=(!t)?cookieexp:t*60*1000;
	d.setTime( d.getTime() + cookieexp);
	expires = "expires=" + d.toGMTString()+";";
	document.cookie = cookiestr+ expires;
}

function getCookie(name)
{
	var start = document.cookie.indexOf( name + "=" );
	var len = start + name.length + 1;
	if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) return "";
	if ( start == -1 ) return "";
	var end = document.cookie.indexOf( ";", len );
	if ( end == -1 ) end = document.cookie.length;
	return unescape( document.cookie.substring( len, end ) );
}

function sack(file) {
	this.xmlhttp = null;

	this.resetData = function() {
		this.method = "GET";
		this.URLString = "";
		this.encodeURL = true;
		this.file = file;
		this.late = true;
		this.failed = false;
  	};

	this.resetFunctions = function() {
  		this.onLoading = function() { };
  		this.onLoaded = function() { };
  		this.onInteractive = function() { };
  		this.onCompletion = function() { };
  		this.onError = function() { };
		this.encode = (encodeURIComponent && this.encodeURL)?function(s) {
			return encodeURIComponent(s);
		}:function(s){return s;}
	};

	this.reset = function() {
		this.resetFunctions();
		this.resetData();
	};

	this.createAJAX = function(){
		try {
			this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e1){
			try {
				this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
				this.xmlhttp = null;
			}
		}
		if (! this.xmlhttp) {
			if (typeof XMLHttpRequest != "undefined") {
				this.xmlhttp = new XMLHttpRequest();
			} else {
				this.failed = true;
			}
		}
	};

	this.setVar = function(name, value) {
		var first = (this.URLString.length == 0);
		this.URLString += (first)?"":"&";
		this.URLString += name + "=" + this.encode(value);
	};

	this.send = function() {
		if (!this.xmlhttp || this.failed ) {
			this.onError();
			return;
		}
		var self = this;
		if (this.method == "GET" || this.method == "GET&POST") {
			this.xmlhttp.open(this.method,this.file+"?"+this.URLString,this.late);
		} else if (this.method == "POST") {
			this.xmlhttp.open(this.method,this.file,this.late);
			try {
				this.xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			} catch(e) {}
		}
		else this.onError();

		this.xmlhttp.onreadystatechange = function() {
			switch (self.xmlhttp.readyState) {
				case 1:
					self.onLoading();
					break;
				case 2:
					self.onLoaded();
					break;
				case 3:
					self.onInteractive();
					break;
				case 4:
					self.response = self.xmlhttp.responseText;
					self.responseXML = self.xmlhttp.responseXML;
					if (self.xmlhttp.status == "200") {
						self.onCompletion();
					} else {
						self.onError();
					}
					self.URLString = "";
					break;
			}
		};
		
		if (this.method == "POST") {
			this.xmlhttp.send(this.URLString);
		} else if (this.method == "GET") {
			this.xmlhttp.send(null);
		} else {
			this.xmlhttp.send(this.content);
		}
	};

	this.reset();
	this.createAJAX();
}

function pickColor()
{
	var sColor = $('dlgHelper').ChooseColorDlg();
	var color = sColor.toString(16);
	while (color.length<6) color="0"+color;
	window.color = color;
	color = "#"+color;
	$('div_color').style.backgroundColor = color;
	$('div_color').value = color;
}

function ubb_click(keyword) {
	var ubb = $('chat_word');
	ubb.value += keywords[keyword] ? keywords[keyword] : '[:ani_wink:]';
}

var isIE = (document.all && window.ActiveXObject) ? true : false;
var keywords = {
	'aw':'[:ani_wink:]',
	'be':'[:big_eyes:]',
	'co':'[:cool:]',
	'cr':'[:cry:]',
	'er':'[:eye_roll:]',
	'gr':'[:grin:]',
	'ha':'[:happy:]',
	'ni':'[:not_impressed:]',
	'sm':'[:smile:]',
	'se':'[:smile_eyes:]',
	'st':'[:stickout:]',
	'sr': '[:straight:]',
	'su':'[:surprised:]',
	'uh':'[:unhappy:]',
	'wi':'[:wink:]'};
</script>
</head>
<body>
<center>

<div class="mydiv login" id='div_description'>
<?php echo $description;?>
</div>

<div class="mydiv rooms" id='div_msg'>
<div class='contents' style='height:350px;' id='div_contents'>Loading...</div>
</div>

<div class="mydiv login" id='div_name' style='display:block;'>
名称:<input type=text class="inputtext bg" size=8 id='chat_user' value='' />&nbsp;
<OBJECT id=dlgHelper CLASSID="clsid:3050f819-98b5-11cf-bb82-00aa00bdce0b" WIDTH="0px" HEIGHT="0px"></OBJECT>
<input class="inputtext" style='width:50px;cursor:hand;10px;background-color:#000000;color:#ffffff;' id='div_color' onclick="pickColor()" value="#000000" onblur="this.style.backgroundColor=this.value;window.color=this.value.replace('#','');" />
&nbsp;字号:<input class="inputtext bg" type=text style='width:20px' maxlength=3 id='input_size' value='16' />(px)
&nbsp;字体:<select id='input_font' class='inputtext bg' style='width:70px;'>&nbsp;
<option value='Fixedsys'>Fixedsys</option>
<option value='heiti'>黑体</option>
<option value='songti'>宋体</option>
<option value='kaiti'>楷体</option>
</select>&nbsp;
加粗:<input type=checkbox id='input_bold' class='inputtext' style='border-bottom:0px;' />&nbsp;
窗体:<a class='mybut' href='javascript:resize(1)'>+</a>
&nbsp;<a class='mybut' href='javascript:resize(0)'>-</a>
&nbsp;<a class='mybut' href='javascript:clearAll()'>Clear</a>
</div>
<div class="mydiv login" id='div_name' style='display:block;' style="text-align:center;">
<a href="javascript:void(0);" onclick="ubb_click('aw');"><img src="./smilies/ani_wink.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('be');"><img src="./smilies/big_eyes.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('co');"><img src="./smilies/cool.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('cr');"><img src="./smilies/cry.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('er');"><img src="./smilies/eye_roll.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('gr');"><img src="./smilies/grin.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('ha');"><img src="./smilies/happy.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('ni');"><img src="./smilies/not_impressed.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('sm');"><img src="./smilies/smile.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('se');"><img src="./smilies/smile_eyes.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('st');"><img src="./smilies/stickout.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('sr');"><img src="./smilies/straight.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('su');"><img src="./smilies/surprised.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('uh');"><img src="./smilies/unhappy.gif" border="0" /></a>&nbsp;
<a href="javascript:void(0);" onclick="ubb_click('wi');"><img src="./smilies/wink.gif" border="0" /></a>
</div>
<div class="mydiv login" id='div_word'>
<textarea type=text class="inputtext bg" rows=1 scrolling=no style='height:20px;overflow:hidden;width:500px;' id='chat_word' onfocus="if (this.value == '<?php echo $lang["hereyourwords"];?>') this.value='';" 
 onkeydown="return check_send(event);" ><?php echo $lang["hereyourwords"];?></textarea>
<input type='button' class='submit' value='Send' onclick="chat_send();$('chat_word').value='';$('chat_word').style.height=20;" onfocus="this.blur();"/>
</div>

<div class='mydiv' style='display:<?php if (!$disonline) echo "none";?>' id='div_online'>Loading online...</div>

<script>
var lastmod = <?php echo time()-$earlier*60;?>;
var login = 1;
var loading = false;
var olduser = getCookie('chatusername');
if (olduser != "") $('chat_user').value = olduser;
var room = "<?php echo $room;?>";
var first = 1;
var dis = "<?php echo $least;?>";
var lastword;
var color='';
var touchs = <?php echo $touchs;?>;
var dotouch = true;
var maxdisplay = <?php echo $maxdisplay;?>;
var nowdisplay = 1;

function load_word(re)
{
	if (re) setTimeout("load_word(1);",1000);
	if (window.loading) return;
	var sk = new sack("");
	sk.method = "GET&POST";
	sk.setVar("action","read");
	sk.setVar("lastmod",window.lastmod);
	sk.setVar("room",room);
	if (window.first)
	{
		sk.setVar("first","true");
		sk.setVar("dis",dis);
	}
	if (window.dotouch) 
	{
		sk.setVar("touchme","true");
		window.dotouch = false;
		try { CollectGarbage(); } catch(e) {}
	}
	sk.onCompletion = function()
	{
		window.loading = false;
		var body = $('div_contents');
		try {
			eval("var arr = "+sk.response); 
		} catch(e)
		{
			alert('Error 101\nJSON Syntax Error!\n\n'+sk.response);
			return;
		}
		if (!arr || !arr.lastmod)
		{
			return;
		}
		var html = "";
		var line = arr.lines;
		var i = 0;
		var v1 = 0;
		var div_online = $('div_online');
		if (window.first)
		{
			body.innerHTML = "";
			window.first = false;
		}
		
		if (arr.onlines)
		{
			$('div_online').innerHTML = "Online User:";
			for(var i=0;i<arr.onlines.length;i++) addonline(arr.onlines[i]);
		}

		for(var i=0;i<line.length;i++)
		{
			var div1 = document.createElement("div");
			window.nowdisplay ++;
			if (window.nowdisplay > window.maxdisplay) window.nowdisplay = 1;
			if ($("contentitem"+window.nowdisplay)) body.removeChild($("contentitem"+window.nowdisplay));
			div1.className = "content";
			div1.id = "contentitem"+window.nowdisplay;
			div1.innerHTML = line[i].word+" <span class='time'>("+line[i].time+")</span>";
			body.appendChild(div1);
			body.scrollTop = 655350;
			v1 = 1;
		}
		if (v1) 
		{
			window.focus(); 
			document.body.focus();
			window.lastmod = arr.lastmod;
			$('chat_word').focus();
		}
	}

	sk.onError=function()
	{
		window.loading = false;
		window.status = 'Error 102';
		setTimeout("window.status = '';",5000);
	}
	window.loading = true;
	sk.content = $('chat_user').value;
	sk.send();
}

function touchme()
{
	window.dotouch = true;
	setTimeout("touchme()",window.touchs*1000);
}

function showalert(a,n)
{
	if (!n) n=0;
	if (n>3) return;
	if (!a)
	{
		a = 0;
		b = 1;
	}
	else
	{
		a = 1;
		b = 0;
	}
	document.title = mytitle[a];
	setTimeout("showalert("+b+","+(n+1)+");",500);
}

function addonline(name)
{
	if ($(name)) return;
	var d1 = document.createElement("div");
	d1.id = name;
	d1.style.border = '1px solid #000';
	d1.style.padding = '2px;';
	d1.style.background = '#ccc';
	d1.innerHTML = name;
	d1.className = "online";
	$('div_online').appendChild(d1);
}

load_word(1);
touchme();

function check_send(e)
{
	if (!e) e = window.event;
	var obj = $('chat_word');
	if (isIE) obj.style.height = obj.scrollHeight+3;
	if (e.keyCode == 13)
	{
		if ((!e.shiftKey && !e.altKey && !e.ctrlKey) || !isIE)
		{
			chat_send();
			obj.value="";
			obj.style.height = 20;
			return false;
		}
		else if (isIE) obj.style.height = obj.scrollHeight+18;
	}
	return true;
}

function chat_send(n)
{
	if (!n) n=0;
	var username = $('chat_user').value.replace("\n","");
	var content = $('chat_word').value;
	var size = parseInt($('input_size').value);
	var font = $('input_font').value;
	var bold = ($('input_bold').checked)?"bold":"";
	if (username == "")
	{
		alert('Please Enter Your Nick Name First!!');
		$('chat_user').focus();
		return;
	}
	if (content == "" || content == "\n" || content == "\n\n" || content == "\n\n\n")
	{
		alert('Please Enter Your Words!');
		$('chat_word').focus();
		$('chat_word').value = "";
		return;
	}
	if (size>100) size = 100;
	else if (size<0) size = 1;
	lastword = content;
	var sk = new sack("");
	sk.method = "GET&POST";
	sk.setVar("action","write");
	sk.setVar("bold",bold);
	sk.setVar("color",window.color);
	sk.setVar("font",font);
	sk.setVar("size",size);
	sk.setVar("room",room);
	sk.onCompletion = function()
	{
		//alert(sk.response);
		if (sk.response.indexOf("NAME")!=-1)
		{
			alert('昵称重复!');
			$('chat_user').value = "";
			$('chat_user').focus();
		}
		else if (sk.response.indexOf("repeat")!=-1)
		{
			$('chat_word').value = sk.lastcontent;
		}
		if (!window.loading)
		{
			window.dotouch = true;
			load_word();
		}
	}
	
	sk.onError=function()
	{
		alert('Error 103\nWhen Send Words\n\nYou Can Send Them Again!');
		$('chat_word').value = lastword;
	}
	sk.content = username+"\n"+content;
	sk.send();
	sk.lastcontent = content;
	$('chat_word').focus();
	setCookie("chatusername",$('chat_user').value);
}

function resize(s)
{
	var o = $('div_contents').style;
	var h = parseInt(o.height);
	h = (s)?h+50:h-50;
	if (h<=50 || h>=3000) return;
	o.height = h;
	$('div_contents').scrollTop = 655350;
}

function clearAll()
{
	$('div_contents').innerHTML = "";
}
</script>
</center>
</body>
</html>
<?php
}
?>