<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN""http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="<?php echo ($keywords); ?>" name="keywords">
    <meta content="<?php echo ($description); ?>" name="description">
    <title><?php echo ($webtitle); ?>--用户中心</title>
    <link rel="stylesheet" type="text/css" href="/xiufae3/Public/User/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/xiufae3/Public/User/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/xiufae3/Public/User/css/animate.css" />
</head>
<body>
<div class="vbox">
    <div class="h1 font-bold m-t-xl">
	用户中心
    </div>
    <div class="m-t-lg wrapper-md animated fadeInUp">
        <div class="container aside-xxl">
            <div class="panel panel-default">
                <div class="panel-heading font-bold">
                    用户登陆
                </div>
                <div class="panel-body">
                    <form class="bs-example form-horizontal" method="post" action="<?php echo U();?>">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                用户名
                            </label>
                            <div class="col-lg-10">
                                <input name="username" type="text" class="form-control" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">
                                密码
                            </label>
                            <div class="col-lg-10">
                                <input name="password" type="password" class="form-control" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <div class="checkbox i-checks">
                                    <label>
                                        <input type="checkbox" checked="">
                                        <i>
                                        </i>
                                        保存密码
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-success">
                                    登 陆
                                </button>
                                <div class="pull-right">
                                    <a href="<?php echo U('reg');?>" class="text-info">
                                        注册用户
                                    </a>
                                    <a href="#" class="text-info">
                                        忘记密码
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center padder">
	<p>
		<small><?php echo ($webtitle); ?> &copy; 2014</small>
	</p>
	</div>
</div>
<script type="text/javascript" src="/xiufae3/Public/User/js/jquery.js"></script>
<script type="text/javascript" src="/xiufae3/Public/User/js/bootstrap.min.js"></script>
</body>
</html>