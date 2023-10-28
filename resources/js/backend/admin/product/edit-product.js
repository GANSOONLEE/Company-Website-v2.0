
// /**
//  *  @param {string} searchFilter The filter input
//  *  @param {string} searchColumn The result you want search in which column
//  */

// class Filter{

//     /**
//      * @param
//      */

//     element

//     constructor(element){
//         this.element = element;
//     }

//     init(){

//         let ident = this.element.getAttribute('data-select-filter');
//         let searchColumns = document.querySelectorAll(`[data-search-column=${ident}]`) 

//         this.element.addEventListener('change', ()=>{
//             this.addBindEvent(searchColumns);
//         })

//         this.element.addEventListener('keyup', ()=>{
//             this.addBindEvent(searchColumns);
//         })
//     }

//     addBindEvent(searchColumns){
        
//         let index = this.element.selectedIndex;
//         let text;
//         try{
//             text = this.element.options[index].text;
//         }catch{
//             text = this.element.value;
//         }
       
        
//         searchColumns.forEach(searchColumn=>{
            
//             console.log(searchColumn.innerText)
//             console.log(text)

//             if (text == "All" || text == '') {
//                 searchColumn.parentNode.style.display = 'table-row';
//             } else if (searchColumn.innerHTML.includes(text)) {
//                 searchColumn.parentNode.style.display = 'table-row';
//             } else {
//                 searchColumn.parentNode.style.display = 'none';
//             }
//         })

//     }

// }

// let filters = document.querySelectorAll('[data-select-filter]');
// filters.forEach(filter => {
//     let instance = new Filter(filter)
//     instance.init();
// });


/**
 *  Helper Function
 *  @function DOMElement - select all filter
 *  @param {String} filterName - filter name you want to select 
 */

function findFilter(filterName){

    let filter = document.querySelector(`[data-select-filter=${filterName}]`);
    
    if(!filter){
        console.error(`Filter ${filterName} not find`)
    }

    return filter;

}

/**
 * Init Filter
 */

import Filter from './class/Filter.js';

let filters = {};

function initFilter(columnId, mode, trigger = "change") {
    let column = findFilter(columnId);
    filters[columnId] = new Filter(column, mode, trigger);
    console.log('初始化成功')

    // 设置回调函数，用于处理过滤器值变化
    filters[columnId].setChangeCallback(applyFilters);
}

initFilter('name', 'contain', 'keyup');
initFilter('category', 'strict');
initFilter('type', 'strict');
initFilter('status', 'strict');

function applyFilters() {
    console.log('調用中')
    let nameValue = filters['name'].getValue();
    let categoryValue = filters['category'].getValue();
    let typeValue = filters['type'].getValue();
    let statusValue = filters['status'].getValue();

    let columns = document.querySelectorAll('[data-search-column]'); // 选择带有 data-search-column 属性的元素
    var nameMatch, categoryMatch, typeMatch, statusMatch;

    columns.forEach(column => {
        let columnName = column.getAttribute('data-search-column');
        let columnContent = column.innerText;

        if(columnName === "name"){
            nameMatch = nameValue == "" || (columnMatchesFilter(columnContent, nameValue, filters['name'].getMode()));
            console.log(`nameMatch 結果為：${nameMatch}，查詢條件為 ${nameValue}，内容爲${columnContent}` )
            return nameMatch
        }

        if(columnName === "category"){
            categoryMatch = categoryValue == "" || (columnMatchesFilter(columnContent, categoryValue, filters['category'].getMode()));
            console.log(`categoryMatch 結果為：${categoryMatch}，查詢條件為 ${categoryValue}，内容爲${columnContent}` )
            return categoryMatch
        }

        if(columnName === "type"){
            typeMatch = typeValue == "" || (columnMatchesFilter(columnContent, typeValue, filters['type'].getMode()));
            console.log(`typeMatch 結果為：${typeMatch}，查詢條件為 ${typeValue}，内容爲${columnContent}` )
            return typeMatch
        }

        if(columnName === "status"){
            statusMatch = statusValue == "" || (columnMatchesFilter(columnContent, statusValue, filters['status'].getMode()));
            console.log(`statusMatch 結果為：${statusMatch}，查詢條件為 ${statusValue}，内容爲${columnContent}` )
            return statusMatch
        }

        console.log(nameMatch && categoryMatch && typeMatch && statusMatch)

        if (nameMatch && categoryMatch && typeMatch && statusMatch) {
            column.parentElement.style.display = 'table-row';
        } else {
            column.parentElement.style.display = 'none';
        }
    });
}

function columnMatchesFilter(columnContent, filterValue, mode) {
    if (mode === 'contain') {
        return columnContent.toUpperCase().includes(filterValue.toUpperCase());
    } else if (mode === 'strict') {
        return columnContent === filterValue;
    }
}




/**
 *  --------------------------------------------
 *  
 *  Filter Factory
 * 
 *  --------------------------------------------
 */

// import FilterFactory from './filter/FilterFactory.js'

// export default class FilterElementFactory {
    
//     static filterList = [];

//     element;
//     column;
//     trigger;

//     constructor(element, method, trigger = "change") {

//         this.element = element;
//         this.column = element.getAttribute('data-select-filter');
//         this.trigger = trigger;

//         this.setupFilterMethod(element, method, trigger)
//     }

//     setupFilterMethod(element, method, trigger) {

//         // Define Variable
//         let column = this.column;

//         // Push to Stack
//         FilterElementFactory.filterList.push(this);

//         // Define available methods
//         const allowedMethods = ['contain', 'strict'];

//         // Verify method
//         if (!allowedMethods.includes(method)) {
//             console.error(`Method [${method}] isn't allowed`);
//             return false;
//         }

//         // Pass to method factory
//         let bindFilter = new FilterFactory(element, method, column, trigger);
//         return;
//     }

//     /**
//      * @static
//      * @returns {Array}
//      */
//     static getAllFilter() {
//         return FilterElementFactory.filterList;
//     }

//     static filterOnLink(){
//         let allFilter = FilterElementFactory.getAllFilter();

//         allFilter.forEach(filter => {

//             let trigger = filter.trigger;
            
//             const event = new Event(trigger, {
//                 bubbles: true,
//                 cancelable: true,
//             });

//             let result = filter.element.dispatchEvent(event);
//         });
//     }
// }

/**
 * Filter & Data Connector
 */

// let name = findFilter('name');
// let nameFilter = new FilterElementFactory(name, 'contain', 'keyup');

// let category = findFilter('category');
// let categoryFilter = new FilterElementFactory(category, 'strict');

// let type = findFilter('type');
// let typeFilter = new FilterElementFactory(type, 'strict');

// let status = findFilter('status');
// let statusFilter = new FilterElementFactory(status, 'strict');

// const allFilters = FilterElementFactory.filterOnLink();
// console.log(allFilters);
