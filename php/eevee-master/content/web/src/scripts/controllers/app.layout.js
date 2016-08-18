/**
 * App 布局控制器
 *
 * 后台管理界面包括边栏,头部交互定义
 *
 * @author 古月(Gue@lehu.io)
 */
define([
        'url',
        'user',
        'typing',
        'system',
        'navgoco',
        'semantic',
        'slimScroll',
        '../directives/sidebar',
        'css!../../css/app'
    ],
    function () {

        return ['$scope', '$state', 'user', 'url', 'system', 'typing', function ($scope, $state, user, url, system, typing) {

            // 检查用户是否登录
            if (!user.isLogin()) {
                url.redirect('/login');
            } else {
                $('#eevee-layout').show();
            }

            // 检查元素添加个人信息
            var timeout = setInterval(function () {

                if ($('#eevee-layout').length > 0) {

                    user.setUserInformation($scope);
                    clearTimeout(timeout);
                }
            }, 100);


            // 显示用户信息
            $scope.userInformation = function () {
                $scope.$emit('user.information.show');
            };

            // 用户注销
            $scope.logout = function () {

                user.logout(function () {
                    url.redirect('/login');
                });

            };

            system.getUserMenu()
                .success(function (response) {
                    if (response.code == 200) {

                        $scope.userMenus = response.data;
                    } else {
                        typing.warning(response.message);
                    }
                })
                .error(function () {
                    typing.error('网络错误');
                });


            // 垂直导航栏
            $('#eevee-sidebar .menu').navgoco({
                openClass: 'active',
                accordion: true,
                slide: {
                    duration: 200,
                    easing: 'swing'
                },
                onClickAfter: function (e, submenu) {
                    $('#eevee-sidebar .menu .item').removeClass('active');
                    $(e.target).parents('.item').addClass('active');
                }
            });


            // 配置头部导航菜单
            $('.ui.selection.dropdown').dropdown();


            $('.ui.menu .ui.dropdown').dropdown({
                on: 'click'
            });


        }];

    });
