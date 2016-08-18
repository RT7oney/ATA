/**
 * ueditor 编辑器服务
 *
 * author : 古月
 * time   : 2016/05
 *
 */

define([
        'app',
        'UE',
        'zeroClipboard'
    ],
    function (app, UE, zeroClipboard) {

        app.factory('ueditor', [function () {

            window['ZeroClipboard'] = zeroClipboard;

            ueditor = new UE.ui.Editor({
                UEDITOR_HOME_URL: 'scripts/vendor/ueditor-bower/',
                // 可配置选项
                // toolbars: [],
                autoHeightEnabled: true,
                autoFloatEnabled: true,
                serverUrl: false
            });

            // ueditor.render('container');

            return ueditor;
        }]);
    });
