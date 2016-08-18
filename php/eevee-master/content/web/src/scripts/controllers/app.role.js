define([
    'role.editor',
    'role.detail',
    '../models/role',
    '../services/typing',
    'css!../../css/app.role'
], function () {

    return ['$scope', 'role', 'typing', function ($scope, role, typing) {


        $scope.roles = [];

        role.setRoleEditor($scope);

        role.setRoleDetail($scope);

        var sort = {
            name: null,
            permission_amount: null,
            status: null
        };

        var sortField = null;

        var sortRule = 'asc';

        $scope.sort = $.extend({}, sort);


        var getRoles = function (params) {
            params = params || null;
            role.getRoles(params)
                .success(function (response) {
                    if (response.code == 200) {
                        $scope.roles = response.data;
                    } else {
                        typing.warning(response.message);
                    }
                })
                .error(function () {
                    typing.error('网络错误');
                });
        };

        $scope.sortBy = function (field) {

            if (sortField == field) {
                sortRule = sortRule == 'asc' ? 'desc' : 'asc';
            }

            $scope.sort = $.extend({}, sort);

            sortField = field;

            $scope.sort[field] = sortRule == 'asc' ? 'sort ascending' : 'sort descending';

            getRoles({
                order: field + ':' + sortRule
            });
        };


        getRoles({
            order: 'updated_at:desc'
        });


        $scope.openRoleDetailView = function (role_id) {
            $scope.$emit('app.role.editor.hide');
            $scope.$emit('app.role.detail.show', role_id);
        };


        $scope.$on('app.role.posted', function (e, data) {
            if (sortField != 'updated_at' && sortRule != 'desc') {
                sortRule = 'desc';
                getRoles({
                    order: 'updated_at:desc'
                });
            } else {
                $scope.roles.unshift(data);
            }
        });

        $scope.$on('app.role.putted', function (e, data) {
            for (var i in $scope.roles) {
                if ($scope.roles[i].id == data.id) {
                    $scope.roles[i] = data;
                    $scope.$emit('app.role.editor.hide');
                    break;
                }
            }
        });


        $scope.openRoleEditor = function () {

            $scope.$emit('app.role.editor.show');
        }


    }];

});
