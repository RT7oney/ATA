<?php

require_once __DIR__ . '/../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
|载入环境变量文件
|--------------------------------------------------------------------------
*/
Dotenv::load(__DIR__ . '/../');

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

global $app;


$app = new Core\Services\App(
    realpath(__DIR__ . '/../')
);


/*
|--------------------------------------------------------------------------
| Register Facades
|--------------------------------------------------------------------------
*/
$app->withFacades();


/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Core\Exceptions\Handler::class
);


$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Core\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $app->middleware([
//     // Illuminate\Cookie\Middleware\EncryptCookies::class,
//     // Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
//     // Illuminate\Session\Middleware\StartSession::class,
//     // Illuminate\View\Middleware\ShareErrorsFromSession::class,
//     // Laravel\Lumen\Http\Middleware\VerifyCsrfToken::class,
//     // App\Http\Middleware\AuthMiddleware::class,
// ]);


$app->routeMiddleware([
    'access' => Core\Middleware\Access::class,
    'auth' => Core\Middleware\Authenticate::class,
]);


/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

//$app->register(Core\Providers\AppServiceProvider::class);
$app->register(Core\Providers\EventServiceProvider::class);
$app->register(Core\Providers\StatusServiceProvider::class);
$app->register(Core\Providers\ContextServiceProvider::class);
$app->register(Core\Providers\RequestServiceProvider::class);

/*
|--------------------------------------------------------------------------
| 载入系统核心插件
|--------------------------------------------------------------------------
| 接下来会遍历模块(modules)目录, 注册模块路径到应用实例中, 在模块中可以自由定制路由配置,
| 每一个模块拥有自己的视图, 配置文件,本地化文件和数据库迁移能力。
*/

load_core($app);

/*
|--------------------------------------------------------------------------
| 载入系统插件
|--------------------------------------------------------------------------
| 系统插件中可以通过钩子(Hook)回调函数的方式用以扩展和补充系统的功能。
|
*/

load_plugins($app);



return $app;