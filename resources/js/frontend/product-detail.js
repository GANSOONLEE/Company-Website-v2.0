
/** Init document */

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})

/** Form Valid */
// #region

$('.form').submit(function(event) {
    event.preventDefault();

    if (validateForm()) {
        this.submit();
    }else{
        setTimeout(()=>{
            tooltipList.forEach(tooltip => {
                tooltip.hide();
            });
        }, 3000)
    }
});

function validateForm(){
    
    // check are brand select
    let checkedRadio = $('input[type="radio"][name="brand"]:checked').length;
    if(!checkedRadio > 0){
        tooltipList[0].show()
        return false;
    }

    // check are quantity invalid
    let checkedQuantity = $('input[type="number"]')[0].value;
    if(checkedQuantity == 0){
        tooltipList[1].show()
        return false;
    }

    return true;

}

// #endregion


/**
 * Image Selector
 */

// #region


// #endregion

/** CLASS DEFINE */

/**
 *   @class Number Selector
 */

// #region

class NumberSelector{

    /**
     * @param {string} selectorID The id for selector
     */

    selectorID;

    // Initial Class
    constructor(selectorID){
        this.selectorID = selectorID;
    }

    // Static Method

    // Dynamic Method

    /**
     * @function init Init instance
     * @return {void}
     * 
     */

    init(){

        let removeButton = document.querySelector(`[data-text="${this.selectorID}"][data-button-type="remove"]`);
        let addButton = document.querySelector(`[data-text="${this.selectorID}"][data-button-type="add"]`);

        $(removeButton).click(()=>{
            this.modifierQuantity('remove');
        });
        $(addButton).click(()=>{
            this.modifierQuantity('add');
        });

    }

    modifierQuantity(method){

        // get text input
        let textInput = document.querySelector(`#${this.selectorID}`);
        
        // check logic
        let max = 100;
        let min = 0;
        let quantity = textInput.value;

        if(method == "add" && quantity >= 100){
            return false;
        }

        if(method == "remove" && quantity <= 0){
            return false;
        }

        switch (method)
        {

            case 'remove':
                textInput.value = parseInt(textInput.value) - 1;
                break;
            case 'add':
                textInput.value = parseInt(textInput.value) + 1;
                break;
            default:
                break;

        }

    }

}

let selector = new NumberSelector('quantity-input');
selector.init()

// #endregion


