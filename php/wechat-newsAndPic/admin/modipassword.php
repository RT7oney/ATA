<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>微信编辑器后台管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
<body>
    <form action="modipass.php" method="post">
      <table width="323" border="0">
        <tr>
          <td width="123" height="50">密码：</td>
          <td width="190"><label for="newpass"></label>
          <input type="password" name="newpass" id="newpass" /></td>
        </tr>
        <tr>
          <td height="51">重新输入密码：</td>
          <td><label for="newpass2"></label>
          <input type="password" name="newpass2" id="newpass2" /></td>
        </tr>
        <tr>
          <td height="55">&nbsp;</td>
          <td><input type="submit" name="button" id="button" value=" 确 定 "/></td>
        </tr>
      </table>
</form>
</body>
</html>