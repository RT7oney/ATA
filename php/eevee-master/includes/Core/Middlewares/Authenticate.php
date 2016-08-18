<?php

/**
 * 权限验证中间件.
 *
 * 权限验证以4种接口请求方式(POST,GET,PUT,DELETE)为依托, 在中间件层面按照约定的规对接口的访问加上权限保护.
 *
 * 验证流程:
 *
 *     1. 获取 "X-App-ID" 请求头, 验证应用ID是否有效.
 *
 *
 * @author 古月(2016/03/11)
 */

namespace Core\Middleware;

use Closure;
use Core\Models\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class Authenticate
{

    // 请求对象
    protected $request;

    // 应用ID
    protected $app_id;

    // 应用版本
    protected $app_version;

    /**
     * 验证请求接口的X-APP-ID
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function auth()
    {

        $x_app_id = $this->request->header('X-App-ID');

        if (!$x_app_id || substr_count($x_app_id, ':') != 1) {

            exception('AppIDIsInvalid');
        }

        list($this->app_id, $this->app_version) = explode(':', $x_app_id);

        if (!$this->app_id || !DB::table('app')->where('id', $this->app_id)->first()) {

            exception('AppIDIsInvalid');
        }

        if (!$this->app_version || !DB::table('app_version')->where('app_id', $this->app_id)->where('version', $this->app_version)->where('status', 'active')->first()) {

            exception('AppIDIsInvalid');
        }


    }

    /**
     * 设置系统常量
     */
    protected function setConstants()
    {
        define('APP_ID', $this->app_id);

        define('APP_VERSION', $this->app_version);

        define('USER_TOKEN', $this->request->header('X-User-Token'));
    }


    /**
     * 权限验证中间件
     *
     * 如果权限验证成功，则返回接着调用下一中间
     * 如果失败，则会抛出 403 错误
     */
    public function handle($request, Closure $next)
    {
        $this->request = $request;

        $this->auth();

        $this->setConstants();

        return $next($this->request);

    }

}
