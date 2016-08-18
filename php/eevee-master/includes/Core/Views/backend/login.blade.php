<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EEVEE 后台登录</title>

    <link rel="stylesheet" href="/content/web/src/scripts/vendor/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="/content/web/src/css/login.css">
    <?php do_action('load_login_styles'); ?>
</head>

<body>

<div class="wrapper">

    <div id="page-login">


        <div class="mask"></div>

        <div class="mask-cover"></div>

        <div id="wrapper" class="ui middle aligned center aligned grid">

            <div class="column">

                <h2 class="ui teal image header">
                    <!--<img src="images/logo.png" class="image">-->
                    <div class="content">
                        EEVEE
                    </div>
                </h2>

                <form class="ui large form">
                    <div class="ui stacked segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input id="account-input" type="text" name="text" placeholder="用户名或邮箱">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input id="password-input" type="password" name="password" placeholder="密码">
                            </div>
                        </div>
                        <!--<div class="ui fluid large teal submit button" ng-click="login()">登录</div>-->
                    </div>

                    <div class="ui error message"></div>

                </form>

                <div id="login-btn" class="ui message">
                    <a href="#">登录</a>
                </div>

            </div>

        </div>

    </div>


</div>

</body>
<script src="/content/web/src/scripts/vendor/jquery/dist/jquery.min.js"></script>
<?php do_action('load_login_scripts'); ?>

</html>


