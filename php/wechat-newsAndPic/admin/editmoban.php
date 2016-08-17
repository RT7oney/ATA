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
if($do=="modi"){
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
<p></p>
    <form id="form1" name="form1" method="post" action="editmoban.php?do=save">
      <table width="90%" class="table table-bordered table-striped">
        <thead>
        </thead>
        <tbody>
          <tr>
            <td width="100">模板名称：</td>
            <td><label for="mbname"></label>
            <input name="mbname" type="text" id="mbname" size="40" value="<?php echo $mbname;?>"/></td>
          </tr>
          <tr>
            <td>模板描述：</td>
            <td><label for="mbstr"></label>
            <textarea name="mbstr" id="mbstr" cols="80" rows="5"><?php echo $mbstr;?></textarea><input name="mbid" type="hidden" value="<?php echo $mbid;?>" /></td>
          </tr>
          <tr>
            <td>模板代码：</td>
            <td>
    <script id="container" name="content" type="text/plain" style="max-width:750px;height:200px;margin-top:5px;">
	<?php echo $mbcode;?>
    </script>
    <script type="text/javascript">
        //var ue = UE.getEditor('container');
		var ue = UE.getEditor('container', {
		toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', 'autotypeset', 'blockquote', 'pasteplain', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'indent', 'justifyleft', 'justifycenter', 'justifyright', 'fontfamily','fontsize','justifyjustify', 'touppercase', 'tolowercase', 'simpleupload', 'emotion', 'insertvideo', 'map', 'date', 'time', 'spechars', 'preview', 'searchreplace'], ['con', 'title', 'fork', 'guide', 'division', 'other', 'mystyle']],
		autoHeightEnabled: false,
		allowDivTransToP: false,
		autoFloatEnabled: true,
		enableAutoSave: false
	})
	
    </script>
            
            </td>
            </tr>
            <tr>
            <td></td>
            <td><input name="submit" type="submit" id="submit" value="保存" /></td>
          </tr>
        </tbody>
      </table>
    </form>
    <br />
     <br />
      <br />
</body>
</html>
<?php
  }
	}
		if($do=="save"){
		$mbid=$_POST['mbid'];
		$mbname=$_POST['mbname'];
		$mbstr=$_POST['mbstr'];
		$mbcode=$_POST['content'];
		header("Content-type: text/html; charset=utf-8"); 
		if ($mbname==""||$mbcode==""){
			echo "<script>alert('模板名称及内容不能为空！');window.history.back(-1);</script>";
		}else{
			
			$sql = "update moban set mbname='".$mbname."',mbstr='".$mbstr."',mbcode='".$mbcode."',addtime=now() where mbid=".$mbid;
			mysql_query("set names 'utf8'");
			$retss=mysql_query($sql,$link);
			if ($retss===false) {
        		die("faile:".mysql_error($link));
			}else{
        		echo "<script>alert('修改模板成功！');window.location.href='mblist.php';</script>";
			}
        	mysql_close($link);
		  }
		}
?>
