/**
 * Cube - Bootstrap Admin Theme
 * Copyright 2014 Phoonio
 */

function ngConfirmClick() {
    return {
        link: function (scope, element, attr) {
            var msg = attr.ngConfirmClick || "Are you sure want to delete?";
            var clickAction = attr.confirmedClick;
            element.bind('click', function (event) {
                if (window.confirm(msg)) {
                    scope.$apply(clickAction);
                }
                else {
                }
            });
        }
    };
}

function showMenu() {
    return {
        link: function (scope, element, attrs) {
            $('#nav-accordion').dcAccordion({
                eventType: 'click',
                autoClose: true,
                saveState: true,
                disableLink: true,
                speed: 'slow',
                showCount: false,
                autoExpand: true,
                classExpand: 'dcjq-current-parent'
            });
        }
    };
}


function smallNav() {
    return {
        link: function (scope, element, attrs) {
            $(element).click(function (e) {
                $(".leftside-navigation").niceScroll({
                    cursorcolor: "#1FB5AD",
                    cursorborder: "0px solid #fff",
                    cursorborderradius: "0px",
                    cursorwidth: "3px"
                });

                $('#sidebar').toggleClass('hide-left-bar');
                if ($('#sidebar').hasClass('hide-left-bar')) {
                    $(".leftside-navigation").getNiceScroll().hide();
                }
                $(".leftside-navigation").getNiceScroll().show();
                $('#main-content').toggleClass('merge-left');
                e.stopPropagation();
                if ($('#container').hasClass('open-right-panel')) {
                    $('#container').removeClass('open-right-panel')
                }
                if ($('.right-sidebar').hasClass('open-right-bar')) {
                    $('.right-sidebar').removeClass('open-right-bar')
                }

                if ($('.header').hasClass('merge-header')) {
                    $('.header').removeClass('merge-header')
                }
            });
        }
    };
}

angular
        .module('Directives', [])
        .directive('ngConfirmClick', ngConfirmClick)
        .directive('showMenu', showMenu)
        .directive('smallNav', smallNav);
