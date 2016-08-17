<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
}


//header('conten-type:text/html;charset=utf-8');
require_once('../conn.php');



mysql_query("set names 'utf8'");

$res=mysql_query("select * from wechat where id= 1" ,$link);
$myrow = mysql_fetch_array($res);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>微信编辑器后台管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
<body>
    <form action="addwc.php" method="post">
      <table width="323" border="0">
	  
	       <tr>
          <td width="123" height="50">微信名称（只是标注，可以任意）：</td>
          <td width="190"><label for="newpass"></label>
          <input type="text" name="uname" id="uname" value="<?php echo $myrow[1]; ?>"/></td>
        </tr>
		
		
        <tr>
          <td width="123" height="50">微信账号：</td>
          <td width="190"><label for="name"></label>
          <input type="text" name="name" id="name" value="<?php echo $myrow[2]; ?>" /></td>
        </tr>
        <tr>
          <td height="51">微信密码：</td>
          <td><label for="newpass2"></label>
          <input type="password" name="password" id="password" value="<?php echo $myrow[3]; ?>" /></td>
        </tr>
        <tr>
          <td height="55">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value=" 修 改 "/></td>
        </tr>
      </table>
</form>
</body>
</html>