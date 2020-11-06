$(document).ready(function() {
    /**
     * @license
     * Lodash (Custom Build) lodash.com/license | Underscore.js 1.8.3 underscorejs.org/LICENSE
     * Build: `lodash include="throttle"`
     */
    (function() {
        function t() {}

        function e(t) {
            return null == t ?
                t === l ?
                d :
                y :
                I && I in Object(t) ?
                n(t) :
                r(t);
        }

        function n(t) {
            var e = $.call(t, I),
                n = t[I];
            try {
                t[I] = l;
                var r = true;
            } catch (t) {}
            var o = _.call(t);
            return r && (e ? (t[I] = n) : delete t[I]), o;
        }

        function r(t) {
            return _.call(t);
        }

        function o(t, e, n) {
            function r(e) {
                var n = d,
                    r = g;
                return (d = g = l), (x = e), (v = t.apply(r, n));
            }

            function o(t) {
                return (x = t), (O = setTimeout(c, e)), T ? r(t) : v;
            }

            function i(t) {
                var n = t - h,
                    r = t - x,
                    o = e - n;
                return w ? k(o, j - r) : o;
            }

            function f(t) {
                var n = t - h,
                    r = t - x;
                return h === l || n >= e || n < 0 || (w && r >= j);
            }

            function c() {
                var t = D();
                return f(t) ? p(t) : ((O = setTimeout(c, i(t))), l);
            }

            function p(t) {
                return (O = l), S && d ? r(t) : ((d = g = l), v);
            }

            function s() {
                O !== l && clearTimeout(O), (x = 0), (d = h = g = O = l);
            }

            function y() {
                return O === l ? v : p(D());
            }

            function m() {
                var t = D(),
                    n = f(t);
                if (((d = arguments), (g = this), (h = t), n)) {
                    if (O === l) return o(h);
                    if (w) return (O = setTimeout(c, e)), r(h);
                }
                return O === l && (O = setTimeout(c, e)), v;
            }
            var d,
                g,
                j,
                v,
                O,
                h,
                x = 0,
                T = false,
                w = false,
                S = true;
            if (typeof t != "function") throw new TypeError(b);
            return (
                (e = a(e) || 0),
                u(n) &&
                ((T = !!n.leading),
                    (w = "maxWait" in n),
                    (j = w ? M(a(n.maxWait) || 0, e) : j),
                    (S = "trailing" in n ? !!n.trailing : S)),
                (m.cancel = s),
                (m.flush = y),
                m
            );
        }

        function i(t, e, n) {
            var r = true,
                i = true;
            if (typeof t != "function") throw new TypeError(b);
            return (
                u(n) &&
                ((r = "leading" in n ? !!n.leading : r),
                    (i = "trailing" in n ? !!n.trailing : i)),
                o(t, e, { leading: r, maxWait: e, trailing: i })
            );
        }

        function u(t) {
            var e = typeof t;
            return null != t && ("object" == e || "function" == e);
        }

        function f(t) {
            return null != t && typeof t == "object";
        }

        function c(t) {
            return typeof t == "symbol" || (f(t) && e(t) == m);
        }

        function a(t) {
            if (typeof t == "number") return t;
            if (c(t)) return s;
            if (u(t)) {
                var e = typeof t.valueOf == "function" ? t.valueOf() : t;
                t = u(e) ? e + "" : e;
            }
            if (typeof t != "string") return 0 === t ? t : +t;
            t = t.replace(g, "");
            var n = v.test(t);
            return n || O.test(t) ?
                h(t.slice(2), n ? 2 : 8) :
                j.test(t) ?
                s :
                +t;
        }
        var l,
            p = "4.17.5",
            b = "Expected a function",
            s = NaN,
            y = "[object Null]",
            m = "[object Symbol]",
            d = "[object Undefined]",
            g = /^\s+|\s+$/g,
            j = /^[-+]0x[0-9a-f]+$/i,
            v = /^0b[01]+$/i,
            O = /^0o[0-7]+$/i,
            h = parseInt,
            x =
            typeof global == "object" &&
            global &&
            global.Object === Object &&
            global,
            T =
            typeof self == "object" &&
            self &&
            self.Object === Object &&
            self,
            w = x || T || Function("return this")(),
            S =
            typeof exports == "object" &&
            exports &&
            !exports.nodeType &&
            exports,
            N =
            S &&
            typeof module == "object" &&
            module &&
            !module.nodeType &&
            module,
            E = Object.prototype,
            $ = E.hasOwnProperty,
            _ = E.toString,
            W = w.Symbol,
            I = W ? W.toStringTag : l,
            M = Math.max,
            k = Math.min,
            D = function() {
                return w.Date.now();
            };
        (t.debounce = o),
        (t.throttle = i),
        (t.isObject = u),
        (t.isObjectLike = f),
        (t.isSymbol = c),
        (t.now = D),
        (t.toNumber = a),
        (t.VERSION = p),
        typeof define == "function" &&
            typeof define.amd == "object" &&
            define.amd ?
            ((w._ = t),
                define(function() {
                    return t;
                })) :
            N ?
            (((N.exports = t)._ = t), (S._ = t)) :
            (w._ = t);
    }.call(this));

    // This function will run a throttled script every 300 ms
    var checkHeader = _.throttle(() => {
        // Detect scroll position
        let scrollPosition = Math.round(window.scrollY);

        // If we've scrolled 100px, add "sticky" class to the header
        if (scrollPosition > 1) {
            $("#header .logo").css({ "min-width": "unset" });
            $("#stick-nav").css({ padding: "6px 0" });
            $("#header-logo").css({ width: "135px" });
        }
        // If not, remove "sticky" class from header
        else {
            $("#stick-nav").css({ padding: "15px 0" });
            $("#header-logo").css("width", "unset");
        }
    }, 300);

    // Run the checkHeader function every time you scroll
    window.addEventListener("scroll", checkHeader);
    $("img.lazy").lazyload();
    if ($.fn.owlCarousel) {
        $(".owl-ProdHome").owlCarousel({
            dots: false,
            // autoplayTimeout: 4000,
            responsiveClass: true,
            checkVisible: true,
            margin: 30,
            // loop: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true,
                    navText: [
                        "<span class='icon-previous-product'></span>",
                        "<span class='icon-next-product'></span>"
                    ]
                },
                768: {
                    items: 4,
                    nav: true,
                    navText: [
                        "<span class='icon-previous-product'></span>",
                        "<span class='icon-next-product'></span>"
                    ]
                }
            }
        });
        $(".gallery-product").owlCarousel({
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            responsiveClass: true,
            checkVisible: true,
            margin: 30,
            loop: true,
            responsive: {
                0: {
                    items: 3,
                    nav: true,
                    navText: [
                        "<span class='icon-previous-product'></span>",
                        "<span class='icon-next-product'></span>"
                    ]
                },
                768: {
                    items: 3,
                    nav: true,
                    navText: [
                        "<span class='icon-previous-product'></span>",
                        "<span class='icon-next-product'></span>"
                    ]
                },
                1200: {
                    items: 4,
                    nav: true,
                    navText: [
                        "<span class='icon-previous-product'></span>",
                        "<span class='icon-next-product'></span>"
                    ]
                }
            }
        });
    }

    var ItemGallery = $(".gallery-product").find(".item-imgGall");
    $(ItemGallery).each(function(index, el) {
        var Img = $(el).find("img");
        $(Img).click(function() {
            var UrlImg = $(this).attr("name-img");
            $("#Img-product").attr("src", UrlImg);
            $("#Mb-Img-product").attr("src", UrlImg);
        });
    });
    var ItemGallery = $(".modal-gallery-product").find(".item-imgGall");
    $(ItemGallery).each(function(index, el) {
        var Img = $(el).find("img");
        $(Img).click(function() {
            var UrlImg = $(this).attr("name-img");
            $("#imageZoom").attr("src", UrlImg);
            $("#Img-product-Mb").attr("src", UrlImg);
        });
    });
    var active = $("#active").val();
    $(".sub-active").addClass(active);

    var $containers = $(
        "[data-animation]:not([data-animation-child]), [data-animation-container]"
    );
    $containers.scrollAnimations();

});
$(document).ready(function() {
    $('#imageZoom').imageZoom({ zoom: 200 });

    $('.btn-submit').on('click', function() {
        var elements = document.getElementsByClassName("inputValidate");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("This field cannot null");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }


        $("input[name=txtPhone]")[0].oninvalid = function() {
            this.setCustomValidity("This field must be a number");
        };
    })


    $('.modal-gallery-product-top').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        arrows: false
    });

    $(".modal-gallery-product").owlCarousel({
        dots: false,
        autoplay: false,
        // autoplayTimeout: 4000,
        responsiveClass: true,
        checkVisible: true,
        margin: 30,
        loop: true,
        responsive: {
            0: {
                items: 4,
                nav: true,
                navText: [
                    "<span class='icon-previous-product'></span>",
                    "<span class='icon-next-product'></span>"
                ]
            },
            768: {
                items: 3,
                nav: true,
                navText: [
                    "<span class='icon-previous-product'></span>",
                    "<span class='icon-next-product'></span>"
                ]
            },

        },

    });

    function syncPosition(el) {
        var current = this.currentItem;
        $(".modal-gallery-product")
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced")
        if ($(".modal-gallery-product").data("owlCarousel") !== undefined) {
            center(current)
        }
    }

    $(".modal-gallery-product").on("click", ".owl-item", function(e) {
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo", number);
    });

    function center(number) {
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for (var i in sync2visible) {
            if (num === sync2visible[i]) {
                var found = true;
            }
        }

        if (found === false) {
            if (num > sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", num - sync2visible.length + 2)
            } else {
                if (num - 1 === -1) {
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if (num === sync2visible[sync2visible.length - 1]) {
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if (num === sync2visible[0]) {
            sync2.trigger("owl.goTo", num - 1)
        }

    }

});