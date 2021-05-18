(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_ManagersView_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.n, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ManagerFormFields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ManagerFormFields */ "./resources/js/components/modals/manager/ManagerFormFields.vue");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.mjs");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup() {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_3__.useStore)();
    var container = (0,vue__WEBPACK_IMPORTED_MODULE_2__.inject)('container');
    var emitter = (0,vue__WEBPACK_IMPORTED_MODULE_2__.inject)("emitter");
    var managerFields = (0,vue__WEBPACK_IMPORTED_MODULE_2__.ref)(null);

    var emptyManager = _objectSpread({}, store.getters.getEmptyUser);

    var manager = (0,vue__WEBPACK_IMPORTED_MODULE_2__.reactive)(_objectSpread({}, emptyManager));

    function storeManager() {
      return _storeManager.apply(this, arguments);
    }

    function _storeManager() {
      _storeManager = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        var storedManager;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.prev = 0;
                _context.next = 3;
                return managerFields.value.validate();

              case 3:
                _context.next = 5;
                return container.UserService.storeUser(manager);

              case 5:
                storedManager = _context.sent;
                store.commit('user/setUserById', storedManager.data.user);
                document.getElementById('storeUserFormClose').click();
                emitter.emit('notification-success', 'manager was added');
                clearForm();
                _context.next = 15;
                break;

              case 12:
                _context.prev = 12;
                _context.t0 = _context["catch"](0);
                emitter.emit('notification-error', _context.t0.response.data);

              case 15:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[0, 12]]);
      }));
      return _storeManager.apply(this, arguments);
    }

    var clearForm = function clearForm() {
      return Object.keys(emptyManager).forEach(function (key) {
        return manager[key] = emptyManager[key];
      });
    };

    emitter.on('create-manager-form', clearForm);
    (0,vue__WEBPACK_IMPORTED_MODULE_2__.onBeforeUnmount)(function () {
      return emitter.off('create-manager-form', clearForm);
    });
    return {
      manager: manager,
      managerFields: managerFields,
      storeManager: storeManager
    };
  },
  components: {
    ManagerFormFields: _ManagerFormFields__WEBPACK_IMPORTED_MODULE_1__.default
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.n, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _ManagerFormFields__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ManagerFormFields */ "./resources/js/components/modals/manager/ManagerFormFields.vue");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.mjs");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup() {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_3__.useStore)();
    var container = (0,vue__WEBPACK_IMPORTED_MODULE_2__.inject)('container');
    var emitter = (0,vue__WEBPACK_IMPORTED_MODULE_2__.inject)("emitter");
    var managerFields = (0,vue__WEBPACK_IMPORTED_MODULE_2__.ref)(null);

    var emptyManager = _objectSpread({}, store.getters.getEmptyUser);

    var manager = (0,vue__WEBPACK_IMPORTED_MODULE_2__.reactive)(_objectSpread({}, emptyManager));
    emitter.on('edit-manager-form', setUser);
    (0,vue__WEBPACK_IMPORTED_MODULE_2__.onBeforeUnmount)(function () {
      return emitter.off('edit-manager-form', setUser);
    });

    function updateManager() {
      return _updateManager.apply(this, arguments);
    }

    function _updateManager() {
      _updateManager = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.prev = 0;
                _context.next = 3;
                return managerFields.value.validate();

              case 3:
                if (manager.password === null || manager.password.length === 0) delete manager.password;
                delete manager.dataIsValid;
                delete manager.avatar;
                _context.next = 8;
                return container.UserService.updateUser(manager);

              case 8:
                store.commit('user/setUserById', manager);
                emitter.emit('notification-success', 'manager was updated');
                document.getElementById('editUserFormClose').click();
                _context.next = 16;
                break;

              case 13:
                _context.prev = 13;
                _context.t0 = _context["catch"](0);
                emitter.emit('notification-error', _context.t0.response.data);

              case 16:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, null, [[0, 13]]);
      }));
      return _updateManager.apply(this, arguments);
    }

    function setUser(userData) {
      Object.keys(userData).forEach(function (key) {
        return manager[key] = userData[key];
      });
    }

    return {
      manager: manager,
      managerFields: managerFields,
      updateManager: updateManager
    };
  },
  components: {
    ManagerFormFields: _ManagerFormFields__WEBPACK_IMPORTED_MODULE_1__.default
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js ***!
  \***********************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _modals_manager_CreateManagerForm__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../modals/manager/CreateManagerForm */ "./resources/js/components/modals/manager/CreateManagerForm.vue");
