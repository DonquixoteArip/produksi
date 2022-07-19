"use strict";
function _classCallCheck(t, s) {
    if (!(t instanceof s)) throw new TypeError("Cannot call a class as a function")
}
function _defineProperties(t, s) {
    for (var e = 0; e < s.length; e++) {
        var n = s[e];
        n.enumerable = n.enumerable || !1, n.configurable = !0, "value" in n && (n.writable = !0), Object.defineProperty(t, n.key, n)
    }
}
function _createClass(t, s, e) {
    return s && _defineProperties(t.prototype, s), e && _defineProperties(t, e), Object.defineProperty(t, "prototype", {
        writable: !1
    }), t
}
function _typeof(t) {
    return (_typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
        return typeof t
    } : function(t) {
        return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
    })(t)
}
/*!
 * jQuery SmartWizard v6.0.1
 * The awesome step wizard plugin for jQuery
 * http://www.techlaboratory.net/jquery-smartwizard
 *
 * Created by Dipu Raj (http://dipu.me)
 *
 * Licensed under the terms of the MIT License
 * https://github.com/techlab/jquery-smartwizard/blob/master/LICENSE
 */
! function(e) {
    "function" == typeof define && define.amd ? define(["jquery"], e) : "object" === ("undefined" == typeof module ? "undefined" : _typeof(module)) && module.exports ? module.exports = function(t, s) {
        return void 0 === s && (s = "undefined" != typeof window ? require("jquery") : require("jquery")(t)), e(s), s
    } : e(jQuery)
}(function(l) {
    var i = {
            selected: 0,
            theme: "basic",
            justified: !0,
            autoAdjustHeight: !0,
            backButtonSupport: !0,
            enableUrlHash: !0,
            transition: {
                animation: "none",
                speed: "400",
                easing: "",
                prefixCss: "",
                fwdShowCss: "",
                fwdHideCss: "",
                bckShowCss: "",
                bckHideCss: ""
            },
            toolbar: {
                position: "bottom",
                showNextButton: !0,
                showPreviousButton: !0,
                extraHtml: ""
            },
            anchor: {
                enableNavigation: true,
                enableNavigationAlways: true,
                enableDoneState: !0,
                markPreviousStepsAsDone: !0,
                unDoneOnBackNavigation: !1,
                enableDoneStateNavigation: !0
            },
            keyboard: {
                keyNavigation: !0,
                keyLeft: [37],
                keyRight: [39]
            },
            lang: {
                next: "Next",
                previous: "Previous"
            },
            style: {
                mainCss: "sw",
                navCss: "nav",
                navLinkCss: "nav-link",
                contentCss: "tab-content",
                contentPanelCss: "tab-pane",
                themePrefixCss: "sw-theme-",
                anchorDefaultCss: "default",
                anchorDoneCss: "done",
                anchorActiveCss: "active",
                anchorDisabledCss: "disabled",
                anchorHiddenCss: "hidden",
                anchorErrorCss: "error",
                anchorWarningCss: "warning",
                justifiedCss: "sw-justified",
                btnCss: "sw-btn",
                btnNextCss: "sw-btn-next",
                btnPrevCss: "sw-btn-prev",
                loaderCss: "sw-loading",
                progressCss: "progress",
                progressBarCss: "progress-bar",
                toolbarCss: "toolbar",
                toolbarPrefixCss: "toolbar-"
            },
            disabledSteps: [],
            errorSteps: [],
            warningSteps: [],
            hiddenSteps: [],
            getContent: null
        },
        e = function() {
            function n(t, s) {
                var e = this;
                _classCallCheck(this, n), this.options = l.extend(!0, {}, i, s), this.main = l(t), this.nav = this._getFirstDescendant("." + this.options.style.navCss), this.container = this._getFirstDescendant("." + this.options.style.contentCss), this.steps = this.nav.find("." + this.options.style.navLinkCss), this.pages = this.container.children("." + this.options.style.contentPanelCss), this.progressbar = this.main.find("." + this.options.style.progressCss), this.dir = this._getDir(), this.current_index = -1, this.is_init = !1, this._init(), setTimeout(function() {
                    e._load()
                }, 0)
            }
            return _createClass(n, [{
                key: "_init",
                value: function() {
                    if (this._setElements(), this._setToolbar(), !0 === this.is_init) return !0;
                    this._setEvents(), this.is_init = !0, this._triggerEvent("initialized")
                }
            }, {
                key: "_load",
                value: function() {
                    this.pages.hide(), this.steps.removeClass([this.options.style.anchorDoneCss, this.options.style.anchorActiveCss]), this.current_index = -1;
                    var t = (t = this._getURLHashIndex()) || this.options.selected,
                        s = this._getShowable(t - 1, "forward");
                    0 < (t = null === s && 0 < t ? this._getShowable(-1, "forward") : s) && this.options.anchor.enableDoneState && this.options.anchor.markPreviousStepsAsDone && this.steps.slice(0, t).addClass(this.options.style.anchorDoneCss), this._showStep(t), this._triggerEvent("loaded")
                }
            }, {
                key: "_getFirstDescendant",
                value: function(n) {
                    var i = this.main.children(n);
                    return 0 < i.length ? i : (this.main.children().each(function(t, s) {
                        var e = l(s).children(n);
                        if (0 < e.length) return i = e, !1
                    }), 0 < i.length ? i : (this._showError("Element not found " + n), !1))
                }
            }, {
                key: "_getDir",
                value: function() {
                    var t = this.main.prop("dir");
                    return 0 === t.length && (t = document.documentElement.dir, this.main.prop("dir", t)), t
                }
            }, {
                key: "_setElements",
                value: function() {
                    var e = this;
                    this.main.addClass(this.options.style.mainCss), this.main.removeClass(function(t, s) {
                        return (s.match(/(^|\s)sw-theme-\S+/g) || []).join(" ")
                    }).addClass(this.options.style.themePrefixCss + this.options.theme), this.main.toggleClass(this.options.style.justifiedCss, this.options.justified), !0 === this.options.anchor.enableNavigationAlways && !0 === this.options.anchor.enableNavigation || this.steps.addClass(this.options.style.anchorDefaultCss), l.each(this.options.disabledSteps, function(t, s) {
                        e.steps.eq(s).addClass(e.options.style.anchorDisabledCss)
                    }), l.each(this.options.errorSteps, function(t, s) {
                        e.steps.eq(s).addClass(e.options.style.anchorErrorCss)
                    }), l.each(this.options.warningSteps, function(t, s) {
                        e.steps.eq(s).addClass(e.options.style.anchorWarningCss)
                    }), l.each(this.options.hiddenSteps, function(t, s) {
                        e.steps.eq(s).addClass(e.options.style.anchorHiddenCss)
                    })
                }
            }, {
                key: "_setEvents",
                value: function() {
                    var e = this;
                    this.steps.on("click", function(t) {
                        var s;
                        t.preventDefault(), !0 === e.options.anchor.enableNavigation && (s = l(t.currentTarget), e._isShowable(s) && e._showStep(e.steps.index(s)))
                    }), this.main.on("click", function(t) {
                        l(t.target).hasClass(e.options.style.btnNextCss) ? (t.preventDefault(), e._navigate("next")) : l(t.target).hasClass(e.options.style.btnPrevCss) && (t.preventDefault(), e._navigate("prev"))
                    }), l(document).keyup(function(t) {
                        e._keyNav(t)
                    }), l(window).on("hashchange", function(t) {
                        var s;
                        !0 !== e.options.backButtonSupport || (s = e._getURLHashIndex()) && e._isShowable(e.steps.eq(s)) && (t.preventDefault(), e._showStep(s))
                    }), l(window).on("resize", function(t) {
                        e._fixHeight(e.current_index)
                    })
                }
            }, {
                key: "_setToolbar",
                value: function() {
                    this.main.find(".sw-toolbar-elm").remove();
                    var t = this.options.toolbar.position;
                    "none" !== t && ("both" == t ? (this.container.before(this._createToolbar("top")), this.container.after(this._createToolbar("bottom"))) : "top" == t ? this.container.before(this._createToolbar("top")) : this.container.after(this._createToolbar("bottom")))
                }
            }, {
                key: "_createToolbar",
                value: function(t) {
                    var s = l("<div></div>").addClass("sw-toolbar-elm d-none " + this.options.style.toolbarCss + " " + this.options.style.toolbarPrefixCss + t).attr("role", "toolbar"),
                        e = !1 !== this.options.toolbar.showNextButton ? l("<button></button>").text(this.options.lang.next).addClass("d-none btn " + this.options.style.btnNextCss + " " + this.options.style.btnCss).attr("type", "button") : null,
                        n = !1 !== this.options.toolbar.showPreviousButton ? l("<button></button>").text(this.options.lang.previous).addClass("d-none btn " + this.options.style.btnPrevCss + " " + this.options.style.btnCss).attr("type", "button") : null;
                    return s.append(n, e, this.options.toolbar.extraHtml)
                }
            }, {
                key: "_navigate",
                value: function(t) {
                    this._showStep(this._getShowable(this.current_index, t))
                }
            }, {
                key: "_showStep",
                value: function(n) {
                    var i = this;
                    if (-1 === n || null === n) return !1;
                    if (n == this.current_index) return !1;
                    if (!this.steps.eq(n)) return !1;
                    if (!this._isEnabled(this.steps.eq(n))) return !1;
                    var o = this._getStepDirection(n);
                    if (-1 !== this.current_index && !1 === this._triggerEvent("leaveStep", [this._getStepAnchor(this.current_index), this.current_index, n, o])) return !1;
                    this._loadContent(n, function() {
                        var t = i._getStepAnchor(n);
                        i._setURLHash(t.attr("href")), i._setAnchor(n);
                        var s = i._getStepPage(i.current_index),
                            e = i._getStepPage(n);
                        i._transit(e, s, o, function() {
                            i.current_index = n, i._fixHeight(n), i._setButtons(n), i._setProgressbar(n), i._triggerEvent("showStep", [t, n, o, i._getStepPosition(n)])
                        })
                    })
                }
            }, {
                key: "_getShowable",
                value: function(e, n) {
                    var i = this,
                        o = null;
                    return ("prev" == n ? l(this.steps.slice(0, e).get().reverse()) : this.steps.slice(e + 1)).each(function(t, s) {
                        if (i._isEnabled(l(s))) return o = "prev" == n ? e - (t + 1) : t + e + 1, !1
                    }), o
                }
            }, {
                key: "_isShowable",
                value: function(t) {
                    if (!this._isEnabled(t)) return !1;
                    var s = t.hasClass(this.options.style.anchorDoneCss);
                    return (!1 !== this.options.anchor.enableDoneStateNavigation || !s) && !(!1 === this.options.anchor.enableNavigationAlways && !s)
                }
            }, {
                key: "_isEnabled",
                value: function(t) {
                    return !t.hasClass(this.options.style.anchorDisabledCss) && !t.hasClass(this.options.style.anchorHiddenCss)
                }
            }, {
                key: "_getStepDirection",
                value: function(t) {
                    return this.current_index < t ? "forward" : "backward"
                }
            }, {
                key: "_getStepPosition",
                value: function(t) {
                    return 0 === t ? "first" : t === this.steps.length - 1 ? "last" : "middle"
                }
            }, {
                key: "_getStepAnchor",
                value: function(t) {
                    return null == t || -1 == t ? null : this.steps.eq(t)
                }
            }, {
                key: "_getStepPage",
                value: function(t) {
                    return null == t || -1 == t ? null : this.pages.eq(t)
                }
            }, {
                key: "_loadContent",
                value: function(t, s) {
                    var e, n, i, o;
                    l.isFunction(this.options.getContent) && (e = this._getStepPage(t)) ? (n = this._getStepDirection(t), i = this._getStepPosition(t), o = this._getStepAnchor(t), this.options.getContent(t, n, i, o, function(t) {
                        t && e.html(t), s()
                    })) : s()
                }
            }, {
                key: "_transit",
                value: function(s, e, t, n) {
                    var i = l.fn.smartWizard.transitions[this.options.transition.animation];
                    l.isFunction(i) ? i(s, e, t, this, function(t) {
                        !1 === t && (null !== e && e.hide(), s.show()), n()
                    }) : (null !== e && e.hide(), s.show(), n())
                }
            }, {
                key: "_fixHeight",
                value: function(t) {
                    var s;
                    !1 !== this.options.autoAdjustHeight && (s = this._getStepPage(t).outerHeight(), l.isFunction(this.container.finish) && l.isFunction(this.container.animate) && 0 < s ? this.container.finish().animate({
                        height: s
                    }, this.options.transition.speed) : this.container.css({
                        height: 0 < s ? s : "auto"
                    }))
                }
            }, {
                key: "_setAnchor",
                value: function(t) {
                    this.steps.eq(this.current_index).removeClass(this.options.style.anchorActiveCss), !1 !== this.options.anchor.enableDoneState && null !== this.current_index && 0 <= this.current_index && (this.steps.eq(this.current_index).addClass(this.options.style.anchorDoneCss), !1 !== this.options.anchor.unDoneOnBackNavigation && "backward" === this._getStepDirection(t) && this.steps.eq(this.current_index).removeClass(this.options.style.anchorDoneCss)), this.steps.eq(t).removeClass(this.options.style.anchorDoneCss), this.steps.eq(t).addClass(this.options.style.anchorActiveCss)
                }
            }, {
                key: "_setButtons",
                value: function(t) {
                    this.main.find("." + this.options.style.btnNextCss + ", ." + this.options.style.btnPrevCss).removeClass(this.options.style.anchorDisabledCss);
                    var s, e = this._getStepPosition(t);
                    "first" === e || "last" === e ? (s = "first" === e ? "." + this.options.style.btnPrevCss : "." + this.options.style.btnNextCss, this.main.find(s).addClass(this.options.style.anchorDisabledCss)) : (null === this._getShowable(t, "next") && this.main.find("." + this.options.style.btnNextCss).addClass(this.options.style.anchorDisabledCss), null === this._getShowable(t, "prev") && this.main.find("." + this.options.style.btnPrevCss).addClass(this.options.style.anchorDisabledCss))
                }
            }, {
                key: "_setProgressbar",
                value: function(t) {
                    var s = this.nav.width(),
                        e = s / this.steps.length * (t + 1) / s * 100;
                    document.documentElement.style.setProperty("--sw-progress-width", e + "%"), 0 < this.progressbar.length && this.progressbar.find("." + this.options.style.progressBarCss).css("width", e + "%")
                }
            }, {
                key: "_keyNav",
                value: function(t) {
                    if (this.options.keyboard.keyNavigation)
                        if (-1 < l.inArray(t.which, this.options.keyboard.keyLeft)) this._navigate("prev"), t.preventDefault();
                        else {
                            if (!(-1 < l.inArray(t.which, this.options.keyboard.keyRight))) return;
                            this._navigate("next"), t.preventDefault()
                        }
                }
            }, {
                key: "_triggerEvent",
                value: function(t, s) {
                    var e = l.Event(t);
                    return this.main.trigger(e, s), !e.isDefaultPrevented() && e.result
                }
            }, {
                key: "_setURLHash",
                value: function(t) {
                    this.options.enableUrlHash && window.location.hash !== t && history.pushState(null, null, t)
                }
            }, {
                key: "_getURLHashIndex",
                value: function() {
                    if (this.options.enableUrlHash) {
                        var t = window.location.hash;
                        if (0 < t.length) {
                            var s = this.nav.find("a[href*='" + t + "']");
                            if (0 < s.length) return this.steps.index(s)
                        }
                    }
                    return !1
                }
            }, {
                key: "_showError",
                value: function(t) {
                    console.error(t)
                }
            }, {
                key: "_changeState",
                value: function(t, s, e) {
                    var n = this;
                    e = !1 !== e;
                    var i = "";
                    "default" == s ? i = this.options.style.anchorDefaultCss : "active" == s ? i = this.options.style.anchorActiveCss : "done" == s ? i = this.options.style.anchorDoneCss : "disable" == s ? i = this.options.style.anchorDisabledCss : "hidden" == s ? i = this.options.style.anchorHiddenCss : "error" == s ? i = this.options.style.anchorErrorCss : "warning" == s && (i = this.options.style.anchorWarningCss), l.each(t, function(t, s) {
                        n.steps.eq(s).toggleClass(i, e)
                    })
                }
            }, {
                key: "goToStep",
                value: function(t, s) {
                    !0 != (s = !1 !== s) && !this._isShowable(this.steps.eq(t)) || (!0 === s && 0 < t && this.options.anchor.enableDoneState && this.options.anchor.markPreviousStepsAsDone && this.steps.slice(0, t).addClass(this.options.style.anchorDoneCss), this._showStep(t))
                }
            }, {
                key: "setState",
                value: function(t, s) {
                    this._changeState(t, s, !0)
                }
            }, {
                key: "unsetState",
                value: function(t, s) {
                    this._changeState(t, s, !1)
                }
            }, {
                key: "setOptions",
                value: function(t) {
                    this.options = l.extend(!0, {}, this.options, t), this._init()
                }
            }, {
                key: "getOptions",
                value: function() {
                    return this.options
                }
            }, {
                key: "getStepInfo",
                value: function() {
                    return {
                        currentStep: this.current_index ? this.current_index : 0,
                        totalSteps: this.steps ? this.steps.length : 0
                    }
                }
            }, {
                key: "loader",
                value: function(t) {
                    this.main.toggleClass(this.options.style.loaderCss, "show" === t)
                }
            }, {
                key: "fixHeight",
                value: function() {
                    this._fixHeight(this.current_index)
                }
            }]), n
        }();
    l.fn.smartWizard = function(t) {
        if (void 0 === t || "object" === _typeof(t)) return this.each(function() {
            l.data(this, "smartWizard") || l.data(this, "smartWizard", new e(this, t))
        });
        if ("string" == typeof t && "_" !== t[0] && "init" !== t) {
            var s = l.data(this[0], "smartWizard");
            return "destroy" === t && l.data(this, "smartWizard", null), s instanceof e && "function" == typeof s[t] ? s[t].apply(s, Array.prototype.slice.call(arguments, 1)) : this
        }
    }, l.fn.smartWizard.transitions = {
        fade: function(t, s, e, n, i) {
            l.isFunction(t.fadeOut) ? s ? s.fadeOut(n.options.transition.speed, n.options.transition.easing, function() {
                t.fadeIn(n.options.transition.speed, n.options.transition.easing, function() {
                    i()
                })
            }) : t.fadeIn(n.options.transition.speed, n.options.transition.easing, function() {
                i()
            }) : i(!1)
        },
        slideSwing: function(t, s, e, n, i) {
            l.isFunction(t.slideDown) ? s ? s.slideUp(n.options.transition.speed, n.options.transition.easing, function() {
                t.slideDown(n.options.transition.speed, n.options.transition.easing, function() {
                    i()
                })
            }) : t.slideDown(n.options.transition.speed, n.options.transition.easing, function() {
                i()
            }) : i(!1)
        },
        slideHorizontal: function(t, s, e, i, n) {
            var o, a, r, h;
            l.isFunction(t.animate) ? (o = function(t, s, e, n) {
                t.css({
                    position: "absolute",
                    left: s
                }).show().animate({
                    left: e
                }, i.options.transition.speed, i.options.transition.easing, n)
            }, -1 == i.current_index && i.container.height(t.outerHeight()), a = i.container.width(), s && (r = s.css(["position", "left"]), o(s, 0, a * ("backward" == e ? 1 : -1), function() {
                s.hide().css(r)
            })), h = t.css(["position"]), o(t, a * ("backward" == e ? -2 : 1), 0, function() {
                t.css(h), n()
            })) : n(!1)
        },
        slideVertical: function(t, s, e, i, n) {
            var o, a, r, h;
            l.isFunction(t.animate) ? (o = function(t, s, e, n) {
                t.css({
                    position: "absolute",
                    top: s
                }).show().animate({
                    top: e
                }, i.options.transition.speed, i.options.transition.easing, n)
            }, -1 == i.current_index && i.container.height(t.outerHeight()), a = i.container.height(), s && (r = s.css(["position", "top"]), o(s, 0, a * ("backward" == e ? -1 : 1), function() {
                s.hide().css(r)
            })), h = t.css(["position"]), o(t, a * ("backward" == e ? 1 : -2), 0, function() {
                t.css(h), n()
            })) : n(!1)
        },
        css: function(t, s, e, n, i) {
            var o, a, r;
            0 != n.options.transition.fwdHideCss.length && 0 != n.options.transition.bckHideCss.length ? (o = function(t, s, e) {
                s && 0 != s.length || e(), t.addClass(s).one("animationend", function(t) {
                    l(t.currentTarget).removeClass(s), e()
                }), t.addClass(s).one("animationcancel", function(t) {
                    l(t.currentTarget).removeClass(s), e("cancel")
                })
            }, a = n.options.transition.prefixCss + " " + ("backward" == e ? n.options.transition.bckShowCss : n.options.transition.fwdShowCss), s ? (r = n.options.transition.prefixCss + " " + ("backward" == e ? n.options.transition.bckHideCss : n.options.transition.fwdHideCss), o(s, r, function() {
                s.hide(), o(t, a, function() {
                    i()
                }), t.show()
            })) : (o(t, a, function() {
                i()
            }), t.show())) : i(!1)
        }
    }
});