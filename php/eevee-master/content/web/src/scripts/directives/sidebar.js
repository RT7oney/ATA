define(['app', 'slimScroll', 'navgoco'], function (app) {

    app.directive('sidebar', [function () {

        return {
            restrict: 'A',
            replace: true,
            scope: {},
            link: function ($scope, $elem, $attrs) {

                $elem.find('.menu').navgoco({
                    openClass: 'active',
                    accordion: true,
                    slide: {
                        duration: 200,
                        easing: 'swing'
                    },
                    onClickAfter: function (e, submenu) {
                        $('#layout-sidebar .menu .item').removeClass('active');
                        $(e.target).parents('.item').addClass('active');
                    }
                });


                // 导航栏滚动体
                $elem.find('.menu').slimScroll({
                    height: '100%'
                });
            }
        };

    }]);
})
