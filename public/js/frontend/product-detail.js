

// Pusher
// var pusher = new Pusher("a018306a14faf67a1d14", {
//     channelAuthorization:{
//         endpoint: "/pusher/auth",
//         headers: { "X-CSRF-Token":  $('meta[name="csrf-token"]').attr('content') },
//     },
//     cluster: "ap1",
// });

// var privateChannel = pusher.subscribe("private-product-detail-channel");
// privateChannel.bind('App\\Events\\TestMessageSend', (data) => {
//     console.log(data)
//     document.querySelector('#notification-total-cart').innerText = data.total_cart;
//     document.querySelector('form').reset();
// });

/** Init document */

// let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
// let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//   return new bootstrap.Tooltip(tooltipTriggerEl)
// })

/** Form Valid */
// #region

let form = document.querySelector('form.form#post-form');

form.addEventListener('submit', e => {
    e.preventDefault();

    if (!validateForm()) {
        return false;
    }

    let brandSelector = document.querySelector('input:checked').value;
    let numberInput = document.querySelector('input[type=number]').value;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', form.action, true);

    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                let data = JSON.parse(xhr.responseText);
                document.querySelector('#notification-total-cart').innerText = data.count;
                document.querySelector('form#post-form').reset();
                console.info(data);
            } else {
                console.error(xhr.status);
            }
        }
    };

    let formData = new FormData();
    formData.append('brand', brandSelector);
    formData.append('quantity', numberInput);
    formData.append('_method', 'POST');

    xhr.send(formData);

});

function validateForm(){
    
    // check are brand select
    let checkedRadio = $('input[type="radio"][name="brand"]:checked').length;
    if(!checkedRadio > 0){
        // tooltipList[0].show()
        return false;
    }

    // check are quantity invalid
    let checkedQuantity = $('input[type="number"]')[0].value;
    if(checkedQuantity == 0){
        // tooltipList[1].show()
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
                document.querySelectorAll('#quantity').forEach(element => {
                    element.value = textInput.value;
                })
                break;
            case 'add':
                textInput.value = parseInt(textInput.value) + 1;
                document.querySelectorAll('#quantity').forEach(element => {
                    element.value = textInput.value;
                })
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
        
        let imagePreview = document.querySelector('#' + this.selectorID);

        // Button
        // let prevButton = imagePreview.querySelector('[data-button="prev"]');
        // let nextButton = imagePreview.querySelector('[data-button="next"]');

        // prevButton.addEventListener('click', e => {
        //     this.moveContainer('prev')                
        // })
        // nextButton.addEventListener('click', e => {
        //     this.moveContainer('next')            
        // })

        // Container
        this.container = imagePreview.querySelector(`[data-item="${this.selectorID}"]`)

        // Image
        let images = document.querySelectorAll(`div[data-item="${this.selectorID}"]`);

        images.forEach(image => {
            image.addEventListener('mouseenter',()=>{
                this.imagePreview(image.querySelector('.item-image').src)
            })
            image.addEventListener('dblclick',()=>{
                this.imageZoom(image.querySelector('.item-image').src)
            })
        });

    }

    imagePreview(imgSrc){
        document.querySelector('[data-preview="image-selector"]').src = imgSrc;
    }

    imageZoom(imgSrc){

        zoom.style.display = 'flex';

        zoom.addEventListener('click', e => {
            zoom.style.display = 'none';
        });

        let imageZoom = document.querySelector('#zoom-preview');

        modal.addEventListener('click', e => {
            e.stopPropagation();
        })

        imageZoom.click(function(event){
            event.stopPropagation();
        })
        imageZoom.dblclick(function(event){
            event.stopPropagation();
        })

        imageZoom.setAttribute('src', imgSrc);

    }

}

function moveContainer(mode) {

    let container = imageSelector.querySelector('.image-selector'); 
    let containerWidth = container.clientWidth;

    console.info(mode);
    console.info(container);
    console.info(containerWidth);

    switch(mode){

        case 'prev':
            let scrollXPrev = container.scrollLeft - containerWidth / 2;
            // container.animate({ scrollLeft: scrollXPrev }, 220);
            container.scroll(({
                top: 0,
                left: scrollXPrev,
                behavior: "smooth",
            }))
            console.info(scrollXPrev);
            break;

        case 'next':
            let scrollXNext = container.scrollLeft + containerWidth / 2;
            // container.animate({ scrollLeft: scrollXNext }, 220);
            container.scroll(({
                top: 0,
                left: scrollXNext,
                behavior: "smooth",
            }))
            console.info(scrollXNext);
            break;

        default:
            break;

        }
        
    console.info(scrollX);
    console.info(container.scrollLeft);
}

let zoom = document.querySelector('div.zoom-preview');
let modal = document.querySelector('#popupModal');
let imagePreview = new ImageSelector('image-selector');
let imagePreviewContainer = document.querySelector(`#image-selector`);
imagePreview.init();

// Setup Prev and Next Button
let imageSelector = document.querySelector('.image-selector-container');
let selectorPrevButton = imageSelector.querySelector('.prev-button');
let selectorNextButton = imageSelector.querySelector('.next-button');

selectorPrevButton.addEventListener('click', e => {
    moveContainer('prev')                
})
selectorNextButton.addEventListener('click', e => {
    moveContainer('next')            
})

/**
 * Brand Image
 */

let brands = document.querySelectorAll('.brand-label');
brands.forEach(brand => {

    brand.addEventListener('click',function(){
        let name = brand.querySelector('input').value
        document.querySelectorAll('#brand').forEach(element => {
            element.value = name;
        })

        if (name.includes('#')) {
            src = encodeURIComponent(name);
        }
        
        let relation = '/' + brand.getAttribute('data-image');

        var req = new XMLHttpRequest();
        req.open('GET', relation, false);
        req.send();
        if(req.status === 200){
            document.querySelector('[data-preview="image-selector"]').src = relation;
        }else{
            document.querySelector('[data-preview="image-selector"]').src = `/storage/product/placeholder.png`;
        }
    })
})