require.config({

    baseUrl: "scripts",

    paths: {
        'jquery': './vendor/jquery/dist/jquery.min',
        'angular': './vendor/angular/angular',
        'angularRoute': './vendor/angular-ui-router/release/angular-ui-router.min',
        'angularAMD': './vendor/angularAMD/angularAMD.min',
        'text': 'vendor/requirejs-plugins/lib/text',
        'json': 'vendor/requirejs-plugins/src/json',
        'domReady': './vendor/domReady/domReady',
        'semantic': './vendor/semantic/dist/semantic.min',
        'slimScroll': './vendor/jQuery-slimScroll/jquery.slimscroll.min',
        'navgoco': './vendor/navgoco/src/jquery.navgoco.min',
        'nestable': './vendor/Nestable/jquery.nestable',
        'UE': './vendor/ueditor-bower/ueditor.all.min',
        'zeroClipboard': './vendor/ueditor-bower/third-party/zeroclipboard/ZeroClipboard.min',
        'layer': './vendor/layer/src/layer',
        'pace': './vendor/PACE/pace.min',
        'toastr': './vendor/toastr/toastr.min',
        'app': './app',

        'user': './models/user',
        'role': './models/role',
        'media': './models/media',
        'post': './models/post',
        'system': './models/system',

        'url': './services/url',
        'ajax': './services/ajax',
        'typing': './services/typing',
        'storage': './services/storage',
        'ueditor': './services/ueditor',

        'role.editor': './directives/role.editor',
        'role.detail': './directives/role.detail',
        'user.editor': './directives/user.editor',
        'user.detail': './directives/user.detail',
        'user.information': './directives/user.information',
        'post.edirot': './directives/post.editor'
    },

    map: {
        '*': {
            'css': 'vendor/require-css/css.min'
        }
    },

    shim: {
        'angularAMD': {
            deps: ['angularRoute']
        },
        'angular': {
            exports: 'angular'
        },
        'angularRoute': {
            deps: ['angular']
        },
        'UE': {
            exports: 'UE',
            deps: ['./vendor/ueditor-bower/ueditor.config']
        },
        'pace': {
            deps: ['css!./vendor/PACE/themes/blue/pace-theme-minimal']
        },
        'layer': {
            exports: 'layer',
            deps: ['css!./vendor/layer/skin/layer']
        },
        'toastr': {
            deps: ['jquery', 'css!./vendor/toastr/toastr.min']
        }
    },
    // urlArgs: "bust=" + (new Date()).getTime()
    urlArgs: "version=0.0.1"

});

define(['pace', 'app'], function (pace) {

    pace.start({
        restartOnPushState: true,
        restartOnRequestAfter: true
    });

});


