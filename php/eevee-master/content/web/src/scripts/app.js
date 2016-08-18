define([
        'angularAMD',
        'json!../config.json',
        'jquery',
        'css!./vendor/semantic/dist/semantic.min',
        'css!./vendor/animate.css/animate.min.css'
    ],
    function (angularAMD, config) {

        var app = angular.module("eevee", ['ui.router']);

        app.config(['$stateProvider','$urlRouterProvider','$locationProvider','$uiViewScrollProvider',function ($stateProvider, $urlRouterProvider, $locationProvider, $uiViewScrollProvider) {

            $uiViewScrollProvider.useAnchorScroll();

            $urlRouterProvider.otherwise('/app/dashboard');

            var routes = config.routes || [];

            for (var i in routes) {
                $stateProvider.state(i, angularAMD.route(routes[i]));
            }

        }]);

        // app.config(['$httpProvider', function ($httpProvider) {
        //     $httpProvider.interceptors.push(function () {
        //         return {
        //             'request': function (config) {
        //                 return config;
        //             },
        //             'response': function (response) {
        //                 return response
        //             }
        //         };
        //     });
        // }]);


        return angularAMD.bootstrap(app);

    });
