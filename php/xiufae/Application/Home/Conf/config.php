<?php
return array(
	// 预先加载的标签库
	'TAGLIB_BUILD_IN'       =>  'MyTag,Cx',
	
	'DATA_CACHE_PREFIX'    => 'lf_', // 缓存前缀
    'DATA_CACHE_TYPE'      => 'File', // 数据缓存类型
	
	/* SESSION 和 COOKIE 配置 */
    'SESSION_PREFIX' => 'lf_users', //session前缀
    'COOKIE_PREFIX'  => 'lf_users_', // Cookie前缀 避免冲突
	
	'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/static',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
		'__Player__' => __ROOT__ . '/Public/Player',
    ),
	'HTML_CACHE_ON'     =>    false, // 开启静态缓存 true false
	'HTML_CACHE_TIME'   =>    86400,
	'HTML_CACHE_RULES' =>
		array (
		'index:index' => '{:action}',
		'lists:index' => '{:module}_{:controller}/{$_SERVER.REQUEST_URI|md5}',
		'movie:index' => '{:module}_{:controller}/{id|md5}',
		'player:index' => '{:module}_{:controller}/{$_SERVER.REQUEST_URI|md5}',
		'news:index' => '{:module}_{:controller}/{id|md5}',
		'other:index' => '{:module}_{:controller}/{$_SERVER.REQUEST_URI|md5}',
		),
);