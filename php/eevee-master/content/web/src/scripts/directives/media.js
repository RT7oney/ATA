/**
 * 媒体管理指令
 */
define([
        'app',
        'css!../../css/directives/media'
    ],
    function (app) {

        app.directive('media', function () {

            return {
                restrict: 'A',
                replace: true,
                scope: {},
                templateUrl: 'views/directives/media.html',
                controller: ['$scope', function ($scope) {
                    console.log('媒体');
                }]
            };

        });

    })
