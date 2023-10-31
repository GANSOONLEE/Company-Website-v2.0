
// Import Vue Components

import BootstrapModal from '../components/BootstrapModal.vue';

app.component('bootstrap-modal', BootstrapModal);
app.mount('#modal');

import CustomAlert from '../components/CustomAlert.vue';

const alert = createApp(CustomAlert);
const vm = alert.mount('#alert')

// Delete Button Listener

    // Website Current Url
    let currentURL = window.location.href;
    var parts = currentURL.split('/');
    let product_code = parts[parts.length - 1];

let dataSlot;
let deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener('click', (event)=>{
        event.preventDefault();
        let closestInput = event.target.closest('.box-list').querySelector('input[type="file"]');
        dataSlot = closestInput.getAttribute('data-slot');
    })
});


let ImageUploadCollection = document.querySelectorAll('input[type="file"]');
ImageUploadCollection.forEach(ImageUpload => {
    ImageUpload.addEventListener('click', (event)=>{    
        let imageClosest = event.target.closest('.box-list').querySelector('img');
        if(imageClosest.src !== currentURL){
            event.preventDefault();
            vm.updateMessage('You must delete the image first !', 'error');
            vm.autoAlert();
        }
    })
});

let deleteImageButton = document.querySelector('#deleteImageButton');
deleteImageButton.addEventListener('click', ()=>{
    let slotImage = document.querySelector(`[data-slot="${dataSlot}"]`);
    let image = slotImage.closest('.box-list').querySelector('img');
    let imageSrc = image.src;
    let fileName = imageSrc.match(/\/([^/]+)$/)[1];
    image.src = "";
    deleteImageAPI(fileName, product_code)
})

/**
 * Thumbnails
 */

let imageInputs = document.querySelectorAll('.product-image');

imageInputs.forEach((input) => {
    input.addEventListener('change', function (event) {
        let file = event.target.files[0];
        let previewImage = event.target.nextElementSibling.querySelector('.image-preview');

        if (file) {
            let reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
        }
    });
});

let brandInputs = document.querySelectorAll('.brand-image');

brandInputs.forEach((input) => {
    input.addEventListener('change', function (event) {
        let file = event.target.files[0];
        let previewImage = event.target.nextElementSibling.querySelector('.brand-preview');

        if (file) {
            let reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
        }
    });
});


/**
 * API Delete Image
 * 
 */

function deleteImageAPI(imageSrc ,product_code){

    $.ajax({
        url: '/admin/product/image-delete-api',
        data: {'imageName' : imageSrc, 'product_code' : product_code},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success(response){
            console.info(response)
            vm.updateMessage('Success delete Image', 'success');
            vm.autoAlert();
        },
        error(){
            console.error('Error')
        }
    })

}

// form
const form = document.querySelector('form');

form.addEventListener('submit', (event)=>{

    event.preventDefault();

    vm.updateMessage('Success Edit !', 'success')
    vm.autoAlert();

    setTimeout(()=>{
        form.submit();
    }, 1700)

})