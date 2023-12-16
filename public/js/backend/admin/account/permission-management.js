/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/backend/admin/account/permission-management.js":
/*!*********************************************************************!*\
  !*** ./resources/js/backend/admin/account/permission-management.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\nfunction _typeof(o) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && \"function\" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? \"symbol\" : typeof o; }, _typeof(o); }\nfunction _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError(\"Cannot call a class as a function\"); } }\nfunction _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if (\"value\" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }\nfunction _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, \"prototype\", { writable: false }); return Constructor; }\nfunction _toPropertyKey(arg) { var key = _toPrimitive(arg, \"string\"); return _typeof(key) === \"symbol\" ? key : String(key); }\nfunction _toPrimitive(input, hint) { if (_typeof(input) !== \"object\" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || \"default\"); if (_typeof(res) !== \"object\") return res; throw new TypeError(\"@@toPrimitive must return a primitive value.\"); } return (hint === \"string\" ? String : Number)(input); }\nfunction _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }\nfunction _nonIterableSpread() { throw new TypeError(\"Invalid attempt to spread non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _iterableToArray(iter) { if (typeof Symbol !== \"undefined\" && iter[Symbol.iterator] != null || iter[\"@@iterator\"] != null) return Array.from(iter); }\nfunction _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }\nvar tooltipTriggerList = document.querySelectorAll('[data-bs-toggle=\"tooltip\"]');\nvar tooltipList = _toConsumableArray(tooltipTriggerList).map(function (tooltipTriggerEl) {\n  return new bootstrap.Tooltip(tooltipTriggerEl);\n});\n\n/**\n * checkbox toggle status\n */\n\nvar permissionCheckboxes = document.querySelectorAll('.switch-box input[type=\"checkbox\"]');\npermissionCheckboxes.forEach(function (checkbox) {\n  checkbox.addEventListener('change', function () {\n    var permissionName = this.name;\n    var section = this.closest('section[data-role-level]');\n    var level = parseInt(section.getAttribute('data-role-level'));\n    if (this.checked) {\n      permissionCheckboxes.forEach(function (otherCheckbox) {\n        var otherSection = otherCheckbox.closest('section[data-role-level]');\n        var otherLevel = parseInt(otherSection.getAttribute('data-role-level'));\n        if (otherCheckbox.name.test(permissionName) && otherLevel >= level) {\n          otherCheckbox.checked = true;\n        }\n      });\n    } else {\n      permissionCheckboxes.forEach(function (otherCheckbox) {\n        var otherSection = otherCheckbox.closest('section[data-role-level]');\n        var otherLevel = parseInt(otherSection.getAttribute('data-role-level'));\n        if (otherCheckbox.name.test(permissionName) && otherLevel <= level) {\n          otherCheckbox.checked = false;\n        }\n      });\n    }\n  });\n});\n\n// update permission\n\n$('.submit-button').click(updatePermission);\nfunction updatePermission() {\n  var panelContent = $(this).closest('div.panel-footer').closest('section.panel');\n  var checkboxes = panelContent.find('input[type=\"checkbox\"]:not([disabled])');\n  var permissions = [];\n  checkboxes.each(function () {\n    var checkbox = $(this);\n    var name = checkbox.attr('name');\n    var checked = checkbox.prop('checked');\n    permissions.push({\n      name: name,\n      checked: checked\n    });\n  });\n  var role = $(this).data('role');\n  var request = new AjaxAPI();\n  request.sentData('/admin/account/update-permission', {\n    'role': role,\n    'permissions': JSON.stringify(permissions)\n  });\n}\nvar AjaxAPI = /*#__PURE__*/function () {\n  /**\n   * @function constructor - Init Ajax Request\n   * @param {string} url\n   * @param {JSON} data - data you want to sent\n   */\n\n  function AjaxAPI() {\n    _classCallCheck(this, AjaxAPI);\n  }\n  _createClass(AjaxAPI, [{\n    key: \"sentData\",\n    value: function sentData(url, data) {\n      var refresh = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;\n      $.ajax({\n        url: url,\n        type: 'PUT',\n        data: data,\n        dataType: 'html',\n        headers: {\n          'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n        },\n        success: function success(data) {\n          if (refresh) {\n            location.reload();\n          }\n          console.log(data);\n        },\n        error: function error(xhr, status, _error) {\n          console.log(xhr.responseText);\n        }\n      });\n    }\n  }]);\n  return AjaxAPI;\n}();//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9hY2NvdW50L3Blcm1pc3Npb24tbWFuYWdlbWVudC5qcyIsIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7Ozs7O0FBQ0EsSUFBTUEsa0JBQWtCLEdBQUdDLFFBQVEsQ0FBQ0MsZ0JBQWdCLENBQUMsNEJBQTRCLENBQUM7QUFDbEYsSUFBTUMsV0FBVyxHQUFHQyxrQkFBQSxDQUFJSixrQkFBa0IsRUFBRUssR0FBRyxDQUFDLFVBQUFDLGdCQUFnQjtFQUFBLE9BQUksSUFBSUMsU0FBUyxDQUFDQyxPQUFPLENBQUNGLGdCQUFnQixDQUFDO0FBQUEsRUFBQzs7QUFFNUc7QUFDQTtBQUNBOztBQUVBLElBQU1HLG9CQUFvQixHQUFHUixRQUFRLENBQUNDLGdCQUFnQixDQUFDLG9DQUFvQyxDQUFDO0FBRTVGTyxvQkFBb0IsQ0FBQ0MsT0FBTyxDQUFDLFVBQUFDLFFBQVEsRUFBSTtFQUNyQ0EsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxRQUFRLEVBQUUsWUFBWTtJQUM1QyxJQUFNQyxjQUFjLEdBQUcsSUFBSSxDQUFDQyxJQUFJO0lBRWhDLElBQU1DLE9BQU8sR0FBRyxJQUFJLENBQUNDLE9BQU8sQ0FBQywwQkFBMEIsQ0FBQztJQUN4RCxJQUFNQyxLQUFLLEdBQUdDLFFBQVEsQ0FBQ0gsT0FBTyxDQUFDSSxZQUFZLENBQUMsaUJBQWlCLENBQUMsQ0FBQztJQUUvRCxJQUFJLElBQUksQ0FBQ0MsT0FBTyxFQUFFO01BQ2RYLG9CQUFvQixDQUFDQyxPQUFPLENBQUMsVUFBQVcsYUFBYSxFQUFJO1FBQzFDLElBQU1DLFlBQVksR0FBR0QsYUFBYSxDQUFDTCxPQUFPLENBQUMsMEJBQTBCLENBQUM7UUFDdEUsSUFBTU8sVUFBVSxHQUFHTCxRQUFRLENBQUNJLFlBQVksQ0FBQ0gsWUFBWSxDQUFDLGlCQUFpQixDQUFDLENBQUM7UUFFekUsSUFBSUUsYUFBYSxDQUFDUCxJQUFJLENBQUNVLElBQUksQ0FBQ1gsY0FBYyxDQUFDLElBQUlVLFVB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QUFDQyxHQUFHLENBQUN2QixJQUFJLENBQUM7UUFDckIsQ0FBQztRQUNEd0IsS0FBSyxFQUFFLFNBQUFBLE1BQVNDLEdBQUcsRUFBRUMsTUFBTSxFQUFFRixNQUFLLEVBQUU7VUFDaENGLE9BQU8sQ0FBQ0MsR0FBRyxDQUFDRSxHQUFHLENBQUNFLFlBQVksQ0FBQztRQUNqQztNQUNKLENBQUMsQ0FBQztJQUVOO0VBQUM7RUFBQSxPQUFBekIsT0FBQTtBQUFBIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL2JhY2tlbmQvYWRtaW4vYWNjb3VudC9wZXJtaXNzaW9uLW1hbmFnZW1lbnQuanM/ODliMiJdLCJzb3VyY2VzQ29udGVudCI6WyJcbmNvbnN0IHRvb2x0aXBUcmlnZ2VyTGlzdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ1tkYXRhLWJzLXRvZ2dsZT1cInRvb2x0aXBcIl0nKVxuY29uc3QgdG9vbHRpcExpc3QgPSBbLi4udG9vbHRpcFRyaWdnZXJMaXN0XS5tYXAodG9vbHRpcFRyaWdnZXJFbCA9PiBuZXcgYm9vdHN0cmFwLlRvb2x0aXAodG9vbHRpcFRyaWdnZXJFbCkpXG5cbi8qKlxuICogY2hlY2tib3ggdG9nZ2xlIHN0YXR1c1xuICovXG5cbmNvbnN0IHBlcm1pc3Npb25DaGVja2JveGVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnN3aXRjaC1ib3ggaW5wdXRbdHlwZT1cImNoZWNrYm94XCJdJyk7XG5cbnBlcm1pc3Npb25DaGVja2JveGVzLmZvckVhY2goY2hlY2tib3ggPT4ge1xuICAgIGNoZWNrYm94LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgY29uc3QgcGVybWlzc2lvbk5hbWUgPSB0aGlzLm5hbWU7XG4gICAgICAgIFxuICAgICAgICBjb25zdCBzZWN0aW9uID0gdGhpcy5jbG9zZXN0KCdzZWN0aW9uW2RhdGEtcm9sZS1sZXZlbF0nKTtcbiAgICAgICAgY29uc3QgbGV2ZWwgPSBwYXJzZUludChzZWN0aW9uLmdldEF0dHJpYnV0ZSgnZGF0YS1yb2xlLWxldmVsJykpO1xuICAgICAgICBcbiAgICAgICAgaWYgKHRoaXMuY2hlY2tlZCkge1xuICAgICAgICAgICAgcGVybWlzc2lvbkNoZWNrYm94ZXMuZm9yRWFjaChvdGhlckNoZWNrYm94ID0+IHtcbiAgICAgICAgICAgICAgICBjb25zdCBvdGhlclNlY3Rpb24gPSBvdGhlckNoZWNrYm94LmNsb3Nlc3QoJ3NlY3Rpb25bZGF0YS1yb2xlLWxldmVsXScpO1xuICAgICAgICAgICAgICAgIGNvbnN0IG90aGVyTGV2ZWwgPSBwYXJzZUludChvdGhlclNlY3Rpb24uZ2V0QXR0cmlidXRlKCdkYXRhLXJvbGUtbGV2ZWwnKSk7XG4gICAgICAgICAgICAgICAgXG4gICAgICAgICAgICAgICAgaWYgKG90aGVyQ2hlY2tib3gubmFtZS50ZXN0KHBlcm1pc3Npb25OYW1lKSAmJiBvdGhlckxldmVsID49IGxldmVsKSB7XG4gICAgICAgICAgICAgICAgICAgIG90aGVyQ2hlY2tib3guY2hlY2tlZCA9IHRydWU7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBwZXJtaXNzaW9uQ2hlY2tib3hlcy5mb3JFYWNoKG90aGVyQ2hlY2tib3ggPT4ge1xuICAgICAgICAgICAgICAgIGNvbnN0IG90aGVyU2VjdGlvbiA9IG90aGVyQ2hlY2tib3guY2xvc2VzdCgnc2VjdGlvbltkYXRhLXJvbGUtbGV2ZWxdJyk7XG4gICAgICAgICAgICAgICAgY29uc3Qgb3RoZXJMZXZlbCA9IHBhcnNlSW50KG90aGVyU2VjdGlvbi5nZXRBdHRyaWJ1dGUoJ2RhdGEtcm9sZS1sZXZlbCcpKTtcbiAgICAgICAgICAgICAgICBcbiAgICAgICAgICAgICAgICBpZiAob3RoZXJDaGVja2JveC5uYW1lLnRlc3QocGVybWlzc2lvbk5hbWUpICYmIG90aGVyTGV2ZWwgPD0gbGV2ZWwpIHtcbiAgICAgICAgICAgICAgICAgICAgb3RoZXJDaGVja2JveC5jaGVja2VkID0gZmFsc2U7XG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSk7XG4gICAgICAgIH1cbiAgICB9KTtcbn0pO1xuXG4vLyB1cGRhdGUgcGVybWlzc2lvblxuXG4kKCcuc3VibWl0LWJ1dHRvbicpLmNsaWNrKHVwZGF0ZVBlcm1pc3Npb24pO1xuXG5mdW5jdGlvbiB1cGRhdGVQZXJtaXNzaW9uKCl7XG4gICAgbGV0IHBhbmVsQ29udGVudCA9ICQodGhpcykuY2xvc2VzdCgnZGl2LnBhbmVsLWZvb3RlcicpLmNsb3Nlc3QoJ3NlY3Rpb24ucGFuZWwnKTtcbiAgICBsZXQgY2hlY2tib3hlcyA9IHBhbmVsQ29udGVudC5maW5kKCdpbnB1dFt0eXBlPVwiY2hlY2tib3hcIl06bm90KFtkaXNhYmxlZF0pJyk7XG4gICAgbGV0IHBlcm1pc3Npb25zID0gW107XG5cbiAgICBjaGVja2JveGVzLmVhY2goZnVuY3Rpb24oKSB7XG4gICAgICAgIGxldCBjaGVja2JveCA9ICQodGhpcyk7XG4gICAgICAgIGxldCBuYW1lID0gY2hlY2tib3guYXR0cignbmFtZScpO1xuICAgICAgICBsZXQgY2hlY2tlZCA9IGNoZWNrYm94LnByb3AoJ2NoZWNrZWQnKTtcblxuICAgICAgICBwZXJtaXNzaW9ucy5wdXNoKHtcbiAgICAgICAgICAgIG5hbWU6IG5hbWUsXG4gICAgICAgICAgICBjaGVja2VkOiBjaGVja2VkXG4gICAgICAgIH0pO1xuICAgIH0pO1xuXG4gICAgbGV0IHJvbGUgPSAkKHRoaXMpLmRhdGEoJ3JvbGUnKTtcblxuICAgIGxldCByZXF1ZXN0ID0gbmV3IEFqYXhBUEkoKTtcbiAgICByZXF1ZXN0LnNlbnREYXRhKFxuICAgICAgICAnL2FkbWluL2FjY291bnQvdXBkYXRlLXBlcm1pc3Npb24nLFxuICAgICAgICB7XG4gICAgICAgICAgICAncm9sZSc6IHJvbGUsXG4gICAgICAgICAgICAncGVybWlzc2lvbnMnOiBKU09OLnN0cmluZ2lmeShwZXJtaXNzaW9ucyksXG4gICAgICAgIH0sXG4gICAgKTtcbn1cblxuY2xhc3MgQWpheEFQSXtcblxuICAgIC8qKlxuICAgICAqIEBmdW5jdGlvbiBjb25zdHJ1Y3RvciAtIEluaXQgQWpheCBSZXF1ZXN0XG4gICAgICogQHBhcmFtIHtzdHJpbmd9IHVybFxuICAgICAqIEBwYXJhbSB7SlNPTn0gZGF0YSAtIGRhdGEgeW91IHdhbnQgdG8gc2VudFxuICAgICAqL1xuXG4gICAgY29uc3RydWN0b3IoKXtcbiAgICAgICAgXG4gICAgfVxuXG4gICAgc2VudERhdGEodXJsLCBkYXRhLCByZWZyZXNoPXRydWUpe1xuXG4gICAgICAgICQuYWpheCh7XG4gICAgICAgICAgICB1cmw6IHVybCxcbiAgICAgICAgICAgIHR5cGU6ICdQVVQnLFxuICAgICAgICAgICAgZGF0YTogZGF0YSxcbiAgICAgICAgICAgIGRhdGFUeXBlOiAnaHRtbCcsXG4gICAgICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICAgICAgICAgIH0sXG4gICAgICAgICAgICBzdWNjZXNzOiBmdW5jdGlvbihkYXRhKSB7XG4gICAgICAgICAgICAgICAgaWYocmVmcmVzaCl7XG4gICAgICAgICAgICAgICAgICAgIGxvY2F0aW9uLnJlbG9hZCgpXG4gICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKGRhdGEpO1xuICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIGVycm9yOiBmdW5jdGlvbih4aHIsIHN0YXR1cywgZXJyb3IpIHtcbiAgICAgICAgICAgICAgICBjb25zb2xlLmxvZyh4aHIucmVzcG9uc2VUZXh0KTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG5cbiAgICB9XG5cbn0iXSwibmFtZXMiOlsidG9vbHRpcFRyaWdnZXJMaXN0IiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yQWxsIiwidG9vbHRpcExpc3QiLCJfdG9Db25zdW1hYmxlQXJyYXkiLCJtYXAiLCJ0b29sdGlwVHJpZ2dlckVsIiwiYm9vdHN0cmFwIiwiVG9vbHRpcCIsInBlcm1pc3Npb25DaGVja2JveGVzIiwiZm9yRWFjaCIsImNoZWNrYm94IiwiYWRkRXZlbnRMaXN0ZW5lciIsInBlcm1pc3Npb25OYW1lIiwibmFtZSIsInNlY3Rpb24iLCJjbG9zZXN0IiwibGV2ZWwiLCJwYXJzZUludCIsImdldEF0dHJpYnV0ZSIsImNoZWNrZWQiLCJvdGhlckNoZWNrYm94Iiwib3RoZXJTZWN0aW9uIiwib3RoZXJMZXZlbCIsInRlc3QiLCIkIiwiY2xpY2siLCJ1cGRhdGVQZXJtaXNzaW9uIiwicGFuZWxDb250ZW50IiwiY2hlY2tib3hlcyIsImZpbmQiLCJwZXJtaXNzaW9ucyIsImVhY2giLCJhdHRyIiwicHJvcCIsInB1c2giLCJyb2xlIiwiZGF0YSIsInJlcXVlc3QiLCJBamF4QVBJIiwic2VudERhdGEiLCJKU09OIiwic3RyaW5naWZ5IiwiX2NsYXNzQ2FsbENoZWNrIiwiX2NyZWF0ZUNsYXNzIiwia2V5IiwidmFsdWUiLCJ1cmwiLCJyZWZyZXNoIiwiYXJndW1lbnRzIiwibGVuZ3RoIiwidW5kZWZpbmVkIiwiYWpheCIsInR5cGUiLCJkYXRhVHlwZSIsImhlYWRlcnMiLCJzdWNjZXNzIiwibG9jYXRpb24iLCJyZWxvYWQiLCJjb25zb2xlIiwibG9nIiwiZXJyb3IiLCJ4aHIiLCJzdGF0dXMiLCJyZXNwb25zZVRleHQiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/backend/admin/account/permission-management.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/backend/admin/account/permission-management.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;