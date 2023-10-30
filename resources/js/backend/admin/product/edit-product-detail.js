
// Import Vue Components

import BootstrapModal from '../components/BootstrapModal.vue';

app.component('bootstrap-modal', BootstrapModal);
let vm = app.mount('#modal');

// Delete Button Listener

let dataSlot;
let deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(deleteButton => {
    deleteButton.addEventListener('click', (event)=>{
        event.preventDefault();
        let closestInput = event.target.closest('.box-list').querySelector('input[type="file"]');
        dataSlot = closestInput.getAttribute('data-slot');
    })
});

let deleteImageButton = document.querySelector('#deleteImageButton');
deleteImageButton.addEventListener('click', ()=>{
    let slotImage = document.querySelector(`[data-slot="${dataSlot}"]`);
    let image = slotImage.closest('.box-list').querySelector('img');
    deleteImageAPI(image.src)
    image.src = "";
})

/**
 * Thumbnails
 */

let imageInputs = document.querySelectorAll('.product-image');

imageInputs.forEach((input) => {
    console.log(input)
    input.addEventListener('change', function (event) {
        let file = event.target.files[0];
        console.log(file)
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
    console.log(input)
    input.addEventListener('change', function (event) {
        let file = event.target.files[0];
        console.log(file)
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

function deleteImageAPI(imageSrc){

    $.ajax({
        url: '/admin/product/image-delete-api',
        data: {'src' : imageSrc},
        dataType: 'json',
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success(response){
            console.info(response)
        },
        error(){
            console.error('Error')
        }
    })

}