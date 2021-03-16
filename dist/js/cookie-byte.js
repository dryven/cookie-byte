/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/cookie-byte.js":
/*!*************************************!*\
  !*** ./resources/js/cookie-byte.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CookieConsent": function() { return /* reexport safe */ _cookie_consent__WEBPACK_IMPORTED_MODULE_0__.CookieConsent; },
/* harmony export */   "CookieModal": function() { return /* reexport safe */ _cookie_modal__WEBPACK_IMPORTED_MODULE_1__.CookieModal; },
/* harmony export */   "CookieCovers": function() { return /* reexport safe */ _cookie_covers__WEBPACK_IMPORTED_MODULE_2__.CookieCovers; }
/* harmony export */ });
/* harmony import */ var _cookie_consent__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cookie-consent */ "./resources/js/cookie-consent.js");
/* harmony import */ var _cookie_modal__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./cookie-modal */ "./resources/js/cookie-modal.js");
/* harmony import */ var _cookie_covers__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./cookie-covers */ "./resources/js/cookie-covers.js");




/***/ }),

/***/ "./resources/js/cookie-consent.js":
/*!****************************************!*\
  !*** ./resources/js/cookie-consent.js ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CookieConsent": function() { return /* binding */ CookieConsent; }
/* harmony export */ });
/* harmony import */ var _cookies__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cookies */ "./resources/js/cookies.js");


function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }


/**
 * Class for handling cookie requests, changes and callbacks
 */

var CookieConsent = /*#__PURE__*/function () {
  /**
   * Creates the instance for handling cookie requests, changes and callbacks.
   *
   * Available options:
   *  - callbacks: object with arrays of functions, which are called when a cookie class has been consented to
   *
   * @param {Object} options
   */
  function CookieConsent() {
    var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

    _classCallCheck(this, CookieConsent);

    this._defaults = {
      callbacks: {}
    };
    this._options = Object.assign({}, this._defaults, options); // Nevertheless, overwrite prefix, because it can't be customized yet

    this._options.prefix = 'cookie-byte-consent'; // Add trailing dash to prefix if none exists

    if (!this._options.prefix.endsWith('-')) {
      this._options.prefix += '-';
    }

    this._registerCPCallbacksAndRun(); // Add linkers to the dependent classes


    this.cookieModal = null;
    this.cookieCover = null;
  }
  /**
   * Adds a callback function to a cookie class
   *
   * @param {string} cookieClass the cookie class
   * @param {function} callback the callback function to be called when the cookie class has been consented to
   */


  _createClass(CookieConsent, [{
    key: "registerCallback",
    value: function registerCallback(cookieClass, callback) {
      // Create callback array if it doesn't exist already
      if (!Array.isArray(this._options.callbacks[cookieClass])) {
        this._options.callbacks[cookieClass] = [];
      }

      this._options.callbacks[cookieClass].push(callback);
    }
    /**
     * Removes the callbacks added to a cookie class or a list of cookie classes.
     *
     * @param {string} cookieClasses the cookie classes
     */

  }, {
    key: "unregisterCallback",
    value: function unregisterCallback(cookieClasses) {
      var _this = this;

      this._runSplitList(cookieClasses, function (cookieClass) {
        delete _this._options.callbacks[cookieClass];
      });
    }
    /**
     * Runs the callback function of a cookie class if it has been consented to.
     * TODO: Prevention of running callbacks multiple times
     *
     * @param {string} cookieClass the cookie class
     */

  }, {
    key: "runCallback",
    value: function runCallback(cookieClass) {
      // Don't bother if the cookie class has no consent or callback function
      if (!this.hasConsent(cookieClass)) return;
      if (!(cookieClass in this._options.callbacks)) return;

      this._options.callbacks[cookieClass].forEach(function (callback) {
        if (typeof callback === 'function') callback();
      });
    }
    /**
     * Runs all the callback functions which cookie classes have been consented to.
     */

  }, {
    key: "runCallbacks",
    value: function runCallbacks() {
      var _this2 = this;

      Object.keys(this._options.callbacks).forEach(function (cookieClass) {
        _this2.runCallback(cookieClass);
      });
    }
    /**
     * Checks whether the cookie class or cookie classes have already been consented to.
     *
     * @param cookieClasses the cookie classes to check for
     * @returns {boolean} whether the cookie classes have been consented to
     */

  }, {
    key: "hasConsent",
    value: function hasConsent(cookieClasses) {
      var consent = false;
      var arr = cookieClasses.toString().split(',');

      var _iterator = _createForOfIteratorHelper(arr),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var cookieClass = _step.value;
          consent = _cookies__WEBPACK_IMPORTED_MODULE_0__.Cookies.get(this._options.prefix + cookieClass) === 'true'; // Return false if the current cookie class hasn't been consented to

          if (!consent) {
            return false;
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      return consent;
    }
    /**
     * Consents to the cookie class.
     *
     * @param cookieClass the cookie class to consent to
     */

  }, {
    key: "consent",
    value: function consent(cookieClass) {
      this.setConsent(cookieClass, true);
    }
    /**
     * Sets the consent for a list of cookie classes.
     *
     * @param cookieClasses the cookie classes to set
     * @param {boolean, string} value
     */

  }, {
    key: "setConsent",
    value: function setConsent(cookieClasses, value) {
      var _this3 = this;

      this._runSplitList(cookieClasses, function (cookieType) {
        _cookies__WEBPACK_IMPORTED_MODULE_0__.Cookies.set(_this3._options.prefix + cookieType, value === true || value === 'true', {
          expires: 365
        });

        _this3.runCallback(cookieType);
      });
    }
  }, {
    key: "_registerCPCallbacksAndRun",
    value: function _registerCPCallbacksAndRun() {
      var _this4 = this;

      var snippets = document.querySelectorAll('script[type="text/snippetscript"]');
      if (snippets.length === 0) return;
      snippets.forEach(function (snippet) {
        var cookieClass = snippet.dataset["class"];
        var snippetCode = snippet.text;

        _this4.registerCallback(cookieClass.toString(), Function(snippetCode));
      });
      this.runCallbacks();
    }
    /**
     * Runs a function on a comma-seperated list of strings.
     *
     * @param {string} str the comma-seperated list
     * @param {function} func the function to iterate over
     * @private
     */

  }, {
    key: "_runSplitList",
    value: function _runSplitList(str, func) {
      // First split the string into pieces
      var arr = str.toString().split(',');
      arr.forEach(func);
    }
  }]);

  return CookieConsent;
}();

/***/ }),