/* harmony import */ var _modals_manager_EditManagerForm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../modals/manager/EditManagerForm */ "./resources/js/components/modals/manager/EditManagerForm.vue");
/* harmony import */ var _ManagersTableHead__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ManagersTableHead */ "./resources/js/components/tables/managers/ManagersTableHead.vue");
/* harmony import */ var _ManagersTableRow__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./ManagersTableRow */ "./resources/js/components/tables/managers/ManagersTableRow.vue");
/* harmony import */ var _layout_NoRecords__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../layout/NoRecords */ "./resources/js/components/layout/NoRecords.vue");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.mjs");







/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup() {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_6__.useStore)();
    var emitter = (0,vue__WEBPACK_IMPORTED_MODULE_5__.inject)("emitter");
    return {
      showManagerStoreForm: function showManagerStoreForm() {
        return emitter.emit('create-manager-form');
      },
      users: (0,vue__WEBPACK_IMPORTED_MODULE_5__.computed)(function () {
        return store.getters.getUsers;
      })
    };
  },
  components: {
    StoreManagerForm: _modals_manager_CreateManagerForm__WEBPACK_IMPORTED_MODULE_0__.default,
    EditManagerForm: _modals_manager_EditManagerForm__WEBPACK_IMPORTED_MODULE_1__.default,
    ManagersTableHead: _ManagersTableHead__WEBPACK_IMPORTED_MODULE_2__.default,
    ManagersTableRow: _ManagersTableRow__WEBPACK_IMPORTED_MODULE_3__.default,
    NoRecords: _layout_NoRecords__WEBPACK_IMPORTED_MODULE_4__.default
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _actions_DeleteButton__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./actions/DeleteButton */ "./resources/js/components/tables/managers/actions/DeleteButton.vue");
/* harmony import */ var _actions_EditButton__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./actions/EditButton */ "./resources/js/components/tables/managers/actions/EditButton.vue");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.mjs");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup() {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_3__.useStore)();
    return {
      profile: (0,vue__WEBPACK_IMPORTED_MODULE_2__.computed)(function () {
        return store.getters.getProfile;
      })
    };
  },
  props: {
    user: Object
  },
  components: {
    DeleteButton: _actions_DeleteButton__WEBPACK_IMPORTED_MODULE_0__.default,
    EditButton: _actions_EditButton__WEBPACK_IMPORTED_MODULE_1__.default
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js ***!
  \******************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.n, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.mjs");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup(props) {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_2__.useStore)();
    var emitter = (0,vue__WEBPACK_IMPORTED_MODULE_1__.inject)("emitter");
    var container = (0,vue__WEBPACK_IMPORTED_MODULE_1__.inject)('container');
    var deleteEventId = 'delete-user-' + props.user.id;
    emitter.on(deleteEventId, deleteUser);
    (0,vue__WEBPACK_IMPORTED_MODULE_1__.onBeforeUnmount)(function () {
      return emitter.off(deleteEventId, deleteUser);
    });

    function deleteWarning() {
      return _deleteWarning.apply(this, arguments);
    }

    function _deleteWarning() {
      _deleteWarning = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee() {
        var warning;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                warning = {
                  message: generateWarningMessage(),
                  event_id: deleteEventId
                };
                emitter.emit('notification-warning', warning);

              case 2:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }));
      return _deleteWarning.apply(this, arguments);
    }

    function deleteUser() {
      return _deleteUser.apply(this, arguments);
    }

    function _deleteUser() {
      _deleteUser = _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default().wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.prev = 0;
                _context2.next = 3;
                return container.UserService.deleteUser(props.user);

              case 3:
                emitter.emit('notification-success', ' manager ' + props.user.login + ' was deleted');
                store.dispatch('user/deleteUser', props.user);
                _context2.next = 11;
                break;

              case 7:
                _context2.prev = 7;
                _context2.t0 = _context2["catch"](0);
                console.log(_context2.t0);
                emitter.emit('notification-error', _context2.t0.response.data);

              case 11:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, null, [[0, 7]]);
      }));
      return _deleteUser.apply(this, arguments);
    }

    function generateWarningMessage() {
      var message;
      if (props.user.login) message = props.user.login;else message = props.user.role;
      return message;
    }

    return {
      deleteWarning: deleteWarning
    };
  },
  props: {
    user: Object
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js ***!
  \****************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup(props) {
    var emitter = (0,vue__WEBPACK_IMPORTED_MODULE_0__.inject)("emitter");
    return {
      showEditManagerForm: function showEditManagerForm() {
        return emitter.emit('edit-manager-form', props.user);
      }
    };
  },
  props: {
    user: Object
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=script&lang=js":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _components_tables_managers_ManagersTable_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/tables/managers/ManagersTable.vue */ "./resources/js/components/tables/managers/ManagersTable.vue");
/* harmony import */ var _components_modals_manager_CreateManagerForm_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/modals/manager/CreateManagerForm.vue */ "./resources/js/components/modals/manager/CreateManagerForm.vue");
/* harmony import */ var _components_modals_manager_EditManagerForm_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../components/modals/manager/EditManagerForm.vue */ "./resources/js/components/modals/manager/EditManagerForm.vue");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.mjs");




