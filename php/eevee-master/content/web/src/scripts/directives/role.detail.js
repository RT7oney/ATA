/**
 * user.detail directive
 */
define(
    [
        'app',
        'role',
        'typing',
        'css!../css/directives/role.detail'
    ],
    function (app) {

        app.directive('role.detail', function () {
            return {
                restrict: 'A',
                replace: true,
                templateUrl: 'views/directives/role.detail.html',
                controller: ['$scope', 'role', 'typing', function ($scope, role, typing) {

                    $scope.role = {};

                    $scope.permissions = {};

                    $scope.loadPermissionsDone = false;

                    $scope.hasPermissions = true;

                    var closeUserDetailView = function () {
                        $('#directive-role-detail').addClass('animated slideOutRight');
                    };

                    $scope.$on('app.role.detail.show', function (e, role_id) {

                        $('#directive-role-detail').hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();

                        role.getRole(role_id)
                            .success(function (response) {

                                if (response.code == 200) {
                                    $scope.role = response.data;
                                } else {
                                    typing.warning(response.message);
                                }

                            })
                            .error(function () {
                                typing.error('网络错误');
                            });

                        $scope.loadPermissionsDone = false;

                        $scope.hasPermissions = true;

                        role.getRolePermissions(role_id)
                            .success(function (response) {

                                $scope.loadPermissionsDone = true;

                                if (response.code == 200) {

                                    $scope.permissions = response.data;

                                    // 判断返回的对象是否有属性
                                    for (var _ in response.data) {
                                        return;
                                    }

                                    $scope.hasPermissions = false;


                                } else {
                                    typing.warning(response.message);
                                }

                            })
                            .error(function () {
                                typing.error('网络错误');
                            });

                    });

                    $scope.openRoleEditor = function (role_id) {

                        closeUserDetailView();
                        
                        $scope.$emit('app.role.editor.show',role_id);

                    };

                    $scope.closeUserDetailView = function () {

                        closeUserDetailView();

                    };


                }]
            };
        });

    })
  
