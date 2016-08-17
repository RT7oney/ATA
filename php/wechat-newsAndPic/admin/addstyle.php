<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 

error_reporting(0);

require_once('../conn.php');
$type = $_GET["type"];
$do=$_GET['do'];
if($do=="add"){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<title>样式列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/themes/default/easyui.css" />
<script type="text/javascript" src="../js/ueditor/ueditor.config.js?v=1.1.10"></script>
<script type="text/javascript" src="../js/ueditor/ueditor.all.min.js?v=1.1.10"></script>
</head>
<body>
<p><a href="./addstyle.php?do=add" class="easyui-linkbutton l-btn" onclick="load2()" id=""><span class="l-btn-left"><span class="l-btn-text">添加样式</span></span></a></p>
    <form id="form1" name="form1" method="post" action="addstyle.php?do=save">
      <table width="90%" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="100px">类型：</th>
            <th><label for="typestr"></label>
              <select name="typestr" id="typestr">
                <option value="1" <?php if($type==1){echo 'selected="selected"';}?>>顶关注</option>
                <option value="2" <?php if($type==2){echo 'selected="selected"';}?>>标题</option>
                <option value="3" <?php if($type==3){echo 'selected="selected"';}?>>卡片</option>
                <option value="4" <?php if($type==4){echo 'selected="selected"';}?>>互推账号</option>
                <option value="5" <?php if($type==5){echo 'selected="selected"';}?>>分割线</option>
                <option value="6" <?php if($type==6){echo 'selected="selected"';}?>>底提示</option>
                <option value="7" <?php if($type==7){echo 'selected="selected"';}?>>背景</option>
                  <option value="8" <?php if($type==8){echo 'selected="selected"';}?>>图文图片</option>
                  <option value="9" <?php if($type==9){echo 'selected="selected"';}?>>应用场景</option>
                  <option value="10" <?php if($type==10){echo 'selected="selected"';}?>>音视频</option>
                  <option value="11" <?php if($type==11){echo 'selected="selected"';}?>>模板</option>
                  <option value="12" <?php if($type==12){echo 'selected="selected"';}?>>点赞分享</option>
                  <option value="13" <?php if($type==13){echo 'selected="selected"';}?>>素材图</option>
                  <option value="14" <?php if($type==14){echo 'selected="selected"';}?>>小符号</option>
                  <option value="15" <?php if($type==15){echo 'selected="selected"';}?>>节日</option>

            </select></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>样式名称：</td>
            <td><label for="stylestr"></label>
            <input name="stylestr" type="text" id="stylestr" size="40" /></td>
          </tr>
          <tr>
            <td>样式代码：</td>
            <td>
<script id="container" name="content" type="text/plain" style="max-width:750px;height:200px;margin-top:5px;">
<div class="element-item" data-color="">
<div class="content">
切换到html编写代码
</div>
</div>
</script>
    <script type="text/javascript">
        //var ue = UE.getEditor('container');
		var ue = UE.getEditor('container', {
		toolbars: [['fullscreen', 'source', 'undo', 'redo', 'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat', 'autotypeset', 'blockquote', 'pasteplain', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', 'rowspacingtop', 'rowspacingbottom', 'lineheight', 'indent', 'justifyleft', 'justifycenter', 'justifyright', 'fontfamily','fontsize','justifyjustify', 'touppercase', 'tolowercase', 'simpleupload', 'emotion', 'insertvideo', 'map', 'date', 'time', 'spechars', 'preview', 'searchreplace'], ['con', 'title', 'fork', 'guide', 'division', 'other', 'mystyle']],
		autoHeightEnabled: false,
		allowDivTransToP: false,
		autoFloatEnabled: true,
		enableAutoSave: false
	});
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
</body>
</html>
<?php
}
if($do=="save"){
$typestr=$_POST['typestr'];
$stylestr=$_POST['stylestr'];
$codestr=$_POST['content'];
header("Content-type: text/html; charset=utf-8"); 
if ($stylestr==""||$codestr==""){
	echo "<script>alert('样式名称及内容不能为空！');window.history.back(-1);</script>";
}else{
	
	$sql="insert into wxstyle(type,style,code,addtime) values(".$typestr.",'".$stylestr."','".$codestr."',now())";
	mysql_query("set names 'utf8'");
	$retss=mysql_query($sql,$link);
	if ($retss===false) {
	die("faile:".mysql_error($link));
	}else{
	echo "<script>alert('添加成功！');window.location.href='list.php?type=".$typestr."';</script>";
	}
	mysql_close($link);
}

}
?>