/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  setup: function setup() {
    var store = (0,vuex__WEBPACK_IMPORTED_MODULE_3__.useStore)();
    var usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
    var rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
    if (usersAreUndefined) store.dispatch('user/setUsersToStore');
    if (rolesAreUndefined) store.dispatch('user/setRolesToStore');
  },
  components: {
    ManagersTable: _components_tables_managers_ManagersTable_vue__WEBPACK_IMPORTED_MODULE_0__.default,
    StoreManagerForm: _components_modals_manager_CreateManagerForm_vue__WEBPACK_IMPORTED_MODULE_1__.default,
    EditManagerForm: _components_modals_manager_EditManagerForm_vue__WEBPACK_IMPORTED_MODULE_2__.default
  }
});

/***/ }),

/***/ "./resources/js/components/layout/NoRecords.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/layout/NoRecords.vue ***!
  \******************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _NoRecords_vue_vue_type_template_id_8d05de72__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./NoRecords.vue?vue&type=template&id=8d05de72 */ "./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72");

const script = {}
script.render = _NoRecords_vue_vue_type_template_id_8d05de72__WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

script.__file = "resources/js/components/layout/NoRecords.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (script);

/***/ }),

/***/ "./resources/js/components/modals/manager/CreateManagerForm.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/modals/manager/CreateManagerForm.vue ***!
  \**********************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _CreateManagerForm_vue_vue_type_template_id_f71a1956_bindings_manager_setup_managerFields_setup_storeManager_setup___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={"manager":"setup","managerFields":"setup","storeManager":"setup"} */ "./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"storeManager\":\"setup\"}");
/* harmony import */ var _CreateManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CreateManagerForm.vue?vue&type=script&lang=js */ "./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js");



_CreateManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _CreateManagerForm_vue_vue_type_template_id_f71a1956_bindings_manager_setup_managerFields_setup_storeManager_setup___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_CreateManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/components/modals/manager/CreateManagerForm.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_CreateManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/components/modals/manager/EditManagerForm.vue":
/*!********************************************************************!*\
  !*** ./resources/js/components/modals/manager/EditManagerForm.vue ***!
  \********************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _EditManagerForm_vue_vue_type_template_id_40e60af2_bindings_manager_setup_managerFields_setup_updateManager_setup___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={"manager":"setup","managerFields":"setup","updateManager":"setup"} */ "./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"updateManager\":\"setup\"}");
/* harmony import */ var _EditManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditManagerForm.vue?vue&type=script&lang=js */ "./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js");



_EditManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _EditManagerForm_vue_vue_type_template_id_40e60af2_bindings_manager_setup_managerFields_setup_updateManager_setup___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_EditManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/components/modals/manager/EditManagerForm.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_EditManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTable.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTable.vue ***!
  \*******************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _ManagersTable_vue_vue_type_template_id_7aafad2e_bindings_showManagerStoreForm_setup_users_setup___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={"showManagerStoreForm":"setup","users":"setup"} */ "./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={\"showManagerStoreForm\":\"setup\",\"users\":\"setup\"}");
/* harmony import */ var _ManagersTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ManagersTable.vue?vue&type=script&lang=js */ "./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js");



_ManagersTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _ManagersTable_vue_vue_type_template_id_7aafad2e_bindings_showManagerStoreForm_setup_users_setup___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_ManagersTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/components/tables/managers/ManagersTable.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ManagersTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTableHead.vue":
/*!***********************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTableHead.vue ***!
  \***********************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _ManagersTableHead_vue_vue_type_template_id_09d497a4__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ManagersTableHead.vue?vue&type=template&id=09d497a4 */ "./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4");

const script = {}
script.render = _ManagersTableHead_vue_vue_type_template_id_09d497a4__WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

script.__file = "resources/js/components/tables/managers/ManagersTableHead.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (script);

/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTableRow.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTableRow.vue ***!
  \**********************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _ManagersTableRow_vue_vue_type_template_id_f3c50608_bindings_profile_setup_user_props___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={"profile":"setup","user":"props"} */ "./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={\"profile\":\"setup\",\"user\":\"props\"}");
/* harmony import */ var _ManagersTableRow_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ManagersTableRow.vue?vue&type=script&lang=js */ "./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js");



_ManagersTableRow_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _ManagersTableRow_vue_vue_type_template_id_f3c50608_bindings_profile_setup_user_props___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_ManagersTableRow_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/components/tables/managers/ManagersTableRow.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ManagersTableRow_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/components/tables/managers/actions/DeleteButton.vue":
/*!**************************************************************************!*\
  !*** ./resources/js/components/tables/managers/actions/DeleteButton.vue ***!
  \**************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _DeleteButton_vue_vue_type_template_id_b185f34e_bindings_deleteWarning_setup_user_props___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DeleteButton.vue?vue&type=template&id=b185f34e&bindings={"deleteWarning":"setup","user":"props"} */ "./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={\"deleteWarning\":\"setup\",\"user\":\"props\"}");
/* harmony import */ var _DeleteButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DeleteButton.vue?vue&type=script&lang=js */ "./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js");



_DeleteButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _DeleteButton_vue_vue_type_template_id_b185f34e_bindings_deleteWarning_setup_user_props___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_DeleteButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/components/tables/managers/actions/DeleteButton.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_DeleteButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/components/tables/managers/actions/EditButton.vue":
/*!************************************************************************!*\
  !*** ./resources/js/components/tables/managers/actions/EditButton.vue ***!
  \************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _EditButton_vue_vue_type_template_id_0c2fd4f8_bindings_showEditManagerForm_setup_user_props___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={"showEditManagerForm":"setup","user":"props"} */ "./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={\"showEditManagerForm\":\"setup\",\"user\":\"props\"}");
