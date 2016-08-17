<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 

error_reporting(0);
//header("Content-type: text/html; charset=utf-8"); 
require_once('../conn.php');
$type = $_GET["type"];
$id=$_GET['id'];
$do=$_GET['do'];
if($id!="" and $type!=""){
mysql_query("set names 'utf8'");
$res=mysql_query("select * from wxstyle where id=".$id ,$link);
$myrow = mysql_fetch_array($res);
$style =  $myrow[2];
$code =  $myrow[3];
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
    <form id="form1" name="form1" method="post" action="editstyle.php?do=save">
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
            <input name="stylestr" type="text" id="stylestr" size="40" value="<?php echo $style;?>"/><input name="id" type="hidden" value="<?php echo $id;?>" /></td>
          </tr>
          <tr>
            <td>样式代码：</td>
            <td>
    <script id="container" name="content" type="text/plain" style="max-width:750px;height:200px;margin-top:5px;"><?php echo $code;?></script>
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
    <br />
    <br />
</body>
</html>
<?php
}
if($do=="save"){
$id=$_POST['id'];
$typestr=$_POST['typestr'];
$stylestr=$_POST['stylestr'];
$codestr=$_POST['content'];
//header("Content-type: text/html; charset=utf-8"); 
if ($stylestr==""||$codestr==""){
	echo "<script>alert('样式名称及内容不能为空！');window.history.back(-1);</script>";
}else{
	
	$sql = "update wxstyle set type=".$typestr.",style='".$stylestr."',code='".$codestr."',addtime=now() where id=".$id;
	mysql_query("set names 'utf8'");
	$ret = mysql_query($sql, $link);
	if ($ret === false) {
		die("faile: " . mysql_error($link));
	} else {
		echo "<script>alert('修改成功！');window.location.href='list.php?type=".$typestr."';</script>";
	}
    mysql_close($link);
}

}
?>
