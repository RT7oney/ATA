/**
 * typing service
 *
 * @author 古月
 */

define(['app', 'jquery', 'layer', 'toastr'], function (app, $, layer, toastr) {

    var toastrDefaultOption = {
        "closeButton": false,
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    app.factory('typing', function () {

        return {
            /**
             * 打印消息
             *
             * @param  message
             */
            message: function (message, title, option) {

                title = title || '';
                option = option || {};

                toastr.options = $.extend(toastrDefaultOption, option);

                toastr.success(message, title);
            },

            success: function (message, title, option) {

                title = title || '';
                option = option || {};

                toastr.options = $.extend(toastrDefaultOption, option);

                toastr.success(message, title);
            },

            /**
             * 答应警告消息
             * @param  string message
             */
            warning: function (message, title, option) {

                title = title || '';
                option = option || {};

                toastr.options = $.extend(toastrDefaultOption, option);

                toastr.warning(message, title);
            },

            
            tip: function (message, selector) {

                layer.tips(message, selector, {
                    tips: [1, '#3595CC'],
                    time: 2000
                });

            },
            /**
             * 打印错误消息
             *
             * @param  message message
             */
            error: function (message, title, option) {

                title = title || '';

                option = option || {};

                toastr.options = $.extend(toastrDefaultOption, option);

                toastr.error(message, title);

            },
            /**
             * 设置页面 title
             *
             * @param  string title
             */
            title: function (title) {
                document.title = title;
            },
            /**
             * 过滤字符串
             * @param  string str      字符串
             * @param  string charlist 顾虑字符
             *
             * @return string
             */
            trim: function (str, charlist) {
                //  discuss at: http://phpjs.org/functions/trim/
                // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                // improved by: mdsjack (http://www.mdsjack.bo.it)
                // improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
                // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
                // improved by: Steven Levithan (http://blog.stevenlevithan.com)
                // improved by: Jack
                //    input by: Erkekjetter
                //    input by: DxGx
                // bugfixed by: Onno Marsman
                //   example 1: trim('    Kevin van Zonneveld    ');
                //   returns 1: 'Kevin van Zonneveld'
                //   example 2: trim('Hello World', 'Hdle');
                //   returns 2: 'o Wor'
                //   example 3: trim(16, 1);
                //   returns 3: 6

                var whitespace, l = 0,
                    i = 0;
                str += '';

                if (!charlist) {
                    // default list
                    whitespace =
                        ' \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000';
                } else {
                    // preg_quote custom list
                    charlist += '';
                    whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1');
                }

                l = str.length;
                for (i = 0; i < l; i++) {
                    if (whitespace.indexOf(str.charAt(i)) === -1) {
                        str = str.substring(i);
                        break;
                    }
                }

                l = str.length;
                for (i = l - 1; i >= 0; i--) {
                    if (whitespace.indexOf(str.charAt(i)) === -1) {
                        str = str.substring(0, i + 1);
                        break;
                    }
                }

                return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
            }
        };

    });

});
