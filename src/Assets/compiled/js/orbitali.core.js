"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/orbitali.core"],{

/***/ "./storage/orbitali/src/Assets/source/js/dashmix/app.js":
/*!**************************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/js/dashmix/app.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ App)
/* harmony export */ });
/* harmony import */ var _images_favicon_png__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../images/favicon.png */ "./storage/orbitali/src/Assets/source/images/favicon.png");
/* harmony import */ var clockwork_browser_metrics__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! clockwork-browser/metrics */ "./node_modules/.pnpm/clockwork-browser@1.1.1/node_modules/clockwork-browser/metrics.js");
/* harmony import */ var select2__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! select2 */ "./node_modules/.pnpm/select2@4.0.13/node_modules/select2/dist/js/select2.js");
/* harmony import */ var select2__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(select2__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var bootstrap_notify__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! bootstrap-notify */ "./node_modules/.pnpm/bootstrap-notify@3.1.3/node_modules/bootstrap-notify/bootstrap-notify.js");
/* harmony import */ var bootstrap_notify__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(bootstrap_notify__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var dropzone__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! dropzone */ "./node_modules/.pnpm/dropzone@5.5.1/node_modules/dropzone/dist/dropzone.js");
/* harmony import */ var dropzone__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(dropzone__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var imask__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! imask */ "./node_modules/.pnpm/imask@6.6.1/node_modules/imask/esm/index.js");
/* harmony import */ var quill__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! quill */ "./node_modules/.pnpm/quill@1.3.7/node_modules/quill/dist/quill.js");
/* harmony import */ var quill__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(quill__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _chuyik_quill_blot_formatter__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @chuyik/quill-blot-formatter */ "./node_modules/.pnpm/@chuyik+quill-blot-formatter@1.2.0_quill@1.3.7/node_modules/@chuyik/quill-blot-formatter/dist/index.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! bootstrap */ "./node_modules/.pnpm/bootstrap@5.2.3_@popperjs+core@2.11.7/node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var jquery_appear__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! jquery.appear */ "./node_modules/.pnpm/jquery.appear@1.0.1/node_modules/jquery.appear/jquery.appear.js");
/* harmony import */ var jquery_appear__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(jquery_appear__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var jquery_scroll_lock__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! jquery-scroll-lock */ "./node_modules/.pnpm/jquery-scroll-lock@3.1.3/node_modules/jquery-scroll-lock/jquery-scrollLock.js");
/* harmony import */ var jquery_scroll_lock__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(jquery_scroll_lock__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var dragula__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! dragula */ "./node_modules/.pnpm/dragula@3.7.3/node_modules/dragula/dragula.js");
/* harmony import */ var dragula__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(dragula__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var _modules_template__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./modules/template */ "./storage/orbitali/src/Assets/source/js/dashmix/modules/template.js");
/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "./node_modules/.pnpm/jquery@3.7.0/node_modules/jquery/dist/jquery.js");
/* provided dependency */ var $ = __webpack_require__(/*! jquery */ "./node_modules/.pnpm/jquery@3.7.0/node_modules/jquery/dist/jquery.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(arr, i) { var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"]; if (null != _i) { var _s, _e, _x, _r, _arr = [], _n = !0, _d = !1; try { if (_x = (_i = _i.call(arr)).next, 0 === i) { if (Object(_i) !== _i) return; _n = !1; } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0); } catch (err) { _d = !0, _e = err; } finally { try { if (!_n && null != _i["return"] && (_r = _i["return"](), Object(_r) !== _r)) return; } finally { if (_d) throw _e; } } return _arr; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _get() { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get.bind(); } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(arguments.length < 3 ? target : receiver); } return desc.value; }; } return _get.apply(this, arguments); }
function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }








quill__WEBPACK_IMPORTED_MODULE_6___default().register('modules/blotFormatter', _chuyik_quill_blot_formatter__WEBPACK_IMPORTED_MODULE_7__["default"]);




//import SimpleBar from "simplebar";


