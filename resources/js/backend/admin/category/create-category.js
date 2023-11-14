
// Vue Components Import

import CustomAlert from '../components/CustomAlert.vue';
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert');

// Function

$('#category-cover').on('change', function() {
    var file = this.files[0];

    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.category-cover-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(file);
    }
});

let form = document.querySelector('form#form');
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
    formData.append("category-cover", categoryCover)

    xhr.send(formData);

})

function down(){
    document.querySelectorAll('input[type=text]').forEach(element => {
        element.value = "";
    });
    document.querySelectorAll('img').forEach(element => {
        element.src = "";
    });
}