/**
 * user.detail directive
 */
define(
    [
        'app',
        'user',
        'typing',
        'css!../css/directives/user.detail'
    ],
    function (app) {

        app.directive('user.detail', function () {
            return {
                restrict: 'A',
                replace: true,
                templateUrl: 'views/directives/user.detail.html',
                controller: ['$scope', 'user', 'typing', function ($scope, user, typing) {
                    var closeUserEditor = function () {

                        $("#directive-user-detail").addClass('animated slideOutRight');
                    };

                    var openUserDetail = function () {
                        $("#directive-user-detail").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
                    };

                    $scope.user = {};


                    $scope.$on('app.user.detail.show', function (e, user_id) {

                        openUserDetail();
                        
                        user.getUser(user_id)
                            .success(function (response) {
                                if (response.code == 200) {
                                    $scope.user = response.data;
                                } else {
                                    typing.warning(response.message);
                                }
                            })
                            .error(function () {
                                typing.error('网络错误');

                            });

                    });


                    $scope.closePostEditor = function () {
                        closeUserEditor();
                    };


                }]
            };
        });

    });
  
