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

/***/ "./resources/js/backend/admin/account/user-management.js":
/*!***************************************************************!*\
  !*** ./resources/js/backend/admin/account/user-management.js ***!
  \***************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// Modal\n\n$('.edit-button').click(function (event) {\n  // Define variable\n  var username = $(this).closest('tr').find('#name').data('name');\n  var email = $(this).closest('tr').find('#email').text();\n  var role = $(this).closest('tr').find('#role').data('role');\n  $('#modal-input-name').val(username);\n  $('#modal-input-email').val(email);\n  $('#modal-input-role').val(role);\n  $('.modal-background').addClass('active');\n});\n\n// $('.modal-background').click(function(event){\n//     $(this).removeClass('active');\n// })\n\n$('.custom-modal').click(function (event) {\n  event.stopPropagation();\n});\n$('.close-button').click(function (event) {\n  $('.modal-background').removeClass('active');\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9hY2NvdW50L3VzZXItbWFuYWdlbWVudC5qcyIsIm1hcHBpbmdzIjoiO0FBQ0E7O0FBRUFBLENBQUMsQ0FBQyxjQUFjLENBQUMsQ0FBQ0MsS0FBSyxDQUFDLFVBQVNDLEtBQUssRUFBQztFQUVuQztFQUNBLElBQUlDLFFBQVEsR0FBR0gsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDSSxPQUFPLENBQUMsSUFBSSxDQUFDLENBQUNDLElBQUksQ0FBQyxPQUFPLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLE1BQU0sQ0FBQztFQUMvRCxJQUFJQyxLQUFLLEdBQUdQLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ0ksT0FBTyxDQUFDLElBQUksQ0FBQyxDQUFDQyxJQUFJLENBQUMsUUFBUSxDQUFDLENBQUNHLElBQUksQ0FBQyxDQUFDO0VBQ3ZELElBQUlDLElBQUksR0FBR1QsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDSSxPQUFPLENBQUMsSUFBSSxDQUFDLENBQUNDLElBQUksQ0FBQyxPQUFPLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLE1BQU0sQ0FBQztFQUUzRE4sQ0FBQyxDQUFDLG1CQUFtQixDQUFDLENBQUNVLEdBQUcsQ0FBQ1AsUUFBUSxDQUFDO0VBQ3BDSCxDQUFDLENBQUMsb0JBQW9CLENBQUMsQ0FBQ1UsR0FBRyxDQUFDSCxLQUFLLENBQUM7RUFDbENQLENBQUMsQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDVSxHQUFHLENBQUNELElBQUksQ0FBQztFQUVoQ1QsQ0FBQyxDQUFDLG1CQUFtQixDQUFDLENBQUNXLFFBQVEsQ0FBQyxRQUFRLENBQUM7QUFDN0MsQ0FBQyxDQUFDOztBQUVGO0FBQ0E7QUFDQTs7QUFFQVgsQ0FBQyxDQUFDLGVBQWUsQ0FBQyxDQUFDQyxLQUFLLENBQUMsVUFBU0MsS0FBSyxFQUFDO0VBQ3BDQSxLQUFLLENBQUNVLGVBQWUsQ0FBQyxDQUFDO0FBQzNCLENBQUMsQ0FBQztBQUVGWixDQUFDLENBQUMsZUFBZSxDQUFDLENBQUNDLEtBQUssQ0FBQyxVQUFTQyxLQUFLLEVBQUM7RUFDcENGLENBQUMsQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDYSxXQUFXLENBQUMsUUFBUSxDQUFDO0FBQ2hELENBQUMsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9qcy9iYWNrZW5kL2FkbWluL2FjY291bnQvdXNlci1tYW5hZ2VtZW50LmpzP2JhZGQiXSwic291cmNlc0NvbnRlbnQiOlsiXHJcbi8vIE1vZGFsXHJcblxyXG4kKCcuZWRpdC1idXR0b24nKS5jbGljayhmdW5jdGlvbihldmVudCl7XHJcblxyXG4gICAgLy8gRGVmaW5lIHZhcmlhYmxlXHJcbiAgICBsZXQgdXNlcm5hbWUgPSAkKHRoaXMpLmNsb3Nlc3QoJ3RyJykuZmluZCgnI25hbWUnKS5kYXRhKCduYW1lJyk7XHJcbiAgICBsZXQgZW1haWwgPSAkKHRoaXMpLmNsb3Nlc3QoJ3RyJykuZmluZCgnI2VtYWlsJykudGV4dCgpO1xyXG4gICAgbGV0IHJvbGUgPSAkKHRoaXMpLmNsb3Nlc3QoJ3RyJykuZmluZCgnI3JvbGUnKS5kYXRhKCdyb2xlJyk7XHJcblxyXG4gICAgJCgnI21vZGFsLWlucHV0LW5hbWUnKS52YWwodXNlcm5hbWUpO1xyXG4gICAgJCgnI21vZGFsLWlucHV0LWVtYWlsJykudmFsKGVtYWlsKTtcclxuICAgICQoJyNtb2RhbC1pbnB1dC1yb2xlJykudmFsKHJvbGUpO1xyXG4gICAgXHJcbiAgICAkKCcubW9kYWwtYmFja2dyb3VuZCcpLmFkZENsYXNzKCdhY3RpdmUnKTtcclxufSlcclxuXHJcbi8vICQoJy5tb2RhbC1iYWNrZ3JvdW5kJykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xyXG4vLyAgICAgJCh0aGlzKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbi8vIH0pXHJcblxyXG4kKCcuY3VzdG9tLW1vZGFsJykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XHJcbn0pXHJcblxyXG4kKCcuY2xvc2UtYnV0dG9uJykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgJCgnLm1vZGFsLWJhY2tncm91bmQnKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XHJcbn0pIl0sIm5hbWVzIjpbIiQiLCJjbGljayIsImV2ZW50IiwidXNlcm5hbWUiLCJjbG9zZXN0IiwiZmluZCIsImRhdGEiLCJlbWFpbCIsInRleHQiLCJyb2xlIiwidmFsIiwiYWRkQ2xhc3MiLCJzdG9wUHJvcGFnYXRpb24iLCJyZW1vdmVDbGFzcyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/backend/admin/account/user-management.js\n");

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
/******/ 	__webpack_modules__["./resources/js/backend/admin/account/user-management.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;