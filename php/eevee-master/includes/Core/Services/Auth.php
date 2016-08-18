<?php

namespace Core\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;


class Auth
{

    protected static function getCallClass()
    {

    }

    /**
     * 根据访客密钥获取访客ID
     *
     * @return string
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected static function getVisitorID()
    {

        if (!($visitor_id = DB::table('user_token')->where('app_id', APP_ID)->where('user_token', USER_TOKEN)->value('user_id'))) {

            exception('UserTokenIsInvalid');
        }

        return $visitor_id;
    }

    /**
     * 获取访客对象
     *
     * @return object
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected static function getVisitor()
    {
        if (!($visitor = DB::table('user')->where('id', self::getVisitorID())->first())) {

            exception('UserTokenIsInvalid');
        }

        return $visitor;
    }

    /**
     * 加密用户密钥
     *
     * @param $user_id
     * @param $user_password
     *
     * @return mixed
     */
    public static function encryptUserToken($user_id, $user_password)
    {
        return sha1($user_id . $user_password . time());
    }

    /**
     * 获取访客对象
     *
     * @return object
     *
     * @throws \Core\Exceptions\StatusException
     */
    public static function visitor()
    {
        if (!USER_TOKEN) {

            exception('UserTokenIsInvalid');
        }

        $visitor = self::getVisitor();

        unset($visitor->password);

        return $visitor;
    }

    /**
     * 验证接口权限
     *
     * @param string $action 操作动作
     * @param array $data    校验数据
     * @param null $callback 回调函数
     *
     * @throws \Core\Exceptions\StatusException
     */
    public static function can($action, $data = [], $callback = null)
    {

//        exception('PermissionDenied');
    }


}