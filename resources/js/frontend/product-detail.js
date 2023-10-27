
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
 * @class Number Selector
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


/**
 * @class Image Selector
 */

class ImageSelector{

    selectorID;
    container;

    /**
     * 
     * @param {string} selectorID 
     */

    constructor(selectorID){
        this.selectorID = selectorID;
    }

    init(){
        
        let imagePreview = $(`#${this.selectorID}`); 

        // Button
        let prevButton = imagePreview.find('[data-button="prev"]');
        let nextButton = imagePreview.find('[data-button="next"]');

        prevButton.click(()=>{
            this.moveContainer('prev')                
        })
        nextButton.click(()=>{
            this.moveContainer('next')            
        })

        // Container
        this.container = imagePreview.find(`[data-item="${this.selectorID}"]`)

        // Image
        let images = document.querySelectorAll(`img[data-item="${this.selectorID}"]`);
        images.forEach(image => {
            image.addEventListener('mouseenter',()=>{
                this.imagePreview(image.src)
            })
            image.addEventListener('dblclick',()=>{
                this.imageZoom(image.src)

            })
        });

    }

    moveContainer(mode){

        let container = this.container; 
        let containerWidth = container.width();

        switch(mode){

            case 'prev':
                let scrollX = container.scrollLeft() - containerWidth / 2;
                container.animate({ scrollLeft: scrollX }, 220);
                break;

            case 'next':
                let scrollXNext = container.scrollLeft() + containerWidth / 2;
                container.animate({ scrollLeft: scrollXNext }, 220);
                break;

            default:
                break;

        }

    }

    imagePreview(imgSrc){
        imagePreviewContainer[0].querySelector('img').src = imgSrc;
    }

    imageZoom(imgSrc){

        zoom.css('display', 'flex');
        
        zoom.click(function(){
            zoom.hide()
        })

        let imageZoom =$('#zoom-preview');
        imageZoom.click(function(event){
            event.stopPropagation();
        })
        imageZoom.dblclick(function(event){
            event.stopPropagation();
        })

        imageZoom.attr('src', imgSrc);

    }

}

let zoom = $('div.zoom-preview');
let imagePreview = new ImageSelector('image-selector');
let imagePreviewContainer = $(`#image-selector`);
imagePreview.init();

/**
 * Brand Image
 */

let brands = document.querySelectorAll('.brand-label');
brands.forEach(brand => {

    brand.addEventListener('click',function(){
        let src = brand.querySelector('input').value
        if (src.includes('#')) {
            src = encodeURIComponent(src);
        }

        let category = brand.querySelector('input').getAttribute('data-category')
        let code = brand.querySelector('input').getAttribute('data-product')

        let relation = `/storage/product/${category}/${code}/${src}/cover.png`;

        var req = new XMLHttpRequest();
        req.open('GET', relation, false);
        req.send();
        console.log(req.status)
        if(req.status === 200){
            imagePreviewContainer[0].querySelector('img').src = relation;
        }else{
            imagePreviewContainer[0].querySelector('img').src = `/storage/product/placeholder.png`;
        }
    })
})