/* harmony import */ var _EditButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./EditButton.vue?vue&type=script&lang=js */ "./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js");



_EditButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _EditButton_vue_vue_type_template_id_0c2fd4f8_bindings_showEditManagerForm_setup_user_props___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_EditButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/components/tables/managers/actions/EditButton.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_EditButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/views/ManagersView.vue":
/*!*********************************************!*\
  !*** ./resources/js/views/ManagersView.vue ***!
  \*********************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.r, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _ManagersView_vue_vue_type_template_id_14eecd4a_bindings___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ManagersView.vue?vue&type=template&id=14eecd4a&bindings={} */ "./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={}");
/* harmony import */ var _ManagersView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ManagersView.vue?vue&type=script&lang=js */ "./resources/js/views/ManagersView.vue?vue&type=script&lang=js");



_ManagersView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.render = _ManagersView_vue_vue_type_template_id_14eecd4a_bindings___WEBPACK_IMPORTED_MODULE_0__.render
/* hot reload */
if (false) {}

_ManagersView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default.__file = "resources/js/views/ManagersView.vue"

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_ManagersView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__.default);

/***/ }),

/***/ "./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CreateManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CreateManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CreateManagerForm.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js ***!
  \********************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditManagerForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./EditManagerForm.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersTable.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTableRow_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTableRow_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersTableRow.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js":
/*!**************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DeleteButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DeleteButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DeleteButton.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js ***!
  \************************************************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditButton_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./EditButton.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/views/ManagersView.vue?vue&type=script&lang=js":
/*!*********************************************************************!*\
  !*** ./resources/js/views/ManagersView.vue?vue&type=script&lang=js ***!
  \*********************************************************************/
/*! namespace exports */
/*! export default [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=script&lang=js .default */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => /* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__.default
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersView_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersView.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72":
/*!************************************************************************************!*\
  !*** ./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72 ***!
  \************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72 .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NoRecords_vue_vue_type_template_id_8d05de72__WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_NoRecords_vue_vue_type_template_id_8d05de72__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./NoRecords.vue?vue&type=template&id=8d05de72 */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72");


/***/ }),

/***/ "./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"storeManager\":\"setup\"}":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={"manager":"setup","managerFields":"setup","storeManager":"setup"} ***!
  \********************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={"manager":"setup","managerFields":"setup","storeManager":"setup"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CreateManagerForm_vue_vue_type_template_id_f71a1956_bindings_manager_setup_managerFields_setup_storeManager_setup___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_CreateManagerForm_vue_vue_type_template_id_f71a1956_bindings_manager_setup_managerFields_setup_storeManager_setup___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={"manager":"setup","managerFields":"setup","storeManager":"setup"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"storeManager\":\"setup\"}");


/***/ }),

/***/ "./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"updateManager\":\"setup\"}":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={"manager":"setup","managerFields":"setup","updateManager":"setup"} ***!
  \*******************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={"manager":"setup","managerFields":"setup","updateManager":"setup"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditManagerForm_vue_vue_type_template_id_40e60af2_bindings_manager_setup_managerFields_setup_updateManager_setup___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditManagerForm_vue_vue_type_template_id_40e60af2_bindings_manager_setup_managerFields_setup_updateManager_setup___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={"manager":"setup","managerFields":"setup","updateManager":"setup"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"updateManager\":\"setup\"}");


/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={\"showManagerStoreForm\":\"setup\",\"users\":\"setup\"}":
/*!***********************************************************************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={"showManagerStoreForm":"setup","users":"setup"} ***!
  \***********************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={"showManagerStoreForm":"setup","users":"setup"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTable_vue_vue_type_template_id_7aafad2e_bindings_showManagerStoreForm_setup_users_setup___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTable_vue_vue_type_template_id_7aafad2e_bindings_showManagerStoreForm_setup_users_setup___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={"showManagerStoreForm":"setup","users":"setup"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={\"showManagerStoreForm\":\"setup\",\"users\":\"setup\"}");


/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4 ***!
  \*****************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4 .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTableHead_vue_vue_type_template_id_09d497a4__WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTableHead_vue_vue_type_template_id_09d497a4__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersTableHead.vue?vue&type=template&id=09d497a4 */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4");


/***/ }),

