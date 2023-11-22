
import { createApp } from 'vue';
import BootstrapAlert from '../components/BootstrapAlert.vue';

// 创建一个全局的 Vue 应用实例
const alert = createApp(BootstrapAlert);
const vm = alert.mount('#alert');
console.log(vm)
/**
 * @example call method update message
 * vm.updateMessage(THE_MESSAGE_YOU_WANT_DISPLAY)
 */


/**
 * Verify before submit
 * 
 */

// #region
const form = document.querySelector('#form');

form.addEventListener('submit', function(event){
    
    event.preventDefault();

    let validationResult = validateForm();

    if(!validationResult.valid){
        vm.updateMessage(validationResult.message)
        vm.showAlert();
        $('#alert').css('display', 'block')
        return false;
    }

    vm.updateMessage('Success Post !')
    vm.showAlert();
    $('#alert').css('display', 'block')

    setTimeout(()=>{
        form.submit();
    }, 3000)

   
})

function validateForm(){

    // check cover
    let cover = document.querySelector('#product-cover');
    if(!cover){
        return {valid: false, message: "Please upload the product cover!"}
    }

    // check cover file type
    const allowedExtensions = [".jpg", ".png", ".jpeg"];
    let fileType = cover.files[0].name.toLowerCase();
    if(!allowedExtensions.some(ext=> fileType.endsWith(ext))){
        return {valid: false, message: "Wrong Extensions! Support .png, .jpg, .jpeg only!"}
    }

    // check dropdown list have be selected
    let brandList = document.querySelector('#brand-0')
    let categoryList = document.querySelector('[name="product-category"]')

    if(!(
        categoryList.value !== "Default" &&
        brandList.value !== "Default"
        )){
        return {valid: false, message: "Please choose category or type"};
    }

    return {valid: true, message: ""};
}

// #endregion

/**
 * Add Name Input
 */

// #region

let nameIndex = 0;

let addNameInputButton = document.querySelector('#add-name-input');
addNameInputButton.addEventListener('click', (event)=>{
    if(nameIndex>=10){
        return false;
    }

    nameIndex>=10? false: '';

    let list = $('.another-name-box');
    list.eq(nameIndex).css('display', 'flex');
    nameIndex++;
})

// #endregion

/**
 * Add Brand Input
 */

// #region

let brandIndex = 0;

let addBrandInputButton = document.querySelector('#add-brand-input');
addBrandInputButton.addEventListener('click', (event)=>{
    if(brandIndex>=10){
        brandIndex = 0;
        return false;
    }

    let list = $('.another-brand-box');
    list.eq(brandIndex).css('display', 'flex');
    brandIndex++;
})

/**
 * Hide Brand Input
 */

let deleteBrandInputButton = document.querySelectorAll('#delete-brand-input')
deleteBrandInputButton.forEach(button => {
    button.addEventListener('click', (event) => {
        let list = $(event.target).closest('.another-brand-box');
        list.css('display', 'none');
    });
})
// #endregion


/**
 * Thumbnail preview
 */

$('input[type="file"]').change(function () {
    const fileInput = this;
    const thumbnail = $(this).closest('div').find('img.thumbnail');
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            // Set the src attribute of the nearest img element to display the thumbnail
            thumbnail.attr('src', e.target.result);
            thumbnail.css('display', 'block');
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
});