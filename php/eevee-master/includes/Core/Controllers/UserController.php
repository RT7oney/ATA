<?php

namespace Core\Controllers;

use Core\Models\User;
use Core\Services\Auth;
use Core\Services\Context;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // 用户正常状态
    const user_status_common = 'common';

    // 用户禁用状态
    const user_status_forbidden = 'forbidden';

    // 用户默认头像
    const user_default_avatar = '/images/avatar.png';

    // 用户默认角色
    const user_default_role = 'guest';

    // 用户默认来源
    const user_default_source = 'admin';

    /**
     * 初始化用户
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function initializeUser(array $data)
    {
        $initialize = [
            'id' => $this->id(),
            'role' => self::user_default_role,
            'avatar' => self::user_default_avatar,
            'source' => self::user_default_source,
            'status' => self::user_status_common,
        ];

        return array_merge($initialize, $data);
    }

    /**
     * 验证用户
     *
     * @param array $data
     * @param array $ignore
     *
     * @throws \Core\Exceptions\StatusException
     */
    protected function validateUser(array $data, array $ignore = [])
    {

        $rule = [
            'id' => 'required|unique:user',
            'username' => 'required|unique:user',
            'email' => 'required|unique:user',
            'role' => 'required',
        ];

        $this->ignore($data, $ignore);

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {

            exception('ValidateFailed', $validator->errors());
        }

    }

    public function getTest(Context $context)
    {
//        Auth::can('get-user');
//
//        if ($user = User::find($context->param('id'))) {
//
//            return $context->status('success', $user);
//        }
//
//        exception('UserDoesNotExist');

        echo config('app.key');
        echo '<br>';
        echo config('core.app.key');
        echo '<br>';
        echo config('app.key');


//        return response(view('test'));
    }


    /**
     * 获取用户
     *
     * @param Context $context
     *
     * @return \Core\Services\Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function getUser(Context $context)
    {
        Auth::can('get-user');

        if ($user = User::find($context->param('id'))) {

            return $context->status('success', $user);
        }

        exception('UserDoesNotExist');
    }

    /**
     * 获取用户组
     *
     * @param Context $context
     *
     * @return \Core\Services\Status
     */
    public function getUsers(Context $context)
    {
        Auth::can('get-user');

        return $context->status('success', $this->selector('user', $context->params()));
    }

    /**
     * 添加用户
     *
     * @param Context $context
     *
     * @return \Core\Services\Status
     *
     * @throws \Core\Exceptions\StatusException
     */
    public function postUser(Context $context)
    {

        Auth::can('post_user');

        $data = $this->initializeUser($context->data());

        $this->validateUser($data);

        $data['password'] = User::encryptPassword($data['password']);

        if (User::create($data)) {

            return $context->status('success', User::find($data['id']));
        }

        exception('PostUserFailed');
    }

}