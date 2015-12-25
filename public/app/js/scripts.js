(function ($) {
    "use strict";
    $(document).ready(function () {
        setTimeout(function () {
            /*==Slim Scroll ==*/
            if ($.fn.slimScroll) {
                $('.event-list').slimscroll({
                    height: '305px',
                    wheelStep: 20
                });
                $('.conversation-list').slimscroll({
                    height: '360px',
                    wheelStep: 35
                });
                $('.to-do-list').slimscroll({
                    height: '300px',
                    wheelStep: 35
                });
            }
            /*==Nice Scroll ==*/
            if ($.fn.niceScroll) {

                $(".leftside-navigation").niceScroll({
                    cursorcolor: "#1FB5AD",
                    cursorborder: "0px solid #fff",
                    cursorborderradius: "0px",
                    cursorwidth: "3px"
                });

                $(".leftside-navigation").getNiceScroll().resize();
                if ($('#sidebar').hasClass('hide-left-bar')) {
                    $(".leftside-navigation").getNiceScroll().hide();
                }
                $(".leftside-navigation").getNiceScroll().show();

                $(".right-stat-bar").niceScroll({
                    cursorcolor: "#1FB5AD",
                    cursorborder: "0px solid #fff",
                    cursorborderradius: "0px",
                    cursorwidth: "3px"
                });

            }
        }, 1000);
    })
})(jQuery);