/***/ "./resources/js/cookie-covers.js":
/*!***************************************!*\
  !*** ./resources/js/cookie-covers.js ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CookieCovers": function() { return /* binding */ CookieCovers; }
/* harmony export */ });


function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var DISPLAY_SLEEP_TIME = 300;
/**
 * Class for initializing the cookie covers on the current page.
 */

var CookieCovers = /*#__PURE__*/function () {
  /**
   * Initializes the cookie covers if there are any on the page.
   *
   * @param {CookieConsent} instance the CookieConsent instance
   */
  function CookieCovers(instance) {
    var _this = this;

    _classCallCheck(this, CookieCovers);

    this._instance = instance;
    this._instance.cookieCover = this; // Now, there could be more than one of these, so keep that in mind

    this._covers = document.querySelectorAll('.ddmcc');
    if (this._covers.length === 0) return;

    this._covers.forEach(function (cover) {
      // Add a event listener to consent and hide the cover
      var cover_button = cover.querySelector('#ddmcc-button-accept');
      if (cover_button === null) return;
      cover_button.addEventListener('click', function (event) {
        event.preventDefault();

        _this._instance.consent(cover.dataset.classes);

        _this.hide(cover.id);
      });
    });
  }
  /**
   * Returns the first cookie cover with a given handle.
   *
   * @param {string} handle
   * @returns {Element} the node element
   */


  _createClass(CookieCovers, [{
    key: "getCoverByHandle",
    value: function getCoverByHandle(handle) {
      var _document$querySelect;

      return (_document$querySelect = document.querySelector('.ddmcc#' + handle)) !== null && _document$querySelect !== void 0 ? _document$querySelect : false;
    }
  }, {
    key: "show",
    value: function show(handle) {
      var cover = this.getCoverByHandle(handle);

      if (cover) {
        cover.style.display = 'block';
        setTimeout(function () {
          cover.style.opacity = '1';
        }, 10);
      }
    }
  }, {
    key: "hide",
    value: function hide(handle) {
      var cover = this.getCoverByHandle(handle);

      if (cover) {
        cover.style.opacity = '0';
        setTimeout(function () {
          cover.style.display = 'none';
        }, DISPLAY_SLEEP_TIME);
      }
    }
    /**
     * Hides all cookie covers which have been consented to since the
     * initialization.
     */

  }, {
    key: "hideConsented",
    value: function hideConsented() {
      var _this2 = this;

      if (this._covers.length === 0) return;

      this._covers.forEach(function (cover) {
        if (_this2._instance.hasConsent(cover.dataset.classes)) _this2.hide(cover.id);
      });
    }
  }]);

  return CookieCovers;
}();

