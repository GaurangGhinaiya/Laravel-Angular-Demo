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

function nksOnlyNumber() {
    return {
        restrict: 'EA',
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            scope.$watch(attrs.ngModel, function (newValue, oldValue) {
                var spiltArray = String(newValue).split("");
                if (attrs.allowNegative == "false") {
                    if (spiltArray[0] == '-') {
                        newValue = newValue.replace("-", "");
                        ngModel.$setViewValue(newValue);
                        ngModel.$render();
                    }
                }

                if (attrs.allowDecimal == "false") {
                    if (newValue) {
                        newValue = parseInt(newValue);
                        ngModel.$setViewValue(newValue);
                        ngModel.$render();
                    }
                }

                if (attrs.allowDecimal != "false") {
                    if (attrs.decimalUpto) {
                        var n = String(newValue).split(".");
                        if (n[1]) {
                            var n2 = n[1].slice(0, attrs.decimalUpto);
                            newValue = [n[0], n2].join(".");
                            ngModel.$setViewValue(newValue);
                            ngModel.$render();
                        }
                    }
                }

                if (attrs.allowMax) {
                    if (newValue) {
                        if (_.isString(newValue) && newValue.charAt(0) == '0') {
                            while (newValue.charAt(0) === '0')
                                newValue = newValue.substr(1);
                        }
                        //newValue = newValue.toString();
                        if (newValue * 1 > attrs.allowMax * 1 || newValue * 1 > 100) {
                            ngModel.$setViewValue(0);
                            ngModel.$render();
                        } else {
                            ngModel.$setViewValue(newValue);
                            ngModel.$render();
                        }
                    }
                }

                if (spiltArray.length === 0)
                    return;
                if (spiltArray.length === 1 && (spiltArray[0] == '-' || spiltArray[0] === '.'))
                    return;
                if (spiltArray.length === 2 && newValue === '-.')
                    return;

                /*Check it is number or not.*/
                if (isNaN(newValue)) {
                    ngModel.$setViewValue(oldValue);
                    ngModel.$render();
                }
                if (angular.isUndefined(newValue)) {
                    ngModel.$setViewValue('');
                    ngModel.$render();
                }
            });
        }
    };
}

function bsNavbar($window, $location) {

    var defaults = this.defaults = {
        activeClass: 'active',
        routeAttr: 'data-match-route',
        strict: true
    };

    return {
        restrict: 'A',
        link: function postLink(scope, element, attr, controller) {

            // Directive options
            var options = angular.copy(defaults);
            angular.forEach(Object.keys(defaults), function (key) {
                if (angular.isDefined(attr[key]))
                    options[key] = attr[key];
            });

            // Watch for the $location
            scope.$watch(function () {
                return $location.path();

            }, function (newValue, oldValue) {

                var liElements = element[0].querySelectorAll('li[' + options.routeAttr + '],li > a[' + options.routeAttr + ']');

                angular.forEach(liElements, function (li) {

                    var liElement = angular.element(li);
                    var pattern = liElement.attr(options.routeAttr).replace('/', '\\/');
                    if (options.strict) {
                        pattern = '^' + pattern;
                    }
                    var regexp = new RegExp(pattern, ['i']);

                    if (regexp.test(newValue)) {
                        liElement.addClass(options.activeClass);
                    } else {
                        liElement.removeClass(options.activeClass);
                    }

                });

                // Close all other opened elements
                var op = $('#sidebar-nav').find('.open:not(.active)');
                op.children('.submenu').slideUp('fast');
                op.removeClass('open');
            });

        }

    };
}

function gd(year, day, month) {
    return new Date(year, month - 1, day).getTime();
}

function showTooltip(x, y, label, data) {
    $('<div id="flot-tooltip">' + '<b>' + label + ': </b><i>' + data + '</i>' + '</div>').css({
        top: y + 5,
        left: x + 20
    }).appendTo("body").fadeIn(200);
}


function showtab() {
    return {
        link: function (scope, element, attrs) {
            element.click(function (e) {
                e.preventDefault();
                $(element).tab('show');
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
        .directive('bsNavbar', bsNavbar)
        .directive('showtab', showtab)
        .directive('ngConfirmClick', ngConfirmClick)
        .directive('nksOnlyNumber', nksOnlyNumber)
        .directive('showMenu', showMenu)
        .directive('smallNav', smallNav)
        ;
