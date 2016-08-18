/**
 * media model
 */

define([
    'app',
    'layer',
    'ajax',
    'directives/media'
], function (app, layer) {

    app.factory('media', ['$compile', 'ajax', function ($compile, ajax) {

        var modalOprion = {
            id: 'directive-media-modal',
            type: 1,
            title: false,
            shadeClose: true,
            shade: 0.4,
            maxmin: false,
            area: ['90%', '80%']
        };

        return {
            config: function ($scope, option) {

                option = option || {};

                modalOprion = $.extend(modalOprion, option);

            },
            open: function ($scope) {

                var index = layer.open(modalOprion);

                $('#layui-layer' + index + ' .layui-layer-content').append($compile('<div media></div>')($scope));

            }

        };

    }]);

});
   
