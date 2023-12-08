
// Vue Components Import

import CustomAlert from '../components/CustomAlert.vue';
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert');

// Function

$('#brand-cover').on('change', function() {
    var file = this.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.brand-cover-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

// Build Async Request

let brandCover = document.querySelector('#brand-cover');

let form = document.querySelector('form');
form.addEventListener('submit',(event)=>{
    event.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open(
        'POST',
        form.action,
        true
    )

    // csrf token
    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            down()
            alertInstance.updateMessage(response.status, response.icon);
            alertInstance.autoAlert();
        }
    };

    let brandName = document.querySelector('[name="brand-name"]').value;
    
    // build data
    let formData = new FormData(form);
    formData.append("brand-cover", brandCover.files[0]);
    formData.append("brand-name", brandName);

    xhr.send(formData);

})

function down(){
    document.querySelectorAll('input[type=text]').forEach(element => {
        element.value = "";
    });
    document.querySelector('img.brand-cover-preview').src = "";
}

/* ------------------------------ Drag & Drop ------------------------------ */

// category-cover => upload-button
// image-display => image-display
// container => container

let uploadButton = document.querySelector('#brand-cover');
let imageDisplay = document.querySelector('#image-display');
let img = document.querySelector('#brand-cover-preview');
let error = document.querySelector('#error');
let container = document.querySelector('.container-custom');

const fileHandle = (file, name, type) => {

    if (type.split("/")[0] !== "image"){
        // File Type Error
        error.innerText = "Please upload an image file";
        return false;
    }

    error.innerText = "";
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = () => {
        img.src = reader.result;
    }
}

uploadButton.addEventListener('change', () => {
    Array.from(uploadButton.files).forEach(file => {
        fileHandle(file, file.name, file.type)
    });
})

container.addEventListener(
    'dragenter',
    e => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.add("active");
    },
    false
)

container.addEventListener(
    'dragleave',
    e => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.remove("active");
    },
    false
)

container.addEventListener(
    'dragover',
    e => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.add("active");
    },
    false
)

container.addEventListener(
    'drop',
    e => {
        e.preventDefault();

        e.stopPropagation();
        container.classList.remove("active");
        let draggedData = e.dataTransfer;
        let files = draggedData.files;
        Array.from(files).forEach(file => {
            fileHandle(file, file.name, file.type)
        })

        brandCover.files = files;
    },
    false
)

window.onload = () => {
    error.innerText = "";
};