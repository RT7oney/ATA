define([
    'post',
    'user',
    '../services/typing',
    'css!../../css/app.qingjia'
], function () {

    return ['$scope', 'user', 'post', 'typing', function ($scope, user, post, typing) {

        var init = {
            user_id: user.info()['id'],
            content: '',
            title: '',
            type: '假条',
            status: '待教师批阅'
        };

        $scope.post = $.extend({}, init);

        $scope.posts = [];

        post.getPosts({
                user_id: user.info()['id'],
                order : 'created_at:desc'
            })
            .success(function (response) {
                if (response.code == 200) {
                    for (var i in response.data) {
                        if (response.data[i].status == '审核通过') {
                            response.data[i].class = 'positive';
                        } else if (response.data[i].status == '审核未通过') {
                            response.data[i].class = 'negative';
                        } else {
                            response.data[i].class = '';
                        }
                    }
                    $scope.posts = response.data;
                } else {
                    typing.warning(response.message);
                }
            })
            .error(function () {
                typing.error('网络错误');
            });

        $scope.submit = function () {
            post.postPost($scope.post)
                .success(function (response) {
                    if (response.code == 200) {
                        typing.success('申请成功,等待审核.');

                        $scope.posts.unshift(response.data);

                        $scope.post = $.extend({}, init);

                        $scope.close();

                    } else {
                        typing.warning(response.message);
                    }
                })
                .error(function () {
                    typing.error('网络错误');
                });
        };

        $scope.add = function () {
            $('#jiatiao-editor').hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
        };

        $scope.close = function () {
            $('#jiatiao-editor').addClass('animated slideOutRight');
        };


    }];

});
