define(['app', 'json!../config.json', 'storage'], function (app, config) {

    return app.factory('ajax', ['$http', 'storage', function ($http, storage) {


        var host = '';
        // var host = 'http://dev.eevee.io';  

        var app_id = config.app_id;

        var getUserToken = function () {

            if (storage.has('APP_LOGIN_USER')) {

                return JSON.parse(storage.get('APP_LOGIN_USER')).user_token;
            }
            return null;
        };

        var ajax = {
            config: {
                timeout: 10000,
                headers: {
                    'Content-Type': 'application/json',
                    'X-App-ID': app_id,
                    'X-User-Token': null
                }
            },
            get: function (url, params) {

                params = params || {};

                ajax.config.method = 'get';
                ajax.config.url = host + url;
                ajax.config.params = params;
                ajax.config.headers['X-User-Token'] = getUserToken();

                return $http(ajax.config);

            },
            post: function (url, data) {

                data = data || {};

                ajax.config.method = 'post';
                ajax.config.url = host + url;
                ajax.config.data = data;
                ajax.config.headers['X-User-Token'] = getUserToken();


                return $http(ajax.config);
            },
            put: function (url, data) {

                data = data || {};

                ajax.config.method = 'put';
                ajax.config.url = host + url;
                ajax.config.data = data;
                ajax.config.headers['X-User-Token'] = getUserToken();
                
                return $http(ajax.config);
            }
        };

        return ajax;

    }]);

});
