/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
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
var __webpack_exports__ = {};
/*!********************************************************************!*\
  !*** ./resources/js/backend/admin/category/management-category.js ***!
  \********************************************************************/
__webpack_require__.r(__webpack_exports__);
// Document ready
$(document).ready(function (event) {
  $('.background-form').click(function (event) {
    $('.background-form').hide().animate({
      opacity: '0'
    });
  });
  $('.form').click(function (event) {
    event.stopPropagation();
  });
  $('.button').click(function (event) {
    event.stopPropagation();
    alert($(this).closest('tr').data('id'));
  });
});

// Bind the edit form trigger
$('tr.category-row-data').click(function (event) {
  // Default method blocked
  event.stopPropagation();
  var id = $(this).data('id');
  var name = $(this).find('.editable').text();
  var cover = $(this).find('img').attr('src');
  var data = {
    'id': id,
    'name': name,
    'cover': cover
  };
  $('.background-form').show().animate({
    opacity: '1'
  }).css('display', 'flex');
  callbackEditForm(data);
});

// Call the edit form
function callbackEditForm(data) {
  var editForm = $('edit-category-form');
  $('.category-cover-image').attr('src', data['cover']);
  $('.form-control').attr('value', data['name']);
}

/**
 * <<API CALL>>
 * Delete Category
 */
/******/ })()
;