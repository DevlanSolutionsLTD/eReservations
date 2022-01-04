"use strict";
!(function (r, u) {
  (r.Package.name = "DashLite"), (r.Package.version = "1.4.0");
  var c = u(window),
    l = u("body"),
    d = u(document),
    t = "nk-menu",
    f = "nk-header-menu",
    o = "nk-aside",
    g = "nk-sidebar",
    e = "nk-sidebar-mobile",
    n = "nk-sidebar-fat",
    i = "nk-sidebar-short",
    a = "nk-content-sidebar",
    p = r.Break;
  function h(e, n) {
    return (
      Object.keys(n).forEach(function (t) {
        e[t] = n[t];
      }),
      e
    );
  }
  (r.ClassBody = function () {
    r.AddInBody(o),
      r.AddInBody("nk-apps-sidebar"),
      r.AddInBody(g),
      r.AddInBody(n);
  }),
    (r.ClassNavMenu = function () {
      r.BreakClass("." + f, p.lg, { timeOut: 0 }),
        r.BreakClass("." + o, p.lg, { timeOut: 0 }),
        r.BreakClass("." + a, p.lg, { timeOut: 0 }),
        r.BreakClass("." + g, p.lg, { timeOut: 0, classAdd: e, ignore: i }),
        r.BreakClass("." + n, p.xl, { timeOut: 0, classAdd: e }),
        r.BreakClass("." + i, p.md, { timeOut: 0, classAdd: e }),
        c.on("resize", function () {
          r.BreakClass("." + f, p.lg),
            r.BreakClass("." + o, p.lg),
            r.BreakClass("." + a, p.lg),
            r.BreakClass("." + g, p.lg, { classAdd: e, ignore: i }),
            r.BreakClass("." + n, p.xl, { classAdd: e }),
            r.BreakClass("." + i, p.md, { classAdd: e });
        });
    }),
    (r.Prettify = function () {
      window.prettyPrint && prettyPrint();
    }),
    (r.Copied = function () {
      var t = ".clipboard-init",
        c = ".clipboard-text",
        l = "clipboard-success",
        d = "clipboard-error";
      function e(t, e) {
        var n = u(t),
          i = n.parent(),
          a = { text: "Copy", done: "Copied", fail: "Failed" },
          o = {
            text: n.data("clip-text"),
            done: n.data("clip-success"),
            fail: n.data("clip-error"),
          };
        (a.text = o.text ? o.text : a.text),
          (a.done = o.done ? o.done : a.done),
          (a.fail = o.fail ? o.fail : a.fail);
        var s = "success" === e ? a.done : a.fail,
          r = "success" === e ? l : d;
        i.addClass(r).find(c).html(s),
          setTimeout(function () {
            i
              .removeClass(l + " " + d)
              .find(c)
              .html(a.text)
              .blur(),
              i.find("input").blur();
          }, 2e3);
      }
      ClipboardJS.isSupported()
        ? new ClipboardJS(t)
            .on("success", function (t) {
              e(t.trigger, "success"), t.clearSelection();
            })
            .on("error", function (t) {
              e(t.trigger, "error");
            })
        : u(t).css("display", "none");
    }),
    (r.CurrentLink = function () {
      var t = window.location.href,
        n = (n = t.substring(
          0,
          -1 == t.indexOf("#") ? t.length : t.indexOf("#")
        )).substring(0, -1 == n.indexOf("?") ? n.length : n.indexOf("?"));
      u(".nk-menu-link, .menu-link, .nav-link").each(function () {
        var t = u(this),
          e = t.attr("href");
        n.match(e)
          ? (t
              .closest("li")
              .addClass("active current-page")
              .parents()
              .closest("li")
              .addClass("active current-page"),
            t.closest("li").children(".nk-menu-sub").css("display", "block"),
            t
              .parents()
              .closest("li")
              .children(".nk-menu-sub")
              .css("display", "block"))
          : t
              .closest("li")
              .removeClass("active current-page")
              .parents()
              .closest("li:not(.current-page)")
              .removeClass("active");
      });
    }),
    (r.PassSwitch = function () {
      r.Passcode(".passcode-switch");
    }),
    (r.Toast = function (t, e, n) {
      var i,
        a =
          "info" === (e = e || "info")
            ? "ni ni-info-fill"
            : "success" === e
            ? "ni ni-check-circle-fill"
            : "error" === e
            ? "ni ni-cross-circle-fill"
            : "warning" === e
            ? "ni ni-alert-fill"
            : "",
        o = { position: "bottom-right", ui: "", icon: "auto", clear: !1 },
        s = n ? h(o, n) : o;
      if (
        ((s.position = s.position
          ? "toast-" + s.position
          : "toast-bottom-right"),
        (s.icon = "auto" === s.icon ? a : s.icon ? s.icon : ""),
        (s.ui = s.ui ? " " + s.ui : ""),
        (i =
          "" !== s.icon
            ? '<span class="toastr-icon"><em class="icon ' +
              s.icon +
              '"></em></span>'
            : ""),
        "" !==
          (t = "" !== t ? i + '<div class="toastr-text">' + t + "</div>" : ""))
      ) {
        !0 === s.clear && toastr.clear();
        var r = {
          closeButton: !0,
          debug: !1,
          newestOnTop: !1,
          progressBar: !1,
          positionClass: s.position + s.ui,
          closeHtml: '<span class="btn-trigger">Close</span>',
          preventDuplicates: !0,
          showDuration: "1500",
          hideDuration: "1500",
          timeOut: "2000",
          toastClass: "toastr",
          extendedTimeOut: "3000",
        };
        (toastr.options = h(r, s)), toastr[e](t);
      }
    }),
    (r.TGL.screen = function (t) {
      u(t).exists() &&
        u(t).each(function () {
          var t = u(this).data("toggle-screen");
          t && u(this).addClass("toggle-screen-" + t);
        });
    }),
    (r.TGL.content = function (t, e) {
      var n = u(t || ".toggle"),
        i = u("[data-content]"),
        a = !1,
        o = { active: "active", content: "content-active", break: !0 },
        s = e ? h(o, e) : o;
      r.TGL.screen(i),
        n.on("click", function (t) {
          (a = this),
            r.Toggle.trigger(u(this).data("target"), s),
            t.preventDefault();
        }),
        d.on("mouseup", function (t) {
          if (a) {
            var e = u(a);
            e.is(t.target) ||
              0 !== e.has(t.target).length ||
              i.is(t.target) ||
              0 !== i.has(t.target).length ||
              (r.Toggle.removed(e.data("target"), s), (a = !1));
          }
        }),
        c.on("resize", function () {
          i.each(function () {
            var t = u(this).data("content"),
              e = u(this).data("toggle-screen"),
              n = p[e];
            r.Win.width > n && r.Toggle.removed(t, s);
          });
        });
    }),
    (r.TGL.expand = function (t, e) {
      var n = t || ".expand",
        i = { toggle: !0 },
        a = e ? h(i, e) : i;
      u(n).on("click", function (t) {
        r.Toggle.trigger(u(this).data("target"), a), t.preventDefault();
      });
    }),
    (r.TGL.ddmenu = function (t, e) {
      var n = t || ".nk-menu-toggle",
        i = { active: "active", self: "nk-menu-toggle", child: "nk-menu-sub" },
        a = e ? h(i, e) : i;
      u(n).on("click", function (t) {
        (r.Win.width < p.lg ||
          u(this).parents().hasClass(g) ||
          u(this).parents().hasClass(o)) &&
          r.Toggle.dropMenu(u(this), a),
          t.preventDefault();
      });
    }),
    (r.TGL.showmenu = function (t, e) {
      var n = u(t || ".nk-nav-toggle"),
        i = u("[data-content]"),
        a = l.hasClass("short-nav") || i.hasClass(f) ? p.lg : p.xl,
        o = {
          active: "toggle-active",
          content: g + "-active",
          body: "nav-shown",
          overlay: "nk-sidebar-overlay",
          break: a,
          close: { profile: !0, menu: !1 },
        },
        s = e ? h(o, e) : o;
      n.on("click", function (t) {
        r.Toggle.trigger(u(this).data("target"), s), t.preventDefault();
      }),
        d.on("mouseup", function (t) {
          !n.is(t.target) &&
            0 === n.has(t.target).length &&
            !i.is(t.target) &&
            0 === i.has(t.target).length &&
            r.Win.width < a &&
            r.Toggle.removed(n.data("target"), s);
        }),
        c.on("resize", function () {
          (r.Win.width < p.xl || r.Win.width < a) &&
            r.Toggle.removed(n.data("target"), s);
        });
    }),
    (r.Ani.formSearch = function (t, e) {
      var n = { active: "active", timeout: 400, target: "[data-search]" },
        a = e ? h(n, e) : n,
        i = u(t),
        o = u(a.target);
      i.exists() &&
        (i.on("click", function (t) {
          t.preventDefault();
          var e = u(this).data("target"),
            n = u("[data-search=" + e + "]"),
            i = u("[data-target=" + e + "]");
          n.hasClass(a.active)
            ? (i.add(n).removeClass(a.active),
              setTimeout(function () {
                n.find("input").val("");
              }, a.timeout))
            : (i.add(n).addClass(a.active), n.find("input").focus());
        }),
        d.on({
          keyup: function (t) {
            "Escape" === t.key && i.add(o).removeClass(a.active);
          },
          mouseup: function (t) {
            o.find("input").val() ||
              o.is(t.target) ||
              0 !== o.has(t.target).length ||
              i.is(t.target) ||
              0 !== i.has(t.target).length ||
              i.add(o).removeClass(a.active);
          },
        }));
    }),
    (r.Ani.formElm = function (t, e) {
      var n = { focus: "focused" },
        i = e ? h(n, e) : n;
      u(t).exists() &&
        u(t).each(function () {
          var t = u(this);
          t.val() && t.parent().addClass(i.focus),
            t.on({
              focus: function () {
                t.parent().addClass(i.focus);
              },
              blur: function () {
                t.val() || t.parent().removeClass(i.focus);
              },
            });
        });
    }),
    (r.Validate = function (t, n) {
      u(t).exists() &&
        u(t).each(function () {
          var t = { errorElement: "span" },
            e = n ? h(t, n) : t;
          u(this).validate(e);
        });
    }),
    (r.Validate.init = function () {
      r.Validate(".form-validate", {
        errorElement: "span",
        errorClass: "invalid",
        errorPlacement: function (t, e) {
          t.appendTo(e.parent());
        },
      });
    }),
    (r.Dropzone = function (t, n) {
      u(t).exists() &&
        u(t).each(function () {
          var t = { autoDiscover: !1 },
            e = n ? h(t, n) : t;
          u(this).addClass("dropzone").dropzone(e);
        });
    }),
    (r.DataTable = function (t, i) {
      u(t).exists() &&
        u(t).each(function () {
          var t = u(this).data("auto-responsive"),
            e = {
              responsive: !0,
              autoWidth: !1,
              dom:
                '<"row justify-between g-2"<"col-7 col-sm-6 text-left"f><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>',
              language: {
                search: "",
                searchPlaceholder: "Type in to Search",
                lengthMenu:
                  "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                info: "_START_ -_END_ of _TOTAL_",
                infoEmpty: "No records found",
                infoFiltered: "( Total _MAX_  )",
                paginate: {
                  first: "First",
                  last: "Last",
                  next: "Next",
                  previous: "Prev",
                },
              },
            },
            n = i ? h(e, i) : e;
          (n = !1 === t ? h(n, { responsive: !1 }) : n), u(this).DataTable(n);
        });
    }),
    (r.BS.ddfix = function (t, e) {
      var n =
        e ||
        "a:not(.clickable), button:not(.clickable), a:not(.clickable) *, button:not(.clickable) *";
      u(t || ".dropdown-menu").on("click", function (t) {
        u(t.target).is(n) || t.stopPropagation();
      });
    }),
    (r.BS.tabfix = function (t) {
      u(t || '[data-toggle="modal"]').on("click", function () {
        var t = u(this),
          e = t.data("target"),
          n = t.attr("href"),
          i = t.data("tab-target"),
          a = e ? l.find(e) : l.find(n);
        if (i && "#" !== i && a) a.find('[href="' + i + '"]').tab("show");
        else if (a) {
          var o = a.find(".nk-nav.nav-tabs"),
            s = u(o[0]).find('[data-toggle="tab"]');
          u(s[0]).tab("show");
        }
      });
    }),
    (r.Knob.init = function () {
      var t = { readOnly: !0, lineCap: "round" },
        e = { angleOffset: -90, angleArc: 180, readOnly: !0, lineCap: "round" };
      r.Knob(".knob", t), r.Knob(".knob-half", e);
    }),
    (r.Range.init = function () {
      r.Range(".form-range-slider");
    }),
    (r.Select2.init = function () {
      r.Select2(".form-select");
    }),
    (r.Slider.init = function () {
      r.Slick(".slider-init");
    }),
    (r.Dropzone.init = function () {
      r.Dropzone(".upload-zone", { url: "/images" });
    }),
    (r.DataTable.init = function () {
      r.DataTable(".datatable-init", { responsive: { details: !0 } }),
        (u.fn.DataTable.ext.pager.numbers_length = 7);
    }),
    (r.OtherInit = function () {
      r.ClassBody(),
        r.PassSwitch(),
        r.CurrentLink(),
        r.LinkOff(".is-disable"),
        r.ClassNavMenu();
    }),
    (r.Ani.init = function () {
      r.Ani.formElm(".form-control-animate"),
        r.Ani.formSearch(".toggle-search");
    }),
    (r.BS.init = function () {
      r.BS.menutip("a.nk-menu-link"),
        r.BS.tooltip(".nk-tooltip"),
        r.BS.tooltip(".btn-tooltip", { placement: "top" }),
        r.BS.tooltip('[data-toggle="tooltip"]'),
        r.BS.tooltip(".tipinfo,.nk-menu-tooltip", { placement: "right" }),
        r.BS.popover('[data-toggle="popover"]'),
        r.BS.progress("[data-progress]"),
        r.BS.fileinput(".custom-file-input"),
        r.BS.modalfix(),
        r.BS.ddfix(),
        r.BS.tabfix();
    }),
    (r.Picker.init = function () {
      r.Picker.date(".date-picker"),
        r.Picker.dob(".date-picker-alt"),
        r.Picker.time(".time-picker");
    }),
    (r.Addons.Init = function () {
      r.Knob.init(),
        r.Range.init(),
        r.Select2.init(),
        r.Dropzone.init(),
        r.Slider.init(),
        r.DataTable.init();
    }),
    (r.TGL.init = function () {
      r.TGL.content(".toggle"),
        r.TGL.expand(".toggle-expand"),
        r.TGL.expand(".toggle-opt", { toggle: !1 }),
        r.TGL.showmenu(".nk-nav-toggle"),
        r.TGL.ddmenu("." + t + "-toggle", {
          self: t + "-toggle",
          child: t + "-sub",
        });
    }),
    (r.BS.modalOnInit = function () {
      u(".modal").on("shown.bs.modal", function () {
        r.Select2.init(), r.Validate.init();
      });
    }),
    (r.init = function () {
      r.coms.docReady.push(r.OtherInit),
        r.coms.docReady.push(r.Prettify),
        r.coms.docReady.push(r.ColorBG),
        r.coms.docReady.push(r.ColorTXT),
        r.coms.docReady.push(r.Copied),
        r.coms.docReady.push(r.Ani.init),
        r.coms.docReady.push(r.TGL.init),
        r.coms.docReady.push(r.BS.init),
        r.coms.docReady.push(r.Validate.init),
        r.coms.docReady.push(r.Picker.init),
        r.coms.docReady.push(r.Addons.Init);
    }),
    r.init();
})(NioApp, jQuery);
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * Repository: https://github.com/shaack/bootstrap-input-spinner
 * License: MIT, see file 'LICENSE'
 */

