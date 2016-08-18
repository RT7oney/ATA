/**
 * 用户模型
 *
 * @author 胡桂华(gue@lehu.io)
 */

define([
        'app',
        'jquery',
        'ajax',
        'storage',
        'user.editor',
        'user.detail',
        'user.information'
    ],
    function (app, $) {

        app.factory('user', ['$compile', 'ajax', 'storage', function ($compile, ajax, storage) {

            return {
                /**
                 * 配置用户编辑器
                 *
                 * @param $scope
                 */
                setUserEditor: function ($scope) {
                    $('#eevee-view').append($compile($('<div user.editor></div>'))($scope));
                },
                /**
                 * 配置用户详情弹窗
                 *
                 * @param $scope
                 */
                setUserDetail: function ($scope) {
                    $('#eevee-view').append($compile($('<div user.detail></div>'))($scope));
                },
                /**
                 * 配置用户详情弹窗
                 *
                 * @param $scope
                 */
                setUserInformation: function ($scope) {
                    $('#eevee-layout').append($compile($('<div user.information></div>'))($scope));
                },
                /**
                 * 用户登录
                 *
                 * @param params
                 *
                 * @returns $http
                 */
                login: function (params, success, error) {
                    ajax.post('/api/auth/login', params)
                        .success(function (response) {
                            if (typeof success == 'function') {

                                storage.set('APP_LOGIN_USER', JSON.stringify(response.data));

                                success(response);
                            }
                        })
                        .error(function (response) {
                            if (typeof error == 'function') {
                                error(response);
                            }
                        });
                },
                /**
                 * 判断用户是否登录
                 *
                 * @return bool
                 */
                isLogin: function () {
                    return storage.has('APP_LOGIN_USER');
                },
                /**
                 * 获取用户登录信息
                 *
                 * @return Object
                 */
                info: function () {
                    return JSON.parse(storage.get('APP_LOGIN_USER'));
                },
                /**
                 * 用户注销登录
                 *
                 * @param callback
                 */
                logout: function (callback) {

                    storage.remove('APP_LOGIN_USER');

                    if (typeof callback == 'function') {
                        callback();
                    }
                },
                /**
                 * 获取用户组
                 */
                getUsers: function (params) {
                    return ajax.get('/api/users', params);
                },
                /**
                 * 添加用户
                 *
                 * @param data Object
                 *
                 * @returns $http
                 */
                postUser: function (data) {
                    return ajax.post('/api/user', data)
                },
                /**
                 * 获取用户
                 *
                 * @param user_id string
                 *
                 * @returns $http
                 */
                getUser: function (user_id) {
                    return ajax.get('/api/user', {user_id: user_id});
                }

            };


        }]);

    });
