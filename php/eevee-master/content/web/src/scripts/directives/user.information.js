/**
 * user.editor 指令
 */
define([
        'app',
        'user',
        'typing',
        'css!../css/directives/user.information'
    ],
    function (app) {

        app.directive('user.information', function () {

            return {
                restrict: 'A',
                replace: true,
                templateUrl: 'views/directives/user.information.html',
                controller: ['$scope', 'user', 'typing', function ($scope, role, user, typing) {

                    var closeUserInformation = function () {
                        $("#directive-user-information").addClass('animated slideOutRight');
                    };

                    var openUserInformation = function () {
                        $("#directive-user-information").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
                    };

                    $scope.closeUserInformation = function () {
                        closeUserInformation();
                    };

                    $scope.$on('user.information.show', function (e, data) {
                        openUserInformation();
                    });
                }]
            };

        });

    });