String.prototype.to128Charset = function () {
  return this.replace('Ğ', 'g').replace('Ü', 'u').replace('Ş', 's').replace('I', 'i').replace('İ', 'i').replace('Ö', 'o').replace('Ç', 'c').replace('ğ', 'g').replace('ü', 'u').replace('ş', 's').replace('ı', 'i').replace('ö', 'o').replace('ç', 'c');
};
var App = /*#__PURE__*/function (_Template) {
  _inherits(App, _Template);
  var _super = _createSuper(App);
  function App() {
    _classCallCheck(this, App);
    return _super.call(this);
  }
  _createClass(App, [{
    key: "_uiInit",
    value: function _uiInit() {
      this.fileSvgs = {
        file: __webpack_require__(/*! ../../images/filetypes/file.svg */ "./storage/orbitali/src/Assets/source/images/filetypes/file.svg"),
        pdf: __webpack_require__(/*! ../../images/filetypes/pdf.svg */ "./storage/orbitali/src/Assets/source/images/filetypes/pdf.svg")
      };
      jQuery.expr[":"].hasData = function (obj, index, meta, stack) {
        return undefined !== $(obj).data(meta[3]);
      };
      bootstrap__WEBPACK_IMPORTED_MODULE_8__.Tooltip.Default.allowList.button = ["data-submit", "data-close"];
      this.structPage();
      this.categoryPage();
      this.menuPage();

      //Call original function
      _get(_getPrototypeOf(App.prototype), "_uiInit", this).call(this);
      this.helpers(["jq-appear", "jq-datepicker", "jq-colorpicker", "jq-maxlength", "jq-select2", "jq-rangeslider", "dm-table-tools-sections"]);
      this.mask();
      this.dropzone();
      this.select2PreventSort();
      this.stickyTop();
      this.dirtyForm();
      this.previewModal();
      this.initRepeaterPanel();
      this.initPopoverRemove();
      this.initFormAction();
      this.editor();
      this.textarea();
      this.toast();
    }
  }, {
    key: "initToolbar",
    value: function initToolbar() {
      __webpack_require__.e(/*! import() */ "/js/vendor").then(__webpack_require__.bind(__webpack_require__, /*! clockwork-browser/toolbar */ "./node_modules/.pnpm/clockwork-browser@1.1.1/node_modules/clockwork-browser/toolbar.js"));
    }
  }, {
    key: "dirtyForm",
    value: function dirtyForm() {
      jQuery("form:not(.js-form-dirty-enable)").each(function (i, p) {
        var el = jQuery(p).addClass("js-form-dirty-enable");
        var submitBtn = jQuery("[type=submit]", el);
        jQuery(el).on("dirty", function () {
          submitBtn.removeClass("btn-alt-secondary").addClass("btn-info");
        });
        jQuery(el).one("input", "input,select,textarea", jQuery.fn.trigger.bind(el, "dirty"));
      });
    }
  }, {
    key: "previewModal",
    value: function previewModal() {
      var modal = "\n        <div class=\"modal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">\n            <div class=\"modal-dialog modal-lg modal-dialog-centered\" role=\"document\">\n                <div class=\"modal-content overflow-hidden\">\n                    <div class=\"block block-themed block-transparent mb-0\">\n                        <div class=\"bg-body block-header\">\n                            <h3 class=\"block-title text-body-color-dark\">Preview</h3>\n                            <div class=\"block-options\">\n                                <button type=\"button\" class=\"btn-block-option text-body-color-dark\" data-bs-dismiss=\"modal\" aria-label=\"Close\">\n                                    <i class=\"fa fa-fw fa-times\"></i>\n                                </button>\n                            </div>\n                        </div>\n                        <div class=\"block-content pb-3\"></div>\n                    </div>\n                </div>\n            </div>\n        </div>\n        ";
      var self = this;
      jQuery("[data-preview]:not(.js-preview-enable)").each(function (i, el) {
        var $el = jQuery(el).addClass("js-preview-enable");
        $el.on("click", function (e) {
          e.preventDefault();
          var $block = $el.closest(".block").addClass("block-mode-loading");
          var $form = $el.closest("form");
          var url = $el.data("preview") || $el.attr("href");
          var $modal = jQuery(modal);
          var structure = self.structToJSON(design);
          var csrf = jQuery("[name=_token]", $form).val();
          $modal.on("hidden.bs.modal", function (e) {
            return e.target.parentNode.removeChild(e.target);
          });
          jQuery("[data-bs-dismiss=modal]", $modal).on("click", function () {
            $modal.modal("hide");
          });
          $.ajax({
            url: url,
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify({
              structure: structure
            }),
            headers: {
              "X-CSRF-TOKEN": csrf
            },
            success: function success(response) {
              $(".block-content", $modal).html(response);
              $modal.appendTo(document.body).modal("show");
              jQuery(".block-header", $modal).addClass("sticky-top");
              self.init();
              $block.removeClass("block-mode-loading");
            }
          });
        });
      });
    }
  }, {
    key: "stickyTop",
    value: function stickyTop() {
      jQuery(".sticky-top:not(.js-sticky-top-enable)").each(function (i, p) {
        var el = jQuery(p).addClass("js-sticky-top-enable");
        var level = el.parents(".block").length - 1;
        el.css("z-index", 900 - level);
        el.css("top", 55 * level);
        if (!el.hasClass("block-header") && el.parents(".modal-dialog").length > 0) {
          el.css("padding-right", 0);
          el.css("margin-right", 0);
        }
      });
    }
  }, {
    key: "select2PreventSort",
    value: function select2PreventSort() {
      jQuery(".js-select2-enabled:not(.js-select2-configured)").addClass("js-select2-configured").each(function (index, element) {
        var $el = jQuery(element);
        if ($el.data("prevent-sort") == 1) {
          $el.on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
          });
        }
      });
    }
  }, {
    key: "mask",
    value: function mask() {
      var w = "w".repeat(400);
      jQuery(".js-imask:not(.js-imask-enabled)").each(function (index, element) {
        var $el = jQuery(element);
        $el.addClass("js-imask-enabled");
        var ops = {
          lazy: $el.data("lazy") || false,
          overwrite: $el.data("overwrite") || false,
          placeholderChar: $el.data("placeholderChar") || "_"
        };
        var isSlug = !!$el.data("slug");
        if (isSlug) {
          ops.mask = "{" + $el.data("slug").replace(/./g, function (c) {
            return '\\' + c;
          }) + "}`" + w;
          ops.definitions = {
            w: /[\w-]/
          };
          ops.lazy = true;
          ops.prepare = function (str) {
            return str.toLocaleLowerCase().to128Charset();
          };
        } else {
          ops.mask = $el.data("mask") || ($el.data("regex") ? function (v) {
            return new RegExp($el.data("regex")).test(v);
          } : false);
        }
        var maskInput = (0,imask__WEBPACK_IMPORTED_MODULE_5__["default"])(element, ops);
        if (isSlug) {
          var $formGroup = jQuery(element).closest('.form-group');
          var $nameElement = $formGroup.parent().find("[name$='[name]']");
          //
          if ($nameElement.length > 0) {
            var $invalidMessage = $el.siblings('.invalid-feedback').detach();
            $el.detach();
            var checkboxId = element.id + "_slug";
            var $wrapper = jQuery('<div class="input-group"><div class="input-group-text input-group-text-alt"><input type="checkbox" id="' + checkboxId + '" class="slug-checkbox"><label class="mb-0 fa fa-fw" for="' + checkboxId + '"></label></div></div>');
            $wrapper.append($el);
            $wrapper.append($invalidMessage);
            $formGroup.append($wrapper);
            var $slugCheckbox = $wrapper.find('.slug-checkbox');
            var currentVal = $nameElement.val().replace(/\s/g, '-');
            var slugIsActive = !maskInput.unmaskedValue || maskInput.masked.resolve("." + currentVal) == maskInput.unmaskedValue;
            maskInput.masked.resolve(maskInput.unmaskedValue);
            $slugCheckbox.prop('checked', slugIsActive);
            $slugCheckbox.on('change', function () {
              slugIsActive = $slugCheckbox.prop('checked');
              $el.prop('readonly', slugIsActive);
            });
            $slugCheckbox.trigger('change');
            $nameElement.on('input', function () {
              if (!slugIsActive) return;
              var newSlug = this.value.replace(/\s/g, '-');
              maskInput.unmaskedValue = "." + newSlug;
            });
          }
        }
      });
    }
  }, {
    key: "fileTypeSvgConvert",
    value: function fileTypeSvgConvert(mime) {
      var _this$fileSvgs$mime;
      mime = mime.replace(/application.(.*?)/, "$1").toLocaleLowerCase();
      return ((_this$fileSvgs$mime = this.fileSvgs[mime]) !== null && _this$fileSvgs$mime !== void 0 ? _this$fileSvgs$mime : this.fileSvgs.file)["default"];
    }
  }, {
    key: "dropzone",
    value: function dropzone() {
      var self = this;
      jQuery(".js-dropzone:not(.js-dropzone-enabled)").each(function (index, element) {
        var el = jQuery(element).addClass("js-dropzone-enabled dropzone");
        var isMultiple = !!el.data("multiple");
        var form = el.closest("form");
        var csrf = jQuery("[name=_token]", form).val();
        var zone = new (dropzone__WEBPACK_IMPORTED_MODULE_4___default())(element, {
          url: el.data("url"),
          headers: {
            "X-CSRF-TOKEN": csrf
          },
          paramName: el.data("paramname") || "file",
          maxFilesize: el.data("maxfilesize") || 2,
          maxFiles: el.data("maxfiles") || null,
          addRemoveLinks: el.data("addRemoveLinks") || true,
          thumbnailMethod: el.data("thumbnailMethod") || "contain",
          init: function init() {
            var _this = this;
            el.data("files").forEach(function (file) {
              _this.emit("addedfile", file);
              if (file.type.match(/image.*/)) {
                _this.emit("thumbnail", file, file.preview);
              } else {
                _this.emit("thumbnail", file, self.fileTypeSvgConvert(file.type));
              }
              _this.files.push(file);
              jQuery(".dz-size", file.previewElement).remove();
              _this.emit("complete", file);
            });
          },
          success: function success(file, response) {
            file.path = response;
          }
        });
        zone.on("addedfile", function (file) {
          if (!file.type.match(/image.*/)) {
            this.emit("thumbnail", file, self.fileTypeSvgConvert(file.type));
          }
          jQuery.fn.trigger.call(form, "dirty");
        });
        form.on("submit", function (e) {
          var _this2 = this;
          zone.getAcceptedFiles().forEach(function (file) {
            jQuery(_this2).append("<input type=hidden name='" + el.data("name") + (isMultiple ? "[]" : "") + "' value='" + file.path + "' />");
          });
          if (zone.files.length == 0) {
            jQuery(this).append("<input type=hidden name='" + el.data("name") + (isMultiple ? "[]" : "") + "' />");
          }
        });
        var preventDefault = function preventDefault(e) {
          return e.preventDefault();
        };
        dragula__WEBPACK_IMPORTED_MODULE_11___default()([element], {
          direction: (window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) < 425 ? "vertical" : "horizontal",
          mirrorContainer: element,
          ignoreInputTextSelection: false,
          slideFactorX: 20,
          slideFactorY: 20,
          moves: function moves(el, source, handle, sibling) {
            return el.classList.contains("dz-preview");
          }
        }).on("drag", function (e) {
          $(e).on("touchmove", preventDefault);
          el.removeClass("dz-clickable");
        }).on("dragend", function (e) {
          //$(e).off("touchmove", preventDefault);
          el.addClass("dz-clickable");
          var queue = zone.files;
          var newQueue = [];
          jQuery(".dz-preview .dz-filename [data-dz-name]", el).each(function (count, e) {
            var name = e.innerText;
            queue.forEach(function (file) {
              if (file.name === name) {
                newQueue.push(file);
              }
            });
          });
          zone.files = newQueue;
          jQuery.fn.trigger.call(form, "dirty");
        });
      });
    }
  }, {
    key: "structToJSON",
    value: function structToJSON(node) {
      var $children = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
      var self = this;
      jQuery(">:hasData(data)", node).each(function (ind, elm) {
        var $c = self.structToJSON(jQuery(">.block-content", elm));
        var c = [];
        if ($c.length > 0) {
          c[":children"] = $c;
        }
        $children.push(_objectSpread(_objectSpread({
          ":tag": elm.nodeName.toLocaleLowerCase()
        }, jQuery(elm).data("data")), c));
      });
      return $children;
    }
  }, {
    key: "structPage",
    value: function structPage() {
      var self = this;
      jQuery("#visual_desinger:not(.js-enabled)").each(function (index, element) {
        var $el = jQuery(element).addClass("js-enabled");
        jQuery.each(element.children, initData);
        jQuery(element).on("click", "[data-configure]", configureModal);
        $(element).closest("form").on("submit", function (e) {
          var $block = $el.closest(".block").addClass("block-mode-loading");
          $(structure_form_data).val(JSON.stringify(self.structToJSON(design)));
        });
        var drag = dragula__WEBPACK_IMPORTED_MODULE_11___default()(_toConsumableArray(element.children), {
          isContainer: function isContainer(el) {
            return el.classList.contains("block-content") && !jQuery(el).closest(".gu-transit").length && !!jQuery(el).closest("#design").length;
          },
          accepts: function accepts(el, target) {
            return !jQuery(target).closest("#elements").length && !jQuery(target).closest(".salt").length;
          },
          copy: function copy(el, source) {
            return source.id == "elements";
          },
          invalid: function invalid(el, handle) {
            return jQuery(el).closest(".salt").length;
          },
          removeOnSpill: true,
          slideFactorX: 20,
          slideFactorY: 20
        });
        drag.on("drop", jQuery.fn.trigger.bind(jQuery(element), "dirty"));
        drag.on("cloned", function (el, source, type) {
          if (type == "copy") {
            var clone = jQuery(">.block-content", source).clone(true, true);
            var iconBase = 'fa';
            var iconFullscreen = 'si-size-fullscreen';
            var iconFullscreenActive = 'si-size-actual';
            var iconContent = 'fa-chevron-up';
            var iconContentActive = 'fa-chevron-down';
            jQuery(">.block-content", el).replaceWith(clone);
            jQuery(el).data("data", jQuery(source).data("data"));

            // Auto add the default toggle icons to fullscreen and content toggle buttons
            jQuery('[data-toggle="block-option"][data-action="fullscreen_toggle"]', el).each(function (i, btn) {
              btn.innerHTML = '<i class="' + iconBase + ' ' + (btn.closest('.block').classList.contains('block-mode-fullscreen') ? iconFullscreenActive : iconFullscreen) + '"></i>';
            });
            jQuery('[data-toggle="block-option"][data-action="content_toggle"]', el).each(function (i, btn) {
              btn.innerHTML = '<i class="' + iconBase + ' ' + (btn.closest('.block').classList.contains('block-mode-hidden') ? iconContentActive : iconContent) + '"></i>';
            });

            // Call blocks API on option button click
            jQuery('[data-toggle="block-option"]', el).each(function (i, btn) {
              btn.addEventListener('click', function (e) {
                self._uiApiBlocks(btn.dataset.action, btn.closest('.block'));
              });
            });
          }
        });
      });
      function initData(i, el) {
        var $el = jQuery(el);
        var childData = $el.data("data");
        if (!childData) return;
        childData.forEach(function (data) {
          renderChildren($el, data);
        });
      }
      function renderChildren($el, data) {
        var _data$Children;
        var template = block_template.content.cloneNode(true);
        var children = (_data$Children = data[":children"]) !== null && _data$Children !== void 0 ? _data$Children : false;
        delete data[":children"];
        var $block = $(".block", template);
        $block.data("data", data);
        $(".block-title", template).text(data["title"]);
        var $content = $(".block-content", template);
        if (data[":salt"]) $content.addClass("salt");
        if (!children) {
          $content.remove();
          $("[data-action=content_toggle]", template).remove();
        } else {
          children.forEach(function (child) {
            renderChildren($content, child);
          });
        }
        $el.append(template);
      }

      // prettier-ignore
      function configureModal(_ref) {
        var _data$Rules;
        var target = _ref.target;
        var $target = jQuery(target);
        var $block = $target.closest(".block");
        var data = $block.data("data");
        var $modal = jQuery(".modal", block_configure_modal.content).clone(true, true);
        $modal.on("hidden.bs.modal", function (e) {
          return e.target.parentNode.removeChild(e.target);
        });
        jQuery("[data-bs-dismiss=modal]", $modal).on("click", function (e) {
          e.preventDefault();
          e.stopPropagation();
          if (this.type == "submit") {
            //Save Data
            data = _objectSpread(_objectSpread({}, data), {}, {
              title: jQuery("#title", $modal).val(),
              name: jQuery("#name", $modal).val(),
              type: jQuery("#type", $modal).val(),
              ":rules": jQuery("#rules", $modal).val(),
              ":multiple": jQuery("#multiple", $modal).prop("checked"),
              ":mask": jQuery("#mask", $modal).val(),
              ":overwrite": jQuery("#overwrite", $modal).prop("checked"),
              ":auto-height": jQuery("#auto-height", $modal).prop("checked"),
              ":prevent-sort": jQuery("#prevent-sort", $modal).prop("checked"),
              ":placeholderChar": jQuery("#placeholderChar", $modal).val(),
              ":content": jQuery("#content", $modal).val(),
              ":data-source": jQuery("#data-source", $modal).val(),
              ":show-on-list": jQuery("#show-on-list", $modal).prop("checked"),
              ":show-on-list-empty-header": jQuery("#show-on-list-empty-header", $modal).prop("checked"),
              ":show-on-list-order": jQuery("#show-on-list-order", $modal).val(),
              ":show-on-list-prefix": jQuery("#show-on-list-prefix", $modal).val()
            });

            //Update structure screen
            $(">.block-header .block-title", $block).text(data["title"]);

            //Clean undefined data
            data = Object.entries(data).reduce(function (a, _ref2) {
              var _ref3 = _slicedToArray(_ref2, 2),
                k = _ref3[0],
                v = _ref3[1];
              return v === undefined ? a : (a[k] = v, a);
            }, {});
            $block.data("data", data);
          }
          $modal.modal("hide");
        });

        //Clean components on screen
        $("[id^=p_]", $modal).each(function (i, el) {
          var name = el.id.replace("p_", "");
          if (!data.hasOwnProperty(name) && !data.hasOwnProperty(":" + name)) {
            jQuery(el).remove();
          }
        });
        $modal.appendTo(document.body).modal("show");
        jQuery(".block-header", $modal).addClass("sticky-top");

        //Title
        jQuery("#title", $modal).val(data["title"]);

        //Name
        jQuery("#name", $modal).val(data["name"]);

        //Type
        jQuery("#type", $modal).val(data["type"]).trigger("change");

        //Rules
        self.helpers(["jq-select2"]);
        self.select2PreventSort();
        var $select2 = jQuery("#rules", $modal);
        var rules = (_data$Rules = data[":rules"]) !== null && _data$Rules !== void 0 ? _data$Rules : [];
        jQuery.fn.each.call(rules, function (_, rule) {
          var $rule = $select2.find("option[value='" + rule + "']");
          if ($rule.length) {
            $rule.detach();
          } else {
            $rule = new Option(rule, rule, true, true);
          }
          $select2.append($rule);
        });
        $select2.val(rules).trigger("change");

        //Multiple
        data[":multiple"] && jQuery("#multiple", $modal).attr("checked", "checked");

        //Mask
        jQuery("#mask", $modal).val(data[":mask"]);

        //Overwrite
        data[":overwrite"] && jQuery("#overwrite", $modal).attr("checked", "checked");

        //Prevent Sort
        data[":prevent-sort"] && jQuery("#prevent-sort", $modal).attr("checked", "checked");

        //Auto Height
        data[":auto-height"] && jQuery("#auto-height", $modal).attr("checked", "checked");

        //PlaceholderChar
        jQuery("#placeholderChar", $modal).val(data[":placeholderChar"]);

        //Content
        jQuery("#content", $modal).val(data[":content"]);

        //Data Source
        var $datasource = jQuery("#data-source", $modal);
        var sources = !data[":data-source"] ? [] : [data[":data-source"]];
        jQuery.fn.each.call(sources, function (_, rule) {
          var $rule = $datasource.find("option[value='" + rule.replaceAll("\\", "\\\\") + "']");
          if ($rule.length) {
            $rule.detach();
          } else {
            $rule = new Option(rule, rule, true, true);
          }
          $datasource.append($rule);
        });
        $datasource.val(sources).trigger("change");

        //Show on List
        data[":show-on-list"] && jQuery("#show-on-list", $modal).attr("checked", "checked");
        data[":show-on-list-empty-header"] && jQuery("#show-on-list-empty-header", $modal).attr("checked", "checked");
        jQuery("#show-on-list-order", $modal).val(data[":show-on-list-order"]);
        jQuery("#show-on-list-prefix", $modal).val(data[":show-on-list-prefix"]);
      }
    }
  }, {
    key: "categoryPage",
    value: function categoryPage() {
      jQuery("#category_desinger:not(.js-enabled)").each(function (index, element) {
        var $el = jQuery(element).addClass("js-enabled");
        jQuery.each(element.children, initData);
        jQuery("[data-update]", element).each(function (i, target) {
          var $target = jQuery(target);
          var $block = $target.closest(".block");
          var data = $block.data("data");
          $target.attr("href", data["editAction"]);
        });
        jQuery("[data-destroy]", element).each(function (i, target) {
          var $target = jQuery(target);
          var $block = $target.closest(".block");
          var data = $block.data("data");
          jQuery("form", $target).attr("action", data["removeAction"]);
        });
        $(element).closest("form").on("submit", function (e) {
          $el.closest(".block").addClass("block-mode-loading");
          $(category_form_data).val(JSON.stringify(categoryToJSON(design)));
        });
        var drag = dragula__WEBPACK_IMPORTED_MODULE_11___default()(_toConsumableArray(element.children), {
          isContainer: function isContainer(el) {
            return el.classList.contains("block-content") && !jQuery(el).closest(".gu-transit").length && !!jQuery(el).closest("#design").length;
          },
          accepts: function accepts(el, target) {
            return !jQuery(target).closest("#elements").length && !jQuery(target).closest(".salt").length;
          },
          copy: function copy(el, source) {
            return source.id == "elements";
          },
          invalid: function invalid(el, handle) {
            return jQuery(el).closest(".salt").length;
          },
          //removeOnSpill: true,
          slideFactorX: 20,
          slideFactorY: 20
        });
        drag.on("drop", jQuery.fn.trigger.bind(jQuery(element), "dirty"));
      });
      function initData(i, el) {
        var $el = jQuery(el);
        var childData = $el.data("data");
        if (!childData) return;
        childData.forEach(function (data) {
          renderChildren($el, data);
        });
      }
      function renderChildren($el, data) {
        var _data$children;
        var template = block_template.content.cloneNode(true);
        var children = (_data$children = data["children"]) !== null && _data$children !== void 0 ? _data$children : false;
        delete data["children"];
        var $block = $(".block", template);
        $block.data("data", data).attr("id", "category" + data["id"]);
        $(".block-title", template).text(data["detail"]["name"]);
        var $content = $(".block-content", template);
        if (data[":salt"]) $content.addClass("salt");
        if (!children) {
          $content.remove();
          $("[data-action=content_toggle]", template).remove();
        } else {
          children.forEach(function (child) {
            renderChildren($content, child);
          });
        }
        $el.append(template);
      }
      function categoryToJSON(node) {
        var $children = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
        jQuery(">:hasData(data)", node).each(function (ind, elm) {
          var $c = categoryToJSON(jQuery(">.block-content", elm));
          var c = [];
          if ($c.length > 0) {
            c["children"] = $c;
          }
          var data = jQuery(elm).data("data");
          delete data["lft"];
          delete data["rgt"];
          delete data["status"];
          delete data["extras"];
          delete data["detail"];
          delete data["editAction"];
          delete data["removeAction"];
          $children.push(_objectSpread(_objectSpread({}, data), c));
        });
        return $children;
      }
    }
  }, {
    key: "menuPage",
    value: function menuPage() {
      jQuery("#menu_desinger:not(.js-enabled)").each(function (index, element) {
        var $el = jQuery(element).addClass("js-enabled");
        jQuery.each(element.children, initData);
        jQuery("[data-update]", element).each(function (i, target) {
          var $target = jQuery(target);
          var $block = $target.closest(".block");
          var data = $block.data("data");
          $target.attr("href", data["editAction"]);
          $target.on("click", function (event) {
            event.preventDefault();
            var $modal = jQuery(".modal", block_edit_modal.content).clone(true, true);
            $modal.on("hidden.bs.modal", function (e) {
              return e.target.parentNode.removeChild(e.target);
            });
            jQuery("[data-bs-dismiss=modal]", $modal).on("click", function () {
              $modal.modal("hide");
            });
            $(".block-content>iframe", $modal).attr("src", data["editAction"] + "?compact=1").on("load", function () {
              var docHeight = document.body.clientHeight / 1.8;
              var minHeight = Math.min(docHeight, this.contentDocument.body.clientHeight);
              $(this).height(minHeight + "px");
            });
            $modal.appendTo(document.body).modal("show");
            jQuery(".block-header", $modal).addClass("sticky-top");
            window["modalSubmitted" + data["id"]] = function (id, name) {
              delete window["modalSubmitted" + data["id"]];
              $(">.block-header .block-title", "#menu" + id).text(name);
              $modal.modal("hide");
            };
          });
        });
        jQuery("[data-destroy]", element).each(function (i, target) {
          var $target = jQuery(target);
          var $block = $target.closest(".block");
          var data = $block.data("data");
          jQuery("form", $target).attr("action", data["removeAction"]);
        });
        $(element).closest("form").on("submit", function (e) {
          $el.closest(".block").addClass("block-mode-loading");
          $(menu_form_data).val(JSON.stringify(menuToJSON(design)));
        });
        var drag = dragula__WEBPACK_IMPORTED_MODULE_11___default()(_toConsumableArray(element.children), {
          isContainer: function isContainer(el) {
            return el.classList.contains("block-content") && !jQuery(el).closest(".gu-transit").length && !!jQuery(el).closest("#design").length;
          },
          accepts: function accepts(el, target) {
            return !jQuery(target).closest("#elements").length && !jQuery(target).closest(".salt").length;
          },
          copy: function copy(el, source) {
            return source.id == "elements";
          },
          invalid: function invalid(el, handle) {
            return jQuery(el).closest(".salt").length;
          },
          //removeOnSpill: true,
          slideFactorX: 20,
          slideFactorY: 20
        });
        drag.on("drop", jQuery.fn.trigger.bind(jQuery(element), "dirty"));
      });
      function initData(i, el) {
        var $el = jQuery(el);
        var childData = $el.data("data");
        if (!childData) return;
        childData.forEach(function (data) {
          renderChildren($el, data);
        });
      }
      function renderChildren($el, data) {
        var _data$children2;
        var template = block_template.content.cloneNode(true);
        var children = (_data$children2 = data["children"]) !== null && _data$children2 !== void 0 ? _data$children2 : false;
        delete data["children"];
        var $block = $(".block", template);
        $block.data("data", data).attr("id", "menu" + data["id"]);
        var name = data["detail"] && data["detail"]["name"] ? data["detail"]["name"] : data["id"];
        $(".block-title", template).text(name);
        var $content = $(".block-content", template);
        if (data[":salt"]) $content.addClass("salt");
        if (!children) {
          $content.remove();
          $("[data-action=content_toggle]", template).remove();
        } else {
          children.forEach(function (child) {
            renderChildren($content, child);
          });
        }
        $el.append(template);
      }
      function menuToJSON(node) {
        var $children = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];
        jQuery(">:hasData(data)", node).each(function (ind, elm) {
          var $c = menuToJSON(jQuery(">.block-content", elm));
          var c = [];
          if ($c.length > 0) {
            c["children"] = $c;
          }
          var data = jQuery(elm).data("data");
          delete data["lft"];
          delete data["rgt"];
          delete data["status"];
          delete data["extras"];
          delete data["detail"];
          delete data["editAction"];
          delete data["removeAction"];
          $children.push(_objectSpread(_objectSpread({}, data), c));
        });
        return $children;
      }
    }
  }, {
    key: "generateId",
    value: function generateId() {
      return "op" + Math.random().toString(36).replace(/[^a-zA-Z0-9]+/g, '').substr(2, 10);
    }
  }, {
    key: "initRepeaterPanel",
    value: function initRepeaterPanel() {
      var _this3 = this;
      jQuery("[data-repeater-count]:not(.js-repeater-enabled)").addClass("js-repeater-enabled").each(function (i, el) {
        var $el = jQuery(el);
        var $uls = jQuery(">ul", el);
        $uls.removeClass("nav-justified");
        var $plus = $uls.prepend('<li class="nav-item" data-repeater-add><a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-plus small"></i></a></li>');
        var $remove = $uls.prepend('<li class="nav-item" data-repeater-remove><a class="nav-link" href="#" role="tab"><i class="fa fa-fw fa-trash small"></i></a></li>');
        var clonedForm = jQuery('>.tab-content >.tab-pane.active', $el).clone(true, true).removeClass('active');
        jQuery('[selected]', clonedForm).removeAttr('selected');
        jQuery('[checked]', clonedForm).removeAttr('checked');
        jQuery('input:not([type=checkbox]):not([type=radio])', clonedForm).removeAttr('value');
        function ReorderInputs() {
          $el.data("repeater-names").forEach(function (n, i) {
            jQuery('[name^="' + n + '"]', $el).each(function (i, e) {
              jQuery(e).attr('name', n + '[' + i + ']');
            });
          });
        }
        $uls.on("click", "[data-repeater-remove]", function (e) {
          e.preventDefault();
        });
        $uls.on("click", "[data-repeater-add]", function (e) {
          e.preventDefault();
          var count = $el.data("repeater-count") + 1;
          $el.data("repeater-count", count);
          var id = _this3.generateId();
          $uls.append('<li class="nav-item"><a class="nav-link" href="#' + id + '" data-bs-toggle="tab" role="tab">' + count + "</a></li>");
          jQuery('>.tab-content', $el).append(clonedForm.attr("id", id).clone(true, true));
          ReorderInputs();
        });
        var ul = $uls.get(0);
        var drag = dragula__WEBPACK_IMPORTED_MODULE_11___default()([ul], {
          direction: "horizontal",
          revertOnSpill: true,
          mirrorContainer: ul,
          ignoreInputTextSelection: false,
          slideFactorX: 20,
          slideFactorY: 20,
          moves: function moves(el, source, handle, sibling) {
            return el.classList.contains("nav-item") && !(el.dataset.hasOwnProperty("repeaterRemove") || el.dataset.hasOwnProperty("repeaterAdd"));
          },
          accepts: function accepts(el, target, source, sibling) {
            return sibling && !sibling.dataset.hasOwnProperty("repeaterAdd");
          }
        });
        drag.on("drop", function (el, target, source, sibling) {
          $uls.trigger("dirty");
          var $currentForm = jQuery(jQuery("a", el).attr("href"));
          //Remove
          if (sibling.dataset.hasOwnProperty("repeaterRemove")) {
            $currentForm.remove();
            jQuery(el).remove();
            if (jQuery(".active", el).length > 0) {
              jQuery("li:nth-child(3)>a", $uls).tab('show');
            }
            ReorderInputs();
            return;
          }
          //Reorder
          if (!sibling.classList.contains("gu-mirror")) {
            var $siblingForm = jQuery(jQuery("a", sibling).attr("href"));
            $siblingForm.before($currentForm.detach());
          } else {
            var $tabContent = $currentForm.closest('.tab-content');
            $tabContent.append($currentForm.detach());
          }
          ReorderInputs();
        });
      });
    }
  }, {
    key: "initPopoverRemove",
    value: function initPopoverRemove() {
      if (!window.block_remove_form_template) {
        return;
      }
      var _content = block_remove_form_template.content;
      var title = jQuery(block_remove_form_template).data('title');
      jQuery(".js-destroy:not(.js-destroy-enabled)").addClass("js-destroy-enabled").each(function (i, el) {
        var $el = jQuery(el);
        var $form = jQuery('form', $el);
        $el.popover({
          container: 'body',
          boundary: 'window',
          placement: 'auto',
          html: true,
          trigger: 'click',
          title: title,
          template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header py-1 bg-body"></h3><div class="popover-body pt-1"></div></div>',
          content: function content() {
            var $con = jQuery(_content.cloneNode(true).children);
            $con.on('click', '[data-submit]', function () {
              $form.submit();
            });
            $con.on('click', '[data-close]', function () {
              $el.popover('hide');
            });
            return $con;
          }
        }).on("click", function (e) {
          return e.preventDefault();
        });
      });
    }
  }, {
    key: "initFormAction",
    value: function initFormAction() {
      if (!window.block_remove_form_template) {
        return;
      }
      jQuery(".js-action:not(.js-action-enabled)").addClass("js-action-enabled").each(function (i, el) {
        var $el = jQuery(el);
        var $form = jQuery('form', $el);
        $el.on("click", function (e) {
          e.preventDefault();
          $form.submit();
        });
      });
    }
  }, {
    key: "editor",
    value: function editor() {
      jQuery(".js-editor:not(.js-editor-enabled)").each(function (index, element) {
        var $el = jQuery(element).addClass("js-editor-enabled");
        var form = $el.closest("form");
        var editor = new (quill__WEBPACK_IMPORTED_MODULE_6___default())(element, {
          modules: {
            blotFormatter: {},
            toolbar: [[{
              header: [1, 2, false]
            }], ["bold", "italic", "underline", "image"]]
          },
          theme: "snow"
        });
        $(editor.container).addClass("block").addClass("block-bordered");
        $(editor.getModule("toolbar").container).addClass("block").addClass("block-header-default").addClass("block-bordered").addClass("mb-0");
        form.on("submit", function (e) {
          var $input = jQuery("<input type=hidden name='" + $el.data("name") + "' />");
          $input.val(editor.root.innerHTML);
          jQuery(this).append($input);
        });
      });
    }
  }, {
    key: "textarea",
    value: function textarea() {
      jQuery("textarea:not(.js-textarea-enabled)").each(function (index, element) {
        var $el = jQuery(element).addClass("js-textarea-enabled");
        if ($el.data("auto-height")) {
          element.style.height = "5px";
          element.style.height = element.scrollHeight + 10 + "px";
        }
      });
    }
  }, {
    key: "toast",
    value: function toast() {
      jQuery("[data-toast]:not(.js-toast-enabled)").each(function (index, element) {
        jQuery(element).addClass("js-toast-enabled").toast('show');
      });
    }
  }]);
  return App;
}(_modules_template__WEBPACK_IMPORTED_MODULE_12__["default"]);