/***/ "./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={\"profile\":\"setup\",\"user\":\"props\"}":
/*!************************************************************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={"profile":"setup","user":"props"} ***!
  \************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={"profile":"setup","user":"props"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTableRow_vue_vue_type_template_id_f3c50608_bindings_profile_setup_user_props___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersTableRow_vue_vue_type_template_id_f3c50608_bindings_profile_setup_user_props___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={"profile":"setup","user":"props"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={\"profile\":\"setup\",\"user\":\"props\"}");


/***/ }),

/***/ "./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={\"deleteWarning\":\"setup\",\"user\":\"props\"}":
/*!**********************************************************************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={"deleteWarning":"setup","user":"props"} ***!
  \**********************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={"deleteWarning":"setup","user":"props"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DeleteButton_vue_vue_type_template_id_b185f34e_bindings_deleteWarning_setup_user_props___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DeleteButton_vue_vue_type_template_id_b185f34e_bindings_deleteWarning_setup_user_props___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DeleteButton.vue?vue&type=template&id=b185f34e&bindings={"deleteWarning":"setup","user":"props"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={\"deleteWarning\":\"setup\",\"user\":\"props\"}");


/***/ }),

/***/ "./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={\"showEditManagerForm\":\"setup\",\"user\":\"props\"}":
/*!**************************************************************************************************************************************************************!*\
  !*** ./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={"showEditManagerForm":"setup","user":"props"} ***!
  \**************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={"showEditManagerForm":"setup","user":"props"} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditButton_vue_vue_type_template_id_0c2fd4f8_bindings_showEditManagerForm_setup_user_props___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_EditButton_vue_vue_type_template_id_0c2fd4f8_bindings_showEditManagerForm_setup_user_props___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={"showEditManagerForm":"setup","user":"props"} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={\"showEditManagerForm\":\"setup\",\"user\":\"props\"}");


/***/ }),

/***/ "./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={}":
/*!***************************************************************************************!*\
  !*** ./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={} ***!
  \***************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] -> ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={} .render */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_exports__, __webpack_require__.d, __webpack_require__.r, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersView_vue_vue_type_template_id_14eecd4a_bindings___WEBPACK_IMPORTED_MODULE_0__.render
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_ManagersView_vue_vue_type_template_id_14eecd4a_bindings___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./ManagersView.vue?vue&type=template&id=14eecd4a&bindings={} */ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={}");


/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/layout/NoRecords.vue?vue&type=template&id=8d05de72 ***!
  \*********************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = { class: "w-lg-100 d-flex justify-content-center mt-lg-5" }
const _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("h3", null, "No data found", -1 /* HOISTED */)

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_1, [
    _hoisted_2
  ]))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"storeManager\":\"setup\"}":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/CreateManagerForm.vue?vue&type=template&id=f71a1956&bindings={"manager":"setup","managerFields":"setup","storeManager":"setup"} ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = {
  class: "modal fade",
  id: "addManagerForm"
}
const _hoisted_2 = { class: "modal-dialog" }
const _hoisted_3 = { class: "modal-content" }
const _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", { class: "modal-header" }, [
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("h5", { class: "modal-title" }, " Add manager "),
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    type: "button",
    class: "close",
    "data-dismiss": "modal",
    "aria-label": "Close"
  }, "×")
], -1 /* HOISTED */)
const _hoisted_5 = { class: "modal-body" }
const _hoisted_6 = { class: "modal-footer" }
const _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
  id: "storeUserFormClose",
  type: "button",
  class: "btn btn-default",
  "data-dismiss": "modal"
}, "Close ", -1 /* HOISTED */)

