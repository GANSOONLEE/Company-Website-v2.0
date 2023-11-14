
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

let form = document.querySelector('form');
console.log(form);
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

    // get media picture
    let categoryCover = document.querySelector('#category-cover');

    // build data
    let formData = new FormData(form);
    formData.append("brand-cover", categoryCover)

    xhr.send(formData);

})

function down(){
    document.querySelectorAll('input[type=text]').forEach(element => {
        element.value = "";
    });
    document.querySelector('img.brand-cover-preview').src = "";
}