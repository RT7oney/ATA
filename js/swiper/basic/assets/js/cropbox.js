/**
 * Created by BigFACT.
 */

"use strict";
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else {
        factory(jQuery);
    }
}(function ($) {
    var cropbox = function(options, el){
        var el = el || $(options.imageBox),
            obj =
            {
                state : {},
                ratio : 1,
                options : options,
                imageBox : el,
                thumbBox : el.find(options.thumbBox),
                spinner : el.find(options.spinner),
                image : new Image(),
                getDataURL: function ()
                {
                    var width = this.thumbBox.width(),
                        height = this.thumbBox.height(),
                        canvas = document.createElement("canvas"),
                        dim = el.css('background-position').split(' '),
                        size = el.css('background-size').split(' '),
                        dx = parseInt(dim[0]) - el.width()/2 + width/2,
                        dy = parseInt(dim[1]) - el.height()/2 + height/2,
                        dw = parseInt(size[0]),
                        dh = parseInt(size[1]),
                        sh = parseInt(this.image.height),
                        sw = parseInt(this.image.width);

                    canvas.width = width;
                    canvas.height = height;
                    var context = canvas.getContext("2d");
                    context.drawImage(this.image, 0, 0, sw, sh, dx, dy, dw, dh);
                    var imageData = canvas.toDataURL('image/png');
                    return imageData;
                },
                getBlob: function()
                {
                    var imageData = this.getDataURL();
                    var b64 = imageData.replace('data:image/png;base64,','');
                    var binary = atob(b64);
                    var array = [];
                    for (var i = 0; i < binary.length; i++) {
                        array.push(binary.charCodeAt(i));
                    }
                    return  new Blob([new Uint8Array(array)], {type: 'image/png'});
                },
                zoomIn: function ()
                {
                    this.ratio*=1.1;
                    setBackground();
                },
                zoomOut: function ()
                {
                    this.ratio*=0.9;
                    setBackground();
                }
            },
            setBackground = function()
            {
                var w =  parseInt(obj.image.width)*obj.ratio;
                var h =  parseInt(obj.image.height)*obj.ratio;

                var pw = (el.width() - w) / 2;
                var ph = (el.height() - h) / 2;

                el.css({
                    'background-image': 'url(' + obj.image.src + ')',
                    'background-size': w +'px ' + h + 'px',
                    'background-position': pw + 'px ' + ph + 'px',
                    'background-repeat': 'no-repeat'});
            },
            imgMouseDown = function(e)
            {
                e.stopImmediatePropagation();

                e.originalEvent.stopPropagation();
                e.originalEvent.preventDefault();

                obj.state.dragable = true;
                obj.state.mouseX = getSpotPosition(e).x;
                obj.state.mouseY = getSpotPosition(e).y;
                // console.log(obj.state);
                if(e.originalEvent.touches && e.originalEvent.touches.length > 1) {
                    var w = e.originalEvent.touches[0].clientX - e.originalEvent.touches[1].clientX;
                    var h = e.originalEvent.touches[0].clientY - e.originalEvent.touches[1].clientY;
                    obj.state.distance = Math.sqrt(w*w + h*h);
                    (x > 0 && y < 0) && (obj.ratio*=1.1);
                    (x < 0 && y > 0) && (obj.ratio*=0.9);
                    setBackground();
                    return;
                }
            },
            imgMouseMove = function(e)
            {
                e.stopImmediatePropagation();
                e.originalEvent.stopPropagation();
                e.originalEvent.preventDefault();

                if (obj.state.dragable)
                {
                    var x = getSpotPosition(e).x - obj.state.mouseX;
                    var y = getSpotPosition(e).y - obj.state.mouseY;

                    obj.state.mouseX = getSpotPosition(e).x;
                    obj.state.mouseY = getSpotPosition(e).y;

                    if(e.originalEvent.touches && e.originalEvent.touches.length > 1) {
                        var w = e.originalEvent.touches[0].clientX - e.originalEvent.touches[1].clientX;
                        var h = e.originalEvent.touches[0].clientY - e.originalEvent.touches[1].clientY;
                        var d = Math.sqrt(w*w + h*h) - obj.state.distance;
                        (d > 0) && (obj.ratio*=1.1);
                        (d < 0) && (obj.ratio*=0.9);
                        setBackground();
                        return;
                    }
                    
                    var bg = el.css('background-position').split(' ');

                    var bgX = x + parseInt(bg[0]);
                    var bgY = y + parseInt(bg[1]);

                    el.css('background-position', bgX +'px ' + bgY + 'px');
                    
                }
            },
            imgMouseUp = function(e)
            {
                e.stopImmediatePropagation();
                obj.state.dragable = false;
            },
            zoomImage = function(e)
            {
                e.originalEvent.wheelDelta > 0 || e.originalEvent.detail < 0 ? obj.ratio*=1.1 : obj.ratio*=0.9;
                setBackground();
            }

        obj.spinner.show();
        obj.image.onload = function() {
            obj.spinner.hide();
            setBackground();

            el.bind('mousedown touchstart', imgMouseDown);
            el.bind('mousemove touchmove', imgMouseMove);
            $(window).bind('mouseup touchend', imgMouseUp);
            el.bind('mousewheel DOMMouseScroll', zoomImage);
        };
        obj.image.src = options.imgSrc;
        el.on('remove', function(){$(window).unbind('mouseup', imgMouseUp)});

        return obj;
    };

    // 根据事件获取当前触点的位置
  function getSpotPosition(e) {
    var touches = {};
    if (e.originalEvent.touches != undefined) {
      touches.x = e.originalEvent.touches[0].clientX;
      touches.y = e.originalEvent.touches[0].clientY;
    }
    touches.x = touches.x || e.clientX || e.pageX;
    touches.y = touches.y || e.clientY || e.pageY;
    return touches;
  }

    jQuery.fn.cropbox = function(options){
        return new cropbox(options, this);
    };
}));