function render(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_ManagerFormFields = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ManagerFormFields")

  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_1, [
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_2, [
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("form", _hoisted_3, [
        _hoisted_4,
        (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_5, [
          (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ManagerFormFields, {
            ref: "managerFields",
            user: $setup.manager,
            "show-role-field": true
          }, null, 8 /* PROPS */, ["user"])
        ]),
        (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_6, [
          _hoisted_7,
          (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
            onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)((...args) => ($setup.storeManager(...args)), ["prevent"])),
            type: "button",
            class: "btn btn-primary"
          }, "Add ")
        ])
      ])
    ])
  ]))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={\"manager\":\"setup\",\"managerFields\":\"setup\",\"updateManager\":\"setup\"}":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/modals/manager/EditManagerForm.vue?vue&type=template&id=40e60af2&bindings={"manager":"setup","managerFields":"setup","updateManager":"setup"} ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = {
  class: "modal fade",
  id: "editManagerForm"
}
const _hoisted_2 = { class: "modal-dialog" }
const _hoisted_3 = { class: "modal-content" }
const _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", { class: "modal-header" }, [
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("h5", { class: "modal-title" }, " Edit manager "),
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
    type: "button",
    class: "close",
    "data-dismiss": "modal",
    "aria-label": "Close"
  }, "×")
], -1 /* HOISTED */)
const _hoisted_5 = { class: "modal-body" }
const _hoisted_6 = { class: "modal-footer" }
const _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
  id: "editUserFormClose",
  type: "button",
  class: "btn btn-default",
  "data-dismiss": "modal"
}, "Close ", -1 /* HOISTED */)

function render(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_ManagerFormFields = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ManagerFormFields")

  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_1, [
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_2, [
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("form", _hoisted_3, [
        _hoisted_4,
        (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_5, [
          (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ManagerFormFields, {
            ref: "managerFields",
            user: $setup.manager,
            "show-role-field": true
          }, null, 8 /* PROPS */, ["user"])
        ]),
        (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_6, [
          _hoisted_7,
          (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
            type: "button",
            class: "btn btn-primary",
            onClick: _cache[1] || (_cache[1] = (...args) => ($setup.updateManager(...args)))
          }, "Update ")
        ])
      ])
    ])
  ]))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={\"showManagerStoreForm\":\"setup\",\"users\":\"setup\"}":
/*!********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTable.vue?vue&type=template&id=7aafad2e&bindings={"showManagerStoreForm":"setup","users":"setup"} ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = { class: "container-fluid flex-grow-1 container-p-y" }
const _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("h4", { class: "font-weight-bold py-3 mb-4" }, "Managers", -1 /* HOISTED */)
const _hoisted_3 = { class: "d-flex justify-content-between mb-3" }
const _hoisted_4 = {
  key: 0,
  class: "table-responsive"
}
const _hoisted_5 = { class: "datatables-demo table table-striped table-bordered col-8" }

