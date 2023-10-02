
/**
 *  @param {string} searchFilter The filter input
 *  @param {string} searchColumn The result you want search in which column
 */

class Filter{

    /**
     * @param
     */

    element

    constructor(element){
        this.element = element;
    }

    init(){

        let ident = this.element.getAttribute('data-select-filter');
        let searchColumns = document.querySelectorAll(`[data-search-column=${ident}]`) 

        this.element.addEventListener('change', ()=>{
            this.addBindEvent(searchColumns);
        })

        this.element.addEventListener('keyup', ()=>{
            this.addBindEvent(searchColumns);
        })
    }

    addBindEvent(searchColumns){
        
        let index = this.element.selectedIndex;
        let text;
        try{
            text = this.element.options[index].text;
        }catch{
            text = this.element.value;
        }
       
        
        searchColumns.forEach(searchColumn=>{
            
            console.log(searchColumn.innerText)
            console.log(text)

            if(text == "All"){
                searchColumn.parentNode.style.display = 'table-row';
            }else if(text == ''){
                searchColumn.parentNode.style.display = 'table-row';
            }else if(searchColumn.innerHTML == text){
                searchColumn.parentNode.style.display = 'table-row';
            }else if(searchColumn.innerHTML !== text){
                searchColumn.parentNode.style.display = 'none';
            }
        })

    }

}

let filters = document.querySelectorAll('[data-select-filter]');
filters.forEach(filter => {
    let instance = new Filter(filter)
    instance.init();
});