window.$ = window.jQuery = jQuery;
jQuery(function () {
  return window.orbitali = new App();
});

/***/ }),

/***/ "./storage/orbitali/src/Assets/source/js/dashmix/modules/helpers.js":
/*!**************************************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/js/dashmix/modules/helpers.js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Helpers)
/* harmony export */ });
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap */ "./node_modules/.pnpm/bootstrap@5.2.3_@popperjs+core@2.11.7/node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* provided dependency */ var jQuery = __webpack_require__(/*! jquery */ "./node_modules/.pnpm/jquery@3.7.0/node_modules/jquery/dist/jquery.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/*
 *  Document   : helpers.js
 *  Author     : pixelcave
 *  Description: Various helpers for plugin inits or helper functionality
 *
 */



// Helper variables
var jqSparklineResize = false;
var jqSparklineTimeout;

// Helpers
var Helpers = /*#__PURE__*/function () {
  function Helpers() {
    _classCallCheck(this, Helpers);
  }
  _createClass(Helpers, null, [{
    key: "run",
    value:
    /*
     * Run helpers
     *
     */
    function run(helpers) {
      var _this = this;
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      var helperList = {
        // Bootstrap
        'bs-tooltip': function bsTooltip() {
          return _this.bsTooltip();
        },
        'bs-popover': function bsPopover() {
          return _this.bsPopover();
        },
        // Dashmix
        'dm-toggle-class': function dmToggleClass() {
          return _this.dmToggleClass();
        },
        'dm-year-copy': function dmYearCopy() {
          return _this.dmYearCopy();
        },
        'dm-ripple': function dmRipple() {
          return _this.dmRipple();
        },
        'dm-print': function dmPrint() {
          return _this.dmPrint();
        },
        'dm-table-tools-sections': function dmTableToolsSections() {
          return _this.dmTableToolsSections();
        },
        'dm-table-tools-checkable': function dmTableToolsCheckable() {
          return _this.dmTableToolsCheckable();
        },
        // JavaScript
        'js-ckeditor': function jsCkeditor() {
          return _this.jsCkeditor();
        },
        'js-ckeditor5': function jsCkeditor5() {
          return _this.jsCkeditor5();
        },
        'js-simplemde': function jsSimplemde() {
          return _this.jsSimpleMDE();
        },
        'js-highlightjs': function jsHighlightjs() {
          return _this.jsHighlightjs();
        },
        'js-flatpickr': function jsFlatpickr() {
          return _this.jsFlatpickr();
        },
        // jQuery
        'jq-appear': function jqAppear() {
          return _this.jqAppear();
        },
        'jq-magnific-popup': function jqMagnificPopup() {
          return _this.jqMagnific();
        },
        'jq-slick': function jqSlick() {
          return _this.jqSlick();
        },
        'jq-datepicker': function jqDatepicker() {
          return _this.jqDatepicker();
        },
        'jq-colorpicker': function jqColorpicker() {
          return _this.jqColorpicker();
        },
        'jq-masked-inputs': function jqMaskedInputs() {
          return _this.jqMaskedInputs();
        },
        'jq-select2': function jqSelect2() {
          return _this.jqSelect2();
        },
        'jq-notify': function jqNotify(options) {
          return _this.jqNotify(options);
        },
        'jq-easy-pie-chart': function jqEasyPieChart() {
          return _this.jqEasyPieChart();
        },
        'jq-maxlength': function jqMaxlength() {
          return _this.jqMaxlength();
        },
        'jq-rangeslider': function jqRangeslider() {
          return _this.jqRangeslider();
        },
        'jq-pw-strength': function jqPwStrength() {
          return _this.jqPwStrength();
        },
        'jq-sparkline': function jqSparkline() {
          return _this.jqSparkline();
        },
        'jq-validation': function jqValidation() {
          return _this.jqValidation();
        }
      };
      if (helpers instanceof Array) {
        for (var index in helpers) {
          if (helperList[helpers[index]]) {
            helperList[helpers[index]](options);
          }
        }
      } else {
        if (helperList[helpers]) {
          helperList[helpers](options);
        }
      }
    }

    /*
     ********************************************************************************************
     *
     * Init helpers for Bootstrap plugins
     *
     *********************************************************************************************
     */

    /*
     * Bootstrap Tooltip, for more examples you can check out https://getbootstrap.com/docs/5.0/components/tooltips/
     *
     * Helpers.run('bs-tooltip');
     *
     * Example usage:
     *
     * <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" title="Tooltip Text">Example</button> or
     * <button type="button" class="btn btn-primary js-bs-tooltip" title="Tooltip Text">Example</button>
     *
     */
  }, {
    key: "bsTooltip",
    value: function bsTooltip() {
      var elements = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]:not(.js-bs-tooltip-enabled), .js-bs-tooltip:not(.js-bs-tooltip-enabled)'));
      window.helperBsTooltips = elements.map(function (el) {
        // Add .js-bs-tooltip-enabled class to tag it as activated
        el.classList.add('js-bs-tooltip-enabled');

        // Init Bootstrap Tooltip
        return new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Tooltip(el, {
          container: el.dataset.bsContainer || '#page-container',
          animation: el.dataset.bsAnimation && el.dataset.bsAnimation.toLowerCase() == 'true' ? true : false
        });
      });
    }

    /*
     * Bootstrap Popover, for more examples you can check out https://getbootstrap.com/docs/5.0/components/popovers/
     *
     * Helpers.run('bs-popover');
     *
     * Example usage:
     *
     * <button type="button" class="btn btn-primary" data-bs-toggle="popover" title="Popover Title" data-bs-content="This is the content of the Popover">Example</button> or
     * <button type="button" class="btn btn-primary js-popover" title="Popover Title" data-bs-content="This is the content of the Popover">Example</button>
     *
     */
  }, {
    key: "bsPopover",
    value: function bsPopover() {
      var elements = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]:not(.js-bs-popover-enabled), .js-bs-popover:not(.js-bs-popover-enabled)'));
      window.helperBsPopovers = elements.map(function (el) {
        // Add .js-bs-popover-enabled class to tag it as activated
        el.classList.add('js-bs-popover-enabled');

        // Init Bootstrap Popover
        return new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Popover(el, {
          container: el.dataset.bsContainer || '#page-container',
          animation: el.dataset.bsAnimation && el.dataset.bsAnimation.toLowerCase() == 'true' ? true : false,
          trigger: el.dataset.bsTrigger || 'hover focus'
        });
      });
    }

    /*
     ********************************************************************************************
     *
     * JS helpers to add custom functionality
     *
     *********************************************************************************************
     */

    /*
     * Toggle class on element click
     *
     * Helpers.run('dm-toggle-class');
     *
     * Example usage (on button click, "exampleClass" class is toggled on the element with id "elementID"):
     *
     * <button type="button" class="btn btn-primary" data-toggle="class-toggle" data-target="#elementID" data-class="exampleClass">Toggle</button>
     *
     * or
     *
     * <button type="button" class="btn btn-primary js-class-toggle" data-target="#elementID" data-class="exampleClass">Toggle</button>
     *
     */
  }, {
    key: "dmToggleClass",
    value: function dmToggleClass() {
      var elements = document.querySelectorAll('[data-toggle="class-toggle"]:not(.js-class-toggle-enabled), .js-class-toggle:not(.js-class-toggle-enabled)');
      elements.forEach(function (el) {
        el.addEventListener('click', function () {
          // Add .js-class-toggle-enabled class to tag it as activated
          el.classList.add('js-class-toggle-enabled');

          // Get all classes
          var cssClasses = el.dataset["class"] ? el.dataset["class"].split(' ') : false;

          // Toggle class on target elements
          document.querySelectorAll(el.dataset.target).forEach(function (targetEl) {
            if (cssClasses) {
              cssClasses.forEach(function (cls) {
                targetEl.classList.toggle(cls);
              });
            }
          });
        });
      });
    }

    /*
     * Add the correct copyright year to an element
     *
     * Helpers.run('dm-year-copy');
     *
     * Example usage (it will get populated with current year if empty or will append it to specified year if needed):
     *
     * <span data-toggle="year-copy"></span> or
     * <span data-toggle="year-copy">2018</span>
     *
     */
  }, {
    key: "dmYearCopy",
    value: function dmYearCopy() {
      var elements = document.querySelectorAll('[data-toggle="year-copy"]:not(.js-year-copy-enabled)');
      elements.forEach(function (el) {
        var date = new Date();
        var currentYear = date.getFullYear();
        var baseYear = el.textContent || currentYear;

        // Add .js-year-copy-enabled class to tag it as activated
        el.classList.add('js-year-copy-enabled');

        // Set the correct year
        el.textContent = parseInt(baseYear) >= currentYear ? currentYear : baseYear + '-' + currentYear.toString().substr(2, 2);
      });
    }

    /*
     * Ripple effect fuctionality
     *
     * Helpers.run('dm-ripple');
     *
     * Example usage:
     *
     * <button type="button" class="btn btn-primary" data-toggle="click-ripple">Click Me!</button>
     *
     */
  }, {
    key: "dmRipple",
    value: function dmRipple() {
      var elements = document.querySelectorAll('[data-toggle="click-ripple"]:not(.js-click-ripple-enabled)');
      elements.forEach(function (el) {
        // Add .js-click-ripple-enabled class to tag it as activated and init it
        el.classList.add('js-click-ripple-enabled');

        // Add custom CSS styles
        el.style.overflow = 'hidden';
        el.style.position = 'relative';
        el.style.zIndex = 1;

        // On click create and render the ripple
        el.addEventListener('click', function (e) {
          var cssClass = 'click-ripple';
          var ripple = el.querySelector('.' + cssClass);
          var d, x, y;

          // If the ripple element exists in this element, remove .animate class from ripple element..
          if (ripple) {
            ripple.classList.remove('animate');
          } else {
            // ..else add it
            var elChild = document.createElement('span');
            elChild.classList.add(cssClass);
            el.insertBefore(elChild, el.firstChild);
          }

          // Get the ripple element
          ripple = el.querySelector('.' + cssClass);

          // If the ripple element doesn't have dimensions, set them accordingly
          if (getComputedStyle(ripple).height === '0px' || getComputedStyle(ripple).width === '0px') {
            d = Math.max(el.offsetWidth, el.offsetHeight);
            ripple.style.height = d + 'px';
            ripple.style.width = d + 'px';
          }

          // Get coordinates for our ripple element
          x = e.pageX - (el.getBoundingClientRect().left + window.scrollX) - parseFloat(getComputedStyle(ripple).width.replace('px', '')) / 2;
          y = e.pageY - (el.getBoundingClientRect().top + window.scrollY) - parseFloat(getComputedStyle(ripple).height.replace('px', '')) / 2;

          // Position the ripple element and add the class .animate to it
          ripple.style.top = y + 'px';
          ripple.style.left = x + 'px';
          ripple.classList.add('animate');
        });
      });
    }

    /*
     * Print Page functionality
     *
     * Helpers.run('dm-print');
     *
     */
  }, {
    key: "dmPrint",
    value: function dmPrint() {
      // Store all #page-container classes
      var lPage = document.getElementById('page-container');
      var pageCls = lPage.className;
      console.log(pageCls);

      // Remove all classes from #page-container
      lPage.classList = '';

      // Print the page
      window.print();

      // Restore all #page-container classes
      lPage.classList = pageCls;
    }

    /*
     * Table sections functionality
     *
     * Helpers.run('dm-table-tools-sections');
     *
     * Example usage:
     *
     * Please check out the Table Helpers page for complete markup examples
     *
     */
  }, {
    key: "dmTableToolsSections",
    value: function dmTableToolsSections() {
      var tables = document.querySelectorAll('.js-table-sections:not(.js-table-sections-enabled)');
      tables.forEach(function (table) {
        // Add .js-table-sections-enabled class to tag it as activated
        table.classList.add('js-table-sections-enabled');

        // When a row is clicked in tbody.js-table-sections-header
        table.querySelectorAll('.js-table-sections-header > tr').forEach(function (tr) {
          tr.addEventListener('click', function (e) {
            if (e.target.type !== 'checkbox' && e.target.type !== 'button' && e.target.tagName.toLowerCase() !== 'a' && e.target.parentNode.nodeName.toLowerCase() !== 'a' && e.target.parentNode.nodeName.toLowerCase() !== 'button' && e.target.parentNode.nodeName.toLowerCase() !== 'label' && !e.target.parentNode.classList.contains('custom-control')) {
              var tbody = tr.parentNode;
              var tbodyAll = table.querySelectorAll('tbody');
              if (!tbody.classList.contains('show')) {
                if (tbodyAll) {
                  tbodyAll.forEach(function (tbodyEl) {
                    tbodyEl.classList.remove('show');
                    tbodyEl.classList.remove('table-active');
                  });
                }
              }
              tbody.classList.toggle('show');
              tbody.classList.toggle('table-active');
            }
          });
        });
      });
    }

    /*
     * Checkable table functionality
     *
     * Helpers.run('dm-table-tools-checkable');
     *
     * Example usage:
     *
     * Please check out the Table Helpers page for complete markup examples
     *
     */
  }, {
    key: "dmTableToolsCheckable",
    value: function dmTableToolsCheckable() {
      var _this2 = this;
      var tables = document.querySelectorAll('.js-table-checkable:not(.js-table-checkable-enabled)');
      tables.forEach(function (table) {
        // Add .js-table-checkable-enabled class to tag it as activated
        table.classList.add('js-table-checkable-enabled');

        // When a checkbox is clicked in thead
        table.querySelector('thead input[type=checkbox]').addEventListener('click', function (e) {
          // Check or uncheck all checkboxes in tbody
          table.querySelectorAll('tbody input[type=checkbox]').forEach(function (checkbox) {
            checkbox.checked = e.currentTarget.checked;

            // Update Row classes
            _this2.tableToolscheckRow(checkbox, e.currentTarget.checked);
          });
        });

        // When a checkbox is clicked in tbody
        table.querySelectorAll('tbody input[type=checkbox], tbody input + label').forEach(function (checkbox) {
          checkbox.addEventListener('click', function (e) {
            var checkboxHead = table.querySelector('thead input[type=checkbox]');

            // Adjust checkbox in thead
            if (!checkbox.checked) {
              checkboxHead.checked = false;
            } else {
              if (table.querySelectorAll('tbody input[type=checkbox]:checked').length === table.querySelectorAll('tbody input[type=checkbox]').length) {
                checkboxHead.checked = true;
              }
            }

            // Update Row classes
            _this2.tableToolscheckRow(checkbox, checkbox.checked);
          });
        });

        // When a row is clicked in tbody
        table.querySelectorAll('tbody > tr').forEach(function (tr) {
          tr.addEventListener('click', function (e) {
            if (e.target.type !== 'checkbox' && e.target.type !== 'button' && e.target.tagName.toLowerCase() !== 'a' && e.target.parentNode.nodeName.toLowerCase() !== 'a' && e.target.parentNode.nodeName.toLowerCase() !== 'button' && e.target.parentNode.nodeName.toLowerCase() !== 'label' && !e.target.parentNode.classList.contains('custom-control')) {
              var checkboxHead = table.querySelector('thead input[type=checkbox]');
              var checkbox = e.currentTarget.querySelector('input[type=checkbox]');

              // Update row's checkbox status
              checkbox.checked = !checkbox.checked;

              // Update Row classes
              _this2.tableToolscheckRow(checkbox, checkbox.checked);

              // Adjust checkbox in thead
              if (!checkbox.checked) {
                checkboxHead.checked = false;
              } else {
                if (table.querySelectorAll('tbody input[type=checkbox]:checked').length === table.querySelectorAll('tbody input[type=checkbox]').length) {
                  checkboxHead.checked = true;
                }
              }
            }
          });
        });
      });
    }

    // Checkable table functionality helper - Checks or unchecks table row
  }, {
    key: "tableToolscheckRow",
    value: function tableToolscheckRow(checkbox, checkedStatus) {
      if (checkedStatus) {
        checkbox.closest('tr').classList.add('table-active');
      } else {
        checkbox.closest('tr').classList.remove('table-active');
      }
    }

    /*
     ********************************************************************************************
     *
     * Init helpers for pure JS libraries
     *
     ********************************************************************************************
     */

    /*
     * CKEditor init, for more examples you can check out http://ckeditor.com/
     *
     * Helpers.run('jsCkeditor');
     *
     * Example usage:
     *
     * <textarea id="js-ckeditor" name="ckeditor">Hello CKEditor!</textarea> or
     * <div id="js-ckeditor-inline">Hello inline CKEditor!</div>
     *
     */
  }, {
    key: "jsCkeditor",
    value: function jsCkeditor() {
      var ckeditorInline = document.querySelector('#js-ckeditor-inline:not(.js-ckeditor-inline-enabled)');
      var ckeditorFull = document.querySelector('#js-ckeditor:not(.js-ckeditor-enabled)');

      // Init inline text editor
      if (ckeditorInline) {
        ckeditorInline.setAttribute('contenteditable', 'true');
        CKEDITOR.inline('js-ckeditor-inline');

        // Add .js-ckeditor-inline-enabled class to tag it as activated
        ckeditorInline.classList.add('js-ckeditor-inline-enabled');
      }

      // Init full text editor
      if (ckeditorFull) {
        CKEDITOR.replace('js-ckeditor');

        // Add .js-ckeditor-enabled class to tag it as activated
        ckeditorFull.classList.add('js-ckeditor-enabled');
      }
    }

    /*
     * CKEditor 5 init, for more examples you can check out http://ckeditor.com/
     *
     * Helpers.run('js-ckeditor5');
     *
     * Example usage:
     *
     * <div id="js-ckeditor5-classic">Hello classic CKEditor 5!</div>
     * ..or..
     * <div id="js-ckeditor5-inline">Hello inline CKEditor 5!</div>
     *
     */
  }, {
    key: "jsCkeditor5",
    value: function jsCkeditor5() {
      var ckeditor5Inline = document.querySelector('#js-ckeditor5-inline');
      var ckeditor5Full = document.querySelector('#js-ckeditor5-classic');

      // Init inline text editor
      if (ckeditor5Inline) {
        InlineEditor.create(document.querySelector('#js-ckeditor5-inline')).then(function (editor) {
          window.editor = editor;
        })["catch"](function (error) {
          console.error('There was a problem initializing the inline editor.', error);
        });
      }

      // Init full text editor
      if (ckeditor5Full) {
        ClassicEditor.create(document.querySelector('#js-ckeditor5-classic')).then(function (editor) {
          window.editor = editor;
        })["catch"](function (error) {
          console.error('There was a problem initializing the classic editor.', error);
        });
      }
    }

    /*
     * SimpleMDE init, for more examples you can check out https://github.com/NextStepWebs/simplemde-markdown-editor
     *
     * Helpers.run('js-simplemde');
     *
     * Example usage:
     *
     * <textarea class="js-simplemde" id="simplemde" name="simplemde">Hello SimpleMDE!</textarea>
     *
     */
  }, {
    key: "jsSimpleMDE",
    value: function jsSimpleMDE() {
      var elements = document.querySelectorAll('.js-simplemde');
      elements.forEach(function (el) {
        // Init editor
        new SimpleMDE({
          element: el,
          autoDownloadFontAwesome: false
        });
      });

      // Fix: Change SimpleMDE's Font Awesome 4 Icons with Font Awesome 5
      if (elements) {
        document.querySelector('.editor-toolbar > a.fa-header').classList.replace('fa-header', 'fa-heading');
        document.querySelector('.editor-toolbar > a.fa-picture-o').classList.replace('fa-picture-o', 'fa-image');
      }
    }

    /*
     * Highlight.js, for more examples you can check out https://highlightjs.org/usage/
     *
     * Helpers.run('js-highlightjs');
     *
     * Example usage:
     *
     * Please check out the Syntax Highlighting page in Components for complete markup examples
     *
     */
  }, {
    key: "jsHighlightjs",
    value: function jsHighlightjs() {
      // Init Highlight.js
      if (!hljs.isHighlighted) {
        hljs.initHighlighting();
      }
    }

    /*
     * Flatpickr init, for more examples you can check out https://github.com/flatpickr/flatpickr
     *
     * Helpers.run('js-flatpickr');
     *
     * Example usage:
     *
     * <input type="text" class="js-flatpickr form-control">
     *
     */
  }, {
    key: "jsFlatpickr",
    value: function jsFlatpickr() {
      var elements = document.querySelectorAll('.js-flatpickr:not(.js-flatpickr-enabled)');
      elements.forEach(function (el) {
        // Add .js-flatpickr-enabled class to tag it as activated
        el.classList.add('js-flatpickr-enabled');

        // Init it
        flatpickr(el);
      });
    }

    /*
     ********************************************************************************************
     *
     * Init helpers for jQuery plugins
     *
     ********************************************************************************************
     */

    /*
     * jQuery Appear, for more examples you can check out https://github.com/bas2k/jquery.appear
     *
     * Helpers.run('jq-appear');
     *
     * Example usage (the following div will appear on scrolling, remember to add the invisible class):
     *
     * <div class="invisible" data-toggle="appear">...</div>
     *
     */
  }, {
    key: "jqAppear",
    value: function jqAppear() {
      // Add a specific class on elements (when they become visible on scrolling)
      jQuery('[data-toggle="appear"]:not(.js-appear-enabled)').each(function (index, element) {
        var windowW = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        var el = jQuery(element);
        var elCssClass = el.data('class') || 'animated fadeIn';
        var elOffset = el.data('offset') || 0;
        var elTimeout = windowW < 992 ? 0 : el.data('timeout') ? el.data('timeout') : 0;

        // Add .js-appear-enabled class to tag it as activated and init it
        el.addClass('js-appear-enabled').appear(function () {
          setTimeout(function () {
            el.removeClass('invisible').addClass(elCssClass);
          }, elTimeout);
        }, {
          accY: elOffset
        });
      });
    }

    /*
     * Magnific Popup functionality, for more examples you can check out http://dimsemenov.com/plugins/magnific-popup/
     *
     * Helpers.run('jq-magnific-popup');
     *
     * Example usage:
     *
     * Please check out the Gallery page in Components for complete markup examples
     *
     */
  }, {
    key: "jqMagnific",
    value: function jqMagnific() {
      // Gallery init
      jQuery('.js-gallery:not(.js-gallery-enabled)').each(function (index, element) {
        // Add .js-gallery-enabled class to tag it as activated and init it
        jQuery(element).addClass('js-gallery-enabled').magnificPopup({
          delegate: 'a.img-lightbox',
          type: 'image',
          gallery: {
            enabled: true
          }
        });
      });
    }

    /*
     * Slick init, for more examples you can check out http://kenwheeler.github.io/slick/
     *
     * Helpers.run('jq-slick');
     *
     * Example usage:
     *
     * <div class="js-slider">
     *   <div>Slide #1</div>
     *   <div>Slide #2</div>
     *   <div>Slide #3</div>
     * </div>
     *
     */
  }, {
    key: "jqSlick",
    value: function jqSlick() {
      // Get each slider element (with .js-slider class)
      jQuery('.js-slider:not(.js-slider-enabled)').each(function (index, element) {
        var el = jQuery(element);

        // Add .js-slider-enabled class to tag it as activated and init it
        el.addClass('js-slider-enabled').slick({
          arrows: el.data('arrows') || false,
          dots: el.data('dots') || false,
          slidesToShow: el.data('slides-to-show') || 1,
          centerMode: el.data('center-mode') || false,
          autoplay: el.data('autoplay') || false,
          autoplaySpeed: el.data('autoplay-speed') || 3000,
          infinite: typeof el.data('infinite') === 'undefined' ? true : el.data('infinite')
        });
      });
    }

    /*
     * Bootstrap Datepicker init, for more examples you can check out https://github.com/eternicode/bootstrap-datepicker
     *
     * Helpers.run('jq-datepicker');
     *
     * Example usage:
     *
     * <input type="text" class="js-datepicker form-control">
     *
     */
  }, {
    key: "jqDatepicker",
    value: function jqDatepicker() {
      // Init datepicker (with .js-datepicker and .input-daterange class)
      jQuery('.js-datepicker:not(.js-datepicker-enabled)').add('.input-daterange:not(.js-datepicker-enabled)').each(function (index, element) {
        var el = jQuery(element);

        // Add .js-datepicker-enabled class to tag it as activated and init it
        el.addClass('js-datepicker-enabled').datepicker({
          weekStart: el.data('week-start') || 0,
          autoclose: el.data('autoclose') || false,
          todayHighlight: el.data('today-highlight') || false,
          container: el.data('container') || '#page-container',
          orientation: 'bottom' // Position issue when using BS5, set it to bottom until officially supported
        });
      });
    }

    /*
     * Bootstrap Colorpicker init, for more examples you can check out https://github.com/itsjavi/bootstrap-colorpicker/
     *
     * Helpers.run('jq-colorpicker');
     *
     * Example usage:
     *
     * <input type="text" class="js-colorpicker form-control" value="#db4a39">
     *
     */
  }, {
    key: "jqColorpicker",
    value: function jqColorpicker() {
      // Get each colorpicker element (with .js-colorpicker class)
      jQuery('.js-colorpicker:not(.js-colorpicker-enabled)').each(function (index, element) {
        // Add .js-enabled class to tag it as activated and init it
        setTimeout(function () {
          jQuery(element).addClass('js-colorpicker-enabled').colorpicker();
        }, 500);
      });
    }

    /*
     * Masked Inputs, for more examples you can check out https://github.com/digitalBush/jquery.maskedinput
     *
     * Helpers.run('jq-masked-inputs');
     *
     * Example usage:
     *
     * Please check out the Form plugins page for complete markup examples
     *
     */
  }, {
    key: "jqMaskedInputs",
    value: function jqMaskedInputs() {
      // Init Masked Inputs
      // a - Represents an alpha character (A-Z,a-z)
      // 9 - Represents a numeric character (0-9)
      // * - Represents an alphanumeric character (A-Z,a-z,0-9)
      jQuery('.js-masked-date:not(.js-masked-enabled)').mask('99/99/9999');
      jQuery('.js-masked-date-dash:not(.js-masked-enabled)').mask('99-99-9999');
      jQuery('.js-masked-phone:not(.js-masked-enabled)').mask('(999) 999-9999');
      jQuery('.js-masked-phdm-ext:not(.js-masked-enabled)').mask('(999) 999-9999? x99999');
      jQuery('.js-masked-taxid:not(.js-masked-enabled)').mask('99-9999999');
      jQuery('.js-masked-ssn:not(.js-masked-enabled)').mask('999-99-9999');
      jQuery('.js-masked-pkey:not(.js-masked-enabled)').mask('a*-999-a999');
      jQuery('.js-masked-time:not(.js-masked-enabled)').mask('99:99');
      jQuery('.js-masked-date').add('.js-masked-date-dash').add('.js-masked-phone').add('.js-masked-phdm-ext').add('.js-masked-taxid').add('.js-masked-ssn').add('.js-masked-pkey').add('.js-masked-time').addClass('js-masked-enabled');
    }

    /*
     * Select2, for more examples you can check out https://github.com/select2/select2
     *
     * Helpers.run('jq-select2');
     *
     * Example usage:
     *
     * <select class="js-select2 form-control" style="width: 100%;" data-placeholder="Choose one..">
     *   <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
     *   <option value="1">HTML</option>
     *   <option value="2">CSS</option>
     *   <option value="3">Javascript</option>
     * </select>
     *
     */
  }, {
    key: "jqSelect2",
    value: function jqSelect2() {
      // Init Select2 (with .js-select2 class)
      jQuery('.js-select2:not(.js-select2-enabled)').each(function (index, element) {
        var el = jQuery(element);

        // Add .js-select2-enabled class to tag it as activated and init it
        el.addClass('js-select2-enabled').select2({
          placeholder: el.data('placeholder') || false,
          dropdownParent: el.data('container') || document.getElementById('page-container')
        });
      });
    }

    /*
     * Bootstrap Notify, for more examples you can check out http://bootstrap-growl.remabledesigns.com/
     *
     * Helpers.run('jq-notify');
     *
     * Example usage:
     *
     * Please check out the Notifications page for examples
     *
     */
  }, {
    key: "jqNotify",
    value: function jqNotify() {
      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      if (jQuery.isEmptyObject(options)) {
        // Init notifications (with .js-notify class)
        jQuery('.js-notify:not(.js-notify-enabled)').each(function (index, element) {
          // Add .js-notify-enabled class to tag it as activated and init it
          jQuery(element).addClass('js-notify-enabled').on('click.pixelcave.helpers', function (e) {
            var el = jQuery(e.currentTarget);

            // Create notification
            jQuery.notify({
              icon: el.data('icon') || '',
              message: el.data('message'),
              url: el.data('url') || ''
            }, {
              element: 'body',
              type: el.data('type') || 'info',
              placement: {
                from: el.data('from') || 'top',
                align: el.data('align') || 'right'
              },
              allow_dismiss: true,
              newest_on_top: true,
              showProgressbar: false,
              offset: 20,
              spacing: 10,
              z_index: 1033,
              delay: 5000,
              timer: 1000,
              animate: {
                enter: 'animated fadeIn',
                exit: 'animated fadeOutDown'
              },
              template: "<div data-notify=\"container\" class=\"col-11 col-sm-4 alert alert-{0} alert-dismissible\" role=\"alert\">\n  <p class=\"mb-0\">\n    <span data-notify=\"icon\"></span>\n    <span data-notify=\"title\">{1}</span>\n    <span data-notify=\"message\">{2}</span>\n  </p>\n  <div class=\"progress\" data-notify=\"progressbar\">\n    <div class=\"progress-bar progress-bar-{0}\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;\"></div>\n  </div>\n  <a href=\"{3}\" target=\"{4}\" data-notify=\"url\"></a>\n  <a class=\"p-2 m-1 text-body-color-dark\" href=\"javascript:void(0)\" aria-label=\"Close\" data-notify=\"dismiss\">\n    <i class=\"fa fa-times\"></i>\n  </a>\n</div>"
            });
          });
        });
      } else {
        // Create notification
        jQuery.notify({
          icon: options.icon || '',
          message: options.message,
          url: options.url || ''
        }, {
          element: options.element || 'body',
          type: options.type || 'info',
          placement: {
            from: options.from || 'top',
            align: options.align || 'right'
          },
          allow_dismiss: options.allow_dismiss === false ? false : true,
          newest_on_top: options.newest_on_top === false ? false : true,
          showProgressbar: options.show_progress_bar ? true : false,
          offset: options.offset || 20,
          spacing: options.spacing || 10,
          z_index: options.z_index || 1033,
          delay: options.delay || 5000,
          timer: options.timer || 1000,
          animate: {
            enter: options.animate_enter || 'animated fadeIn',
            exit: options.animate_exit || 'animated fadeOutDown'
          },
          template: "<div data-notify=\"container\" class=\"col-11 col-sm-4 alert alert-{0} alert-dismissible\" role=\"alert\">\n  <p class=\"mb-0\">\n    <span data-notify=\"icon\"></span>\n    <span data-notify=\"title\">{1}</span>\n    <span data-notify=\"message\">{2}</span>\n  </p>\n  <div class=\"progress\" data-notify=\"progressbar\">\n    <div class=\"progress-bar progress-bar-{0}\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;\"></div>\n  </div>\n  <a href=\"{3}\" target=\"{4}\" data-notify=\"url\"></a>\n  <a class=\"p-2 m-1 text-body-color-dark\" href=\"javascript:void(0)\" aria-label=\"Close\" data-notify=\"dismiss\">\n    <i class=\"fa fa-times\"></i>\n  </a>\n</div>"
        });
      }
    }

    /*
     * Easy Pie Chart, for more examples you can check out http://rendro.github.io/easy-pie-chart/
     *
     * Helpers.run('jq-easy-pie-chart');
     *
     * Example usage:
     *
     * <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="2" data-size="100">
     *   <span>..Content..</span>
     * </div>
     *
     */
  }, {
    key: "jqEasyPieChart",
    value: function jqEasyPieChart() {
      // Init Easy Pie Charts (with .js-pie-chart class)
      jQuery('.js-pie-chart:not(.js-pie-chart-enabled)').each(function (index, element) {
        var el = jQuery(element);

        // Add .js-pie-chart-enabled class to tag it as activated and init it
        el.addClass('js-pie-chart-enabled').easyPieChart({
          barColor: el.data('bar-color') || '#777777',
          trackColor: el.data('track-color') || '#eeeeee',
          lineWidth: el.data('line-width') || 3,
          size: el.data('size') || '80',
          animate: el.data('animate') || 750,
          scaleColor: el.data('scale-color') || false
        });
      });
    }

    /*
     * Bootstrap Maxlength, for more examples you can check out https://github.com/mimo84/bootstrap-maxlength
     *
     * Helpers.run('jq-maxlength');
     *
     * Example usage:
     *
     * <input type="text" class="js-maxlength form-control" maxlength="20">
     *
     */
  }, {
    key: "jqMaxlength",
    value: function jqMaxlength() {
      // Init Bootstrap Maxlength (with .js-maxlength class)
      jQuery('.js-maxlength:not(.js-maxlength-enabled)').each(function (index, element) {
        var el = jQuery(element);

        // Add .js-maxlength-enabled class to tag it as activated and init it
        el.addClass('js-maxlength-enabled').maxlength({
          alwaysShow: el.data('always-show') ? true : false,
          threshold: el.data('threshold') || 10,
          warningClass: el.data('warning-class') || 'badge bg-warning',
          limitReachedClass: el.data('limit-reached-class') || 'badge bg-danger',
          placement: el.data('placement') || 'bottom',
          preText: el.data('pre-text') || '',
          separator: el.data('separator') || '/',
          postText: el.data('post-text') || ''
        });
      });
    }

    /*
     * Ion Range Slider, for more examples you can check out https://github.com/IonDen/ion.rangeSlider
     *
     * Helpers.run('jq-rangeslider');
     *
     * Example usage:
     *
     * <input type="text" class="js-rangeslider form-control" value="50">
     *
     */
  }, {
    key: "jqRangeslider",
    value: function jqRangeslider() {
      // Init Ion Range Slider (with .js-rangeslider class)
      jQuery('.js-rangeslider:not(.js-rangeslider-enabled)').each(function (index, element) {
        var el = jQuery(element);

        // Add .js-rangeslider-enabled class to tag it as activated and init it
        jQuery(element).addClass('js-rangeslider-enabled').ionRangeSlider({
          input_values_separator: ';',
          skin: el.data('skin') || 'round'
        });
      });
    }

    /*
     * Password Strength Meter, for more examples you can check out https://github.com/ablanco/jquery.pwstrength.bootstrap
     *
     * Helpers.run('jq-pw-strength');
     *
     * Example usage:
     *
     * <div class="js-pw-strength-container mb-4">
     *   <label for="example-pw-strength1">Password</label>
     *   <input type="password" class="js-pw-strength form-control" id="example-pw-strength1" name="example-pw-strength1">
     *   <div class="js-pw-strength-progress pw-strength-progress mt-1"></div>
     *   <p class="js-pw-strength-feedback form-text mb-0"></p>
     * </div>
     *
     */
  }, {
    key: "jqPwStrength",
    value: function jqPwStrength() {
      // Init Password Strength Meter (with .js-pw-strength class)
      jQuery('.js-pw-strength:not(.js-pw-strength-enabled)').each(function (index, element) {
        var el = jQuery(element);
        var container = el.parents('.js-pw-strength-container');
        var progress = jQuery('.js-pw-strength-progress', container);
        var verdict = jQuery('.js-pw-strength-feedback', container);

        // Add .js-pw-strength-enabled class to tag it as activated and init it
        el.addClass('js-pw-strength-enabled').pwstrength({
          ui: {
            container: container,
            viewports: {
              progress: progress,
              verdict: verdict
            }
          }
        });
      });
    }

    /*
     * jQuery Sparkline Charts, for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-docs
     *
     * Helpers.run('jq-sparkline');
     *
     * Example usage:
     *
     * <span class="js-sparkline" data-type="line" data-points="[10,20,30,25,15,40,45]"></span>
     *
     */
  }, {
    key: "jqSparkline",
    value: function jqSparkline() {
      var self = this;

      // Init jQuery Sparkline Charts (with .js-sparkline class)
      jQuery('.js-sparkline:not(.js-sparkline-enabled)').each(function (index, element) {
        var el = jQuery(element);
        var type = el.data('type');
        var options = {};

        // Sparkline types
        var types = {
          line: function line() {
            options['type'] = type;
            options['lineWidth'] = el.data('line-width') || 2;
            options['lineColor'] = el.data('line-color') || '#0665d0';
            options['fillColor'] = el.data('fill-color') || '#0665d0';
            options['spotColor'] = el.data('spot-color') || '#495057';
            options['minSpotColor'] = el.data('min-spot-color') || '#495057';
            options['maxSpotColor'] = el.data('max-spot-color') || '#495057';
            options['highlightSpotColor'] = el.data('highlight-spot-color') || '#495057';
            options['highlightLineColor'] = el.data('highlight-line-color') || '#495057';
            options['spotRadius'] = el.data('spot-radius') || 2;
            options['tooltipFormat'] = '{{prefix}}{{y}}{{suffix}}';
          },
          bar: function bar() {
            options['type'] = type;
            options['barWidth'] = el.data('bar-width') || 8;
            options['barSpacing'] = el.data('bar-spacing') || 6;
            options['barColor'] = el.data('bar-color') || '#0665d0';
            options['tooltipFormat'] = '{{prefix}}{{value}}{{suffix}}';
          },
          pie: function pie() {
            options['type'] = type;
            options['sliceColors'] = ['#fadb7d', '#faad7d', '#75b0eb', '#abe37d'];
            options['highlightLighten'] = el.data('highlight-lighten') || 1.1;
            options['tooltipFormat'] = '{{prefix}}{{value}}{{suffix}}';
          },
          tristate: function tristate() {
            options['type'] = type;
            options['barWidth'] = el.data('bar-width') || 8;
            options['barSpacing'] = el.data('bar-spacing') || 6;
            options['posBarColor'] = el.data('pos-bar-color') || '#82b54b';
            options['negBarColor'] = el.data('neg-bar-color') || '#e04f1a';
          }
        };

        // If the correct type is set init the chart
        if (types[type]) {
          types[type]();

          // Extra options added only if specified
          if (type === 'line') {
            if (el.data('chart-range-min') >= 0 || el.data('chart-range-min')) {
              options['chartRangeMin'] = el.data('chart-range-min');
            }
            if (el.data('chart-range-max') >= 0 || el.data('chart-range-max')) {
              options['chartRangeMax'] = el.data('chart-range-max');
            }
          }

          // Add common options used in all types
          options['width'] = el.data('width') || '120px';
          options['height'] = el.data('height') || '80px';
          options['tooltipPrefix'] = el.data('tooltip-prefix') ? el.data('tooltip-prefix') + ' ' : '';
          options['tooltipSuffix'] = el.data('tooltip-suffix') ? ' ' + el.data('tooltip-suffix') : '';

          // If we need a responsive width for the chart, then don't add .js-sparkline-enabled class and re-run the helper on window resize
          if (options['width'] === '100%') {
            if (!jqSparklineResize) {
              // Make sure that we bind the event only once
              jqSparklineResize = true;

              // On window resize, re-run the Sparkline helper
              jQuery(window).on('resize.pixelcave.helpers.sparkline', function (e) {
                clearTimeout(jqSparklineTimeout);
                jqSparklineTimeout = setTimeout(function () {
                  self.sparkline();
                }, 500);
              });
            }
          } else {
            // It has a specific width (it doesn't need to re-init again on resize), so add .js-sparkline-enabled class to tag it as activated
            jQuery(element).addClass('js-sparkline-enabled');
          }

          // Finally init it
          jQuery(element).sparkline(el.data('points') || [0], options);
        } else {
          console.log('[jQuery Sparkline JS Helper] Please add a correct type (line, bar, pie or tristate) in all your elements with \'js-sparkline\' class.');
        }
      });
    }

    /*
     * jQuery Validation, for more examples you can check out https://github.com/jzaefferer/jquery-validation
     *
     * Helpers.run('jq-validation');
     *
     * Example usage:
     *
     * By calling the helper, you set up the default options that will be used for jQuery Validation
     *
     */
  }, {
    key: "jqValidation",
    value: function jqValidation() {
      // Set default options for jQuery Validation plugin
      jQuery.validator.setDefaults({
        errorClass: 'invalid-feedback animated fadeIn',
        errorElement: 'div',
        errorPlacement: function errorPlacement(error, el) {
          jQuery(el).addClass('is-invalid');
          jQuery(el).parents('div:not(.input-group)').first().append(error);
        },
        highlight: function highlight(el) {
          jQuery(el).parents('div:not(.input-group)').first().find('.is-invalid').removeClass('is-invalid').addClass('is-invalid');
        },
        success: function success(el) {
          jQuery(el).parents('div:not(.input-group)').first().find('.is-invalid').removeClass('is-invalid');
          jQuery(el).remove();
        }
      });
    }
  }]);
  return Helpers;
}();


