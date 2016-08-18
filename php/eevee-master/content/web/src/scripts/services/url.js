/**
 * route service
 */
define([
        'app'
    ],
    function (app) {

        app.factory('url', ['$location', function ($location) {


            // 路由参数的标识符
            // 用于标示在路由中的加密参数
            // 依赖于此参数实现页面重定向和获取路由参数
            var params_ident = 'param';

            var url = {
                /**
                 * url加密函数
                 * @param  object params 需要加密的参数对象
                 * @return string        加密后的字符串]
                 */
                params_encode: function (params) {
                    return urlencode(base64_encode(json_encode(params)));
                },
                parseParams: function (params) {
                    var param = '';
                    var count = 1;
                    for (item in params) {
                        param = count > 1 ? param + '&' : param;
                        param = param + item + '=' + params[item];
                        count = count + 1;
                    }
                    return param;
                },
                /**
                 * url解密函数
                 * @param  string string 需要解密的字符串]
                 * @return boject        返回解密后的hash对象]
                 */
                params_decode: function (str) {
                    return json_decode(base64_decode(urldecode(str)));
                },
                /**
                 * 回退历史记录页面
                 *
                 * @param  int $count 回退层数，默认为 -1
                 */
                last: function (count) {
                    count = typeof count == 'undefined' ? -1 : count;
                    history.go(count);
                },
                /**
                 * 页面替换
                 *
                 * @param   uri     string   example:/path
                 * @param   params  object
                 */
                replace: function (uri, params) {
                    $location.url(uri + '?' + url.parseParams(params)).replace();
                },
                /**
                 * 页面跳转函数函数
                 *
                 * @param   uri     string   路由，自动处理‘#’号
                 * @param   params  object   路由参数
                 *
                 * @return 页面跳转
                 */
                redirect: function (uri, params) {

                    params = params || {};

                    location.href = '#' + uri + '?' + url.parseParams(params);

                },
                /**
                 * 获取路由参数
                 * @return object 路由中附带的参数对象
                 */
                getParams: function () {
                    // 从路由地址中湖区加密字符串
                }
            };

            return url;
        }]);

    });
