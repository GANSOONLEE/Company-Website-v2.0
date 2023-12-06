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

/***/ "./resources/js/backend/admin/brand/management-brand.js":
/*!**************************************************************!*\
  !*** ./resources/js/backend/admin/brand/management-brand.js ***!
  \**************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n// Document ready\n$(document).ready(function (event) {\n  $('.background-form').click(function (event) {\n    $('.background-form').hide().animate({\n      opacity: '0'\n    });\n  });\n  $('.form').click(function (event) {\n    event.stopPropagation();\n  });\n  $('.button').click(function (event) {\n    event.stopPropagation();\n    alert($(this).closest('tr').data('id'));\n  });\n});\n\n// Bind the edit form trigger\n$('tr.brand-row-data').click(function (event) {\n  // Default method blocked\n  event.stopPropagation();\n  var id = $(this).data('id');\n  var name = $(this).find('.editable').text();\n  var cover = $(this).find('img').attr('src');\n  var data = {\n    'id': id,\n    'name': name,\n    'cover': cover\n  };\n  $('.background-form').show().animate({\n    opacity: '1'\n  }).css('display', 'flex');\n  callbackEditForm(data);\n});\n\n// Call the edit form\nfunction callbackEditForm(data) {\n  var editForm = $('edit-brand-form');\n  $('.brand-cover-image').attr('src', data['cover']);\n  $('.form-control').attr('value', data['name']);\n}\n\n/**\r\n * Search bar\r\n */\n\n$('#searchInput').on('input', function () {\n  var searchText = $(this).val().toLowerCase();\n  $('.brand-row-data').each(function () {\n    var rowText = $(this).find('.editable').text().toLowerCase();\n    if (rowText.includes(searchText)) {\n      $(this).show();\n    } else {\n      $(this).hide();\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9icmFuZC9tYW5hZ2VtZW50LWJyYW5kLmpzIiwibWFwcGluZ3MiOiI7QUFDQTtBQUNBQSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsVUFBU0MsS0FBSyxFQUFDO0VBRTdCSCxDQUFDLENBQUMsa0JBQWtCLENBQUMsQ0FBQ0ksS0FBSyxDQUFDLFVBQVNELEtBQUssRUFBQztJQUN2Q0gsQ0FBQyxDQUFDLGtCQUFrQixDQUFDLENBQUNLLElBQUksQ0FBQyxDQUFDLENBQUNDLE9BQU8sQ0FBQztNQUNqQ0MsT0FBTyxFQUFFO0lBQ2IsQ0FBQyxDQUFDO0VBQ04sQ0FBQyxDQUFDO0VBRUZQLENBQUMsQ0FBQyxPQUFPLENBQUMsQ0FBQ0ksS0FBSyxDQUFDLFVBQVNELEtBQUssRUFBQztJQUM1QkEsS0FBSyxDQUFDSyxlQUFlLENBQUMsQ0FBQztFQUMzQixDQUFDLENBQUM7RUFFRlIsQ0FBQyxDQUFDLFNBQVMsQ0FBQyxDQUFDSSxLQUFLLENBQUMsVUFBU0QsS0FBSyxFQUFDO0lBQzlCQSxLQUFLLENBQUNLLGVBQWUsQ0FBQyxDQUFDO0lBQ3ZCQyxLQUFLLENBQUNULENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ1UsT0FBTyxDQUFDLElBQUksQ0FBQyxDQUFDQyxJQUFJLENBQUMsSUFBSSxDQUFDLENBQUM7RUFDM0MsQ0FBQyxDQUFDO0FBQ04sQ0FBQyxDQUFDOztBQUVGO0FBQ0FYLENBQUMsQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDSSxLQUFLLENBQUMsVUFBU0QsS0FBSyxFQUFDO0VBRXhDO0VBQ0FBLEtBQUssQ0FBQ0ssZUFBZSxDQUFDLENBQUM7RUFDdkIsSUFBSUksRUFBRSxHQUFHWixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNXLElBQUksQ0FBQyxJQUFJLENBQUM7RUFDM0IsSUFBSUUsSUFBSSxHQUFHYixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNjLElBQUksQ0FBQyxXQUFXLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLENBQUM7RUFDM0MsSUFBSUMsS0FBSyxHQUFHaEIsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDYyxJQUFJLENBQUMsS0FBSyxDQUFDLENBQUNHLElBQUksQ0FBQyxLQUFLLENBQUM7RUFFM0MsSUFBSU4sSUFBSSxHQUFHO0lBQ1AsSUFBSSxFQUFFQyxFQUFFO0lBQ1IsTUFBTSxFQUFFQyxJQUFJO0lBQ1osT0FBTyxFQUFFRztFQUNiLENBQUM7RUFFRGhCLENBQUMsQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDa0IsSUFBSSxDQUFDLENBQUMsQ0FBQ1osT0FBTyxDQUFDO0lBQ2pDQyxPQUFPLEVBQUU7RUFDYixDQUFDLENBQUMsQ0FBQ1ksR0FBRyxDQUNGLFNBQVMsRUFBRSxNQUNmLENBQUM7RUFFREMsZ0JBQWdCLENBQUNULElBQUksQ0FBQztBQUMxQixDQUFDLENBQUM7O0FBR0Y7QUFDQSxTQUFTUyxnQkFBZ0JBLENBQUNULElBQUksRUFBQztFQUMzQixJQUFJVSxRQUFRLEdBQUdyQixDQUFDLENBQUMsaUJBQWlCLENBQUM7RUFDbkNBLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDaUIsSUFBSSxDQUFDLEtBQUssRUFBRU4sSUFBSSxDQUFDLE9BQU8sQ0FBQyxDQUFDO0VBQ2xEWCxDQUFDLENBQUMsZUFBZSxDQUFDLENBQUNpQixJQUFJLENBQUMsT0FBTyxFQUFFTixJQUFJLENBQUMsTUFBTSxDQUFDLENBQUM7QUFDbEQ7O0FBRUE7QUFDQTtBQUNBOztBQUVBWCxDQUFDLENBQUMsY0FBYyxDQUFDLENBQUNzQixFQUFFLENBQUMsT0FBTyxFQUFFLFlBQVc7RUFDckMsSUFBSUMsVUFBVSxHQUFHdkIsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDd0IsR0FBRyxDQUFDLENBQUMsQ0FBQ0MsV0FBVyxDQUFDLENBQUM7RUFFNUN6QixDQUFDLENBQUMsaUJBQWlCLENBQUMsQ0FBQzBCLElBQUksQ0FBQyxZQUFXO0lBQ2pDLElBQUlDLE9BQU8sR0FBRzNCLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2MsSUFBSSxDQUFDLFdBQVcsQ0FBQyxDQUFDQyxJQUFJLENBQUMsQ0FBQyxDQUFDVSxXQUFXLENBQUMsQ0FBQztJQUM1RCxJQUFJRSxPQUFPLENBQUNDLFFBQVEsQ0FBQ0wsVUFBVSxDQUFDLEVBQUU7TUFDOUJ2QixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNrQixJQUFJLENBQUMsQ0FBQztJQUNsQixDQUFDLE1BQU07TUFDSGxCLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ0ssSUFBSSxDQUFDLENBQUM7SUFDbEI7RUFDSixDQUFDLENBQUM7QUFDTixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9icmFuZC9tYW5hZ2VtZW50LWJyYW5kLmpzPzdmY2EiXSwic291cmNlc0NvbnRlbnQiOlsiXHJcbi8vIERvY3VtZW50IHJlYWR5XHJcbiQoZG9jdW1lbnQpLnJlYWR5KGZ1bmN0aW9uKGV2ZW50KXtcclxuXHJcbiAgICAkKCcuYmFja2dyb3VuZC1mb3JtJykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgICAgICQoJy5iYWNrZ3JvdW5kLWZvcm0nKS5oaWRlKCkuYW5pbWF0ZSh7XHJcbiAgICAgICAgICAgIG9wYWNpdHk6ICcwJ1xyXG4gICAgICAgIH0pO1xyXG4gICAgfSk7XHJcblxyXG4gICAgJCgnLmZvcm0nKS5jbGljayhmdW5jdGlvbihldmVudCl7XHJcbiAgICAgICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XHJcbiAgICB9KTtcclxuXHJcbiAgICAkKCcuYnV0dG9uJykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xyXG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xyXG4gICAgICAgIGFsZXJ0KCQodGhpcykuY2xvc2VzdCgndHInKS5kYXRhKCdpZCcpKVxyXG4gICAgfSk7XHJcbn0pO1xyXG5cclxuLy8gQmluZCB0aGUgZWRpdCBmb3JtIHRyaWdnZXJcclxuJCgndHIuYnJhbmQtcm93LWRhdGEnKS5jbGljayhmdW5jdGlvbihldmVudCl7XHJcblxyXG4gICAgLy8gRGVmYXVsdCBtZXRob2QgYmxvY2tlZFxyXG4gICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XHJcbiAgICBsZXQgaWQgPSAkKHRoaXMpLmRhdGEoJ2lkJyk7XHJcbiAgICBsZXQgbmFtZSA9ICQodGhpcykuZmluZCgnLmVkaXRhYmxlJykudGV4dCgpO1xyXG4gICAgbGV0IGNvdmVyID0gJCh0aGlzKS5maW5kKCdpbWcnKS5hdHRyKCdzcmMnKTtcclxuXHJcbiAgICBsZXQgZGF0YSA9IHtcclxuICAgICAgICAnaWQnOiBpZCxcclxuICAgICAgICAnbmFtZSc6IG5hbWUsXHJcbiAgICAgICAgJ2NvdmVyJzogY292ZXIsXHJcbiAgICB9O1xyXG5cclxuICAgICQoJy5iYWNrZ3JvdW5kLWZvcm0nKS5zaG93KCkuYW5pbWF0ZSh7XHJcbiAgICAgICAgb3BhY2l0eTogJzEnXHJcbiAgICB9KS5jc3MoXHJcbiAgICAgICAgJ2Rpc3BsYXknLCAnZmxleCcsXHJcbiAgICApXHJcblxyXG4gICAgY2FsbGJhY2tFZGl0Rm9ybShkYXRhKTtcclxufSk7XHJcblxyXG5cclxuLy8gQ2FsbCB0aGUgZWRpdCBmb3JtXHJcbmZ1bmN0aW9uIGNhbGxiYWNrRWRpdEZvcm0oZGF0YSl7XHJcbiAgICBsZXQgZWRpdEZvcm0gPSAkKCdlZGl0LWJyYW5kLWZvcm0nKTtcclxuICAgICQoJy5icmFuZC1jb3Zlci1pbWFnZScpLmF0dHIoJ3NyYycsIGRhdGFbJ2NvdmVyJ10pO1xyXG4gICAgJCgnLmZvcm0tY29udHJvbCcpLmF0dHIoJ3ZhbHVlJywgZGF0YVsnbmFtZSddKVxyXG59XHJcblxyXG4vKipcclxuICogU2VhcmNoIGJhclxyXG4gKi9cclxuXHJcbiQoJyNzZWFyY2hJbnB1dCcpLm9uKCdpbnB1dCcsIGZ1bmN0aW9uKCkge1xyXG4gICAgdmFyIHNlYXJjaFRleHQgPSAkKHRoaXMpLnZhbCgpLnRvTG93ZXJDYXNlKCk7XHJcbiAgICBcclxuICAgICQoJy5icmFuZC1yb3ctZGF0YScpLmVhY2goZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgdmFyIHJvd1RleHQgPSAkKHRoaXMpLmZpbmQoJy5lZGl0YWJsZScpLnRleHQoKS50b0xvd2VyQ2FzZSgpO1xyXG4gICAgICAgIGlmIChyb3dUZXh0LmluY2x1ZGVzKHNlYXJjaFRleHQpKSB7XHJcbiAgICAgICAgICAgICQodGhpcykuc2hvdygpO1xyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICAgICQodGhpcykuaGlkZSgpO1xyXG4gICAgICAgIH1cclxuICAgIH0pO1xyXG59KTtcclxuIl0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwiZXZlbnQiLCJjbGljayIsImhpZGUiLCJhbmltYXRlIiwib3BhY2l0eSIsInN0b3BQcm9wYWdhdGlvbiIsImFsZXJ0IiwiY2xvc2VzdCIsImRhdGEiLCJpZCIsIm5hbWUiLCJmaW5kIiwidGV4dCIsImNvdmVyIiwiYXR0ciIsInNob3ciLCJjc3MiLCJjYWxsYmFja0VkaXRGb3JtIiwiZWRpdEZvcm0iLCJvbiIsInNlYXJjaFRleHQiLCJ2YWwiLCJ0b0xvd2VyQ2FzZSIsImVhY2giLCJyb3dUZXh0IiwiaW5jbHVkZXMiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/backend/admin/brand/management-brand.js\n");

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
/******/ 	__webpack_modules__["./resources/js/backend/admin/brand/management-brand.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;