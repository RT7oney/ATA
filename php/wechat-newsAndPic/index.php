<?php
require_once('conn.php');
mysql_query("set names 'utf8'");
error_reporting(0);
?>

<html lang="en"><head>
    <title>搜刮好东西 V5微信编辑器 - 微信文章编辑 - 微信图文内容排版系统</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="搜刮好东西微信编辑器、微信在线编辑器、2010微信排版、微信内容排版、微信文章排版、HTML编辑器、在线编辑器 ">
    <meta name="Description" content="搜刮好东西微信编辑器提供微信内容编辑，文章编辑，图文编辑样式素材，微信文字排版，图文排版功能，是最好用的在线微信代码排版软件，用微信公众平台编辑排版图文文章就用搜刮好东西微信编辑器。">
    <meta name="generator" content="Wechat Super Editor!">
    <meta name="author" content="搜刮好东西微信编辑器">
    <meta name="copyright" content="2010">
    <link href="favicon.ico" rel="SHORTCUT ICON">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <link href="style/css/common.css" type="text/css" rel="stylesheet">
    <link href="style/css/index.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="style/css/editor-min.css" type="text/css">
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="style/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="style/js/baidutongji.js"></script>
	<link rel="stylesheet" type="text/css" href="style/css/guoyoo.css">
	<link rel="stylesheet" type="text/css" href="style/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style/css/jquery.jgrowl.css">
   	<!--[if lt IE 9]>
          <script src="style/js/html5.js"></script>
 	  <![endif]-->
	<script type="text/javascript" charset="utf-8" src="style/js/bootstrap.min.js"></script>
	<script>
	var BASEURL = "";
	var current_editor;
	var current_active_v3item = null;
	var isout="false";
	var isnew="";</script>
	<style>
		#right-fix-tab{
			width:32px;position:absolute;right:0px;
		}
		#right-fix-tab li{width:30px;background:rgba(58,51,50,0.5);border:0 none;color:#FFF;width:30px;font-size:14px;}

		#color-plan .nav-tabs > li > a{padding:5px;color: #efefef;border: 0 none;}
		#color-plan .nav-tabs > li > a:hover{background:transparent;color:#FFF;}
		#color-plan .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {background-color: #000;color: #FFF;border: 0 none;}
		#more-popover-content .btn-xs{font-size:12px;padding:2px 2px;width:64px;margin:2px;height:20px;margin:1px auto;border: 0 none;background: transparent;color: #FFF;border: 1px solid #FFF;}
		#more-popover-content .btn-xs:hover{ background-color:rgb(213,149,69);color:#FFF;}

	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style id="edui-customize-v3BgDialog-style">.edui-default .edui-for-v3BgDialog .edui-dialog-content  {width:600px;height:300px;}</style>
	<style id="edui-customize-v3BdBgDialog-style">.edui-default .edui-for-v3BdBgDialog .edui-dialog-content  {width:800px;height:400px;}</style>
	<link href="style/css/ueditor.css" type="text/css" rel="stylesheet">
	<script src="style/js/codemirror.js" type="text/javascript" defer="defer"></script>
	<link rel="stylesheet" type="text/css" href="style/css/codemirror.css">

</head>

<body style="overflow-y: hidden; overflow-x: auto;" onselectstart="return false" oncontextmenu="return false;" class="" cz-shortcut-listen="true">
<div class="navbar-fixed-top">
        <div class="navbar-inner">
                <div class="container-fluid" style="background:#f1f1f1;">
                    <div class="row" style="height:20px;line-height:20px;">
                 
                    <div style="float:right;width:100%;overflow:hidden;"><marquee scrollamount="2">通知：搜刮好东西 V5微信编辑器开启新运营模式，长期更新，每个模块的精心测试后上架，小伙伴们一起加入让它更完善，更好用吧。 谢谢！2015-12-27</marquee></div>
          
                    </div>
                </div>
        </div>
</div>




<div id="full-page" class="bg small-height" style="min-width: 1200px; margin-top: 22px; height: 352px;">
<div class="box p-r"><!--box start-->
      <div class="fl w0 p-r">

    <div class="w1 fl">
      <div class="n1">分类</div>
      <ul class="n1-1" style="height: 280px;">
        <li id="guanzhu-tpl-trigger" class="active"><a href="#style-guanzhu" role="tab" data-toggle="tab" aria-expanded="true"> 顶关注 </a></li>
        <li id="title-tpl-trigger" class=""><a href="#style-title" role="tab" data-toggle="tab" aria-expanded="false"> 标题 </a></li>
        <li id="body-tpl-trigger" class=""><a href="#style-body" role="tab" data-toggle="tab" aria-expanded="false"> 卡片 </a></li>
        <li id="img-tpl-trigger" class=""><a href="#style-img" role="tab" data-toggle="tab" aria-expanded="false"> 分割线 </a></li>
        <li id="hutui-tpl-trigger"><a href="#style-hutui" role="tab" data-toggle="tab"> 互推账号 </a></li>
        <li id="yuanwen-tpl-trigger" class=""><a href="#style-yuanwen" role="tab" data-toggle="tab" aria-expanded="false"> 底提示 </a></li>
    <li id="backg-tpl-trigger" class=""><a href="#style-backg" role="tab" data-toggle="tab" aria-expanded="false"> 背景 </a></li>
    <li id="pic-tpl-trigger" class=""><a href="#style-pic" role="tab" data-toggle="tab" aria-expanded="false"> 图文图片 </a></li>
    <li id="scene-tpl-trigger" class=""><a href="#style-scene" role="tab" data-toggle="tab" aria-expanded="false"> 应用场景 </a></li>
    <li id="video-tpl-trigger" class=""><a href="#style-video" role="tab" data-toggle="tab" aria-expanded="false"> 音视频 </a></li>
    <li id="mb-tpl-trigger"     class=""><a href="#style-mb" role="tab" data-toggle="tab"> 模板 </a></li>
    <li id="zan-tpl-trigger" class="" ><a href="#style-zan" role="tab" data-toggle="tab">点赞分享</a></li>
          <li id="sucai-tpl-trigger"><a href="#style-sucai" role="tab" data-toggle="tab">素材图</a></li>
          <li id="fuhao-tpl-trigger"><a href="#style-fuhao" role="tab" data-toggle="tab">小符号</a></li>
          <li id="jieri-tpl-trigger"><a href="#style-jieri" role="tab" data-toggle="tab">节日</a></li>


    </ul>
</div>



    <div class="w2 fl" style="background:#FFF">
        <div class="n2 ttt">
            样式展示区
        </div>

        <div id="insert-style-list" class="item tab-content" style="height: 281px;">



<!-- 顶关注 -->
				
<div id="style-guanzhu" class="tab-pane active">
	<div class="alert alert-warning">
      <p>更多样式？登录后，在样式中心，收藏使用！</p>
	</div>	
	
	
	
	<div id="guanzhu-list" class="ui-portlet clearfix ">

		<ul id="loader" class="editor-template-list ui-portlet-list">



			<?php
			$res=mysql_query("select * from wxstyle where type=1 order by id desc" ,$link);
			if ($myrow = mysql_fetch_array($res))
			{

			
			   do {
					$sid = $myrow[0];

					$style =  $myrow[2];
					$code =  $myrow[3];
					echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
					echo "<!--".$style." -->";
					
					echo $code;
				
				}
				while ($myrow = mysql_fetch_array($res));
			}
			?>



		</ul>
	</div>			
</div>


<!-- 标题 -->

<div id="style-title" class="tab-pane">  
	<div class="alert alert-warning">
      <p>更多样式？登录后，在样式中心，收藏使用！</p>
	</div>	
	
	
	<div id="title-list" class="ui-portlet clearfix ">

		<ul id="loader" class="editor-template-list ui-portlet-list">

					<?php
					$res=mysql_query("select * from wxstyle where type=2 order by id desc" ,$link);
					if ($myrow = mysql_fetch_array($res))
					{

					
					   do {
							$sid = $myrow[0];

							$style =  $myrow[2];
							$code =  $myrow[3];
							echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
							echo "<!--".$style." -->";
							
							echo $code;
						
						}
						while ($myrow = mysql_fetch_array($res));
					}
					?>



		</ul>
	</div>			
