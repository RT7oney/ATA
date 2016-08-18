define([
        'role',
        'user',
        'typing',
        'css!../../css/app.user'
    ],
    function () {

        return ['$scope', 'typing', 'user', function ($scope, typing, user) {


            var sortField = 'updated_at';

            var sortRule = 'desc';

            var limit = 10;

            var offset = 0;

            var sort = {
                username: null,
                email: null,
                role: null,
                status: null,
                updated_at: null
            };


            $scope.offsetStart = offset;

            $scope.offsetEnd = offset + limit;

            $scope.users = [];

            $scope.userTotal = null;


            var getUsers = function (params) {

                user.getUsers(params)
                    .success(function (response) {

                        if (response.code == 200) {

                            $scope.users = response.data;

                        } else {
                            typing.warning(response.message);
                        }

                    })
                    .error(function () {

                        typing.error('网络错误');

                    });

            };

            user.setUserEditor($scope);

            user.setUserDetail($scope);

            user.getUsers({
                    count: true
                })
                .success(function (response) {
                    $scope.userTotal = response.data;
                })
                .error(function () {

                });

            getUsers({
                order: sortField + ':' + sortRule,
                limit: limit
            });

            $scope.sort = $.extend({}, sort);

            $scope.sortBy = function (field) {

                if (sortField == field) {
                    sortRule = sortRule == 'asc' ? 'desc' : 'asc';
                }

                $scope.sort = $.extend({}, sort);

                sortField = field;

                $scope.sort[field] = sortRule == 'asc' ? 'sort ascending' : 'sort descending';

                getUsers({
                    order: field + ':' + sortRule,
                    limit: limit
                });

            };

            $scope.nextPage = function () {

                var start = offset + limit;

                if (start < $scope.userTotal) {

                    offset = start;

                    $scope.offsetStart = offset;
                    $scope.offsetEnd = $scope.offsetStart + limit;

                    getUsers({
                        order: sortField + ':' + sortRule,
                        limit: limit,
                        offset: offset
                    });
                }

            };

            $scope.lastPage = function () {

                var start = offset - limit;

                if (start >= 0) {

                    offset = start;

                    $scope.offsetStart = offset;
                    $scope.offsetEnd = $scope.offsetStart + limit;

                    getUsers({
                        order: sortField + ':' + sortRule,
                        limit: limit,
                        offset: offset
                    });
                }

            };

            $scope.openUserEditor = function () {
                $scope.$emit('app.user.editor.show');
            };


            $scope.openUserDetailView = function (user_id) {
                $scope.$emit('app.user.detail.show', user_id);
            };

            $scope.$on('app.user.posted', function (e, data) {
                $scope.users.unshift(data);
            });


        }];

    });
