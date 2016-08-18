/**
 * user.editor 指令
 */
define([
        'app',
        'typing',
        'css!../css/directives/user.editor'
    ],
    function (app) {

        app.directive('user.editor', function () {

            return {
                restrict: 'A',
                replace: true,
                templateUrl: 'views/directives/user.editor.html',
                controller: ['$scope', 'role', 'user', 'typing', function ($scope, role, user, typing) {
                    $scope.title = "编辑用户";

                    $scope.roles = [];

                    var init = {
                        'username': '',
                        'password': '',
                        'email': '',
                        'role': 'guest'
                    };

                    $scope.user = $.extend({}, init);

                    role.getRoles()
                        .success(function (response) {

                            if (response.code == 200) {
                                $scope.roles = response.data;
                            } else {
                                typing.warning(response.message);
                            }

                        })
                        .error(function () {
                            typing.error('获取角色组网络错误');
                        });

                    var closeUserEditor = function () {
                        $("#directive-user-editor").addClass('animated slideOutRight');
                    };

                    var openUserEditor = function () {
                        $("#directive-user-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
                    };


                    $scope.$on('app.user.editor.show', function (e, data) {
                        openUserEditor();
                    });

                    $scope.submitUser = function () {

                        user.postUser($scope.user)
                            .success(function (response) {

                                if (response.code == 200) {

                                    closeUserEditor();

                                    typing.success('用户添加成功');

                                    $scope.$emit('app.user.posted', response.data);

                                    $scope.user = $.extend({}, init);

                                } else {
                                    typing.warning(response.message);
                                }

                            })
                            .error(function () {

                                typing.error('网络错误');

                            });

                    };

                    $scope.closeUserEditor = function () {
                        closeUserEditor();
                    };

                }]
            };

        });

    });