</div>


<!-- 卡片 -->
<div id="style-body" class="tab-pane">

<div id="body-list" class="ui-portlet clearfix ">

    <ul id="loader" class="editor-template-list ui-portlet-list">


        <?php
        $res=mysql_query("select * from wxstyle where type=3 order by id desc" ,$link);
        if ($myrow = mysql_fetch_array($res))
        {


            do {
                $sid = $myrow[0];

                $style =  $myrow[2];
                $code =  $myrow[3];
                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                echo "<!--".$style." -->";

                echo $code;

            }
            while ($myrow = mysql_fetch_array($res));
        }
        ?>

    </ul></div>
</div>



<!-- 分隔线 -->

    <div id="style-img" class="tab-pane">

        <div id="img-list" class="ui-portlet clearfix ">

            <ul id="loader" class="editor-template-list ui-portlet-list">


                <?php
                $res=mysql_query("select * from wxstyle where type=5 order by id desc" ,$link);
                if ($myrow = mysql_fetch_array($res))
                {


                    do {
                        $sid = $myrow[0];

                        $style =  $myrow[2];
                        $code =  $myrow[3];
                        echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                        echo "<!--".$style." -->";

                        echo $code;

                    }
                    while ($myrow = mysql_fetch_array($res));
                }
                ?>

            </ul></div>
    </div>

<!-- 互推 -->

<div id="style-hutui" class="tab-pane">  
<div id="hutui-list" class="ui-portlet clearfix ">

    <ul id="loader" class="editor-template-list ui-portlet-list">


        <?php
        $res=mysql_query("select * from wxstyle where type=4 order by id desc" ,$link);
        if ($myrow = mysql_fetch_array($res))
        {


            do {
                $sid = $myrow[0];

                $style =  $myrow[2];
                $code =  $myrow[3];
                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                echo "<!--".$style." -->";

                echo $code;

            }
            while ($myrow = mysql_fetch_array($res));
        }
        ?>

    </ul>

</div>
</div>


<!-- 底提示 -->

<div id="style-yuanwen" class="tab-pane">
<div id="yuanwen-list" class="ui-portlet clearfix ">

    <ul id="loader" class="editor-template-list ui-portlet-list">


        <?php
        $res=mysql_query("select * from wxstyle where type=6 order by id desc" ,$link);
        if ($myrow = mysql_fetch_array($res))
        {


            do {
                $sid = $myrow[0];

                $style =  $myrow[2];
                $code =  $myrow[3];
                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                echo "<!--".$style." -->";

                echo $code;

            }
            while ($myrow = mysql_fetch_array($res));
        }
        ?>


  </ul>
</div>
</div>

            <!-- 背景 -->
<div id="style-backg" class="tab-pane">
<div id="backg-list" class="ui-portlet clearfix ">
    <ul id="loader" class="editor-template-list ui-portlet-list">

        <?php
        $res=mysql_query("select * from wxstyle where type=7 order by id desc" ,$link);
        if ($myrow = mysql_fetch_array($res))
        {


            do {
                $sid = $myrow[0];

                $style =  $myrow[2];
                $code =  $myrow[3];
                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                echo "<!--".$style." -->";

                echo $code;

            }
            while ($myrow = mysql_fetch_array($res));
        }
        ?>
</ul>
</div>
</div>

            <!-- 图文图片 -->
<div id="style-pic" class="tab-pane">
<div id="pic-list" class="ui-portlet clearfix ">

    <ul id="loader" class="editor-template-list ui-portlet-list">

        <?php
        $res=mysql_query("select * from wxstyle where type=8 order by id desc" ,$link);
        if ($myrow = mysql_fetch_array($res))
        {


            do {
                $sid = $myrow[0];

                $style =  $myrow[2];
                $code =  $myrow[3];
                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                echo "<!--".$style." -->";

                echo $code;

            }
            while ($myrow = mysql_fetch_array($res));
        }
        ?>

    </ul>

</div>
</div>

            <!-- 场景 -->


<div id="style-scene" class="tab-pane">
<div id="scene-list" class="ui-portlet clearfix ">

    <ul id="loader" class="editor-template-list ui-portlet-list">
        <?php
        $res=mysql_query("select * from wxstyle where type=9 order by id desc" ,$link);
        if ($myrow = mysql_fetch_array($res))
        {


            do {
                $sid = $myrow[0];

                $style =  $myrow[2];
                $code =  $myrow[3];
                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                echo "<!--".$style." -->";

                echo $code;

            }
            while ($myrow = mysql_fetch_array($res));
        }
        ?>


    </ul></div>
</div>


            <!-- 音视频 -->


            <div id="style-video" class="tab-pane">
                <div id="video-list" class="ui-portlet clearfix ">

                    <ul id="loader" class="editor-template-list ui-portlet-list">
                        <?php
                        $res=mysql_query("select * from wxstyle where type=10 order by id desc" ,$link);
                        if ($myrow = mysql_fetch_array($res))
                        {


                            do {
                                $sid = $myrow[0];

                                $style =  $myrow[2];
                                $code =  $myrow[3];
                                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                                echo "<!--".$style." -->";

                                echo $code;

                            }
                            while ($myrow = mysql_fetch_array($res));
                        }
                        ?>


                    </ul></div>
            </div>




            <!-- 模板 -->


            <div id="style-mb" class="tab-pane">
                <div id="mb-list" class="ui-portlet clearfix ">

                    <ul id="loader" class="editor-template-list ui-portlet-list">
                        <?php
                        $res=mysql_query("select * from wxstyle where type=11 order by id desc" ,$link);
                        if ($myrow = mysql_fetch_array($res))
                        {


                            do {
                                $sid = $myrow[0];

                                $style =  $myrow[2];
                                $code =  $myrow[3];
                                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                                echo "<!--".$style." -->";

                                echo $code;

                            }
                            while ($myrow = mysql_fetch_array($res));
                        }
                        ?>


                    </ul></div>
            </div>




            <!-- 模板 -->


            <div id="style-zan" class="tab-pane">
                <div id="zan-list" class="ui-portlet clearfix ">

                    <ul id="loader" class="editor-template-list ui-portlet-list">
                        <?php
                        $res=mysql_query("select * from wxstyle where type=12 order by id desc" ,$link);
                        if ($myrow = mysql_fetch_array($res))
                        {


                            do {
                                $sid = $myrow[0];

                                $style =  $myrow[2];
                                $code =  $myrow[3];
                                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                                echo "<!--".$style." -->";

                                echo $code;

                            }
                            while ($myrow = mysql_fetch_array($res));
                        }
                        ?>


                    </ul></div>
            </div>



            <!-- 素材图 -->


            <div id="style-sucai" class="tab-pane">
                <div id="sucai-list" class="ui-portlet clearfix ">

                    <ul id="loader" class="editor-template-list ui-portlet-list">
                        <?php
                        $res=mysql_query("select * from wxstyle where type=13 order by id desc" ,$link);
                        if ($myrow = mysql_fetch_array($res))
                        {


                            do {
                                $sid = $myrow[0];

                                $style =  $myrow[2];
                                $code =  $myrow[3];
                                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                                echo "<!--".$style." -->";

                                echo $code;

                            }
                            while ($myrow = mysql_fetch_array($res));
                        }
                        ?>


                    </ul></div>
            </div>


            <!-- 小符号 -->


            <div id="style-fuhao" class="tab-pane">
                <div id="fuhao-list" class="ui-portlet clearfix ">

                    <ul id="loader" class="editor-template-list ui-portlet-list">
                        <?php
                        $res=mysql_query("select * from wxstyle where type=14 order by id desc" ,$link);
                        if ($myrow = mysql_fetch_array($res))
                        {


                            do {
                                $sid = $myrow[0];

                                $style =  $myrow[2];
                                $code =  $myrow[3];
                                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                                echo "<!--".$style." -->";

                                echo $code;

                            }
                            while ($myrow = mysql_fetch_array($res));
                        }
                        ?>


                    </ul></div>
            </div>



            <!-- 节日 -->


            <div id="style-jieri" class="tab-pane">
                <div id="jieri-list" class="ui-portlet clearfix ">

                    <ul id="loader" class="editor-template-list ui-portlet-list">
                        <?php
                        $res=mysql_query("select * from wxstyle where type=15 order by id desc" ,$link);
                        if ($myrow = mysql_fetch_array($res))
                        {


                            do {
                                $sid = $myrow[0];

                                $style =  $myrow[2];
                                $code =  $myrow[3];
                                echo "<li class='col-xs-12 brush' data-id='$sid' title=$style>";
                                echo "<!--".$style." -->";

                                echo $code;

                            }
                            while ($myrow = mysql_fetch_array($res));
                        }
                        ?>


                    </ul></div>
            </div>

