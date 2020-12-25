(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[4],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/DashboardAnalytics.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-apexcharts */ "./node_modules/vue-apexcharts/dist/vue-apexcharts.js");
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_apexcharts__WEBPACK_IMPORTED_MODULE_0__);
!(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/statistics-cards/StatisticsCardLine.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var _ui_elements_card_analyticsData_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ui-elements/card/analyticsData.js */ "./resources/js/src/views/ui-elements/card/analyticsData.js");
!(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/ChangeTimeDurationDropdown.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
!(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/timeline/VxTimeline'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
!(function webpackMissingModule() { var e = new Error("Cannot find module '@/i18n/i18n'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//






/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      analyticsData: _ui_elements_card_analyticsData_js__WEBPACK_IMPORTED_MODULE_2__["default"]
    };
  },
  components: {
    VueApexCharts: vue_apexcharts__WEBPACK_IMPORTED_MODULE_0___default.a,
    StatisticsCardLine: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/statistics-cards/StatisticsCardLine.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    ChangeTimeDurationDropdown: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/ChangeTimeDurationDropdown.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    VxTimeline: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/timeline/VxTimeline'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())
  },
  computed: {
    activeUser: function activeUser() {
      return this.$store.state.user.currentUser;
    },
    outgoingTokensAmount: function outgoingTokensAmount() {
      return this.$store.getters['token/outgoingTokensAmount'](this.activeUser.id);
    },
    incomingTokensAmount: function incomingTokensAmount() {
      return this.$store.getters['token/incomingTokensAmount'](this.activeUser.id);
    }
  },
  methods: {
    outgoingTokensJustAmount: function outgoingTokensJustAmount() {
      return this.$store.getters['token/outgoingTokensJustAmount'](this.activeUser.id);
    },
    incomingTokensJustAmount: function incomingTokensJustAmount() {
      return this.$store.getters['token/incomingTokensJustAmount'](this.activeUser.id);
    },
    OutGoingPaymentsStatisticData: function OutGoingPaymentsStatisticData() {
      return [{
        name: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/i18n/i18n'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()).t('Amount'),
        data: this.outgoingTokensJustAmount()
      }];
    },
    IncomingPaymentsStatisticData: function IncomingPaymentsStatisticData() {
      return [{
        name: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/i18n/i18n'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()).t('Amount'),
        data: this.incomingTokensJustAmount()
      }];
    }
  },
  created: function created() {
    this.$store.dispatch('token/fetchItems');
    this.$store.dispatch('user/fetchUser'); // this.$store.dispatch('blogPosts/fetchItems')
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "/*! rtl:begin:ignore */\n#dashboard-analytics .greet-user {\n  position: relative;\n}\n#dashboard-analytics .greet-user .decore-left {\n  position: absolute;\n  left: 0;\n  top: 0;\n}\n#dashboard-analytics .greet-user .decore-right {\n  position: absolute;\n  right: 0;\n  top: 0;\n}\n@media (max-width: 576px) {\n#dashboard-analytics .decore-left, #dashboard-analytics .decore-right {\n    width: 140px;\n}\n}\n\n/*! rtl:end:ignore */", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/lib??ref--7-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./DashboardAnalytics.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=template&id=596e52fc&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/DashboardAnalytics.vue?vue&type=template&id=596e52fc& ***!
  \********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { attrs: { id: "dashboard-analytics" } }, [
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        { staticClass: "vx-col w-full lg:w-1/2 mb-base" },
        [
          _c(
            "vx-card",
            {
              staticClass: "text-center bg-primary-gradient greet-user",
              attrs: { slot: "no-body" },
              slot: "no-body"
            },
            [
              _c("img", {
                staticClass: "decore-left",
                attrs: {
                  src: __webpack_require__(!(function webpackMissingModule() { var e = new Error("Cannot find module '@assets/images/elements/decore-left.png'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())),
                  alt: "Decore Left",
                  width: "200"
                }
              }),
              _vm._v(" "),
              _c("img", {
                staticClass: "decore-right",
                attrs: {
                  src: __webpack_require__(!(function webpackMissingModule() { var e = new Error("Cannot find module '@assets/images/elements/decore-right.png'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())),
                  alt: "Decore Right",
                  width: "175"
                }
              }),
              _vm._v(" "),
              _c("feather-icon", {
                staticClass:
                  "p-6 mb-8 bg-primary inline-flex rounded-full text-white shadow",
                attrs: { icon: "AwardIcon", svgClasses: "h-8 w-8" }
              }),
              _vm._v(" "),
              _c("h1", { staticClass: "mb-6 text-white" }, [
                _vm._v(
                  _vm._s(_vm.$t("Welcome")) + " " + _vm._s(_vm.activeUser.name)
                )
              ]),
              _vm._v(" "),
              _c(
                "p",
                {
                  staticClass:
                    "xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white"
                },
                [_vm._v(_vm._s(_vm.$t("underWelcomeText")))]
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass:
            "vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base"
        },
        [
          _c("statistics-card-line", {
            attrs: {
              icon: "ArrowUpIcon",
              statistic: _vm._f("k_formatter")(_vm.outgoingTokensAmount),
              statisticTitle: _vm.$t("OutgoingPayments"),
              chartData: _vm.OutGoingPaymentsStatisticData(),
              color: "warning",
              type: "area"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass:
            "vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base"
        },
        [
          _c("statistics-card-line", {
            attrs: {
              icon: "ArrowDownIcon",
              statistic: _vm._f("k_formatter")(_vm.incomingTokensAmount),
              statisticTitle: _vm.$t("IncomingPayments"),
              chartData: _vm.IncomingPaymentsStatisticData(),
              color: "warning",
              type: "area"
            }
          })
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/DashboardAnalytics.vue":
/*!*******************************************************!*\
  !*** ./resources/js/src/views/DashboardAnalytics.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _DashboardAnalytics_vue_vue_type_template_id_596e52fc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DashboardAnalytics.vue?vue&type=template&id=596e52fc& */ "./resources/js/src/views/DashboardAnalytics.vue?vue&type=template&id=596e52fc&");
/* harmony import */ var _DashboardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DashboardAnalytics.vue?vue&type=script&lang=js& */ "./resources/js/src/views/DashboardAnalytics.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./DashboardAnalytics.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _DashboardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _DashboardAnalytics_vue_vue_type_template_id_596e52fc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _DashboardAnalytics_vue_vue_type_template_id_596e52fc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/DashboardAnalytics.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/DashboardAnalytics.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/src/views/DashboardAnalytics.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./DashboardAnalytics.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss& ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/lib??ref--7-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./DashboardAnalytics.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/DashboardAnalytics.vue?vue&type=template&id=596e52fc&":
/*!**************************************************************************************!*\
  !*** ./resources/js/src/views/DashboardAnalytics.vue?vue&type=template&id=596e52fc& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_template_id_596e52fc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./DashboardAnalytics.vue?vue&type=template&id=596e52fc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/DashboardAnalytics.vue?vue&type=template&id=596e52fc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_template_id_596e52fc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_DashboardAnalytics_vue_vue_type_template_id_596e52fc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);