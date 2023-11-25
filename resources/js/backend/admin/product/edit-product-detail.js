
// Import Vue Component

import CustomAlert from '../components/CustomAlert.vue'
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert')

/* ------------------------ Image Render ------------------------ */
window.onload = () => {
    let cookies = document.cookie.split(';');
    let sessionData;
    cookies.forEach(cookie => {
        const [name, value] = cookie.trim().split('=');
        if (name === 'sessionData') {
            sessionData = JSON.parse(value);
            if (sessionData.status === "successful"){
                alertInstance.updateMessage(sessionData.message, 'success');
            }else{
                alertInstance.updateMessage(sessionData.message, 'error');
            }
            alertInstance.autoAlert();
        }
    });

    updateImageCount();
}

/* ------------------------ Image Render ------------------------ */

const uploadImages = document.querySelectorAll('input[type="file"]');
uploadImages.forEach(image => {

    image.addEventListener('change', e => {
        // get render windows
        const imageRenderWindow = document.querySelector(`img[data-preview-media=${image.name}]`);

        // get icon
        const icon = imageRenderWindow.parentElement.querySelector('i');

        // get name container
        const nameContainer = imageRenderWindow.parentElement.parentElement.querySelector(`[data-image-name="${image.name}"]`);

        const file = e.target.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (e) => {
            icon.hidden = true;
            imageRenderWindow.hidden = false;
            imageRenderWindow.src = e.target.result;
            updateImageCount();

            nameContainer.innerText = file.name;
        }
    })

})

function updateImageCount() {
    const images = document.querySelectorAll('img.product-image[data-preview-media]:not([hidden])');
    const imageCount = images.length;
    document.querySelector('#product-image-uploaded-count').innerHTML = imageCount;
}

const deleteButton = document.querySelectorAll('.delete-button');
deleteButton.forEach(button => {
    button.addEventListener('click', e => {

        const image = button.parentElement.querySelector('img[data-preview-media]');
        const uploadInput = button.parentElement.querySelector('input[type="file"]');
        const icon = button.parentElement.querySelector('i.upload-icon');
        const nameContainer = button.parentElement.parentElement.querySelector(`[data-image-name]`);

        image.src = '';
        image.hidden = true;
        nameContainer.innerText = '';
        icon.hidden = false;
        uploadInput.value = '';

        updateImageCount();
    })
})

/* ------------------------ Name Input ------------------------ */

const productNameInputs= document.querySelectorAll('.product-name-container[data-index]');
productNameInputs.forEach((input, index) => {

    if(index == 0){
        return;
    }

    // input.hidden = true;
});

let addNameInputButton = document.querySelector('#product-name-input-add-button');
addNameInputButton.addEventListener('click', () => {
    const productNameInputs = document.querySelectorAll('.product-name-container');
    const productNameInputCount = document.querySelectorAll('.product-name-container:not([hidden])');

    if(productNameInputCount.length >= productNameInputs.length){
        alertInstance.updateMessage('Maximum input 10 name only!', 'warning');
        alertInstance.autoAlert();
        return false;
    }

    productNameInputs[productNameInputCount.length].hidden = false;
})

let deleteNameInputButtons = document.querySelectorAll('#product-name-input-delete-button');
deleteNameInputButtons.forEach(deleteNameInputButton => {
    deleteNameInputButton.addEventListener('click', () => {
        const productNameInputs = document.querySelectorAll('.product-name-container');
        const productNameInputCount = document.querySelectorAll('.product-name-container:not([hidden])');
    
        if(productNameInputCount.length > productNameInputs.length){
            return;
        }
    
        productNameInputs[productNameInputCount.length-1].hidden = true;
    })
});

/* ------------------------ Brand Input ------------------------ */

const productBrandInputs= document.querySelectorAll('.product-brand-container[data-index]');
productBrandInputs.forEach((input, index) => {

    if(index == 0){
        return;
    }

    // input.hidden = true;

});

let addBrandInputButton = document.querySelector('#product-brand-input-add-button');
addBrandInputButton.addEventListener('click', () => {
    const productBrandInputs = document.querySelectorAll('.product-brand-container');
    const productBrandInputCount = document.querySelectorAll('.product-brand-container:not([hidden])');

    if(productBrandInputCount.length >= productBrandInputs.length){
        alertInstance.updateMessage('Maximum input 10 brand only!', 'warning');
        alertInstance.autoAlert();
        return false;
    }

    productBrandInputs[productBrandInputCount.length].hidden = false;
})

let deleteBrandInputButtons = document.querySelectorAll('#product-brand-input-delete-button');
deleteBrandInputButtons.forEach(deleteBrandInputButton => {
    deleteBrandInputButton.addEventListener('click', () => {
        const productBrandInputs = document.querySelectorAll('.product-brand-container');
        const productBrandInputCount = document.querySelectorAll('.product-brand-container:not([hidden])');
    
        if(productBrandInputCount.length > productBrandInputs.length){
            return;
        }
    
        productBrandInputs[productBrandInputCount.length-1].hidden = true;
    })
});
