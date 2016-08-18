<?php

$app->get('/', function () use ($app) {
	return view('welcome');
});
$app->get('/test', function () {
	return "helo";
});

//$app->group(['middleware' => ['access', 'auth'], 'namespace' => 'Core\Controllers'], function ($app) {
//
//    $app->get('/api/user', 'UserController@getUser');
//    $app->get('/api/users', 'UserController@getUsers');
//    $app->post('/api/user', 'UserController@postUser');
//
//    // 用户登录
//    $app->post('/api/auth/login', 'AuthController@login');
//
//    // 获取个人信息
//    $app->get('/api/auth/profile', 'AuthController@profile');
//
//
//});

$app->group(['prefix' => 'backend', 'namespace' => 'Core\Controllers'], function ($app) {

	// 后台登录
	$app->get('/login', 'BackendController@getLogin');

	// 后台管理主界面
	$app->get('{name}', 'BackendController@getPlugin');

});

$app->group(['namespace' => 'Core\Controllers'], function ($app) {

	$app->get('/api/test', 'UserController@getTest');

});