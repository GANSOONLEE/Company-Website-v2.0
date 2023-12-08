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

eval("__webpack_require__.r(__webpack_exports__);\n// Document ready\n$(document).ready(function (event) {\n  $('.background-form').click(function (event) {\n    $('.background-form').hide().animate({\n      opacity: '0'\n    });\n  });\n  $('.form').click(function (event) {\n    event.stopPropagation();\n  });\n  $('.button').click(function (event) {\n    event.stopPropagation();\n    alert($(this).closest('tr').data('id'));\n  });\n});\n\n// Bind the edit form trigger\n$('tr.brand-row-data').click(function (event) {\n  // Default method blocked\n  event.stopPropagation();\n  var id = $(this).data('id');\n  var name = $(this).find('.editable').text();\n  var cover = $(this).find('img').attr('src');\n  var data = {\n    'id': id,\n    'name': name,\n    'cover': cover\n  };\n  $('.background-form').show().animate({\n    opacity: '1'\n  }).css('display', 'flex');\n  callbackEditForm(data);\n});\n\n// Call the edit form\nfunction callbackEditForm(data) {\n  var editForm = $('edit-brand-form');\n  $('.brand-cover-image').attr('src', data['cover']);\n  $('.form-control').attr('value', data['name']);\n}\n\n/**\n * Search bar\n */\n\n$('#searchInput').on('input', function () {\n  var searchText = $(this).val().toLowerCase();\n  $('.brand-row-data').each(function () {\n    var rowText = $(this).find('.editable').text().toLowerCase();\n    if (rowText.includes(searchText)) {\n      $(this).show();\n    } else {\n      $(this).hide();\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9icmFuZC9tYW5hZ2VtZW50LWJyYW5kLmpzIiwibWFwcGluZ3MiOiI7QUFDQTtBQUNBQSxDQUFDLENBQUNDLFFBQVEsQ0FBQyxDQUFDQyxLQUFLLENBQUMsVUFBU0MsS0FBSyxFQUFDO0VBRTdCSCxDQUFDLENBQUMsa0JBQWtCLENBQUMsQ0FBQ0ksS0FBSyxDQUFDLFVBQVNELEtBQUssRUFBQztJQUN2Q0gsQ0FBQyxDQUFDLGtCQUFrQixDQUFDLENBQUNLLElBQUksQ0FBQyxDQUFDLENBQUNDLE9BQU8sQ0FBQztNQUNqQ0MsT0FBTyxFQUFFO0lBQ2IsQ0FBQyxDQUFDO0VBQ04sQ0FBQyxDQUFDO0VBRUZQLENBQUMsQ0FBQyxPQUFPLENBQUMsQ0FBQ0ksS0FBSyxDQUFDLFVBQVNELEtBQUssRUFBQztJQUM1QkEsS0FBSyxDQUFDSyxlQUFlLENBQUMsQ0FBQztFQUMzQixDQUFDLENBQUM7RUFFRlIsQ0FBQyxDQUFDLFNBQVMsQ0FBQyxDQUFDSSxLQUFLLENBQUMsVUFBU0QsS0FBSyxFQUFDO0lBQzlCQSxLQUFLLENBQUNLLGVBQWUsQ0FBQyxDQUFDO0lBQ3ZCQyxLQUFLLENBQUNULENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ1UsT0FBTyxDQUFDLElBQUksQ0FBQyxDQUFDQyxJQUFJLENBQUMsSUFBSSxDQUFDLENBQUM7RUFDM0MsQ0FBQyxDQUFDO0FBQ04sQ0FBQyxDQUFDOztBQUVGO0FBQ0FYLENBQUMsQ0FBQyxtQkFBbUIsQ0FBQyxDQUFDSSxLQUFLLENBQUMsVUFBU0QsS0FBSyxFQUFDO0VBRXhDO0VBQ0FBLEtBQUssQ0FBQ0ssZUFBZSxDQUFDLENBQUM7RUFDdkIsSUFBSUksRUFBRSxHQUFHWixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNXLElBQUksQ0FBQyxJQUFJLENBQUM7RUFDM0IsSUFBSUUsSUFBSSxHQUFHYixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNjLElBQUksQ0FBQyxXQUFXLENBQUMsQ0FBQ0MsSUFBSSxDQUFDLENBQUM7RUFDM0MsSUFBSUMsS0FBSyxHQUFHaEIsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDYyxJQUFJLENBQUMsS0FBSyxDQUFDLENBQUNHLElBQUksQ0FBQyxLQUFLLENBQUM7RUFFM0MsSUFBSU4sSUFBSSxHQUFHO0lBQ1AsSUFBSSxFQUFFQyxFQUFFO0lBQ1IsTUFBTSxFQUFFQyxJQUFJO0lBQ1osT0FBTyxFQUFFRztFQUNiLENBQUM7RUFFRGhCLENBQUMsQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDa0IsSUFBSSxDQUFDLENBQUMsQ0FBQ1osT0FBTyxDQUFDO0lBQ2pDQyxPQUFPLEVBQUU7RUFDYixDQUFDLENBQUMsQ0FBQ1ksR0FBRyxDQUNGLFNBQVMsRUFBRSxNQUNmLENBQUM7RUFFREMsZ0JBQWdCLENBQUNULElBQUksQ0FBQztBQUMxQixDQUFDLENBQUM7O0FBR0Y7QUFDQSxTQUFTUyxnQkFBZ0JBLENBQUNULElBQUksRUFBQztFQUMzQixJQUFJVSxRQUFRLEdBQUdyQixDQUFDLENBQUMsaUJBQWlCLENBQUM7RUFDbkNBLENBQUMsQ0FBQyxvQkFBb0IsQ0FBQyxDQUFDaUIsSUFBSSxDQUFDLEtBQUssRUFBRU4sSUFBSSxDQUFDLE9BQU8sQ0FBQyxDQUFDO0VBQ2xEWCxDQUFDLENBQUMsZUFBZSxDQUFDLENBQUNpQixJQUFJLENBQUMsT0FBTyxFQUFFTixJQUFJLENBQUMsTUFBTSxDQUFDLENBQUM7QUFDbEQ7O0FBRUE7QUFDQTtBQUNBOztBQUVBWCxDQUFDLENBQUMsY0FBYyxDQUFDLENBQUNzQixFQUFFLENBQUMsT0FBTyxFQUFFLFlBQVc7RUFDckMsSUFBSUMsVUFBVSxHQUFHdkIsQ0FBQyxDQUFDLElBQUksQ0FBQyxDQUFDd0IsR0FBRyxDQUFDLENBQUMsQ0FBQ0MsV0FBVyxDQUFDLENBQUM7RUFFNUN6QixDQUFDLENBQUMsaUJBQWlCLENBQUMsQ0FBQzBCLElBQUksQ0FBQyxZQUFXO0lBQ2pDLElBQUlDLE9BQU8sR0FBRzNCLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ2MsSUFBSSxDQUFDLFdBQVcsQ0FBQyxDQUFDQyxJQUFJLENBQUMsQ0FBQyxDQUFDVSxXQUFXLENBQUMsQ0FBQztJQUM1RCxJQUFJRSxPQUFPLENBQUNDLFFBQVEsQ0FBQ0wsVUFBVSxDQUFDLEVBQUU7TUFDOUJ2QixDQUFDLENBQUMsSUFBSSxDQUFDLENBQUNrQixJQUFJLENBQUMsQ0FBQztJQUNsQixDQUFDLE1BQU07TUFDSGxCLENBQUMsQ0FBQyxJQUFJLENBQUMsQ0FBQ0ssSUFBSSxDQUFDLENBQUM7SUFDbEI7RUFDSixDQUFDLENBQUM7QUFDTixDQUFDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYmFja2VuZC9hZG1pbi9icmFuZC9tYW5hZ2VtZW50LWJyYW5kLmpzPzdmY2EiXSwic291cmNlc0NvbnRlbnQiOlsiXG4vLyBEb2N1bWVudCByZWFkeVxuJChkb2N1bWVudCkucmVhZHkoZnVuY3Rpb24oZXZlbnQpe1xuXG4gICAgJCgnLmJhY2tncm91bmQtZm9ybScpLmNsaWNrKGZ1bmN0aW9uKGV2ZW50KXtcbiAgICAgICAgJCgnLmJhY2tncm91bmQtZm9ybScpLmhpZGUoKS5hbmltYXRlKHtcbiAgICAgICAgICAgIG9wYWNpdHk6ICcwJ1xuICAgICAgICB9KTtcbiAgICB9KTtcblxuICAgICQoJy5mb3JtJykuY2xpY2soZnVuY3Rpb24oZXZlbnQpe1xuICAgICAgICBldmVudC5zdG9wUHJvcGFnYXRpb24oKTtcbiAgICB9KTtcblxuICAgICQoJy5idXR0b24nKS5jbGljayhmdW5jdGlvbihldmVudCl7XG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICBhbGVydCgkKHRoaXMpLmNsb3Nlc3QoJ3RyJykuZGF0YSgnaWQnKSlcbiAgICB9KTtcbn0pO1xuXG4vLyBCaW5kIHRoZSBlZGl0IGZvcm0gdHJpZ2dlclxuJCgndHIuYnJhbmQtcm93LWRhdGEnKS5jbGljayhmdW5jdGlvbihldmVudCl7XG5cbiAgICAvLyBEZWZhdWx0IG1ldGhvZCBibG9ja2VkXG4gICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgbGV0IGlkID0gJCh0aGlzKS5kYXRhKCdpZCcpO1xuICAgIGxldCBuYW1lID0gJCh0aGlzKS5maW5kKCcuZWRpdGFibGUnKS50ZXh0KCk7XG4gICAgbGV0IGNvdmVyID0gJCh0aGlzKS5maW5kKCdpbWcnKS5hdHRyKCdzcmMnKTtcblxuICAgIGxldCBkYXRhID0ge1xuICAgICAgICAnaWQnOiBpZCxcbiAgICAgICAgJ25hbWUnOiBuYW1lLFxuICAgICAgICAnY292ZXInOiBjb3ZlcixcbiAgICB9O1xuXG4gICAgJCgnLmJhY2tncm91bmQtZm9ybScpLnNob3coKS5hbmltYXRlKHtcbiAgICAgICAgb3BhY2l0eTogJzEnXG4gICAgfSkuY3NzKFxuICAgICAgICAnZGlzcGxheScsICdmbGV4JyxcbiAgICApXG5cbiAgICBjYWxsYmFja0VkaXRGb3JtKGRhdGEpO1xufSk7XG5cblxuLy8gQ2FsbCB0aGUgZWRpdCBmb3JtXG5mdW5jdGlvbiBjYWxsYmFja0VkaXRGb3JtKGRhdGEpe1xuICAgIGxldCBlZGl0Rm9ybSA9ICQoJ2VkaXQtYnJhbmQtZm9ybScpO1xuICAgICQoJy5icmFuZC1jb3Zlci1pbWFnZScpLmF0dHIoJ3NyYycsIGRhdGFbJ2NvdmVyJ10pO1xuICAgICQoJy5mb3JtLWNvbnRyb2wnKS5hdHRyKCd2YWx1ZScsIGRhdGFbJ25hbWUnXSlcbn1cblxuLyoqXG4gKiBTZWFyY2ggYmFyXG4gKi9cblxuJCgnI3NlYXJjaElucHV0Jykub24oJ2lucHV0JywgZnVuY3Rpb24oKSB7XG4gICAgdmFyIHNlYXJjaFRleHQgPSAkKHRoaXMpLnZhbCgpLnRvTG93ZXJDYXNlKCk7XG4gICAgXG4gICAgJCgnLmJyYW5kLXJvdy1kYXRhJykuZWFjaChmdW5jdGlvbigpIHtcbiAgICAgICAgdmFyIHJvd1RleHQgPSAkKHRoaXMpLmZpbmQoJy5lZGl0YWJsZScpLnRleHQoKS50b0xvd2VyQ2FzZSgpO1xuICAgICAgICBpZiAocm93VGV4dC5pbmNsdWRlcyhzZWFyY2hUZXh0KSkge1xuICAgICAgICAgICAgJCh0aGlzKS5zaG93KCk7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAkKHRoaXMpLmhpZGUoKTtcbiAgICAgICAgfVxuICAgIH0pO1xufSk7XG4iXSwibmFtZXMiOlsiJCIsImRvY3VtZW50IiwicmVhZHkiLCJldmVudCIsImNsaWNrIiwiaGlkZSIsImFuaW1hdGUiLCJvcGFjaXR5Iiwic3RvcFByb3BhZ2F0aW9uIiwiYWxlcnQiLCJjbG9zZXN0IiwiZGF0YSIsImlkIiwibmFtZSIsImZpbmQiLCJ0ZXh0IiwiY292ZXIiLCJhdHRyIiwic2hvdyIsImNzcyIsImNhbGxiYWNrRWRpdEZvcm0iLCJlZGl0Rm9ybSIsIm9uIiwic2VhcmNoVGV4dCIsInZhbCIsInRvTG93ZXJDYXNlIiwiZWFjaCIsInJvd1RleHQiLCJpbmNsdWRlcyJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/backend/admin/brand/management-brand.js\n");

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