/***/ }),

/***/ "./resources/js/cookie-modal.js":
/*!**************************************!*\
  !*** ./resources/js/cookie-modal.js ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "CookieModal": function() { return /* binding */ CookieModal; }
/* harmony export */ });


function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var DISPLAY_SLEEP_TIME = 300;
/**
 * Class for initializing the cookie modal and its actions.
 */

var CookieModal = /*#__PURE__*/function () {
  /**
   * Initializes the cookie modal if it is found on the page.
   *
   * @param {CookieConsent} instance the CookieConsent instance
   */
  function CookieModal(instance) {
    var _this = this;

    _classCallCheck(this, CookieModal);

    this._instance = instance;
    this._instance.cookieModal = this; // We assume that there should only exist one modal per page

    this._modal = document.querySelector('.ddmcm');
    if (this._modal === null) return; // Find all cookie class checkboxes

    this._modalCheckboxes = this._modal.querySelectorAll('.ddmcm-classes input[type=\"checkbox\"]');
    if (this._modalCheckboxes.length === 0) return; // Select all checkboxes which already have consent

    this._getUncheckedModals().forEach(function (check) {
      check.checked = _this._instance.hasConsent(check.name);
    }); // Find the two buttons necessary in the modal and add their listeners


    this._buttonSelectAll = this._modal.querySelector('#ddmcm-button-all');
    this._buttonConfirm = this._modal.querySelector('#ddmcm-button-selected');
    if (this._buttonSelectAll === null || this._buttonConfirm == null) return;

    this._buttonSelectAll.addEventListener('click', function (event) {
      event.preventDefault();

      _this.checkAll();

      _this._finalize();
    });

    this._buttonConfirm.addEventListener('click', function (event) {
      event.preventDefault();

      _this._finalize();
    }); // Show the cookie notice if it hasn't already been interacted with


    if (!this._instance.hasConsent('showed')) this.show();
  }
  /**
   * Shows the cookie modal.
   */


  _createClass(CookieModal, [{
    key: "show",
    value: function show() {
      var _this2 = this;

      this._modal.style.display = 'block'; // Cancel the race condition for a smooth animation

      setTimeout(function () {
        _this2._modal.style.opacity = '1';
      }, 0);
    }
    /**
     * Hides the cookie modal.
     */

  }, {
    key: "hide",
    value: function hide() {
      var _this3 = this;

      this._modal.style.opacity = '0';
      setTimeout(function () {
        _this3._modal.style.display = 'none';
      }, DISPLAY_SLEEP_TIME);
    }
    /**
     * Selects all the cookie class checkboxes.
     */

  }, {
    key: "checkAll",
    value: function checkAll() {
      this._getUncheckedModals().forEach(function (check) {
        return check.click();
      });
    }
    /**
     * Consents for all selected cookie class checkboxes.
     *
     * @private
     */

  }, {
    key: "_pushSettings",
    value: function _pushSettings() {
      var _this4 = this;

      this._modalCheckboxes.forEach(function (check) {
        if (check.checked) {
          _this4._instance.consent(check.name);
        }
      });

      this._instance.consent('showed');
    }
    /**
     * Consents for all selected cookie class checkboxes and hides the cookie modal.
     *
     * @private
     */

  }, {
    key: "_finalize",
    value: function _finalize() {
      this._pushSettings();

      this.hide();

      if (this._instance.cookieCover !== null) {
        this._instance.cookieCover.hideConsented();
      }
    }
    /**
     * Returns all currenty unselected checkboxes.
     *
     * @returns {NodeListOf<Element>}
     * @private
     */

  }, {
    key: "_getUncheckedModals",
    value: function _getUncheckedModals() {
      return this._modal.querySelectorAll('.ddmcm-classes input[type=\"checkbox\"]:not(:checked)');
    }
  }]);

  return CookieModal;
}();

/***/ }),

/***/ "./resources/js/cookies.js":
/*!*********************************!*\
  !*** ./resources/js/cookies.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "Cookies": function() { return /* binding */ Cookies; }
/* harmony export */ });


