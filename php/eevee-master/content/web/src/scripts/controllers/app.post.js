/**
 * Posts 控制器
 */
define([
        'media',
        'post',
        'css!../../css/app.post'
    ],
    function () {

        return ['$scope', 'media', 'post', function ($scope, media, post) {



            // media.config($scope);
            //
            // $scope.openMediaModal = function () {
            //     media.open($scope);
            // };
            post.setPostEditor($scope);

            $scope.openPostEditor = function () {
                $scope.$emit('post.editor.show');
            };

        }];

    });