/***/ }),

/***/ "./storage/orbitali/src/Assets/source/js/dashmix/modules/template.js":
/*!***************************************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/js/dashmix/modules/template.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Template)
/* harmony export */ });
/* harmony import */ var simplebar__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! simplebar */ "./node_modules/.pnpm/simplebar@5.3.9/node_modules/simplebar/dist/simplebar.esm.js");
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./helpers */ "./storage/orbitali/src/Assets/source/js/dashmix/modules/helpers.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/*
 *  Document   : template.js
 *  Author     : pixelcave
 *  Description: UI Framework custom functionality
 *
 */

// Imports



// Template
var Template = /*#__PURE__*/function () {
  /*
   * Auto called when creating a new instance
   *
   */
  function Template() {
    _classCallCheck(this, Template);
    this.onLoad(this._uiInit.bind(this));
  }

  /*
   * Init all vital functionality
   *
   */
  _createClass(Template, [{
    key: "_uiInit",
    value: function _uiInit() {
      // Layout variables
      this._lHtml = document.documentElement;
      this._lBody = document.body;
      this._lpageLoader = document.getElementById('page-loader');
      this._lPage = document.getElementById('page-container');
      this._lSidebar = document.getElementById('sidebar');
      this._lSidebarScrollCon = this._lSidebar && this._lSidebar.querySelector('.js-sidebar-scroll');
      this._lSideOverlay = document.getElementById('side-overlay');
      this._lResize = false;
      this._lHeader = document.getElementById('page-header');
      this._lHeaderSearch = document.getElementById('page-header-search');
      this._lHeaderSearchInput = document.getElementById('page-header-search-input');
      this._lHeaderLoader = document.getElementById('page-header-loader');
      this._lMain = document.getElementById('main-container');
      this._lFooter = document.getElementById('page-footer');

      // Helper variables
      this._lSidebarScroll = false;
      this._lSideOverlayScroll = false;

      // Base UI Init
      this._uiHandleTheme();
      this._uiHandleDarkMode();
      this._uiHandleSidebars();
      this._uiHandleHeader();
      this._uiHandleNav();

      // API Init
      this._uiApiLayout();
      this._uiApiBlocks();

      // Init the following helpers by default
      this.helpers(['bs-tooltip', 'bs-popover', 'dm-toggle-class', 'dm-year-copy', 'dm-ripple']);

      // Page Loader (hide it)
      this._uiHandlePageLoader();
    }

    /*
     * Handles sidebar and side overlay scrolling functionality/styles
     *
     */
  }, {
    key: "_uiHandleSidebars",
    value: function _uiHandleSidebars() {
      var mode = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'init';
      var self = this;
      if (self._lSidebar || self._lSideOverlay) {
        if (mode === 'init') {
          // Add 'side-trans-enabled' class to #page-container (enables sidebar and side overlay transition on open/close)
          // Fixes IE10, IE11 and Edge bug in which animation was executed on each page load
          self._lPage.classList.add('side-trans-enabled');

          // Remove side transitions on window resizing
          window.addEventListener('resize', function () {
            clearTimeout(self._lResize);
            self._lPage.classList.remove('side-trans-enabled');
            self._lResize = setTimeout(function () {
              self._lPage.classList.add('side-trans-enabled');
            }, 500);
          });

          // Init custom scrolling
          this._uiHandleSidebars('custom-scroll');
        } else if (mode = 'custom-scroll') {
          // If .side-scroll is added to #page-container, enable custom scrolling
          if (self._lPage.classList.contains('side-scroll')) {
            // Init custom scrolling on Sidebar
            if (self._lSidebar && !self._lSidebarScroll) {
              self._lSidebarScroll = new simplebar__WEBPACK_IMPORTED_MODULE_0__["default"](self._lSidebarScrollCon);
            }

            // Init custom scrolling on Side Overlay
            if (self._lSideOverlay && !self._lSideOverlayScroll) {
              self._lSideOverlayScroll = new simplebar__WEBPACK_IMPORTED_MODULE_0__["default"](self._lSideOverlay);
            }
          }
        }
      }
    }

    /*
     * Handles header related classes
     *
     */
  }, {
    key: "_uiHandleHeader",
    value: function _uiHandleHeader() {
      var self = this;

      // If the header is fixed and has the glass style, add the related class on scrolling to add a background color to the header
      if (self._lPage.classList.contains('page-header-glass') && self._lPage.classList.contains('page-header-fixed')) {
        window.addEventListener('scroll', function (e) {
          if (window.scrollY > 60) {
            self._lPage.classList.add('page-header-scroll');
          } else {
            self._lPage.classList.remove('page-header-scroll');
          }
        });
        window.dispatchEvent(new CustomEvent('scroll'));
      }
    }

    /*
     * Toggle Submenu functionality
     *
     */
  }, {
    key: "_uiHandleNav",
    value: function _uiHandleNav() {
      var links = document.querySelectorAll('[data-toggle="submenu"]');

      // When a submenu link is clicked
      if (links) {
        links.forEach(function (link) {
          link.addEventListener('click', function (e) {
            e.preventDefault();

            // Get main navigation
            var mainNav = link.closest('.nav-main');

            // Check if we are in horizontal navigation, large screen and hover is enabled
            if (!((window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth) > 991 && mainNav.classList.contains('nav-main-horizontal') && mainNav.classList.contains('nav-main-hover'))) {
              // Get link's parent
              var parentLi = link.closest('li');
              if (parentLi.classList.contains('open')) {
                // If submenu is open, close it..
                parentLi.classList.remove('open');
                link.setAttribute('aria-expanded', 'false');
              } else {
                // .. else if submenu is closed, close all other (same level) submenus first before open it
                Array.from(link.closest('ul').children).forEach(function (el) {
                  el.classList.remove('open');
                });
                parentLi.classList.add('open');
                link.setAttribute('aria-expanded', 'true');
              }
            }
            return false;
          });
        });
      }
    }

    /*
     * Page loading screen functionality
     *
     */
  }, {
    key: "_uiHandlePageLoader",
    value: function _uiHandlePageLoader() {
      var mode = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'hide';
      var colorClass = arguments.length > 1 ? arguments[1] : undefined;
      if (mode === 'show') {
        if (this._lpageLoader) {
          if (colorClass) {
            this._lpageLoader.className = '';
            this._lpageLoader.classList.add(colorClass);
          }
          this._lpageLoader.classList.add('show');
        } else {
          var pageLoader = document.createElement('div');
          pageLoader.id = 'page-loader';
          if (colorClass) {
            pageLoader.classList.add(colorClass);
          }
          pageLoader.classList.add('show');
          this._lPage.insertBefore(pageLoader, this._lPage.firstChild);
          this._lpageLoader = document.getElementById('page-loader');
        }
      } else if (mode === 'hide') {
        if (this._lpageLoader) {
          this._lpageLoader.classList.remove('show');
        }
      }
    }

    /*
     * Saves/Retrieves Dark Mode preference to local storage
     *
     */
  }, {
    key: "_uiHandleDarkMode",
    value: function _uiHandleDarkMode() {
      var mode = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'init';
      var self = this;

      // If dark mode is not enabled by default remember default sidebar
      // and header style to return to after any possible dark mode disabling
      if (mode === 'init' && !self._lPage.classList.contains('dark-mode')) {
        if (self._lPage.classList.contains('sidebar-dark')) {
          localStorage.setItem('dashmixDefaultsSidebarDark', true);
        } else {
          localStorage.removeItem('dashmixDefaultsSidebarDark');
        }
        if (self._lPage.classList.contains('page-header-dark')) {
          localStorage.setItem('dashmixDefaultsPageHeaderDark', true);
        } else {
          localStorage.removeItem('dashmixDefaultsPageHeaderDark');
        }
      }

      // If remember-theme class is added in #page-container
      if (self._lPage.classList.contains('remember-theme')) {
        var darkMode = localStorage.getItem('dashmixDarkMode') || false;
        if (mode === 'init') {
          if (darkMode) {
            self._lPage.classList.add('sidebar-dark');
            self._lPage.classList.add('page-header-dark');
            self._lPage.classList.add('dark-mode');
          } else if (mode === 'init') {
            self._lPage.classList.remove('dark-mode');
          }
        } else if (mode === 'on') {
          localStorage.setItem('dashmixDarkMode', true);
        } else if (mode === 'off') {
          localStorage.removeItem('dashmixDarkMode');
        }
      } else if (mode === 'init') {
        localStorage.removeItem('dashmixDarkMode');
      }
    }

    /*
     * Set active color theme functionality
     *
     */
  }, {
    key: "_uiHandleTheme",
    value: function _uiHandleTheme() {
      var self = this;
      var themeEl = document.getElementById('css-theme');
      var rememberTheme = this._lPage.classList.contains('remember-theme') ? true : false;

      // If remember theme is enabled
      if (rememberTheme) {
        var themeName = localStorage.getItem('dashmixThemeName') || false;

        // Update color theme
        if (themeName) {
          self._uiUpdateTheme(themeEl, themeName);
        }

        // Update theme element
        themeEl = document.getElementById('css-theme');
      } else {
        localStorage.removeItem('dashmixThemeName');
      }

      // Set the active color theme link as active
      document.querySelectorAll('[data-toggle="theme"][data-theme="' + (themeEl ? themeEl.getAttribute('href') : 'default') + '"]').forEach(function (link) {
        link.classList.add('active');
      });

      // When a color theme link is clicked
      document.querySelectorAll('[data-toggle="theme"]').forEach(function (el) {
        el.addEventListener('click', function (e) {
          e.preventDefault();

          // Get element's data
          var themeName = el.dataset.theme;

          // Set this color theme link as active
          document.querySelectorAll('[data-toggle="theme"]').forEach(function (link) {
            link.classList.remove('active');
          });
          document.querySelector('[data-toggle="theme"][data-theme="' + themeName + '"]').classList.add('active');

          // Update color theme
          self._uiUpdateTheme(themeEl, themeName);

          // Update theme element
          themeEl = document.getElementById('css-theme');

          // If remember theme is enabled, save the new active color theme
          if (rememberTheme) {
            localStorage.setItem('dashmixThemeName', themeName);
          }
        });
      });
    }

    /*
     * Updates the color theme
     *
     */
  }, {
    key: "_uiUpdateTheme",
    value: function _uiUpdateTheme(themeEl, themeName) {
      if (themeName === 'default') {
        if (themeEl) {
          themeEl.parentNode.removeChild(themeEl);
        }
      } else {
        if (themeEl) {
          themeEl.setAttribute('href', themeName);
        } else {
          var themeLink = document.createElement('link');
          themeLink.id = 'css-theme';
          themeLink.setAttribute('rel', 'stylesheet');
          themeLink.setAttribute('href', themeName);
          document.getElementById('css-main').insertAdjacentElement('afterend', themeLink);
        }
      }
    }

    /*
     * Layout API
     *
     */
  }, {
    key: "_uiApiLayout",
    value: function _uiApiLayout() {
      var _this = this;
      var mode = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'init';
      var self = this;

      // API with object literals
      var layoutAPI = {
        init: function init() {
          var buttons = document.querySelectorAll('[data-toggle="layout"]');

          // Call layout API on button click
          if (buttons) {
            buttons.forEach(function (btn) {
              btn.addEventListener('click', function (e) {
                self._uiApiLayout(btn.dataset.action);
              });
            });
          }

          // Prepend Page Overlay div if enabled (used when Side Overlay opens)
          if (self._lPage.classList.contains('enable-page-overlay')) {
            var pageOverlay = document.createElement('div');
            pageOverlay.id = 'page-overlay';
            self._lPage.insertBefore(pageOverlay, self._lPage.firstChild);
            document.getElementById('page-overlay').addEventListener('click', function (e) {
              self._uiApiLayout('side_overlay_close');
            });
          }
        },
        sidebar_pos_toggle: function sidebar_pos_toggle() {
          self._lPage.classList.toggle('sidebar-r');
        },
        sidebar_pos_left: function sidebar_pos_left() {
          self._lPage.classList.remove('sidebar-r');
        },
        sidebar_pos_right: function sidebar_pos_right() {
          self._lPage.classList.add('sidebar-r');
        },
        sidebar_toggle: function sidebar_toggle() {
          if (window.innerWidth > 991) {
            self._lPage.classList.toggle('sidebar-o');
          } else {
            self._lPage.classList.toggle('sidebar-o-xs');
          }
        },
        sidebar_open: function sidebar_open() {
          if (window.innerWidth > 991) {
            self._lPage.classList.add('sidebar-o');
          } else {
            self._lPage.classList.add('sidebar-o-xs');
          }
        },
        sidebar_close: function sidebar_close() {
          if (window.innerWidth > 991) {
            self._lPage.classList.remove('sidebar-o');
          } else {
            self._lPage.classList.remove('sidebar-o-xs');
          }
        },
        sidebar_mini_toggle: function sidebar_mini_toggle() {
          if (window.innerWidth > 991) {
            self._lPage.classList.toggle('sidebar-mini');
          }
        },
        sidebar_mini_on: function sidebar_mini_on() {
          if (window.innerWidth > 991) {
            self._lPage.classList.add('sidebar-mini');
          }
        },
        sidebar_mini_off: function sidebar_mini_off() {
          if (window.innerWidth > 991) {
            self._lPage.classList.remove('sidebar-mini');
          }
        },
        sidebar_style_toggle: function sidebar_style_toggle() {
          if (self._lPage.classList.contains('sidebar-dark')) {
            self._uiApiLayout('sidebar_style_light');
          } else {
            self._uiApiLayout('sidebar_style_dark');
          }
        },
        sidebar_style_dark: function sidebar_style_dark() {
          self._lPage.classList.add('sidebar-dark');
          localStorage.setItem('dashmixDefaultsSidebarDark', true);
        },
        sidebar_style_light: function sidebar_style_light() {
          self._lPage.classList.remove('sidebar-dark');
          self._lPage.classList.remove('dark-mode');
          localStorage.removeItem('dashmixDefaultsSidebarDark');
        },
        side_overlay_toggle: function side_overlay_toggle() {
          if (self._lPage.classList.contains('side-overlay-o')) {
            self._uiApiLayout('side_overlay_close');
          } else {
            self._uiApiLayout('side_overlay_open');
          }
        },
        side_overlay_open: function side_overlay_open() {
          // When ESCAPE key is hit close the side overlay
          document.addEventListener('keydown', function (e) {
            if (e.key === 'Esc' || e.key === 'Escape') {
              self._uiApiLayout('side_overlay_close');
            }
          });
          self._lPage.classList.add('side-overlay-o');
        },
        side_overlay_close: function side_overlay_close() {
          self._lPage.classList.remove('side-overlay-o');
        },
        side_overlay_mode_hover_toggle: function side_overlay_mode_hover_toggle() {
          self._lPage.classList.toggle('side-overlay-hover');
        },
        side_overlay_mode_hover_on: function side_overlay_mode_hover_on() {
          self._lPage.classList.add('side-overlay-hover');
        },
        side_overlay_mode_hover_off: function side_overlay_mode_hover_off() {
          self._lPage.classList.remove('side-overlay-hover');
        },
        header_glass_toggle: function header_glass_toggle() {
          self._lPage.classList.toggle('page-header-glass');
          self._uiHandleHeader();
        },
        header_glass_on: function header_glass_on() {
          self._lPage.classList.add('page-header-glass');
          self._uiHandleHeader();
        },
        header_glass_off: function header_glass_off() {
          self._lPage.classList.remove('page-header-glass');
          self._uiHandleHeader();
        },
        header_mode_toggle: function header_mode_toggle() {
          self._lPage.classList.toggle('page-header-fixed');
        },
        header_mode_static: function header_mode_static() {
          self._lPage.classList.remove('page-header-fixed');
        },
        header_mode_fixed: function header_mode_fixed() {
          self._lPage.classList.add('page-header-fixed');
        },
        header_style_toggle: function header_style_toggle() {
          if (self._lPage.classList.contains('page-header-dark')) {
            self._uiApiLayout('header_style_light');
          } else {
            self._uiApiLayout('header_style_dark');
          }
        },
        header_style_dark: function header_style_dark() {
          self._lPage.classList.add('page-header-dark');
          localStorage.setItem('dashmixDefaultsPageHeaderDark', true);
        },
        header_style_light: function header_style_light() {
          self._lPage.classList.remove('page-header-dark');
          self._lPage.classList.remove('dark-mode');
          localStorage.removeItem('dashmixDefaultsPageHeaderDark');
        },
        header_search_on: function header_search_on() {
          self._lHeaderSearch.classList.add('show');
          self._lHeaderSearchInput.focus();

          // When ESCAPE key is hit close the search section
          document.addEventListener('keydown', function (e) {
            if (e.key === 'Esc' || e.key === 'Escape') {
              self._uiApiLayout('header_search_off');
            }
          });
        },
        header_search_off: function header_search_off() {
          self._lHeaderSearch.classList.remove('show');
          self._lHeaderSearchInput.blur();
        },
        header_loader_on: function header_loader_on() {
          self._lHeaderLoader.classList.add('show');
        },
        header_loader_off: function header_loader_off() {
          self._lHeaderLoader.classList.remove('show');
        },
        dark_mode_toggle: function dark_mode_toggle() {
          if (self._lPage.classList.contains('dark-mode')) {
            self._uiApiLayout('dark_mode_off');
          } else {
            self._uiApiLayout('dark_mode_on');
          }
        },
        dark_mode_on: function dark_mode_on() {
          self._lPage.classList.add('sidebar-dark');
          self._lPage.classList.add('page-header-dark');
          self._lPage.classList.add('dark-mode');
          _this._uiHandleDarkMode('on');
        },
        dark_mode_off: function dark_mode_off() {
          if (!localStorage.getItem('dashmixDefaultsSidebarDark')) {
            self._lPage.classList.remove('sidebar-dark');
          }
          if (!localStorage.getItem('dashmixDefaultsPageHeaderDark')) {
            self._lPage.classList.remove('page-header-dark');
          }
          self._lPage.classList.remove('dark-mode');
          _this._uiHandleDarkMode('off');
        },
        content_layout_toggle: function content_layout_toggle() {
          if (self._lPage.classList.contains('main-content-boxed')) {
            self._uiApiLayout('content_layout_narrow');
          } else if (self._lPage.classList.contains('main-content-narrow')) {
            self._uiApiLayout('content_layout_full_width');
          } else {
            self._uiApiLayout('content_layout_boxed');
          }
        },
        content_layout_boxed: function content_layout_boxed() {
          self._lPage.classList.remove('main-content-narrow');
          self._lPage.classList.add('main-content-boxed');
        },
        content_layout_narrow: function content_layout_narrow() {
          self._lPage.classList.remove('main-content-boxed');
          self._lPage.classList.add('main-content-narrow');
        },
        content_layout_full_width: function content_layout_full_width() {
          self._lPage.classList.remove('main-content-boxed');
          self._lPage.classList.remove('main-content-narrow');
        }
      };

      // Call layout API
      if (layoutAPI[mode]) {
        layoutAPI[mode]();
      }
    }

    /*
     * Blocks API
     *
     */
  }, {
    key: "_uiApiBlocks",
    value: function _uiApiBlocks() {
      var _this2 = this;
      var mode = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'init';
      var block = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      var self = this;

      // Helper variables
      var elBlock, btnFullscreen, btnContentToggle;

      // Set default icons for fullscreen and content toggle buttons
      var iconBase = 'fa';
      var iconFullscreen = 'si-size-fullscreen';
      var iconFullscreenActive = 'si-size-actual';
      var iconContent = 'fa-chevron-up';
      var iconContentActive = 'fa-chevron-down';

      // API with object literals
      var blockAPI = {
        init: function init() {
          // Auto add the default toggle icons to fullscreen and content toggle buttons
          document.querySelectorAll('[data-toggle="block-option"][data-action="fullscreen_toggle"]').forEach(function (btn) {
            btn.innerHTML = '<i class="' + iconBase + ' ' + (btn.closest('.block').classList.contains('block-mode-fullscreen') ? iconFullscreenActive : iconFullscreen) + '"></i>';
          });
          document.querySelectorAll('[data-toggle="block-option"][data-action="content_toggle"]').forEach(function (btn) {
            btn.innerHTML = '<i class="' + iconBase + ' ' + (btn.closest('.block').classList.contains('block-mode-hidden') ? iconContentActive : iconContent) + '"></i>';
          });

          // Call blocks API on option button click
          document.querySelectorAll('[data-toggle="block-option"]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
              _this2._uiApiBlocks(btn.dataset.action, btn.closest('.block'));
            });
          });
        },
        fullscreen_toggle: function fullscreen_toggle() {
          elBlock.classList.remove('block-mode-pinned');
          elBlock.classList.toggle('block-mode-fullscreen');

          // Update block option icon
          if (btnFullscreen) {
            if (elBlock.classList.contains('block-mode-fullscreen')) {
              btnFullscreen && btnFullscreen.querySelector('i').classList.replace(iconFullscreen, iconFullscreenActive);
            } else {
              btnFullscreen && btnFullscreen.querySelector('i').classList.replace(iconFullscreenActive, iconFullscreen);
            }
          }
        },
        fullscreen_on: function fullscreen_on() {
          elBlock.classList.remove('block-mode-pinned');
          elBlock.classList.add('block-mode-fullscreen');

          // Update block option icon
          btnFullscreen && btnFullscreen.querySelector('i').classList.replace(iconFullscreen, iconFullscreenActive);
        },
        fullscreen_off: function fullscreen_off() {
          elBlock.classList.remove('block-mode-fullscreen');

          // Update block option icon
          btnFullscreen && btnFullscreen.querySelector('i').classList.replace(iconFullscreenActive, iconFullscreen);
        },
        content_toggle: function content_toggle() {
          elBlock.classList.toggle('block-mode-hidden');

          // Update block option icon
          if (btnContentToggle) {
            if (elBlock.classList.contains('block-mode-hidden')) {
              btnContentToggle.querySelector('i').classList.replace(iconContent, iconContentActive);
            } else {
              btnContentToggle.querySelector('i').classList.replace(iconContentActive, iconContent);
            }
          }
        },
        content_hide: function content_hide() {
          elBlock.classList.add('block-mode-hidden');

          // Update block option icon
          btnContentToggle && btnContentToggle.querySelector('i').classList.replace(iconContent, iconContentActive);
        },
        content_show: function content_show() {
          elBlock.classList.remove('block-mode-hidden');

          // Update block option icon
          btnContentToggle && btnContentToggle.querySelector('i').classList.replace(iconContentActive, iconContent);
        },
        state_toggle: function state_toggle() {
          elBlock.classList.toggle('block-mode-loading');

          // Return block to normal state if the demostration mode is on in the refresh option button - data-action-mode="demo"
          if (elBlock.querySelector('[data-toggle="block-option"][data-action="state_toggle"][data-action-mode="demo"]')) {
            setTimeout(function () {
              elBlock.classList.remove('block-mode-loading');
            }, 2000);
          }
        },
        state_loading: function state_loading() {
          elBlock.classList.add('block-mode-loading');
        },
        state_normal: function state_normal() {
          elBlock.classList.remove('block-mode-loading');
        },
        pinned_toggle: function pinned_toggle() {
          elBlock.classList.remove('block-mode-fullscreen');
          elBlock.classList.toggle('block-mode-pinned');
        },
        pinned_on: function pinned_on() {
          elBlock.classList.remove('block-mode-fullscreen');
          elBlock.classList.add('block-mode-pinned');
        },
        pinned_off: function pinned_off() {
          elBlock.classList.remove('block-mode-pinned');
        },
        close: function close() {
          elBlock.classList.add('d-none');
        },
        open: function open() {
          elBlock.classList.remove('d-none');
        }
      };
      if (mode === 'init') {
        // Call Block API
        blockAPI[mode]();
      } else {
        // Get block element
        elBlock = block instanceof Element ? block : document.querySelector("".concat(block));

        // If element exists, procceed with block functionality
        if (elBlock) {
          // Get block option buttons if exist (need them to update their icons)
          btnFullscreen = elBlock.querySelector('[data-toggle="block-option"][data-action="fullscreen_toggle"]');
          btnContentToggle = elBlock.querySelector('[data-toggle="block-option"][data-action="content_toggle"]');

          // Call Block API
          if (blockAPI[mode]) {
            blockAPI[mode]();
          }
        }
      }
    }

    /*
     ********************************************************************************************
     *
     * Helpers
     *
     *********************************************************************************************
     */

    /*
     * On DOM content loaded
     *
     */
  }, {
    key: "onLoad",
    value: function onLoad(fn) {
      if (document.readyState != 'loading') {
        fn();
      } else {
        document.addEventListener('DOMContentLoaded', fn);
      }
    }

    /*
     ********************************************************************************************
     *
     * Create aliases for easier/quicker access to vital methods
     *
     *********************************************************************************************
     */

    /*
     * Init base functionality
     *
     */
  }, {
    key: "init",
    value: function init() {
      this._uiInit();
    }

    /*
     * Layout API
     *
     */
  }, {
    key: "layout",
    value: function layout(mode) {
      this._uiApiLayout(mode);
    }

    /*
     * Blocks API
     *
     */
  }, {
    key: "block",
    value: function block(mode, _block) {
      this._uiApiBlocks(mode, _block);
    }

    /*
     * Handle Page Loader
     *
     */
  }, {
    key: "loader",
    value: function loader(mode, colorClass) {
      this._uiHandlePageLoader(mode, colorClass);
    }

    /*
     * Run Helpers
     *
     */
  }, {
    key: "helpers",
    value: function helpers(_helpers) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      _helpers__WEBPACK_IMPORTED_MODULE_1__["default"].run(_helpers, options);
    }

    /*
     * Run Helpers on DOM content loaded
     *
     */
  }, {
    key: "helpersOnLoad",
    value: function helpersOnLoad(helpers) {
      var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      this.onLoad(function () {
        return _helpers__WEBPACK_IMPORTED_MODULE_1__["default"].run(helpers, options);
      });
    }
  }]);
  return Template;
}();


