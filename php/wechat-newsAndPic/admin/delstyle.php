<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  
if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 
header("Content-type: text/html; charset=utf-8"); 
require_once('../conn.php');
$id=$_GET['id'];
if($id<>""){
	$sql="delete from wxstyle where id=".$id;
	$ret=mysql_query($sql,$link);
	if ($ret===false) {
	die("faile:".mysql_error($link));
	} else {
	echo "<script>alert('删除成功！');window.history.back(-1);</script>";
	}
	mysql_close($link);
}
?>
