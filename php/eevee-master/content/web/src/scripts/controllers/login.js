/**
 * Posts 控制器
 */
define([
        'user',
        'storage',
        'url',
        'typing',
        'css!../../css/login'
    ],
    function () {

        return ['$scope', '$state', 'user', 'storage', 'typing', 'url', function ($scope, $state, user, storage, typing, url) {

            $scope.account = null;
            $scope.password = null;
            $scope.showPage = false;

            if (user.isLogin()) {
                url.redirect('/app/dashboard');
            }else{
                $scope.showPage = true;
            }


            $scope.login = function () {

                user.login({
                        account: $scope.account,
                        password: $scope.password
                    },
                    function (response) {

                        if (response.code == 200) {

                            url.redirect('/app/dashboard');

                        } else {

                            typing.tip(response.message, '#account');

                        }

                    });
            };

        }];

    });
