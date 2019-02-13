function cb(r, g, b, o) {
    return "rgba(" + r + "," + g + "," + b + "," + o + ")";
}

function rotate(x0, y0, x, y, angle) {
    return {
        x: (x - x0) * Math.cos(angle) - (y - y0) * Math.sin(angle) + x0,
        y: (x - x0) * Math.sin(angle) + (y - y0) * Math.cos(angle) + y0
    };
}

var Heart = function (ctx, x, y, size) {
    this.ctx = ctx;
    this.ctx.lineWidth = 1;
    this.ctx.fillStyle = cb(255, 0, 0, 1);
    this.x0 = x;
    this.y0 = y;
    this.size = size;
    this.count = 300;
    this.points = [];
    for (var i = 0; i < this.count; i++) {
        var step = i / this.count * (Math.PI * 2);
        this.points.push({
            x: this.x0 + this.size * 16 * Math.pow(Math.sin(step), 3),
            y: this.y0 - this.size * (13 * Math.cos(step) - 5 * Math.cos(2 * step) - 2 * Math.cos(3 * step) - Math.cos(4 * step))
        });
    }
};
Heart.prototype.draw = function (angle) {
    this.ctx.beginPath();
    for (var i = 0; i < this.points.length; i++) {
        var xy = rotate(this.x0, this.y0, this.points[i].x, this.points[i].y, angle);
        this.ctx.lineTo(xy.x, xy.y);
    }
    this.ctx.closePath();
    this.ctx.fill();
};

var Flower = function (ctx) {
    this.ctx = ctx;

};
!(function ($) {
    $.fn.typewriter = function (pin) {
        var p = $.extend(true, {
            timeout: 75
        }, pin || {});
        this.each(function () {
            var $ele = $(this), str = $ele.html(), progress = 0;
            $ele.html('');
            var timer = setInterval(function () {
                var current = str.substr(progress, 1);
                if (current == '<') {
                    progress = str.indexOf('>', progress) + 1;
                } else {
                    progress++;
                }
                $ele.html(str.substring(0, progress) + (progress & 1 ? '_' : ''));
                if (progress >= str.length) {
                    clearInterval(timer);
                }
            }, p.timeout);
        });
        return this;
    };
})(jQuery);