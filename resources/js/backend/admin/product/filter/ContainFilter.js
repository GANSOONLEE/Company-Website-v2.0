
export default class ContainFilter{

    constructor(value, column){
        this.searchResult(value, column);
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
        if(value === ""){
            resultAll.forEach(result => {
                result.parentNode.style.display = 'table-row';
            });
            return;
        }

        resultAll.forEach(result => {
            if(result.innerHTML.includes(value.toUpperCase())){
                resultFiltered.push(result);
                result.parentNode.style.display = 'table-row';
            }else{
                result.parentNode.style.display = 'none';
            }

        });

        return resultFiltered;

    }

}

