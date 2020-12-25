(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[3],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/AdminDashboard.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-perfect-scrollbar */ "./node_modules/vue-perfect-scrollbar/dist/index.js");
/* harmony import */ var vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue-apexcharts */ "./node_modules/vue-apexcharts/dist/vue-apexcharts.js");
/* harmony import */ var vue_apexcharts__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vue_apexcharts__WEBPACK_IMPORTED_MODULE_1__);
!(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/statistics-cards/StatisticsCardLine.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var _ui_elements_card_analyticsData_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./ui-elements/card/analyticsData.js */ "./resources/js/src/views/ui-elements/card/analyticsData.js");
!(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/ChangeTimeDurationDropdown.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
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
  components: {
    VueApexCharts: vue_apexcharts__WEBPACK_IMPORTED_MODULE_1___default.a,
    StatisticsCardLine: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/statistics-cards/StatisticsCardLine.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()),
    VuePerfectScrollbar: vue_perfect_scrollbar__WEBPACK_IMPORTED_MODULE_0___default.a,
    ChangeTimeDurationDropdown: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/components/ChangeTimeDurationDropdown.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())
  },
  data: function data() {
    return {
      subscribers_gained: {
        series: [{
          name: 'Subscribers',
          data: [28, 40, 36, 52, 38, 60, 55]
        }],
        analyticsData: {
          subscribers: 92600
        }
      },
      revenueGenerated: {
        series: [{
          name: 'Revenue',
          data: [350, 275, 400, 300, 350, 300, 450]
        }],
        analyticsData: {
          revenue: 97500
        }
      },
      quarterlySales: {
        series: [{
          name: 'Sales',
          data: [10, 15, 7, 12, 3, 16]
        }],
        analyticsData: {
          sales: '36%'
        }
      },
      ordersRecevied: {
        series: [{
          name: 'Orders',
          data: [10, 15, 8, 15, 7, 12, 8]
        }],
        analyticsData: {
          orders: 97500
        }
      },
      siteTraffic: {
        series: [{
          name: 'Traffic Rate',
          data: [150, 200, 125, 225, 200, 250]
        }]
      },
      activeUsers: {
        series: [{
          name: 'Active Users',
          data: [750, 1000, 900, 1250, 1000, 1200, 1100]
        }]
      },
      newsletter: {
        series: [{
          name: 'Newsletter',
          data: [365, 390, 365, 400, 375, 400]
        }]
      },
      revenueComparisonLine: {},
      goalOverview: {},
      browserStatistics: [],
      clientRetentionBar: {},
      sessionsData: {},
      chatLog: [],
      chatMsgInput: '',
      customersData: {},
      settings: {
        // perfectscrollbar settings
        maxScrollbarLength: 60,
        wheelSpeed: .60
      }
    };
  },
  computed: {
    scrollbarTag: function scrollbarTag() {
      return this.$store.getters.scrollbarTag;
    },
    payments: function payments() {
      return this.$store.state.admin.payments;
    },
    totalAmount: function totalAmount() {
      return this.$store.state.admin.totalAmount;
    },
    allUsersCount: function allUsersCount() {
      return this.$store.getters['user/allUsersCount'];
    },
    tokenRequestsAmount: function tokenRequestsAmount() {
      return this.$store.getters['token/tokenRequestsAmount'];
    },
    pendingTokensForAdmin: function pendingTokensForAdmin() {
      return this.$store.getters['token/pendingTokensForAdmin'];
    }
  },
  methods: {
    chartDataForPayment: function chartDataForPayment() {
      return this.$store.getters['admin/chartDataForPayment'];
    },
    chartDataForUserToken: function chartDataForUserToken() {
      return this.$store.getters['user/allUsersToken'];
    },
    IncomingPaymentsStatisticData: function IncomingPaymentsStatisticData() {
      return [{
        name: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/i18n/i18n'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()).t('Amount'),
        data: this.chartDataForPayment()
      }];
    },
    UsersStatiscticData: function UsersStatiscticData() {
      return [{
        name: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/i18n/i18n'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()).t('UserToken'),
        data: this.chartDataForUserToken()
      }];
    },
    pendingTokensForAdminData: function pendingTokensForAdminData() {
      return [{
        name: !(function webpackMissingModule() { var e = new Error("Cannot find module '@/i18n/i18n'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()).t('Amount'),
        data: this.pendingTokensForAdmin
      }];
    }
  },
  mounted: function mounted() {//const scroll_el = this.$refs.chatLogPS.$el || this.$refs.chatLogPS
    //scroll_el.scrollTop = this.$refs.chatLog.scrollHeight
  },
  created: function created() {
    this.$store.dispatch('user/fetchUsers'); // this.$store.dispatch('user/fetchPayments')

    this.$store.dispatch('token/fetchTokenRequest');
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".chat-card-log {\n  height: 400px;\n}\n.chat-card-log .chat-sent-msg {\n  background-color: #f2f4f7 !important;\n}", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib??ref--7-2!./node_modules/sass-loader/dist/cjs.js??ref--7-3!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/lib??ref--7-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminDashboard.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=template&id=78a319a2&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/src/views/AdminDashboard.vue?vue&type=template&id=78a319a2& ***!
  \****************************************************************************************************************************************************************************************************************/
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
  return _c("div", [
    _c("div", { staticClass: "vx-row" }, [
      _c(
        "div",
        {
          staticClass:
            "vx-col w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base"
        },
        [
          _vm.revenueGenerated.analyticsData
            ? _c("statistics-card-line", {
                attrs: {
                  icon: "DollarSignIcon",
                  statistic: _vm._f("k_formatter")(_vm.totalAmount),
                  statisticTitle: _vm.$t("IncomingPayments"),
                  chartData: _vm.IncomingPaymentsStatisticData(),
                  color: "success",
                  type: "area"
                }
              })
            : _vm._e()
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
          _vm.revenueGenerated.analyticsData
            ? _c("statistics-card-line", {
                attrs: {
                  icon: "UsersIcon",
                  statistic: _vm._f("k_formatter")(_vm.allUsersCount),
                  statisticTitle: _vm.$t("totalUsers"),
                  chartData: _vm.UsersStatiscticData(),
                  color: "warning",
                  type: "area"
                }
              })
            : _vm._e()
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
          _vm.revenueGenerated.analyticsData
            ? _c("statistics-card-line", {
                attrs: {
                  icon: "ArrowDownIcon",
                  statistic: _vm._f("k_formatter")(_vm.tokenRequestsAmount),
                  statisticTitle: _vm.$t("PaymentRequests"),
                  chartData: _vm.pendingTokensForAdminData(),
                  color: "danger",
                  type: "area"
                }
              })
            : _vm._e()
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/src/views/AdminDashboard.vue":
/*!***************************************************!*\
  !*** ./resources/js/src/views/AdminDashboard.vue ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdminDashboard_vue_vue_type_template_id_78a319a2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdminDashboard.vue?vue&type=template&id=78a319a2& */ "./resources/js/src/views/AdminDashboard.vue?vue&type=template&id=78a319a2&");
/* harmony import */ var _AdminDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdminDashboard.vue?vue&type=script&lang=js& */ "./resources/js/src/views/AdminDashboard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./AdminDashboard.vue?vue&type=style&index=0&lang=scss& */ "./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _AdminDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdminDashboard_vue_vue_type_template_id_78a319a2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdminDashboard_vue_vue_type_template_id_78a319a2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/src/views/AdminDashboard.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/src/views/AdminDashboard.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/src/views/AdminDashboard.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminDashboard.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss&":
/*!*************************************************************************************!*\
  !*** ./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss& ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/lib??ref--7-2!../../../../node_modules/sass-loader/dist/cjs.js??ref--7-3!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminDashboard.vue?vue&type=style&index=0&lang=scss& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/lib/index.js?!./node_modules/sass-loader/dist/cjs.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=style&index=0&lang=scss&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_lib_index_js_ref_7_2_node_modules_sass_loader_dist_cjs_js_ref_7_3_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_style_index_0_lang_scss___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/src/views/AdminDashboard.vue?vue&type=template&id=78a319a2&":
/*!**********************************************************************************!*\
  !*** ./resources/js/src/views/AdminDashboard.vue?vue&type=template&id=78a319a2& ***!
  \**********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_template_id_78a319a2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminDashboard.vue?vue&type=template&id=78a319a2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/src/views/AdminDashboard.vue?vue&type=template&id=78a319a2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_template_id_78a319a2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminDashboard_vue_vue_type_template_id_78a319a2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);