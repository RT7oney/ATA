<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 
require_once('../conn.php');
$do=$_GET['do'];
$mbid=$_GET['mbid'];

if($mbid!=""){
mysql_query("set names 'utf8'");
$res=mysql_query("select * from moban where mbid=".$mbid ,$link);
$myrow = mysql_fetch_array($res);
$mbname =  $myrow[1];
$mbstr =  $myrow[2];
$mbcode =  $myrow[3];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<title>模板修改</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/themes/default/easyui.css" />
<script type="text/javascript" src="../js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="../js/ueditor/ueditor.all.min.js"></script>
<style type="text/css">
.demo{width:620px; margin:30px auto}
.demo p{line-height:32px}
.btn{position: relative;overflow: hidden;margin-right: 4px;display:inline-block;*display:inline;padding:4px 10px 4px;font-size:14px;line-height:18px;*line-height:20px;color:#fff;text-align:center;vertical-align:middle;cursor:pointer;background-color:#5bb75b;border:1px solid #cccccc;border-color:#e6e6e6 #e6e6e6 #bfbfbf;border-bottom-color:#b3b3b3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;}
.btn input {position: absolute;top: 0; right: 0;margin: 0;border: solid transparent;opacity: 0;filter:alpha(opacity=0); cursor: pointer;}
.progress { position:relative; margin-left:100px; margin-top:-24px; width:200px;padding: 1px; border-radius:3px; display:none}
.bar {background-color: green; display:block; width:0%; height:20px; border-radius: 3px; }
.percent { position:absolute; height:20px; display:inline-block; top:3px; left:2%; color:#fff }
.files{height:22px; line-height:22px; margin:10px 0}
.delimg{margin-left:20px; color:#090; cursor:pointer}
</style>
</head>
<body>

<div id="previewbox">
        <div style="height:100%;overflow-y:scroll;padding-right:5px;">
        <div style="font-size:18px;line-height:24px;font-weight:700">久恒果优，微信平台专家</div>
        <div><em style="color:#8c8c8c;font-style:normal;font-size:12px;">2014-11-19</em> <a style="font-size:12px;color:#607fa6" href="javascript:void(0);" id="post-user">jh99vucom</a> <a href="#" onclick="window.location.href='mblist.php';">返回</a></div>
        <div id="preview"><script id="container" name="content" type="text/plain" style="max-width:400px;height:564px;margin-top:5px;">
	<?php echo $mbcode;?>
    </script></div>
        </div>
</div>
<p></p>
    
    <script type="text/javascript">
        //var ue = UE.getEditor('container');
		var ue = UE.getEditor('container', {
		toolbars: [],
		autoHeightEnabled: false,
		allowDivTransToP: false,
		autoFloatEnabled: true,
		enableAutoSave: false
	})
	
    </script>
</body>
</html>
<?php
mysql_close($link);
}
?>
