<?php
@session_start();
error_reporting(0);
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 
?>
<html>
<head id="Head1">
<title>微信2010编辑器后台管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/css.css" rel="stylesheet" type="text/css" />

<SCRIPT language=javascript>
function opencat(cat,img,imgsrc){
	if(cat.style.display=="none"){
	cat.style.display="";
	imgsrc.src="images/arrow_off.gif";
	}	else {
	cat.style.display="none"; 
	imgsrc.src="images/arrow_on.gif";
	}
}
</Script>

<style type="text/css">
<!--
.STYLE1 {color: #FF3300}
-->
</style>
</head>

<body style="overflow:hidden;">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="210" valign="top" id="cat"><iframe src="left.html" frameborder="0" scrolling="no" width="100%" height="100%"></iframe></td>
    <td width="10" valign="top" class="arrow01" style="cursor:hand;" onclick=opencat(cat,img,imgsrc)><div align="center" id="img"><img src="images/arrow_off.gif" width="8" height="10" id="imgsrc" style="margin-top:100px;">
    </div></td>
    <td valign="top"><iframe src="main.php" frameborder="0" scrolling="auto" width="100%" height="100%" name="mainbody"></iframe>
      <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFD897">
        <tr>
          <td bgcolor="#FFFBF4"><div align="center"><span class="STYLE1">&nbsp;</span></div></td>
        </tr>
      </table></td>
  </tr>
</table>
	</td>
  </tr>
</table>

</body>
</html>
