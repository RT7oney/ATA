<?php
/**
 * Created by PhpStorm.
 * User: lifangjin
 * Date: 16/3/23
 * Time: 17:12
 */

$aryCmd = array(
    'list',//默认为列表界面
);

$cmd = (!empty($_GET['cmd']) && in_array($_GET['cmd'], $aryCmd))?$_GET['cmd']:'list';

switch ($cmd){
    case 'list':
        show_list();
        break;
}

function show_list(){
    global $_SG;
    $sql="select * from agents order by id desc";
    $result = $_SG['pdo']->query($sql);
    $_SG['view']->assign('agentList',$result);
    $_SG['view']->display('agent_list.tpl');
}