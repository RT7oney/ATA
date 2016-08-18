define(['app', 'jquery', 'plupload'], function (app, $, plupload) {

    app.directive('uploader', function () {

        return {
            restrict: 'A',
            replace: true,
            scope: {},
            link: function ($scope, $elem, $attrs) {

                var uploader = new plupload.Uploader({
                    browse_button: $elem[0],
                    url: 'upload.php'
                });

                uploader.init();
                
            }

        };

    });

})