/***/ }),

/***/ "./storage/orbitali/src/Assets/source/sass/main.scss":
/*!***********************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/sass/main.scss ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./storage/orbitali/src/Assets/source/images/favicon.png":
/*!***************************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/images/favicon.png ***!
  \***************************************************************/
/***/ ((module) => {

module.exports = "/vendor/orbitali/images/favicon.png?5816ea4d859dd9d3";

/***/ }),

/***/ "./storage/orbitali/src/Assets/source/images/filetypes/file.svg":
/*!**********************************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/images/filetypes/file.svg ***!
  \**********************************************************************/
/***/ ((module) => {

module.exports = "/vendor/orbitali/images/file.svg?00be51b20fb58517";

/***/ }),

/***/ "./storage/orbitali/src/Assets/source/images/filetypes/pdf.svg":
/*!*********************************************************************!*\
  !*** ./storage/orbitali/src/Assets/source/images/filetypes/pdf.svg ***!
  \*********************************************************************/
/***/ ((module) => {

module.exports = "/vendor/orbitali/images/pdf.svg?c43da7ceb4ab217c";

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/vendor"], () => (__webpack_exec__("./storage/orbitali/src/Assets/source/js/dashmix/app.js"), __webpack_exec__("./storage/orbitali/src/Assets/source/sass/main.scss")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=orbitali.core.js.map