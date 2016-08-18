define([
    'app',
    'ajax'
], function (app) {

    app.factory('system', ['ajax', function (ajax) {

        return {
            /**
             * 获取用户开始菜单
             *
             * @return $http
             */
            getUserMenu: function () {
                return ajax.get('/api/system/user/menu');
            }


        };

    }]);
});