function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Cookies = /*#__PURE__*/function () {
  function Cookies() {
    _classCallCheck(this, Cookies);
  }

  _createClass(Cookies, null, [{
    key: "get",
    value: function get(key) {
      var _document$cookie$matc;

      var fallback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
      return ((_document$cookie$matc = document.cookie.match('(^|;)\\s*' + key + '\\s*=\\s*([^;]+)')) === null || _document$cookie$matc === void 0 ? void 0 : _document$cookie$matc.pop()) || fallback;
    }
  }, {
    key: "set",
    value: function set(key, value) {
      var expires = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 365;
      var path = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : '/';
      var expirationDate = new Date(new Date() * 1 + expires * 864e+5);
      key = encodeURIComponent(String(key)).replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent).replace(/[()]/g, escape);
      value = encodeURIComponent(String(value)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
      return document.cookie = key + '=' + value + '; expires=' + expirationDate.toUTCString() + '; path=/';
    }
  }]);

  return Cookies;
}();

/***/ }),

/***/ "./resources/js/ie11-polyfills.js":
/*!****************************************!*\
  !*** ./resources/js/ie11-polyfills.js ***!
  \****************************************/
/***/ (function() {

/**
 * IE11-POLYFILLS.JS
 *
 * These JavaScript polyfills are only needed if you support IE11 or other
 * mischievous browsers of that kind.
 */

/**
 * Object.assign() polyfill for IE11
 * @see <https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/assign>
 */
if (typeof Object.assign !== 'function') {
  // Must be writable: true, enumerable: false, configurable: true
  Object.defineProperty(Object, 'assign', {
    value: function assign(target, varArgs) {
      // .length of function is 2
      'use strict';

      if (target === null || target === undefined) {
        throw new TypeError('Cannot convert undefined or null to object');
      }

      var to = Object(target);

      for (var index = 1; index < arguments.length; index++) {
        var nextSource = arguments[index];

        if (nextSource !== null && nextSource !== undefined) {
          for (var nextKey in nextSource) {
            // Avoid bugs when hasOwnProperty is shadowed
            if (Object.prototype.hasOwnProperty.call(nextSource, nextKey)) {
              to[nextKey] = nextSource[nextKey];
            }
          }
        }
      }

      return to;
    },
    writable: true,
    configurable: true
  });
}
/**
 * String.endswith() polyfill for IE11
 * @see <https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/endsWith>
 */


if (!String.prototype.endsWith) {
  String.prototype.endsWith = function (search, this_len) {
    if (this_len === undefined || this_len > this.length) {
      this_len = this.length;
    }

    return this.substring(this_len - search.length, this_len) === search;
  };
}
/**
 * Nodelist.forEach() polyfill for IE11
 * @see <https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach>
 */


if (window.NodeList && !NodeList.prototype.forEach) {
  NodeList.prototype.forEach = function (callback, thisArg) {
    thisArg = thisArg || window;

    for (var i = 0; i < this.length; i++) {
      callback.call(thisArg, this[i], i, this);
    }
  };
}

/***/ }),

/***/ "./resources/js/loadscript.js":
/*!************************************!*\
  !*** ./resources/js/loadscript.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cookie_byte__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cookie-byte */ "./resources/js/cookie-byte.js");
/* harmony import */ var _ie11_polyfills__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ie11-polyfills */ "./resources/js/ie11-polyfills.js");
/* harmony import */ var _ie11_polyfills__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_ie11_polyfills__WEBPACK_IMPORTED_MODULE_1__);



window.InitCookieByte = function () {
  window.CookieConsent = new _cookie_byte__WEBPACK_IMPORTED_MODULE_0__.CookieConsent();
  window.CookieModal = new _cookie_byte__WEBPACK_IMPORTED_MODULE_0__.CookieModal(window.CookieConsent);
  window.CookieCovers = new _cookie_byte__WEBPACK_IMPORTED_MODULE_0__.CookieCovers(window.CookieConsent);
};

if (document.readyState !== 'loading') {
  InitCookieByte();
} else {
  document.addEventListener('DOMContentLoaded', function () {
    InitCookieByte();
  });
}

/***/ }),

/***/ "./resources/css/_cookie_byte.css":
/*!****************************************!*\
  !*** ./resources/css/_cookie_byte.css ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					result = fn();
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/dist/js/cookie-byte": 0,
/******/ 			"dist/css/cookie-byte": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			for(moduleId in moreModules) {
/******/ 				if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 					__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 				}
/******/ 			}
/******/ 			if(runtime) runtime(__webpack_require__);
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			__webpack_require__.O();
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkcookie_byte"] = self["webpackChunkcookie_byte"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["dist/css/cookie-byte"], function() { return __webpack_require__("./resources/js/loadscript.js"); })
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["dist/css/cookie-byte"], function() { return __webpack_require__("./resources/css/_cookie_byte.css"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;