
// Vue Components Import

import CustomAlert from '../admin/components/CustomAlert.vue';
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert');

// Function

window.onload = () => 
{
    resetInput();
}

let disabledElements = document.querySelectorAll('[disabled]:not([read-only])');
function resetInput(){
    let editButton = document.querySelector('[data-button-action="edit"]');
    editButton.addEventListener('click', ()=>{
        disabledElements.forEach(disabledElement => {
            disabledElement.disabled = false;
        });
    })
}

// Form Submit
let form = document.querySelector('form');
form.addEventListener("submit", (event)=>{
    event.preventDefault();
    
    let xhr = new XMLHttpRequest();
    xhr.open(
        'POST',
        form.action,
        true
    );
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // csrf token
    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            disabledElements.forEach(disabledElement=>{
                disabledElement.disabled = true;
            })
            alertInstance.updateMessage(response.status, response.icon);
            alertInstance.autoAlert();
        }
    };

    xhr.send(new URLSearchParams(new FormData(form)));
})