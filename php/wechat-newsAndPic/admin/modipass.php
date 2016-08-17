<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 
//header('conten-type:text/html;charset=utf-8');
require_once('../conn.php');
$newpass=$_POST['newpass'];
$newpass2=$_POST['newpass2'];
if($newpass<>"" and $newpass2<>"" and $newpass==$newpass2){
	$sql="update admin set adminpassword='".$newpass."' where adminname='admin'";
	$ret=mysql_query($sql,$link);
	if ($ret===false) {
	die("faile:".mysql_error($link));
	} else {
	echo "<script>alert('密码修改成功！');window.history.back(-1);</script>";
	}
	mysql_close($link);
}else
{
	echo "<script>alert('密码输入不能为空，且相同！');window.history.back(-1);</script>";
}
?>
