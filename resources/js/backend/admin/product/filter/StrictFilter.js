
export default class StrictFilterFactory{

    constructor(value, column){
        return this.searchResult(value, column);
    }

    /**
     * @function Array
     * @param {String} value
     * @param {DOMElement} column
     * @returns {Array}
     */

    searchResult(value, column){

        let resultFiltered = [];
        let resultAll = document.querySelectorAll(`[data-search-column="${column}"]`)

        // Check have filter
        if(value === "All"){
            resultAll.forEach(result => {
                result.parentNode.style.display = 'table-row';
            });
            return;
        }

        resultAll.forEach(result => {
            if(result.innerHTML === value){
                resultFiltered.push(result);
                result.parentNode.style.display = 'table-row';
            }else{
                result.parentNode.style.display = 'none';
            }

        });

        return resultFiltered;

    }

}

