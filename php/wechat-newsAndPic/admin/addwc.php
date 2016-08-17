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
$uname=$_POST['uname'];
$name=$_POST['name'];
$password=$_POST['password'];





if($uname<>"" and $name<>""  and $password<>""){


	$sql = "update wechat set uname='".$uname."',name='".$name."',password='".$password."' where id=1";

	//$sql="insert into wechat(uname,name,password) values(".$uname.",'".$name."','".$password."')";

   // echo $sql;

    mysql_query("set names 'utf8'");
	$ret=mysql_query($sql,$link);
	if ($ret===false) {
	die("faile:".mysql_error($link));
	} else {
	echo "<script>alert('账号修改成功！');window.history.back(-1);</script>";
	}
	mysql_close($link);
}else
{
	echo "<script>alert('账号修改失败，请完整填写数据后提交！');window.history.back(-1);</script>";
}
?>
