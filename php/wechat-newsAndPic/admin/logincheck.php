<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once('../conn.php');
error_reporting(0);
$do = $_GET["do"];
if($do=="logout")
{
unset($_SESSION['ewema=997720527']); 
echo '<script>if(confirm("确认退出?")){alert("退出成功!");window.location.href="login.html";} </script>';
}
if($do=="login")
{
			$adminname1 = $_POST["adminname"]; 
			$adminpassword1 = $_POST["adminpassword"];
			if ($adminname1=="" and $adminpassword1==""){
	             echo "<script>alert('请输入用户名和密码！');window.location.href='login.html';</script>";
            }else{ 
	             $sqlcx="select * from admin where adminname='".$adminname1."' and adminpassword='".$adminpassword1."'";
	             $ret=mysql_query($sqlcx,$link);
	             $num=mysql_num_rows($ret);
	             if($num==0){
                      echo "<script>alert('用户名或密码错误！');window.location.href='login.html';</script>";
	             }else{
		              $rets=mysql_query("update admin set logintime=now() where adminname='".$adminname1."'",$link);
		              if ($rets===false) {
				           die("faile:".mysql_error($link));
			          } else {
						    //$lifeTime = 2 * 3600;  
                            //session_set_cookie_params($lifeTime);  
							@session_start();  
                            $_SESSION['ewema=997720527'] = $adminname1;  
				            echo "<script>window.location.href='wxadmin.php?do=login';</script>";
			          }
	            }
	           mysql_close($link);
			}

}else{
echo "欢迎关注微信2010微信编辑器";
exit;
}
?>