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

eval("__webpack_require__.r(__webpack_exports__);\n// 获取所有权限的复选框元素\nvar permissionCheckboxes = document.querySelectorAll('.switch-box input[type=\"checkbox\"]');\n\n// 当权限复选框状态发生变化时触发事件\npermissionCheckboxes.forEach(function (checkbox) {\n  checkbox.addEventListener('change', function () {\n    // 获取当前权限的名称\n    var permissionName = this.name;\n\n    // 获取当前权限所在的身份组级别\n    var section = this.closest('section[data-role-level]');\n    var level = parseInt(section.getAttribute('data-role-level'));\n\n    // 如果选中了复选框\n    if (this.checked) {\n      // 遍历其他权限复选框\n      permissionCheckboxes.forEach(function (otherCheckbox) {\n        // 获取其他权限所在的身份组级别\n        var otherSection = otherCheckbox.closest('section[data-role-level]');\n        var otherLevel = parseInt(otherSection.getAttribute('data-role-level'));\n\n        // 如果其他权限的名称以当前权限名称开头（继承关系），且级别小于等于当前身份组级别\n        if (otherCheckbox.name.startsWith(permissionName) && otherLevel >= level) {\n          // 选中继承的权限复选框\n          otherCheckbox.checked = true;\n        }\n      });\n    } else {\n      // 如果取消了复选框\n      // 遍历其他权限复选框\n      permissionCheckboxes.forEach(function (otherCheckbox) {\n        // 获取其他权限所在的身份组级别\n        var otherSection = otherCheckbox.closest('section[data-role-level]');\n        var otherLevel = parseInt(otherSection.getAttribute('data-role-level'));\n\n        // 如果其他权限的名称以当前权限名称开头（继承关系），且级别小于等于当前身份组级别\n        if (otherCheckbox.name.startsWith(permissionName) && otherLevel <= level) {\n          // 取消继承的权限复选框\n          otherCheckbox.checked = false;\n        }\n      });\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9hY2NvdW50L3Blcm1pc3Npb24tbWFuYWdlbWVudC5qcyIsIm1hcHBpbmdzIjoiO0FBQUE7QUFDQSxJQUFNQSxvQkFBb0IsR0FBR0MsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxvQ0FBb0MsQ0FBQzs7QUFFNUY7QUFDQUYsb0JBQW9CLENBQUNHLE9BQU8sQ0FBQyxVQUFBQyxRQUFRLEVBQUk7RUFDckNBLFFBQVEsQ0FBQ0MsZ0JBQWdCLENBQUMsUUFBUSxFQUFFLFlBQVk7SUFDNUM7SUFDQSxJQUFNQyxjQUFjLEdBQUcsSUFBSSxDQUFDQyxJQUFJOztJQUVoQztJQUNBLElBQU1DLE9BQU8sR0FBRyxJQUFJLENBQUNDLE9BQU8sQ0FBQywwQkFBMEIsQ0FBQztJQUN4RCxJQUFNQyxLQUFLLEdBQUdDLFFBQVEsQ0FBQ0gsT0FBTyxDQUFDSSxZQUFZLENBQUMsaUJBQWlCLENBQUMsQ0FBQzs7SUFFL0Q7SUFDQSxJQUFJLElBQUksQ0FBQ0MsT0FBTyxFQUFFO01BQ2Q7TUFDQWIsb0JBQW9CLENBQUNHLE9BQU8sQ0FBQyxVQUFBVyxhQUFhLEVBQUk7UUFDMUM7UUFDQSxJQUFNQyxZQUFZLEdBQUdELGFBQWEsQ0FBQ0wsT0FBTyxDQUFDLDBCQUEwQixDQUFDO1FBQ3RFLElBQU1PLFVBQVUsR0FBR0wsUUFBUSxDQUFDSSxZQUFZLENBQUNILFlBQVksQ0FBQyxpQkFBaUIsQ0FBQyxDQUFDOztRQUV6RTtRQUNBLElBQUlFLGFBQWEsQ0FBQ1AsSUFBSSxDQUFDVSxVQUFVLENBQUNYLGNBQWMsQ0FBQyxJQUFJVSxVQUFVLElBQUlOLEtBQUssRUFBRTtVQUN0RTtVQUNBSSxhQUFhLENBQUNELE9BQU8sR0FBRyxJQUFJO1FBQ2hDO01BQ0osQ0FBQyxDQUFDO0lBQ04sQ0FBQyxNQUFNO01BQUU7TUFDTDtNQUNBYixvQkFBb0IsQ0FBQ0csT0FBTyxDQUFDLFVBQUFXLGFBQWEsRUFBSTtRQUMxQztRQUNBLElBQU1DLFlBQVksR0FBR0QsYUFBYSxDQUFDTCxPQUFPLENBQUMsMEJBQTBCLENBQUM7UUFDdEUsSUFBTU8sVUFBVSxHQUFHTCxRQUFRLENBQUNJLFlBQVksQ0FBQ0gsWUFBWSxDQUFDLGlCQUFpQixDQUFDLENBQUM7O1FBRXpFO1FBQ0EsSUFBSUUsYUFBYSxDQUFDUCxJQUFJLENBQUNVLFVBQVUsQ0FBQ1gsY0FBYyxDQUFDLElBQUlVLFVBQVUsSUFBSU4sS0FBSyxFQUFFO1VBQ3RFO1VBQ0FJLGFBQWEsQ0FBQ0QsT0FBTyxHQUFHLEtBQUs7UUFDakM7TUFDSixDQUFDLENBQUM7SUFDTjtFQUNKLENBQUMsQ0FBQztBQUNOLENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9iYWNrZW5kL2FkbWluL2FjY291bnQvcGVybWlzc2lvbi1tYW5hZ2VtZW50LmpzPzg5YjIiXSwic291cmNlc0NvbnRlbnQiOlsiLy8g6I635Y+W5omA5pyJ5p2D6ZmQ55qE5aSN6YCJ5qGG5YWD57SgXHJcbmNvbnN0IHBlcm1pc3Npb25DaGVja2JveGVzID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLnN3aXRjaC1ib3ggaW5wdXRbdHlwZT1cImNoZWNrYm94XCJdJyk7XHJcblxyXG4vLyDlvZPmnYPpmZDlpI3pgInmoYbnirbmgIHlj5HnlJ/lj5jljJbml7bop6blj5Hkuovku7ZcclxucGVybWlzc2lvbkNoZWNrYm94ZXMuZm9yRWFjaChjaGVja2JveCA9PiB7XHJcbiAgICBjaGVja2JveC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgLy8g6I635Y+W5b2T5YmN5p2D6ZmQ55qE5ZCN56ewXHJcbiAgICAgICAgY29uc3QgcGVybWlzc2lvbk5hbWUgPSB0aGlzLm5hbWU7XHJcbiAgICAgICAgXHJcbiAgICAgICAgLy8g6I635Y+W5b2T5YmN5p2D6ZmQ5omA5Zyo55qE6Lqr5Lu957uE57qn5YirXHJcbiAgICAgICAgY29uc3Qgc2VjdGlvbiA9IHRoaXMuY2xvc2VzdCgnc2VjdGlvbltkYXRhLXJvbGUtbGV2ZWxdJyk7XHJcbiAgICAgICAgY29uc3QgbGV2ZWwgPSBwYXJzZUludChzZWN0aW9uLmdldEF0dHJpYnV0ZSgnZGF0YS1yb2xlLWxldmVsJykpO1xyXG4gICAgICAgIFxyXG4gICAgICAgIC8vIOWmguaenOmAieS4reS6huWkjemAieahhlxyXG4gICAgICAgIGlmICh0aGlzLmNoZWNrZWQpIHtcclxuICAgICAgICAgICAgLy8g6YGN5Y6G5YW25LuW5p2D6ZmQ5aSN6YCJ5qGGXHJcbiAgICAgICAgICAgIHBlcm1pc3Npb25DaGVja2JveGVzLmZvckVhY2gob3RoZXJDaGVja2JveCA9PiB7XHJcbiAgICAgICAgICAgICAgICAvLyDojrflj5blhbbku5bmnYPpmZDmiYDlnKjnmoTouqvku73nu4TnuqfliKtcclxuICAgICAgICAgICAgICAgIGNvbnN0IG90aGVyU2VjdGlvbiA9IG90aGVyQ2hlY2tib3guY2xvc2VzdCgnc2VjdGlvbltkYXRhLXJvbGUtbGV2ZWxdJyk7XHJcbiAgICAgICAgICAgICAgICBjb25zdCBvdGhlckxldmVsID0gcGFyc2VJbnQob3RoZXJTZWN0aW9uLmdldEF0dHJpYnV0ZSgnZGF0YS1yb2xlLWxldmVsJykpO1xyXG4gICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAvLyDlpoLmnpzlhbbku5bmnYPpmZDnmoTlkI3np7Dku6XlvZPliY3mnYPpmZDlkI3np7DlvIDlpLTvvIjnu6fmib/lhbPns7vvvInvvIzkuJTnuqfliKvlsI/kuo7nrYnkuo7lvZPliY3ouqvku73nu4TnuqfliKtcclxuICAgICAgICAgICAgICAgIGlmIChvdGhlckNoZWNrYm94Lm5hbWUuc3RhcnRzV2l0aChwZXJtaXNzaW9uTmFtZSkgJiYgb3RoZXJMZXZlbCA+PSBsZXZlbCkge1xyXG4gICAgICAgICAgICAgICAgICAgIC8vIOmAieS4ree7p+aJv+eahOadg+mZkOWkjemAieahhlxyXG4gICAgICAgICAgICAgICAgICAgIG90aGVyQ2hlY2tib3guY2hlY2tlZCA9IHRydWU7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH0gZWxzZSB7IC8vIOWmguaenOWPlua2iOS6huWkjemAieahhlxyXG4gICAgICAgICAgICAvLyDpgY3ljoblhbbku5bmnYPpmZDlpI3pgInmoYZcclxuICAgICAgICAgICAgcGVybWlzc2lvbkNoZWNrYm94ZXMuZm9yRWFjaChvdGhlckNoZWNrYm94ID0+IHtcclxuICAgICAgICAgICAgICAgIC8vIOiOt+WPluWFtuS7luadg+mZkOaJgOWcqOeahOi6q+S7vee7hOe6p+WIq1xyXG4gICAgICAgICAgICAgICAgY29uc3Qgb3RoZXJTZWN0aW9uID0gb3RoZXJDaGVja2JveC5jbG9zZXN0KCdzZWN0aW9uW2RhdGEtcm9sZS1sZXZlbF0nKTtcclxuICAgICAgICAgICAgICAgIGNvbnN0IG90aGVyTGV2ZWwgPSBwYXJzZUludChvdGhlclNlY3Rpb24uZ2V0QXR0cmlidXRlKCdkYXRhLXJvbGUtbGV2ZWwnKSk7XHJcbiAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgIC8vIOWmguaenOWFtuS7luadg+mZkOeahOWQjeensOS7peW9k+WJjeadg+mZkOWQjeensOW8gOWktO+8iOe7p+aJv+WFs+ezu++8ie+8jOS4lOe6p+WIq+Wwj+S6juetieS6juW9k+WJjei6q+S7vee7hOe6p+WIq1xyXG4gICAgICAgICAgICAgICAgaWYgKG90aGVyQ2hlY2tib3gubmFtZS5zdGFydHNXaXRoKHBlcm1pc3Npb25OYW1lKSAmJiBvdGhlckxldmVsIDw9IGxldmVsKSB7XHJcbiAgICAgICAgICAgICAgICAgICAgLy8g5Y+W5raI57un5om/55qE5p2D6ZmQ5aSN6YCJ5qGGXHJcbiAgICAgICAgICAgICAgICAgICAgb3RoZXJDaGVja2JveC5jaGVja2VkID0gZmFsc2U7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbInBlcm1pc3Npb25DaGVja2JveGVzIiwiZG9jdW1lbnQiLCJxdWVyeVNlbGVjdG9yQWxsIiwiZm9yRWFjaCIsImNoZWNrYm94IiwiYWRkRXZlbnRMaXN0ZW5lciIsInBlcm1pc3Npb25OYW1lIiwibmFtZSIsInNlY3Rpb24iLCJjbG9zZXN0IiwibGV2ZWwiLCJwYXJzZUludCIsImdldEF0dHJpYnV0ZSIsImNoZWNrZWQiLCJvdGhlckNoZWNrYm94Iiwib3RoZXJTZWN0aW9uIiwib3RoZXJMZXZlbCIsInN0YXJ0c1dpdGgiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/backend/admin/account/permission-management.js\n");

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