
// Vue Components Import

import CustomAlert from '../admin/components/CustomAlert.vue';
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert');

// Function

window.onload = () => 
{
    let notification;
    let localS = localStorage.getItem(notification)
    if(localS != null){
        localStorage.clear(notification);
        alertInstance.updateMessage('Successful save', 'success');
        alertInstance.autoAlert();
    }
    
    let editButton = document.querySelector('[data-button-action="edit"]');
    editButton.addEventListener('click', ()=>{
        let disabledElements = document.querySelectorAll('[disabled]:not([read-only])');
        disabledElements.forEach(disabledElement => {
            disabledElement.disabled = false;
        });
    })

    let form = document.querySelector('form');
    form.addEventListener("submit", ()=>{
        localStorage.setItem(notification, 'save')
    })
}