function render(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_ManagersTableHead = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ManagersTableHead")
  const _component_ManagersTableRow = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ManagersTableRow")
  const _component_NoRecords = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("NoRecords")

  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_1, [
    _hoisted_2,
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("div", _hoisted_3, [
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
        onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)((...args) => ($setup.showManagerStoreForm(...args)), ["prevent"])),
        class: "btn btn-primary btn",
        "data-toggle": "modal",
        "data-target": "#addManagerForm"
      }, " Add manager ")
    ]),
    (Object.keys($setup.users).length > 0)
      ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("div", _hoisted_4, [
          (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("table", _hoisted_5, [
            (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ManagersTableHead),
            (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("tbody", null, [
              ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($setup.users, (user) => {
                return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_ManagersTableRow, {
                  key: user.id + user.login,
                  user: user
                }, null, 8 /* PROPS */, ["user"]))
              }), 128 /* KEYED_FRAGMENT */))
            ])
          ])
        ]))
      : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_NoRecords, { key: 1 }))
  ]))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableHead.vue?vue&type=template&id=09d497a4 ***!
  \**************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("tr", { class: "d-flex" }, [
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", { class: "text-left col-2 font-weight-bold" }, "Created"),
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", { class: "text-left col-4 font-weight-bold" }, "Login"),
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", { class: "text-left col-4 font-weight-bold" }, "Role"),
  /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("th", { class: "text-left col-2 font-weight-bold" }, "Actions")
], -1 /* HOISTED */)

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("thead", null, [
    _hoisted_1
  ]))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={\"profile\":\"setup\",\"user\":\"props\"}":
/*!*********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/ManagersTableRow.vue?vue&type=template&id=f3c50608&bindings={"profile":"setup","user":"props"} ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = { class: "col-2" }
const _hoisted_2 = { class: "col-4" }
const _hoisted_3 = { class: "col-4" }
const _hoisted_4 = { class: "d-flex col-2 justify-content-between align-items-center" }

function render(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_EditButton = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("EditButton")
  const _component_DeleteButton = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DeleteButton")

  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("tr", {
    class: ["d-flex", { 'd-none': $props.user.login === $setup.profile.login}]
  }, [
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", _hoisted_1, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($props.user.created_at), 1 /* TEXT */),
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", _hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($props.user.login), 1 /* TEXT */),
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", _hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($props.user.role), 1 /* TEXT */),
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("td", _hoisted_4, [
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_EditButton, { user: $props.user }, null, 8 /* PROPS */, ["user"]),
      (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DeleteButton, { user: $props.user }, null, 8 /* PROPS */, ["user"])
    ])
  ], 2 /* CLASS */))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={\"deleteWarning\":\"setup\",\"user\":\"props\"}":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/DeleteButton.vue?vue&type=template&id=b185f34e&bindings={"deleteWarning":"setup","user":"props"} ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


function render(_ctx, _cache, $props, $setup, $data, $options) {
  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("a", {
    onClick: _cache[1] || (_cache[1] = (...args) => ($setup.deleteWarning(...args))),
    type: "button",
    class: "ion ion-md-trash danger"
  }))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={\"showEditManagerForm\":\"setup\",\"user\":\"props\"}":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/tables/managers/actions/EditButton.vue?vue&type=template&id=0c2fd4f8&bindings={"showEditManagerForm":"setup","user":"props"} ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


const _hoisted_1 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)("button", {
  type: "button",
  class: "ion ion-md-cog p-0 bg-transparent border-0",
  title: "Edit",
  "data-toggle": "tooltip",
  "data-placement": "right"
}, null, -1 /* HOISTED */)

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)("a", {
    "data-toggle": "modal",
    "data-target": "#editManagerForm",
    onClick: _cache[1] || (_cache[1] = (...args) => ($setup.showEditManagerForm(...args)))
  }, [
    _hoisted_1
  ]))
}

/***/ }),

/***/ "./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={}":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/views/ManagersView.vue?vue&type=template&id=14eecd4a&bindings={} ***!
  \************************************************************************************************************************************************************************************************************************/
/*! namespace exports */
/*! export render [provided] [no usage info] [missing usage info prevents renaming] */
/*! other exports [not provided] [no usage info] */
/*! runtime requirements: __webpack_require__, __webpack_require__.r, __webpack_exports__, __webpack_require__.d, __webpack_require__.* */
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


function render(_ctx, _cache, $props, $setup, $data, $options) {
  const _component_ManagersTable = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ManagersTable")
  const _component_StoreManagerForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("StoreManagerForm")
  const _component_EditManagerForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("EditManagerForm")

  return ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_ManagersTable),
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_StoreManagerForm),
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_EditManagerForm)
  ], 64 /* STABLE_FRAGMENT */))
}

/***/ })

}]);