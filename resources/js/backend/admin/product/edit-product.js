
// Vue Component

import CustomAlert from '../components/CustomAlert.vue';

const alert = createApp(CustomAlert);
const alertInstance = alert.mount("#alert")

// /**
//  *  Helper Function
//  *  @function DOMElement - select all filter
//  *  @param {String} filterName - filter name you want to select 
//  */

// function findFilter(filterName){

//     let filter = document.querySelector(`[data-select-filter=${filterName}]`);
    
//     if(!filter){
//         console.error(`Filter ${filterName} not find`)
//     }

//     return filter;

// }

// /**
//  * Init Filter
//  */

// import Filter from './class/Filter.js';

// let filters = {};

// function initFilter(columnId, mode, trigger = "change") {
//     let column = findFilter(columnId);
//     filters[columnId] = new Filter(column, mode, trigger);
//     console.log('初始化成功')

//     filters[columnId].setChangeCallback(applyFilters);
// }

// initFilter('name', 'contain', 'keyup');
// initFilter('category', 'strict');
// initFilter('type', 'strict');
// // initFilter('status', 'strict');

// function applyFilters() {
//     // console.log('調用中')
//     let nameValue = filters['name'].getValue();
//     let categoryValue = filters['category'].getValue();
//     let typeValue = filters['type'].getValue();
//     let statusValue = filters['status'].getValue();

//     let columns = document.querySelectorAll('[data-search-column]'); // 选择带有 data-search-column 属性的元素
//     var nameMatch, categoryMatch, typeMatch, statusMatch;

//     columns.forEach(column => {
//         let columnName = column.getAttribute('data-search-column');
//         let columnContent = column.innerText;

//         if(columnName === "name"){
//             nameMatch = nameValue == "" || (columnMatchesFilter(columnContent, nameValue, filters['name'].getMode()));
//             // console.log(`nameMatch 結果為：${nameMatch}，查詢條件為 ${nameValue}，内容爲${columnContent}` )
//             return nameMatch
//         }

//         if(columnName === "category"){
//             categoryMatch = categoryValue == "" || (columnMatchesFilter(columnContent, categoryValue, filters['category'].getMode()));
//             // console.log(`categoryMatch 結果為：${categoryMatch}，查詢條件為 ${categoryValue}，内容爲${columnContent}` )
//             return categoryMatch
//         }

//         if(columnName === "type"){
//             typeMatch = typeValue == "" || (columnMatchesFilter(columnContent, typeValue, filters['type'].getMode()));
//             // console.log(`typeMatch 結果為：${typeMatch}，查詢條件為 ${typeValue}，内容爲${columnContent}` )
//             return typeMatch
//         }

//         if(columnName === "status"){
//             statusMatch = statusValue == "" || (columnMatchesFilter(columnContent, statusValue, filters['status'].getMode()));
//             // console.log(`statusMatch 結果為：${statusMatch}，查詢條件為 ${statusValue}，内容爲${columnContent}` )
//             return statusMatch
//         }

//         // console.log(nameMatch && categoryMatch && typeMatch && statusMatch)

//         if (nameMatch && categoryMatch && typeMatch && statusMatch) {
//             column.parentElement.style.display = 'table-row';
//         } else {
//             column.parentElement.style.display = 'none';
//         }
//     });
// }

// function columnMatchesFilter(columnContent, filterValue, mode) {
//     if (mode === 'contain') {
//         return columnContent.toUpperCase().includes(filterValue.toUpperCase());
//     } else if (mode === 'strict') {
//         return columnContent === filterValue;
//     }
// }


// Delete Confirm

let buttons = document.querySelectorAll('a[button-event="delete"]');
let deleteConfirmButton = document.querySelector('#deleteButtonConfirm');

window.onload = ()=>{

    buttons.forEach(button=>{

        button.style.display = "table-cell";

        button.addEventListener('click', (event)=>{
            event.preventDefault();
            deleteConfirmButton.setAttribute('data-link', button.href)
        })
    })

}

deleteConfirmButton.addEventListener('click', ()=>{

    window.location.href = deleteConfirmButton.getAttribute('data-link')

});

// Function

let gotoButton = document.querySelector('#gotoButton');
gotoButton.addEventListener('click', ()=>{

    // Get Current Url
    let currentUrl = window.location.href;

    // Get Range
    let pageIndexInput = document.querySelector('input[type=number]') 
    const min = parseInt(pageIndexInput.getAttribute('min'));
    const max = parseInt(pageIndexInput.getAttribute('max'));

    let currentPage = parseInt(pageIndexInput.value);
    if(!currentPage){
        window.location.href = currentUrl
        return false;
    }

    // Verify data validation
    if(currentPage == null || currentPage == ''){
        alertInstance.updateMessage('Please input a number!', 'error')
        alertInstance.autoAlert();
        return false;
    }

    if(min > currentPage || currentPage > max){
        alertInstance.updateMessage(`Your page <b>must between</b> ${min} and ${max}!<br>You value ${currentPage}`, 'error')
        alertInstance.autoAlert();
        return false;
    }

    let url = new URL(currentUrl);
    url.searchParams.set('pageIndex', currentPage);

    url.searchParams.set('text', url.searchParams.get('text') || '');
    url.searchParams.set('category', url.searchParams.get('category') || '');
    url.searchParams.set('type', url.searchParams.get('type') || '');

    window.location.href = url.toString();
})