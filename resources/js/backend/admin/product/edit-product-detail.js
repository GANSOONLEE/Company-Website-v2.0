
// Import Vue Component

import CustomAlert from '../components/CustomAlert.vue'
import { createApp } from 'vue'
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert')

function showMessage(message, icon = 'info') {
    alertInstance.updateMessage(message, icon)
    alertInstance.autoAlert(7);
}

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

        let brandCode = button.parentElement.parentElement.parentElement.querySelector('input[data-column="brand-code"]')
        let brand_code = "";
        let type = "";

        if(brandCode){
            brand_code = brandCode.value;
            type = "brand";
        }else{
            brand_code = '';
            type = "product";
        }

        let path = window.location.pathname;
        let pathSegments = path.split('/');
        let lastSegment = pathSegments[pathSegments.length - 1];

        let data = {
            imageName: nameContainer.innerText,
            product_code: lastSegment,
            brand_code: brand_code,
            type: type
        }

        image.src = '';
        image.hidden = true;
        nameContainer.innerText = '';
        icon.hidden = false;
        uploadInput.value = '';

        updateImageCount();


        $.ajax({
            url:'/admin/product/image-delete-api',
            method: "POST",
            dataType: 'json',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status == true) {
                    showMessage(response.message, 'success')
                    console.info(response.name)
                    console.info(response.path)
                }else{
                    showMessage(response.message, 'error')
                    console.error(response.file);
                    console.error(response.line);
                    console.error(response.error);
                }
                return;
            },
            error: function (response) {
                console.error(response)
                showMessage('Something happened', 'warning')
            }
        })

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
        productNameInputs[productNameInputCount.length-1].querySelectorAll('input').forEach(input => {
            input.value = '';
        })
    })
});

/* ------------------------ Brand Input ------------------------ */

const productBrandInputs= document.querySelectorAll('.product-brand-container[data-index]');
productBrandInputs.forEach((input, index) => {

    // input.hidden = true;
    input.addEventListener('keyup', e => {

        let context = input.querySelector(`#product-brand-code-${index}`).value;
        let warning = input.querySelector('.warning');

        let array = ['\\', '/', ':', '*', '?', '"', '<', '>', '|'];
        let matches = array.filter(char => context.includes(char));

        if (matches.length > 0) {
            warning.style.display = 'block';
            input.querySelector('#matchedText').innerText = matches.join(', ');
        }else{
            warning.style.display = 'none';
        }

    })
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
        productBrandInputs[productBrandInputCount.length-1].querySelectorAll('input[type="text"]').forEach(input => {
            input.value = '';
        })

        let elements = productBrandInputs[productBrandInputCount.length-1].querySelectorAll('option');
        for(let i = 0; i < elements.length; i++){
            elements[i].selected = false;
        }

        productBrandInputs[productBrandInputCount.length-1].querySelector('input[type="file"]').value = '';
        productBrandInputs[productBrandInputCount.length-1].querySelector('img').src = '';
        productBrandInputs[productBrandInputCount.length-1].querySelector('img').hidden = true;
        productBrandInputs[productBrandInputCount.length-1].querySelector('i.upload-icon').hidden = false;
        productBrandInputs[productBrandInputCount.length-1].querySelector('[data-image-name]').innerText = '';
    })
});

// form valid

const form = document.querySelector('form');
form.addEventListener('submit', e => {
    e.preventDefault();

    let valid = false;
    let matchesArray = [];

    let array = ['\\', '/', ':', '*', '?', '"', '<', '>', '|'];
    productBrandInputs.forEach((productBrandInput, index) => {

        let context = productBrandInput.querySelector(`#product-brand-code-${index}`).value;
        let matches = array.filter(char => context.includes(char));
        let warningText = productBrandInput.querySelector('.warning').innerText;

        if (matches.length > 0) {
            alertInstance.updateMessage(warningText, 'warning');
            alertInstance.autoAlert(5);
            valid = false;
        }else if(matches.length === 0){
            valid = true;
        }

        return matchesArray.push(valid);
    
    })

    let isValid = false;
    let checkValid = matchesArray.includes(false);
    isValid = checkValid ? false : true;

    isValid ? form.submit() : '';

})