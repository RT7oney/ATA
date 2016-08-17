<?php
@session_start();  
//检测是否登录，若没登录则转向登录界面  

error_reporting(0);

if(!isset($_SESSION['ewema=997720527'])){  
    header("Location:login.html");  
    exit();  
} 
header("Content-type: text/html; charset=utf-8"); 
require_once('../conn.php');
$type = $_GET["type"];
$page = $_GET["page"];
$ys = $_POST["ys"];
$pagesize=15;
//取得记录总数，计算总页数用
$res=mysql_query("select count(*) from wxstyle where type=".$type ,$link);
$myrow = mysql_fetch_array($res);
$numrows=$myrow[0];
//计算总页数
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
$pages++;
//判断页数设置与否，如无则定义为首页
if (!isset($page))
$page=1;
//判断转到页数
if (isset($ys))
if ($ys>$pages)
$page=$pages;
else
$page=$ys;
//计算记录偏移量
$offset=$pagesize*($page-1);
//取记录
mysql_query("set names 'utf8'");
$res=mysql_query("select * from wxstyle where type=".$type." order by id desc limit $offset,$pagesize" ,$link);
//循环显示记录
if ($myrow = mysql_fetch_array($res))
{
$i=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
<title>样式列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/themes/default/easyui.css" />
<style>
table{table-layout: fixed;}
td{word-break: break-all; word-wrap:break-word;}
</style>
<p><a href="addstyle.php?do=add&type=<?php echo $type;?>" class="easyui-linkbutton l-btn" onclick="load2()" id=""><span class="l-btn-left"><span class="l-btn-text">添加样式</span></span></a></p>
    <table width="90%" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="20px">序号</th>
            <th width="200px">样式编号</th>
            <th >样式预览</th>
            <th width="100px">操作</th>
        </tr>
        </thead>
        <tbody>
<?php
do {
$i++;
$id =  $myrow[0];
$type =  $myrow[1];
$style =  $myrow[2];
$code =  $myrow[3];
//$i=1;
?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$style;?></td>
            <td><?=$code;?></td>
            <td><a href="editstyle.php?id=<?php echo $id;?>&type=<?php echo $type;?>">编辑</a>&nbsp;&nbsp;<a href="delstyle.php?id=<?php echo $id;?>">删除</a></td>
        </tr>
<?php
}
while ($myrow = mysql_fetch_array($res));
?>
        </tbody>
    </table>
<?php   
}
//显示总页数
if($pages>1){
echo "<div align='center'>共有".$pages."页(".$page."/".$pages.")&nbsp;&nbsp;";
//显示分页数
for ($i=1;$i<$page;$i++)
echo "<a href='list.php?type=".$type."&page=".$i."'>第".$i ."页</a> ";
echo "第".$page."页 ";
for ($i=$page+1;$i<=$pages;$i++)
echo "<a href='list.php?type=".$type."&page=".$i."'>第".$i ."页</a> ";

echo "<br/>";
//显示转到页数
echo "<form action='list.php?type=".$type."' method='post'> ";
//计算首页、上一页、下一页、尾页的页数值
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo "<a href='list.php?type=".$type."&page=".$first."'>首页</a> ";
echo "<a href='list.php?type=".$type."&page=".$prev."'>上一页</a> ";
}
if ($page<$pages)
{
echo "<a href='list.php?type=".$type."&page=".$next."'>下一页</a> ";
echo "<a href='list.php?type=".$type."&page=".$last."'>尾页</a> ";
}
echo "转到<input type=text name='ys' size='2' value=".$page.">页";
echo "<input type=submit name='submit' value='go'>";
echo "</form>";
echo "</div>";  
}
mysql_close($link);
?>