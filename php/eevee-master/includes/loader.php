<?php

/**
 * 载入插件
 *
 * @param string $app
 * @param string $name
 * @param string $path
 * @param bool $prefix
 *
 * @throws Exception
 */
function load_plugin(&$app, $name, $path, $prefix = true)
{
    $entry = $path . DIRECTORY_SEPARATOR . 'entry.php';

    if (file_exists($entry)) {

        if ($prefix) {

            $app->group(['prefix' => "api/$name"], function ($app) use ($entry, $app) {

                require $entry;

            });

        } else {

            $app->group(['prefix' => "api"], function ($app) use ($entry, $app) {

                require $entry;

            });

        }


    } else {

        throw  new Exception('Plugin entry file is not defined, where at ' . $entry);

    }

}

/**
 * 加载系统插件
 *
 * 解析插件目录下的 plugin.json 文件, 注册插件信息到系统中。
 *
 * @param Core\Services\App $app 应用实例
 *
 * @throws Exception
 */
function load_plugins(&$app)
{

    $dirs = list_dirs(base_path('/content/plugins'));


    foreach ($dirs as $dir) {

        $name = basename($dir);

        if ($name == 'core') {

            break;
        }

        load_plugin($app, $name, $dir, true);

    }

}


/**
 * 加载系统核心模块
 *
 * 为系统添加多模块机制, 为每一个模块注册路由配置、
 * 视图渲染、 配置文件、本地化和数据库迁移能力。
 *
 * @param $app Core\Services\App 应用实例
 *
 * @return void
 *
 */
function load_core(&$app)
{
    include base_path('includes/routes.php');

    load_plugin($app, 'core', base_path('content/plugins/core'), false);

}

