
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
 *  --------------------------------------------
 *  
 *  Filter Factory
 * 
 *  --------------------------------------------
 */

import FilterFactory from './filter/FilterFactory.js'

export default class FilterElementFactory {
    
    static filterList = [];

    element;
    column;
    trigger;

    constructor(element, method, trigger = "change") {

        this.element = element;
        this.column = element.getAttribute('data-select-filter');
        this.trigger = trigger;

        this.setupFilterMethod(element, method, trigger)
    }

    setupFilterMethod(element, method, trigger) {

        // Define Variable
        let column = this.column;

        // Push to Stack
        FilterElementFactory.filterList.push(this);

        // Define available methods
        const allowedMethods = ['contain', 'strict'];

        // Verify method
        if (!allowedMethods.includes(method)) {
            console.error(`Method [${method}] isn't allowed`);
            return false;
        }

        // Pass to method factory
        let bindFilter = new FilterFactory(element, method, column, trigger);
        return;
    }

    /**
     * @static
     * @returns {Array}
     */
    static getAllFilter() {
        return FilterElementFactory.filterList;
    }

    static filterOnLink(){
        let allFilter = FilterElementFactory.getAllFilter();

        allFilter.forEach(filter => {

            let trigger = filter.trigger;
            
            const event = new Event(trigger, {
                bubbles: true,
                cancelable: true,
            });

            let result = filter.element.dispatchEvent(event);
        });
    }
}

/**
 * Filter & Data Connector
 */

let name = findFilter('name');
let nameFilter = new FilterElementFactory(name, 'contain', 'keyup');

let category = findFilter('category');
let categoryFilter = new FilterElementFactory(category, 'strict');

let type = findFilter('type');
let typeFilter = new FilterElementFactory(type, 'strict');

let status = findFilter('status');
let statusFilter = new FilterElementFactory(status, 'strict');

const allFilters = FilterElementFactory.filterOnLink();
console.log(allFilters);
