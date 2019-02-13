var Heart = function (ctx) {
    this.ctx = ctx;

};
Heart.prototype.draw = function () {
    
};
(function ($) {
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