<!--我的收藏-->
<!--<div id="style-my" class="tab-pane">
<div id="my-list" class="ui-portlet clearfix "></div>
</div>-->
<!--模板列表-->					
<!--<div class="tab-pane" id="editor-tpls" style="padding:0px 0px;position:relative;">
    <ul id="editor-tpls-navtab" class="nav nav-tabs" style="border:0 none;">
                              <li class="ignore">
        <a href="#recommend-tpl-list-1" role="tab" data-toggle="tab">模板可以提高编辑效率哟</a>
      </li>						  
    </ul>
    <div class="tab-content"  style="padding:0 10px;overflow-x:hidden;" id="editor-tpls-list"></div>					
</div>	-->
  </div>
 
</div>
<div class="w3 fl">
<div class="editor2 p-r fl" style="height: 280px;"><!--editor2 start-->
<div id="editor" class="edui-default" style="width: 498px; height: 264px;"><div id="edui12" class="edui-editor  edui-default" style="width: 498px; z-index: 0;"><div id="edui12_toolbarbox" class="edui-editor-toolbarbox edui-default"><div id="edui12_toolbarboxouter" class="edui-editor-toolbarboxouter edui-default"><div class="edui-editor-toolbarboxinner edui-default"><div id="edui13" class="edui-toolbar   edui-default" onselectstart="return false;" onMouseDown="return $EDITORUI[&quot;edui13&quot;]._onMouseDown(event, this);" style="-webkit-user-select: none;"><div id="edui151" class="edui-box edui-button edui-for-fullscreen edui-default"><div id="edui151_state" onMouseDown="$EDITORUI[&quot;edui151&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui151&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui151&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui151&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui151_body" unselectable="on" title="全屏" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui151&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui151&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui14" class="edui-box edui-button edui-for-source edui-default"><div id="edui14_state" onMouseDown="$EDITORUI[&quot;edui14&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui14&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui14&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui14&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui14_body" unselectable="on" title="源代码" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui14&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui14&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui15" class="edui-box edui-button edui-for-undo edui-default"><div id="edui15_state" onMouseDown="$EDITORUI[&quot;edui15&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui15&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui15&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui15&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui15_body" unselectable="on" title="撤销" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui15&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui15&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui16" class="edui-box edui-button edui-for-redo edui-default"><div id="edui16_state" onMouseDown="$EDITORUI[&quot;edui16&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui16&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui16&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui16&quot;].Stateful_onMouseOut(event, this);" class="edui-default edui-state-disabled"><div class="edui-button-wrap edui-default"><div id="edui16_body" unselectable="on" title="重做" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui16&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui16&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui17" class="edui-box edui-button edui-for-bold edui-default"><div id="edui17_state" onMouseDown="$EDITORUI[&quot;edui17&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui17&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui17&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui17&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui17_body" unselectable="on" title="加粗" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui17&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui17&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui18" class="edui-box edui-button edui-for-italic edui-default"><div id="edui18_state" onMouseDown="$EDITORUI[&quot;edui18&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui18&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui18&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui18&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui18_body" unselectable="on" title="斜体" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui18&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui18&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui19" class="edui-box edui-button edui-for-underline edui-default"><div id="edui19_state" onMouseDown="$EDITORUI[&quot;edui19&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui19&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui19&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui19&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui19_body" unselectable="on" title="下划线" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui19&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui19&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui20" class="edui-box edui-button edui-for-fontborder edui-default"><div id="edui20_state" onMouseDown="$EDITORUI[&quot;edui20&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui20&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui20&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui20&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui20_body" unselectable="on" title="字符边框" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui20&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui20&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui21" class="edui-box edui-button edui-for-strikethrough edui-default"><div id="edui21_state" onMouseDown="$EDITORUI[&quot;edui21&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui21&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui21&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui21&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui21_body" unselectable="on" title="删除线" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui21&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui21&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui22" class="edui-box edui-button edui-for-removeformat edui-default"><div id="edui22_state" onMouseDown="$EDITORUI[&quot;edui22&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui22&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui22&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui22&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui22_body" unselectable="on" title="清除格式" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui22&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui22&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui23" class="edui-box edui-splitbutton edui-for-autotypeset edui-default"><div title="自动排版" id="edui23_state" onMouseDown="$EDITORUI[&quot;edui23&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui23&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui23&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui23&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-splitbutton-body edui-default"><div id="edui23_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui23&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui23&quot;]._onArrowClick();"></div></div></div></div><div id="edui26" class="edui-box edui-button edui-for-blockquote edui-default"><div id="edui26_state" onMouseDown="$EDITORUI[&quot;edui26&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui26&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui26&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui26&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui26_body" unselectable="on" title="引用" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui26&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui26&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui27" class="edui-box edui-button edui-for-pasteplain edui-default"><div id="edui27_state" onMouseDown="$EDITORUI[&quot;edui27&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui27&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui27&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui27&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui27_body" unselectable="on" title="纯文本粘贴模式" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui27&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui27&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui28" class="edui-box edui-splitbutton edui-for-forecolor edui-default edui-colorbutton"><div title="字体颜色" id="edui28_state" onMouseDown="$EDITORUI[&quot;edui28&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui28&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui28&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui28&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-splitbutton-body edui-default"><div id="edui28_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui28&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div id="edui28_colorlump" class="edui-colorlump"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui28&quot;]._onArrowClick();"></div></div></div></div><div id="edui31" class="edui-box edui-splitbutton edui-for-backcolor edui-default edui-colorbutton"><div title="背景色" id="edui31_state" onMouseDown="$EDITORUI[&quot;edui31&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui31&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui31&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui31&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-splitbutton-body edui-default"><div id="edui31_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui31&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div id="edui31_colorlump" class="edui-colorlump"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui31&quot;]._onArrowClick();"></div></div></div></div><div id="edui34" class="edui-box edui-menubutton edui-for-insertorderedlist edui-default"><div title="有序列表" id="edui34_state" onMouseDown="$EDITORUI[&quot;edui34&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui34&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui34&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui34&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-menubutton-body edui-default"><div id="edui34_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui34&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui34&quot;]._onArrowClick();"></div></div></div></div><div id="edui47" class="edui-box edui-menubutton edui-for-insertunorderedlist edui-default"><div title="无序列表" id="edui47_state" onMouseDown="$EDITORUI[&quot;edui47&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui47&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui47&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui47&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-menubutton-body edui-default"><div id="edui47_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui47&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui47&quot;]._onArrowClick();"></div></div></div></div><div id="edui54" class="edui-box edui-button edui-for-selectall edui-default"><div id="edui54_state" onMouseDown="$EDITORUI[&quot;edui54&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui54&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui54&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui54&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui54_body" unselectable="on" title="全选" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui54&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui54&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui55" class="edui-box edui-button edui-for-cleardoc edui-default"><div id="edui55_state" onMouseDown="$EDITORUI[&quot;edui55&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui55&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui55&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui55&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui55_body" unselectable="on" title="清空文档" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui55&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui55&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui56" class="edui-box edui-menubutton edui-for-rowspacingtop edui-default"><div title="段前距" id="edui56_state" onMouseDown="$EDITORUI[&quot;edui56&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui56&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui56&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui56&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-menubutton-body edui-default"><div id="edui56_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui56&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui56&quot;]._onArrowClick();"></div></div></div></div><div id="edui63" class="edui-box edui-menubutton edui-for-rowspacingbottom edui-default"><div title="段后距" id="edui63_state" onMouseDown="$EDITORUI[&quot;edui63&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui63&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui63&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui63&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-menubutton-body edui-default"><div id="edui63_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui63&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui63&quot;]._onArrowClick();"></div></div></div></div><div id="edui70" class="edui-box edui-menubutton edui-for-lineheight edui-default"><div title="行间距" id="edui70_state" onMouseDown="$EDITORUI[&quot;edui70&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui70&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui70&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui70&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-menubutton-body edui-default"><div id="edui70_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui70&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui70&quot;]._onArrowClick();"></div></div></div></div><div id="edui79" class="edui-box edui-button edui-for-indent edui-default"><div id="edui79_state" onMouseDown="$EDITORUI[&quot;edui79&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui79&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui79&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui79&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui79_body" unselectable="on" title="首行缩进" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui79&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui79&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui84" class="edui-box edui-button edui-for-background edui-default"><div id="edui84_state" onMouseDown="$EDITORUI[&quot;edui84&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui84&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui84&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui84&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui84_body" unselectable="on" title="背景" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui84&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui84&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui85" class="edui-box edui-combox edui-for-fontfamily edui-default"><div title="字体" id="edui85_state" onMouseDown="$EDITORUI[&quot;edui85&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui85&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui85&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui85&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-combox-body edui-default"><div id="edui85_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui85&quot;]._onButtonClick(event, this);">微软雅黑</div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui85&quot;]._onArrowClick();"></div></div></div></div><div id="edui93" class="edui-box edui-combox edui-for-fontsize edui-default"><div title="字号" id="edui93_state" onMouseDown="$EDITORUI[&quot;edui93&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui93&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui93&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui93&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-combox-body edui-default"><div id="edui93_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui93&quot;]._onButtonClick(event, this);">14px</div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui93&quot;]._onArrowClick();"></div></div></div></div><div id="edui104" class="edui-box edui-button edui-for-justifyjustify edui-default"><div id="edui104_state" onMouseDown="$EDITORUI[&quot;edui104&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui104&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui104&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui104&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui104_body" unselectable="on" title="两端对齐" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui104&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui104&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui105" class="edui-box edui-button edui-for-justifyleft edui-default"><div id="edui105_state" onMouseDown="$EDITORUI[&quot;edui105&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui105&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui105&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui105&quot;].Stateful_onMouseOut(event, this);" class="edui-default edui-state-checked"><div class="edui-button-wrap edui-default"><div id="edui105_body" unselectable="on" title="居左对齐" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui105&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui105&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui106" class="edui-box edui-button edui-for-justifycenter edui-default"><div id="edui106_state" onMouseDown="$EDITORUI[&quot;edui106&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui106&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui106&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui106&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui106_body" unselectable="on" title="居中对齐" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui106&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui106&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui107" class="edui-box edui-button edui-for-justifyright edui-default"><div id="edui107_state" onMouseDown="$EDITORUI[&quot;edui107&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui107&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui107&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui107&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui107_body" unselectable="on" title="居右对齐" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui107&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui107&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui108" class="edui-box edui-button edui-for-touppercase edui-default"><div id="edui108_state" onMouseDown="$EDITORUI[&quot;edui108&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui108&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui108&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui108&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui108_body" unselectable="on" title="字母大写" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui108&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui108&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui109" class="edui-box edui-button edui-for-tolowercase edui-default"><div id="edui109_state" onMouseDown="$EDITORUI[&quot;edui109&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui109&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui109&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui109&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui109_body" unselectable="on" title="字母小写" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui109&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui109&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui114" class="edui-box edui-button edui-for-insertimage edui-default"><div id="edui114_state" onMouseDown="$EDITORUI[&quot;edui114&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui114&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui114&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui114&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui114_body" unselectable="on" title="多图上传" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui114&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui114&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui115" class="edui-box edui-splitbutton edui-for-emotion edui-default"><div title="表情" id="edui115_state" onMouseDown="$EDITORUI[&quot;edui115&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui115&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui115&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui115&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-splitbutton-body edui-default"><div id="edui115_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui115&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui115&quot;]._onArrowClick();"></div></div></div></div><div id="edui121" class="edui-box edui-button edui-for-insertvideo edui-default"><div id="edui121_state" onMouseDown="$EDITORUI[&quot;edui121&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui121&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui121&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui121&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui121_body" unselectable="on" title="视频" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui121&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui121&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui126" class="edui-box edui-button edui-for-map edui-default"><div id="edui126_state" onMouseDown="$EDITORUI[&quot;edui126&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui126&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui126&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui126&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui126_body" unselectable="on" title="Baidu地图" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui126&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui126&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui127" class="edui-box edui-button edui-for-date edui-default"><div id="edui127_state" onMouseDown="$EDITORUI[&quot;edui127&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui127&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui127&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui127&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui127_body" unselectable="on" title="日期" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui127&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui127&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui128" class="edui-box edui-button edui-for-time edui-default"><div id="edui128_state" onMouseDown="$EDITORUI[&quot;edui128&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui128&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui128&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui128&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui128_body" unselectable="on" title="时间" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui128&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui128&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui131" class="edui-box edui-button edui-for-spechars edui-default"><div id="edui131_state" onMouseDown="$EDITORUI[&quot;edui131&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui131&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui131&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui131&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui131_body" unselectable="on" title="特殊字符" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui131&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui131&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui134" class="edui-box edui-button edui-for-searchreplace edui-default"><div id="edui134_state" onMouseDown="$EDITORUI[&quot;edui134&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui134&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui134&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui134&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui134_body" unselectable="on" title="查询替换" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui134&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui134&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui139" class="edui-box edui-button edui-for-link edui-default"><div id="edui139_state" onMouseDown="$EDITORUI[&quot;edui139&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui139&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui139&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui139&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui139_body" unselectable="on" title="超链接" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui139&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui139&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div><div id="edui140" class="edui-box edui-button edui-for-unlink edui-default"><div id="edui140_state" onMouseDown="$EDITORUI[&quot;edui140&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui140&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui140&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui140&quot;].Stateful_onMouseOut(event, this);" class="edui-default edui-state-disabled"><div class="edui-button-wrap edui-default"><div id="edui140_body" unselectable="on" title="取消链接" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui140&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui140&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui141" class="edui-box edui-button edui-for-drafts edui-default"><div id="edui141_state" onMouseDown="$EDITORUI[&quot;edui141&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui141&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui141&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui141&quot;].Stateful_onMouseOut(event, this);" class="edui-default edui-state-disabled"><div class="edui-button-wrap edui-default"><div id="edui141_body" unselectable="on" title="从草稿箱加载" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui141&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui141&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui142" class="edui-box edui-splitbutton edui-for-inserttable edui-default"><div title="插入表格" id="edui142_state" onMouseDown="$EDITORUI[&quot;edui142&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui142&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui142&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui142&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-splitbutton-body edui-default"><div id="edui142_button_body" class="edui-box edui-button-body edui-default" onClick="$EDITORUI[&quot;edui142&quot;]._onButtonClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div><div class="edui-box edui-splitborder edui-default"></div><div class="edui-box edui-arrow edui-default" onClick="$EDITORUI[&quot;edui142&quot;]._onArrowClick();"></div></div></div></div><div id="edui145" class="edui-box edui-button edui-for-horizontal edui-default"><div id="edui145_state" onMouseDown="$EDITORUI[&quot;edui145&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui145&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui145&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui145&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui145_body" unselectable="on" title="分隔线" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui145&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui145&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div></div></div></div></div><div id="edui150" class="edui-box edui-button edui-for-music edui-default"><div id="edui150_state" onMouseDown="$EDITORUI[&quot;edui150&quot;].Stateful_onMouseDown(event, this);" onMouseUp="$EDITORUI[&quot;edui150&quot;].Stateful_onMouseUp(event, this);" onMouseOver="$EDITORUI[&quot;edui150&quot;].Stateful_onMouseOver(event, this);" onMouseOut="$EDITORUI[&quot;edui150&quot;].Stateful_onMouseOut(event, this);" class="edui-default"><div class="edui-button-wrap edui-default"><div id="edui150_body" unselectable="on" title="制作二维码图片" class="edui-button-body edui-default" onMouseDown="return $EDITORUI[&quot;edui150&quot;]._onMouseDown(event, this);" onClick="return $EDITORUI[&quot;edui150&quot;]._onClick(event, this);"><div class="edui-box edui-icon edui-default"></div><div class="edui-box edui-label edui-default"></div></div></div></div></div></div><div id="edui152" class="edui-toolbar   edui-default" onselectstart="return false;" onMouseDown="return $EDITORUI[&quot;edui152&quot;]._onMouseDown(event, this);" style="-webkit-user-select: none;"></div></div></div><div id="edui12_toolbarmsg" class="edui-editor-toolbarmsg edui-default" style="display:none;"><div id="edui12_upload_dialog" class="edui-editor-toolbarmsg-upload edui-default" onClick="$EDITORUI[&quot;edui12&quot;].showWordImageDialog();">点击上传</div><div class="edui-editor-toolbarmsg-close edui-default" onClick="$EDITORUI[&quot;edui12&quot;].hideToolbarMsg();">x</div><div id="edui12_toolbarmsg_label" class="edui-editor-toolbarmsg-label edui-default"></div><div style="height:0;overflow:hidden;clear:both;" class="edui-default"></div></div><div id="edui12_message_holder" class="edui-editor-messageholder edui-default" style="top: 84px; z-index: 1;"></div></div><div id="edui12_iframeholder" class="edui-editor-iframeholder edui-default" style="width: 498px; height: 264px; z-index: 0; overflow: hidden;"><iframe id="ueditor_0" width="100%" height="100%" frameborder="0" src="javascript:void(function(){document.open();document.write(&quot;<!DOCTYPE html><html xmlns='http://www.w3.org/1999/xhtml' class='view' ><head><style type='text/css'>.view{padding:0;word-wrap:break-word;cursor:text;height:90%;}
body{margin:8px;font-family:sans-serif;font-size:16px;}p{margin:5px 0;}</style><link rel='stylesheet' type='text/css' href='style/css/iframe.css'/><style>*{font-family:微软雅黑;}p{line-height:1.6em;font-size:14px;}</style></head><body class='view' ></body><script type='text/javascript'  id='_initialScript'>setTimeout(function(){editor = window.parent.UE.instants['ueditorInstant0'];editor._setup(document);},0);var _tmpScript = document.getElementById('_initialScript');_tmpScript.parentNode.removeChild(_tmpScript);</script></html>&quot;);document.close();}())"></iframe></div><div id="edui12_bottombar" class="edui-editor-bottomContainer edui-default"><table class="edui-default"><tbody class="edui-default"><tr class="edui-default"><td id="edui12_elementpath" class="edui-editor-bottombar edui-default" style="display: none;"></td><td id="edui12_wordcount" class="edui-editor-wordcount edui-default" style="display: none;"></td><td id="edui12_scale" class="edui-editor-scale edui-default" style="display: none;"><div class="edui-editor-icon edui-default"></div></td></tr></tbody></table></div><div id="edui12_scalelayer" class="edui-default"></div></div></div>
 <div class="menu">
       <div class="loginbox"><a href="/admin/login.html" target="_blank">登录</a></div><div id="html-see" data-toggle="modal" data-target="#myModalsee" title="模拟预览">预览</div> <div class="copy-editor-html" title="复制内容">复制</div>        <div id="tongbu" data-toggle="modal" data-target="#tongbumodal" title="同步到微信公众平台">同步</div>
        <div class="clear-editor" title="清空编辑器内容">清空</div>  
        <div id="kefu"><a href="http://www.sogua2008.com" target="_blank" title="编辑器使用帮助">帮助</a></div>
		<div id="caiji" title="采集微信文章内容">采集</div>  
      </div>
</div><!--editor2 end-->

        </div>
      </div>
    </div><!--box end-->
  </div>


<section id="color-plan" style="width:100px;position:fixed;top:128px;right:-5px;height:320px;text-align: center;">
	<div class="panel panel-primary" style="border:0 none;background: transparent;">
	<ul class="nav nav-tabs" role="tablist" id="right-fix-tab">
	  <li role="presentation"><a data-toggle="#color-choosen" href="#color-choosen" aria-controls="home">配色图</a></li>
	  <li role="presentation"><a href="#features" data-toggle="#features" aria-controls="features">魔法棒</a></li>
	</ul>
<div class="tab-content" style="position:absolute;right:32px;padding: 10px 0px !important;width:100px;padding:0;background:rgba(58,51,50,0.5);">
		<div id="features" role="tabpanel" class="tab-pane" style="text-align: left;padding-left:5px;">
			<small id="more-popover-content" style="font-size:12px;">
			<button class="btn btn-default btn-xs" id="set-image-radius"> 图片圆形  </button>
			<button class="btn btn-default btn-xs" id="flat-add-radius"> 加圆角</button>
			<button class="btn btn-default btn-xs" id="flat-strip-radius"> 去圆角</button>
			<button class="btn btn-default btn-xs" id="set-image-border"> 图片边框 </button>
			<button class="btn btn-default btn-xs" id="flat-add-border"> 加边框</button>
			<button class="btn btn-default btn-xs" id="flat-strip-border"> 去边框</button>
			<button class="btn btn-default btn-xs" id="flat-strip-shadow"> 去阴影 </button>
			<button class="btn btn-default btn-xs" id="flat-add-shadow"> 加阴影 </button>
			<button class="btn btn-default btn-xs" id="v3-random-color">随机换色</button>
			<button class="btn btn-default btn-xs" id="v3-random-transform">随机倾斜</button>
			</small>
		</div>
<div role="tabpanel" class="tab-pane active" id="color-choosen">
	 <div class="xiuxiu" style="background:rgba(58,51,50,0.5);border:0 none;color:#fff;"> <a href="#" target="_blank" title="">◢ 快捷面板 ◣</a></div>
	  <div class="panel-body" style="padding:0;background:rgba(58,51,50,0.5);width:100px;">
	  	 <div style="margin:5px 15px;color:#FFF;line-height:32px;text-align: center;position:relative;">
        <input id="custom-color-text" class="colorPicker form-control" style="font-size: 12px; width: 80px; color: rgb(34, 34, 34); padding: 4px 8px; height: 24px; line-height: 16px; background-color: rgb(239, 112, 96);" value="#EF7060">
        </div>
        
        <div style="margin:0 0;color:#dad9d8;line-height:32px;text-align: center;"><label style="cursor:pointer;"><input style="margin-top:8px;" type="checkbox" id="replace-color-all" value="1"> 全文换色</label></div>
	 	<ul id="favor-colors" class="clearfix" style="list-style:none;padding:0 10px 0px;margin:0 0;">
	 		 	</ul>
	 	<hr style="margin:2px 20px;border-color:#ddd;">
	    <ul class="clearfix" style="list-style:none;padding:0 10px 10px;margin:0 0;">
            <li class="color-swatch" style="background-color: #ac1d10"></li>
            <li class="color-swatch" style="background-color: #d82821;"></li>
            <li class="color-swatch active" style="background-color: #ef7060;"></li>
            <li class="color-swatch" style="background-color: #fde2d8;"></li>
            <li class="color-swatch" style="background-color: #d32a63;"></li>
            <li class="color-swatch" style="background-color: #eb6794;"></li>
            <li class="color-swatch" style="background-color: #f5bdd1;"></li>            
            <li class="color-swatch" style="background-color: #ffebf0;"></li>
            <li class="color-swatch" style="clear:left;background-color: #e2561b;"></li>
            <li class="color-swatch" style="background-color: #ff8124;"></li>
            <li class="color-swatch" style="background-color: #fcb42b;"></li>
            <li class="color-swatch" style="background-color: #feecaf;"></li>
            <li class="color-swatch" style="clear:left;background-color: #0c8918;"></li>
            <li class="color-swatch" style="background-color: #80b135;"></li>
            <li class="color-swatch" style="background-color:#c2c92a;"></li>
            <li class="color-swatch" style="background-color:#e5f3d0;"></li>
             <li class="color-swatch" style="clear:left;background-color: #1f877a;"></li>
            <li class="color-swatch" style="background-color: #27abc1;"></li>
            <li class="color-swatch" style="background-color: #5acfe1;"></li>
            <li class="color-swatch" style="background-color: #b6f2ea;"></li> 
            <li class="color-swatch" style="clear:left;background-color:#374aae;"></li>
            <li class="color-swatch" style="background-color:#1e9be8;"></li>
            <li class="color-swatch" style="background-color:#59c3f9;"></li>
            <li class="color-swatch" style="background-color:#b6e4fd;"></li>
            <li class="color-swatch" style="clear:left;background-color:#5b39b4;"></li>
            <li class="color-swatch" style="background-color: #4c6ff3;"></li>
            <li class="color-swatch" style="background-color:#91a8fc;"></li>
            <li class="color-swatch" style="background-color:#d0dafe;"></li>
            
            <!-- 紫色 -->
            <li class="color-swatch" style="clear:left;background-color:#8d4bbb;"></li>
            <li class="color-swatch" style="background-color: rgb(166, 91, 203);"></li>
            <li class="color-swatch" style="background-color:#cca4e3;"></li>
            <li class="color-swatch" style="background-color: rgb(190, 119, 99);"></li>
            
            <li class="color-swatch" data-color="#efefef" style="clear:left;background-color:#3c2822;"></li>
            <li class="color-swatch" style="background-color:#6b4d40;"></li>
            <li class="color-swatch" style="background-color:#9f887f;"></li>
            <li class="color-swatch" style="background-color:#d7ccc8;"></li>
            
        	<li class="color-swatch" style="background-color: #212122;"></li>
        	<li class="color-swatch" style="background-color: #757576;"></li>
        	<li class="color-swatch" style="background-color: #c6c6c7"></li>
        	<li class="color-swatch" style="background-color: #f5f5f4"></li>
        	
        </ul>
		<ul><!-- qq --></ul>
        </div>
	</div> 
        </div>
	</div>        
</section>
<!--导航start-->
<section id="color-plan" style="width:120px;position:fixed;top:128px;left:-5px;height:100px;text-align: center;z-index:9999;">
	<div class="panel panel-primary" style="border:0 none;background: transparent;">
	  <div class="panel-body" style="padding:0;background:rgba(0,0,0,0);">
	    <ul><li style="color:#FFFFFF;"><img src="images/2015.png"></li></ul>
		<ul><li class="xiuxiu" style="color:#FFFFFF;"><a href="http://www.sogua2008.com" target="_ablank" title="有问题就看这儿，2010编辑器新手导航">新手导航</a></li></ul>
        </div>
	</div>        
</section>
<!--新手导航end-->
 <!--预览框  -->  
<!-- Modal -->
 <!-- sample modal content -->
  <div id="myModal" class="modal fade" tabindex="9999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="exampleModalLabel">保存编辑内容</h4>
           <div><em style="color:#8c8c8c;font-style:normal;font-size:12px;">2015-08-10</em> <a style="font-size:12px;color:#607fa6" href="javascript:void(0);" id="post-user"></a> </div>
        </div>
        <div class="modal-body">
       <form id="form1" action="user/savemoban.php" method="post">  
	        <div class="input-group" style="margin-top:10px;">
             <span class="input-group-addon" id="basic-addon1">标题:</span>
            <input type="text" class="form-control" id="wxtitle" name="wxtitle" placeholder="标题（必填）"><input name="wxhname" type="hidden" value=""></div>
			<div class="input-group" style="margin-top:10px;">
             <span class="input-group-addon" id="basic-addon1">描述</span>
			 <textarea class="form-control" rows="2" id="wxstr" name="wxstr" placeholder="指定分享描述（选填）"></textarea></div>
			<div class="input-group" style="margin-top:10px;">
             <span class="input-group-addon" id="basic-addon1">图片URL</span>
            <input type="text" class="form-control" id="wximgurl" name="wximgurl" placeholder="指定分享图标（选填）"></div>
			<div class="form-group">
            <label for="message-text" class="control-label">内容:</label>
             <div style="border:1px solid #ccc;padding:20px;">
             <div id="preview" style="height:200px;overflow-y:scroll;"><p style="border-width: 0px;"><br></p><section data-id="685" class="v3editor"><p style="border-width: 0px;">&nbsp; &nbsp;<img src="https://mmbiz.qlogo.cn/mmbiz/z9433rAGTDfiaaFED4iaX8CS6OIzViaEWFdYHqxw1jAtyo5296wzicjyFWsricb7jd6uRbdNdTZOFcIqveC0ISpbClg/0?wx_fmt=gif" style="border-radius: 4px; max-width: 100%; padding: 4px; border-width: 0px; background-color: rgb(255, 255, 255);"></p></section><p style="border-width: 0px;"><br></p><section data-id="720" class="v3editor"><section style="max-width: 100%; white-space: normal; margin: 1em auto; padding: 1em 2em; box-sizing: border-box !important; word-wrap: break-word !important; border-width: 0px;"><span style="max-width: 100%; float: left; margin-left: -7px; margin-top: 15px; display: block; box-sizing: border-box !important; word-wrap: break-word !important; border-width: 0px;"><section class="color" style="max-width: 100%; min-height: 33px; color: rgb(255, 255, 255); text-align: center; line-height: 1.5; font-size: 15px; margin-right: 10px; padding: 5px 8px; min-width: 75px; border-width: 0px; box-sizing: border-box !important; word-wrap: break-word !important; background: rgb(255, 29, 107);">今日话题</section><img style="display: block; border-radius: 4px; max-width: 100%; padding: 4px; border-width: 0px; width: 7px !important; box-sizing: border-box !important; word-wrap: break-word !important; visibility: visible !important; height: auto !important; background-color: rgb(255, 255, 255);" class="" data-type="gif" data-ratio="0.8571428571428571" data-w="7" _width="7px" src="https://mmbiz.qlogo.cn/mmbiz/SlzGSgJicOCyyFCCia7KrgN9uruqH8dB461o9ZgmIVbOdRSicIpLRPBuciaGl0YKedcIfpXGI9TEia3a14TFWdLNrgQ/0?wx_fmt=gif&amp;tp=webp&amp;wxfrom=5&amp;wx_lazy=1" data-width="7px"></span><section class="v3brush" style="max-width: 100%; padding: 16px; width: 560px; font-size: 14px; line-height: 1.4; border-width: 0px; box-sizing: border-box !important; word-wrap: break-word !important;" data-width="560px">一天一个鸡蛋，不仅能提高记忆力，还能保护视力，帮助减肥。但有些人对鸡蛋心有疑虑，怕每天吃升高血脂。殊不知，早餐吃个鸡蛋，可是有诸多好处。在营养学界，鸡蛋一直有“全营养食品”的美称，杂志甚至为鸡蛋戴上了“世界上最营养早餐”的殊荣。</section></section></section><p style="border-width: 0px;"><br></p><section data-id="716" class="v3editor"><fieldset style="padding: 16px; line-height: 1.4; margin-top: 10px; max-width: 100%; white-space: normal; border-width: 0px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(244, 244, 244);" id="shifu_c_008" class="wxqq-borderTopColor wxqq-borderLeftColor wxqq-borderRightColor wxqq-borderBottomColor;" label="Copyright (c) 2014 99vu.com All Rights Reserved."><section class="v3brush" style="color: inherit; border-width: 0px;">图文排版是设计的基本功，但经常有同学不知道如何处理图片与字体的搭配。正所谓“无规矩不成方圆”，图文排版也需要遵循一定的法则。今天就给同学们扒一扒图文排版10个技巧，让你的设计瞬间高逼格！</section></fieldset></section><p style="border-width: 0px;"><br></p></div>
			 <textarea id="savecontent" name="savecontent" style="display:none"></textarea>
          </div></div>
			
     </form>
  
        </div>
        <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<?php

mysql_query("set names 'utf8'");

$res=mysql_query("select * from wechat where id= 1" ,$link);
$myhaoma = mysql_fetch_array($res);


?>




<!--tongbuweixin_start-->
<div id="tongbumodal" class="modal fade" tabindex="9999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="exampleModalLabel">同步图文内容到微信公众平台</h4>
                <div><em style="color:#ff0000;font-style:normal;font-size:12px;">同步前请确认在后台管理--接口设置---微信同步设置帐号。<a href="admin/login.html" target="_blank">进入</a></em> </div>
            </div>
            <div class="modal-body">
                <form id="form4" action="admin/tbmsg.php?do=tongbu" enctype="multipart/form-data" method="post">

                    <div class="input-group" style="margin-top:10px;">
                        <span class="input-group-addon" id="basic-addon1">标题:</span>
                        <input type="text" class="form-control" id="title" name="title[]">
                    </div>


                    <div class="input-group" style="margin-top:10px;">
                        <span class="input-group-addon" id="basic-addon1">作者:</span>
                        <input type="text" class="form-control" id="author" name="author[]">
                    </div>


                    <div class="input-group" style="margin-top:10px;">
                        <span class="input-group-addon" id="basic-addon1">描述</span>
                        <textarea class="form-control" rows="2" id="digest" name="digest[]"  placeholder="指定分享描述（选填）"></textarea>
                    </div>

                  <!--  <div class="input-group" style="margin-top:10px;">
                        <span class="input-group-addon" id="basic-addon1">导航图片</span>
                        <input name="thumb[]" type="text" id="thumb" value="http://img0.bdstatic.com/img/image/sy1204.jpg" size="86" />
                    </div> -->

                    <div class="input-group" style="margin-top:10px;">
                        <span class="input-group-addon" id="basic-addon1">原文链接</span>
                        <input type="text" class="form-control" id="type" name="link[]" placeholder="原文跳转（选填）">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="control-label">内容:</label>
                        <div style="border:1px solid #ccc;padding:20px;">
                            <div id="tbpreview" style="height:120px;overflow-y:scroll;"></div>

                            <textarea style="display:none" id="tbtb" name="content[]"></textarea>

                        </div>

                    </div>


                    <div class="input-group" style="margin-top:10px;">
                        <span class="input-group-addon" id="basic-addon1">同步账号</span>
                        <select name="tbzhselect" id="tbzhselect" class="form-control">
                            <option value="" selected="selected"><?php echo $myhaoma[1];?></option>
                        </select></div>
                </form>

            </div>
            <div class="modal-footer">
              <!--  <button type="button" class="btn btn-success" id="tbsc" >同步素材</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>        </div>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>


    $("#tbsc").click(function(){

        $("#form4").submit();

    });




</script>

<!--tongbuweiwin_end-->
<!--userlogin-->


<!--e-userlogin-->
<!--userlogin-->
<div class="modal fade" id="userregModal" tabindex="999" role="dialog" aria-labelledby="mySmallModalLabel" data-keyboard="false" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a2d3">
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
        <h4 class="modal-title" id="userregModalLabel" style="color:#FFF;">用户注册</h4>
      </div>
      <div class="modal-body">
       <form id="form3" action="user/user_reg.php?do=reguser" method="post"> 
          <div class="form-group">
            <label for="message-text" class="control-label">用户名：</label>
            <input type="text" class="form-control" id="regusername" name="regusername" placeholder="字母、数字或者英文符号，最短6位">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">密 码：</label>
            <input type="password" class="form-control" id="regpassword" name="regpassword" placeholder="设置一个密码，可输入字母数字">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">邮箱：</label>
            <input type="email" class="form-control" id="reguseremail" name="reguseremail" placeholder="推荐@qq.com邮箱，用于激活账号，找回密码">
          </div>
          <div class="form-group">
             
                <div class="checkbox">
                <label><input id="yres" name="yres" type="checkbox" value="1"> 我遵守互联网法规及中国法律，否则永久删除帐号。</label>
               </div>
                <div style="text-align:right"><a href="user/forget.html" target="_alank">忘记密码</a></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="background:#f7f7f7">
        <button type="button" id="closereg" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" id="myreguser" class="btn btn-success">注册</button>
      </div>
    </div>
  </div>
</div>
<!--caijistart-->
<div class="modal fade" id="weixincaiji" tabindex="999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">微信文章内容采集</h4>
      </div>
      <div class="modal-body">
	  <form id="form5" action="caiji.php?do=add" method="post"> 
			<div class="form-group">
				<label for="exampleInputEmail1">请输入要采集的微信文章网址（Ctrl+V 粘贴）：</label>
				<input type="text" class="form-control" id="caijiurl" name="caijiurl" placeholder="输入网址">
			</div>
	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

      </div>
    </div>
  </div>
</div>
 <!-- endcaiji -->
<!--adstart-->
<div class="modal fade" id="myad" tabindex="999" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">搜刮好东西微信编辑器</h4>
      </div>
      <div class="modal-body">
	  <p>　　大家好，您现在访问的是搜刮好东西微信编辑器，该版本更新了首页布局，编辑器内容一键清空、一键复制、一键预览功能，添加了一些最新流行的新样式，颜色选择器可以对一部分文本样式进行调整颜色等。</p>
	  <p>　　用户登录之后在前台可以直接保存编辑内容到后台数据库中，以备查看，修改，删除、同步微信公众平台等管理。如果您配置了微信公众平台开发者的appid,appsecret参数，你可以作为微信第三方发布平台，手机微信二维码扫描，预览编排好的文章，并可直接分享朋友或朋友圈。</p>

	  <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="paragraph-setting" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" style="width:600px;margin-top:20px;">
    <div class="modal-content">
      <div class="modal-header" style="border:0 none">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
        <h4 class="modal-title">段落设置</h4>
      </div>
     <div class="modal-body" style="overflow: hidden;padding: 0;margin: 10px;">
     	<form class="form-horizontal">
     	<div>
     		<div class="col-xs-6">
     			<div class="form-group">
					<label class="col-sm-5 control-label">行高</label>
					<div class="col-sm-7 controls">
						<input class="form-control" value="1.5em" id="paragraph-lineHeight" type="text">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-5 control-label">字体</label>
					<div class="col-sm-7 controls">
						<select class="form-control" id="paragraph-fontFamily">
						<option value="微软雅黑">微软雅黑</option>
							<option value="宋体">宋体</option>
							<option value="楷体">楷体</option>
							<option value="黑体">黑体</option>
							<option value="隶书,SimLi">隶书</option>
							<option value="arial">arial</option>
							<option value="sans-serif">sans-serif</option>
						</select>
					</div>
				</div>
				 <div class="form-group">
					<label class="col-sm-5 control-label">字号</label>
					<div class="col-sm-7 controls">
						<input class="form-control" placeholder="字号" value="14px" id="paragraph-fontSize" type="text">
					</div>
				</div>
     		</div>
     		<div class="col-xs-6">
     			<div class="form-group">
					<label class="col-sm-5 control-label">首行缩进</label>
					<div class="col-sm-7 controls">
						<input class="form-control" id="paragraph-textIndent" value="2em" type="text">
					</div>
				</div>
     			<div class="form-group">
					<label class="col-sm-5 control-label">段前距</label>
					<div class="col-sm-7 controls">
						<input class="form-control" id="paragraph-paddingTop" value="5px" type="text">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-5 control-label">段后距</label>
					<div class="col-sm-7 controls">
						<input class="form-control" id="paragraph-paddingBottom" value="5px" type="text">
					</div>
				</div>
     		</div>
     	</div>
     		
			
     	</form>
     </div>
     <div class="modal-footer text-right">
     	<button type="button" onClick="applyParagraph('active');" class="btn btn-primary" data-dismiss="modal">应用本样式</button>
     	<button type="button" onClick="applyParagraph('all');" class="btn btn-warning" data-dismiss="modal">应用全文</button>
     	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
     </div>
    </div>
    </div>
</div>

 <!-- sample modal content -->
  <div id="myModalsee" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
  <h4 class="modal-title" id="myModalLabel">预览（提示：如文章太长，请按下鼠标滚轮，上下拉动预览）</h4>
  <div><em style="color:#8c8c8c;font-style:normal;font-size:12px;">2015-08-10</em> <a style="font-size:12px;color:#607fa6" href="javascript:void(0);" id="post-user"></a> </div>
        </div>
        <div class="modal-body">
		 <div class="form-group">
             <div style="border:0px solid #ccc;padding:20px;">
             <div id="previews"><p style="border-width: 0px;"><br></p><section data-id="685" class="v3editor"><p style="border-width: 0px;">&nbsp; &nbsp;<img src="https://mmbiz.qlogo.cn/mmbiz/z9433rAGTDfiaaFED4iaX8CS6OIzViaEWFdYHqxw1jAtyo5296wzicjyFWsricb7jd6uRbdNdTZOFcIqveC0ISpbClg/0?wx_fmt=gif" style="border-radius: 4px; max-width: 100%; padding: 4px; border-width: 0px; background-color: rgb(255, 255, 255);"></p></section><p style="border-width: 0px;"><br></p><section data-id="720" class="v3editor"><section style="max-width: 100%; white-space: normal; margin: 1em auto; padding: 1em 2em; box-sizing: border-box !important; word-wrap: break-word !important; border-width: 0px;"><span style="max-width: 100%; float: left; margin-left: -7px; margin-top: 15px; display: block; box-sizing: border-box !important; word-wrap: break-word !important; border-width: 0px;"><section class="color" style="max-width: 100%; min-height: 33px; color: rgb(255, 255, 255); text-align: center; line-height: 1.5; font-size: 15px; margin-right: 10px; padding: 5px 8px; min-width: 75px; border-width: 0px; box-sizing: border-box !important; word-wrap: break-word !important; background: rgb(255, 29, 107);">今日话题</section><img style="display: block; border-radius: 4px; max-width: 100%; padding: 4px; border-width: 0px; width: 7px !important; box-sizing: border-box !important; word-wrap: break-word !important; visibility: visible !important; height: auto !important; background-color: rgb(255, 255, 255);" class="" data-type="gif" data-ratio="0.8571428571428571" data-w="7" _width="7px" src="https://mmbiz.qlogo.cn/mmbiz/SlzGSgJicOCyyFCCia7KrgN9uruqH8dB461o9ZgmIVbOdRSicIpLRPBuciaGl0YKedcIfpXGI9TEia3a14TFWdLNrgQ/0?wx_fmt=gif&amp;tp=webp&amp;wxfrom=5&amp;wx_lazy=1" data-width="7px"></span><section class="v3brush" style="max-width: 100%; padding: 16px; width: 560px; font-size: 14px; line-height: 1.4; border-width: 0px; box-sizing: border-box !important; word-wrap: break-word !important;" data-width="560px">一天一个鸡蛋，不仅能提高记忆力，还能保护视力，帮助减肥。但有些人对鸡蛋心有疑虑，怕每天吃升高血脂。殊不知，早餐吃个鸡蛋，可是有诸多好处。在营养学界，鸡蛋一直有“全营养食品”的美称，杂志甚至为鸡蛋戴上了“世界上最营养早餐”的殊荣。</section></section></section><p style="border-width: 0px;"><br></p><section data-id="716" class="v3editor"><fieldset style="padding: 16px; line-height: 1.4; margin-top: 10px; max-width: 100%; white-space: normal; border-width: 0px; box-sizing: border-box !important; word-wrap: break-word !important; background-color: rgb(244, 244, 244);" id="shifu_c_008" class="wxqq-borderTopColor wxqq-borderLeftColor wxqq-borderRightColor wxqq-borderBottomColor;" label="Copyright (c) 2014 99vu.com All Rights Reserved."><section class="v3brush" style="color: inherit; border-width: 0px;">图文排版是设计的基本功，但经常有同学不知道如何处理图片与字体的搭配。正所谓“无规矩不成方圆”，图文排版也需要遵循一定的法则。今天就给同学们扒一扒图文排版10个技巧，让你的设计瞬间高逼格！</section></fieldset></section><p style="border-width: 0px;"><br></p></div>
             </div>
         </div>
        </div>
        <div class="modal-footer">
		 <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<!--adend-->
<script type="text/javascript" src="ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="ueditor/ueditor.all.min.js"></script>
<script src="style/js/gjs02.js" type="text/javascript"></script>
<script src="style/js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="style/css/jquery.Jcrop.css" type="text/css">

   	<!--[if lt IE 9]>
          <script src="style/js/html6.js"></script>
 	  <![endif]-->
<script src="style/js/gjs01.js" type="text/javascript"></script>
<script type="text/javascript" src="style/js/less-1.7.0.min.js"></script>
<script type="text/javascript" src="style/js/ZeroClipboard.min.js"></script>
<script>
 //$('#myad').modal('show');
 $('#loginModal').modal('show');</script>
<script type="text/javascript" src="style/js/instoo.js"></script><div id="global-zeroclipboard-html-bridge" class="global-zeroclipboard-container" style="position: absolute; left: 0px; top: -9999px; width: 1px; height: 1px; z-index: 999999999;"><object id="global-zeroclipboard-flash-bridge" name="global-zeroclipboard-flash-bridge" width="100%" height="100%" type="application/x-shockwave-flash" data="js/ueditor/third-party/zeroclipboard/ZeroClipboard.swf?noCache=1439172085753"><param name="allowScriptAccess" value="sameDomain"><param name="allowNetworking" value="all"><param name="menu" value="false"><param name="wmode" value="transparent"><param name="flashvars" value="trustedOrigins=guoyoo.99vu.com%2C%2F%2Fguoyoo.99vu.com%2Chttp%3A%2F%2Fguoyoo.99vu.com&amp;swfObjectId=global-zeroclipboard-flash-bridge&amp;jsVersion=2.2.0"><div id="global-zeroclipboard-flash-bridge_fallbackContent">&nbsp;</div></object></div>

<div id="success" style="display:none;">
		<div>复制成功</div>
</div>
 <div id="tbsuccess" style="display:none;">
		<div>正在同步微信公众平台，请等待......</div>
</div>
<div id="zeroClipBoard-helper" class="hidden"></div>
 <img src="style/images/bg4.jpg" style="position:fixed;top:0px;left:0px;z-index:-1;height:100%;width:100%;border:0;">

<a href="#" id="toTop" style="display: none;"><span id="toTopHover"></span>To Top</a>





</body></html>