(function ($) {
  "use strict";

  // the default editor for parsing and rendering
  var I18nEditor = function (props, element) {
    var locale = props.locale || "en-US";

    this.parse = function (customFormat) {
      var numberFormat = new Intl.NumberFormat(locale);
      var thousandSeparator =
        numberFormat.format(11111).replace(/1/g, "") || ".";
      var decimalSeparator = numberFormat.format(1.1).replace(/1/g, "");
      return parseFloat(
        customFormat
          .replace(new RegExp(" ", "g"), "")
          .replace(new RegExp("\\" + thousandSeparator, "g"), "")
          .replace(new RegExp("\\" + decimalSeparator), ".")
      );
    };

    this.render = function (number) {
      var decimals = parseInt(element.getAttribute("data-decimals")) || 0;
      var digitGrouping = !(
        element.getAttribute("data-digit-grouping") === "false"
      );
      var numberFormat = new Intl.NumberFormat(locale, {
        minimumFractionDigits: decimals,
        maximumFractionDigits: decimals,
        useGrouping: digitGrouping,
      });
      return numberFormat.format(number);
    };
  };

  var triggerKeyPressed = false;
  var originalVal = $.fn.val;
  $.fn.val = function (value) {
    if (arguments.length >= 1) {
      for (var i = 0; i < this.length; i++) {
        if (this[i]["bootstrap-input-spinner"] && this[i].setValue) {
          this[i].setValue(value);
        }
      }
    }
    return originalVal.apply(this, arguments);
  };

  $.fn.inputSpinner = function (methodOrProps) {
    if (methodOrProps === "destroy") {
      this.each(function () {
        if (this["bootstrap-input-spinner"]) {
          this.destroyInputSpinner();
        } else {
          console.warn("element", this, "is no bootstrap-input-spinner");
        }
      });
      return this;
    }

    var props = {
      decrementButton: "<strong>&minus;</strong>", // button text
      incrementButton: "<strong>&plus;</strong>", // ..
      groupClass: "", // css class of the resulting input-group
      buttonsClass: "btn-outline-secondary",
      buttonsWidth: "2.5rem",
      textAlign: "center", // alignment of the entered number
      autoDelay: 500, // ms threshold before auto value change
      autoInterval: 50, // speed of auto value change, set to `undefined` to disable auto-change
      buttonsOnly: false, // set this `true` to disable the possibility to enter or paste the number via keyboard
      keyboardStepping: true, // set this to `false` to disallow the use of the up and down arrow keys to step
      locale: navigator.language, // the locale, per default detected automatically from the browser
      editor: I18nEditor, // the editor (parsing and rendering of the input)
      // the template of the input
      template:
        '<div class="input-group ${groupClass}">' +
        '<button style="min-width: ${buttonsWidth}" class="btn btn-decrement ${buttonsClass} btn-minus" type="button">${decrementButton}</button>' +
        '<input type="text" inputmode="decimal" style="text-align: ${textAlign}" class="form-control form-control-text-input"/>' +
        '<button style="min-width: ${buttonsWidth}" class="btn btn-increment ${buttonsClass} btn-plus" type="button">${incrementButton}</button>' +
        "</div>",
    };

    for (var option in methodOrProps) {
      // noinspection JSUnfilteredForInLoop
      props[option] = methodOrProps[option];
    }

    var html = props.template
      .replace(/\${groupClass}/g, props.groupClass)
      .replace(/\${buttonsWidth}/g, props.buttonsWidth)
      .replace(/\${buttonsClass}/g, props.buttonsClass)
      .replace(/\${decrementButton}/g, props.decrementButton)
      .replace(/\${incrementButton}/g, props.incrementButton)
      .replace(/\${textAlign}/g, props.textAlign);

    this.each(function () {
      if (this["bootstrap-input-spinner"]) {
        console.warn("element", this, "is already a bootstrap-input-spinner");
      } else {
        var $original = $(this);
        $original[0]["bootstrap-input-spinner"] = true;
        $original.hide();
        $original[0].inputSpinnerEditor = new props.editor(props, this);

        var autoDelayHandler = null;
        var autoIntervalHandler = null;

        var $inputGroup = $(html);
        var $buttonDecrement = $inputGroup.find(".btn-decrement");
        var $buttonIncrement = $inputGroup.find(".btn-increment");
        var $input = $inputGroup.find("input");
        var $label = $("label[for='" + $original.attr("id") + "']");
        if (!$label[0]) {
          $label = $original.closest("label");
        }

        var min = null;
        var max = null;
        var step = null;

        updateAttributes();

        var value = parseFloat($original[0].value);
        var pointerState = false;

        var prefix = $original.attr("data-prefix") || "";
        var suffix = $original.attr("data-suffix") || "";

        if (prefix) {
          var prefixElement = $(
            '<span class="input-group-text">' + prefix + "</span>"
          );
          $inputGroup.find("input").before(prefixElement);
        }
        if (suffix) {
          var suffixElement = $(
            '<span class="input-group-text">' + suffix + "</span>"
          );
          $inputGroup.find("input").after(suffixElement);
        }

        $original[0].setValue = function (newValue) {
          setValue(newValue);
        };
        $original[0].destroyInputSpinner = function () {
          destroy();
        };

        var observer = new MutationObserver(function () {
          updateAttributes();
          setValue(value, true);
        });
        observer.observe($original[0], { attributes: true });

        $original.after($inputGroup);

        setValue(value);

        $input
          .on("paste input change focusout", function (event) {
            var newValue = $input[0].value;
            var focusOut = event.type === "focusout";
            newValue = $original[0].inputSpinnerEditor.parse(newValue);
            setValue(newValue, focusOut);
            dispatchEvent($original, event.type);
          })
          .on("keydown", function (event) {
            if (props.keyboardStepping) {
              if (event.which === 38) {
                // up arrow pressed
                event.preventDefault();
                if (!$buttonDecrement.prop("disabled")) {
                  stepHandling(step);
                }
              } else if (event.which === 40) {
                // down arrow pressed
                event.preventDefault();
                if (!$buttonIncrement.prop("disabled")) {
                  stepHandling(-step);
                }
              }
            }
          })
          .on("keyup", function (event) {
            // up/down arrow released
            if (
              props.keyboardStepping &&
              (event.which === 38 || event.which === 40)
            ) {
              event.preventDefault();
              resetTimer();
            }
          });

        // decrement button
        onPointerDown($buttonDecrement[0], function () {
          if (!$buttonDecrement.prop("disabled")) {
            pointerState = true;
            stepHandling(-step);
          }
        });
        // increment button
        onPointerDown($buttonIncrement[0], function () {
          if (!$buttonIncrement.prop("disabled")) {
            pointerState = true;
            stepHandling(step);
          }
        });
        onPointerUp(document.body, function () {
          if (pointerState === true) {
            resetTimer();
            dispatchEvent($original, "change");
            pointerState = false;
          }
        });
      }

      function setValue(newValue, updateInput) {
        if (updateInput === undefined) {
          updateInput = true;
        }
        if (isNaN(newValue) || newValue === "") {
          $original[0].value = "";
          if (updateInput) {
            $input[0].value = "";
          }
          value = NaN;
        } else {
          newValue = parseFloat(newValue);
          newValue = Math.min(Math.max(newValue, min), max);
          $original[0].value = newValue;
          if (updateInput) {
            $input[0].value = $original[0].inputSpinnerEditor.render(newValue);
          }
          value = newValue;
        }
      }

      function destroy() {
        $original.prop("required", $input.prop("required"));
        observer.disconnect();
        resetTimer();
        $input.off("paste input change focusout");
        $inputGroup.remove();
        $original.show();
        $original[0]["bootstrap-input-spinner"] = undefined;
        if ($label[0]) {
          $label.attr("for", $original.attr("id"));
        }
      }

      function dispatchEvent($element, type) {
        if (type) {
          setTimeout(function () {
            var event;
            if (typeof Event === "function") {
              event = new Event(type, { bubbles: true });
            } else {
              // IE
              event = document.createEvent("Event");
              event.initEvent(type, true, true);
            }
            $element[0].dispatchEvent(event);
          });
        }
      }

      function stepHandling(step) {
        calcStep(step);
        resetTimer();
        if (props.autoInterval !== undefined) {
          autoDelayHandler = setTimeout(function () {
            autoIntervalHandler = setInterval(function () {
              calcStep(step);
            }, props.autoInterval);
          }, props.autoDelay);
        }
      }

      function calcStep(step) {
        if (isNaN(value)) {
          value = 0;
        }
        setValue(Math.round(value / step) * step + step);
        dispatchEvent($original, "input");
      }

      function resetTimer() {
        clearTimeout(autoDelayHandler);
        clearTimeout(autoIntervalHandler);
      }

      function updateAttributes() {
        // copy properties from original to the new input
        if ($original.prop("required")) {
          $input.prop("required", $original.prop("required"));
          $original.removeAttr("required");
        }
        $input.prop("placeholder", $original.prop("placeholder"));
        $input.attr("inputmode", $original.attr("inputmode") || "decimal");
        var disabled = $original.prop("disabled");
        var readonly = $original.prop("readonly");
        $input.prop("disabled", disabled);
        $input.prop("readonly", readonly || props.buttonsOnly);
        $buttonIncrement.prop("disabled", disabled || readonly);
        $buttonDecrement.prop("disabled", disabled || readonly);
        if (disabled || readonly) {
          resetTimer();
        }
        var originalClass = $original.prop("class");
        var groupClass = "";
        // sizing
        if (/form-control-sm/g.test(originalClass)) {
          groupClass = "input-group-sm";
        } else if (/form-control-lg/g.test(originalClass)) {
          groupClass = "input-group-lg";
        }
        var inputClass = originalClass.replace(/form-control(-(sm|lg))?/g, "");
        $inputGroup.prop(
          "class",
          "input-group " + groupClass + " " + props.groupClass
        );
        $input.prop("class", "form-control " + inputClass);

        // update the main attributes
        min =
          isNaN($original.prop("min")) || $original.prop("min") === ""
            ? -Infinity
            : parseFloat($original.prop("min"));
        max =
          isNaN($original.prop("max")) || $original.prop("max") === ""
            ? Infinity
            : parseFloat($original.prop("max"));
        step = parseFloat($original.prop("step")) || 1;
        if ($original.attr("hidden")) {
          $inputGroup.attr("hidden", $original.attr("hidden"));
        } else {
          $inputGroup.removeAttr("hidden");
        }
        if ($original.attr("id")) {
          $input.attr("id", $original.attr("id") + "_MP_cBdLN29i2");
          if ($label[0]) {
            $label.attr("for", $input.attr("id"));
          }
        }
      }
    });

    return this;
  };

  function onPointerUp(element, callback) {
    element.addEventListener("mouseup", function (e) {
      callback(e);
    });
    element.addEventListener("touchend", function (e) {
      callback(e);
    });
    element.addEventListener("keyup", function (e) {
      if (e.keyCode === 32 || e.keyCode === 13) {
        triggerKeyPressed = false;
        callback(e);
      }
    });
  }

  function onPointerDown(element, callback) {
    element.addEventListener("mousedown", function (e) {
      if (e.button === 0) {
        e.preventDefault();
        callback(e);
      }
    });
    element.addEventListener("touchstart", function (e) {
      if (e.cancelable) {
        e.preventDefault();
      }
      callback(e);
    });
    element.addEventListener("keydown", function (e) {
      if ((e.keyCode === 32 || e.keyCode === 13) && !triggerKeyPressed) {
        triggerKeyPressed = true;
        callback(e);
      }
    });
  }
})(jQuery);
