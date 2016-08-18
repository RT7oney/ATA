<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EEVEE 后台管理</title>
    <link rel="stylesheet" href="/content/web/src/scripts/vendor/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="/content/web/src/css/app.layout.css">

    <style>
        header {
            background: #666;
            width: 100%;
            height: 150px;
        }

        .sidebar {
            width: 10%;
            /*background: red;*/
            float: left;
            height: 100%;
        }

        .wrapper {
            width: 90%;
            float: left;
        }
    </style>
    <?php do_action('load_plugin_styles'); ?>

</head>

<body>


<div id="eevee-layout" class="page">

    <div id="eevee-header" class="ui menu">
        <div class="item brand">EEVEE</div>
        <a class="item"><i class="sidebar icon"></i></a>
        <div class="right menu">

            <div class="ui dropdown item" tabindex="0">
                <i class="grid layout icon"></i>
                <div id="shortcuts-wrap" class="user panel menu transition hidden" tabindex="-1">
                    <div class="item">一些快捷方式...</div>
                </div>
            </div>

            <div class="ui dropdown item" tabindex="0">
                <i class="mail outline icon"></i>
                <div id="messages-wrap" class="user panel menu transition hidden" tabindex="-1">
                    <div class="item">一些系统消息...</div>
                </div>
            </div>

            <div class="ui dropdown item" tabindex="0">
                <img src="/content/web/src/images/avatar.png" alt="" class="ui avatar image">
                <i class="dropdown icon"></i>
                <div class="user panel menu transition hidden" tabindex="-1">
                    <div class="item" ng-click="userInformation()">个人信息</div>
                    <div class="item"><a href="#/app/dashboard">面板</a></div>
                    <div class="divider"></div>
                    <div class="item" ng-click="logout()">退出登录</div>
                </div>
            </div>
        </div>
    </div>

    <aside id="eevee-sidebar" class="sidebar">

        <ul class="ui vertical menu">
            <li class="item">
                <a href="/backend/core?page=post"><i class="edit icon"></i></i>文章</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=term"><i class="block layout icon"></i>分类</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=media"><i class="video play icon"></i>多媒体</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=user"><i class="user icon"></i>用户</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=role"><i class="spy icon"></i>角色</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=theme"><i class="paint brush icon"></i>主题</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=plugin"><i class="puzzle icon"></i>插件</a>
            </li>
            <li class="item">
                <a class="" href="#"><i class="setting icon"></i>配置</a>
                <ul>
                    <li class="item"><a href="/backend/core?config=site">网站</a></li>
                    <li class="item"><a href="/backend/core?config=email">邮箱</a></li>
                    <li class="item"><a href="/backend/core?config=media">多媒体</a></li>
                </ul>
            </li>
            <li class="item">
                <a href="#"><i class="area info icon"></i></i>帮助</a>
            </li>

        </ul>

    </aside>

    <section id="eevee-placeholder">

        <div id="eevee-view">

            <?php echo $content ?>

        </div>

    </section>

</div>


</body>

<?php do_action('load_plugin_scripts'); ?>

</html>


