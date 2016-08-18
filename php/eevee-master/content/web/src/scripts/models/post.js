/**
 * post model
 */

define([
    'app',
    'ajax',
    'post.edirot'
], function (app) {

    app.factory('post', ['$compile', 'ajax', function ($compile, ajax) {


        return {
            setPostEditor: function ($scope) {
                $('#eevee-view').append($compile($('<div post.editor></div>'))($scope));
            },
            postPost: function (data) {
                return ajax.post('/api/post', data);
            },
            getPosts: function (params) {
                return ajax.get('/api/posts', params);
            }

        };

    }]);

});

