
// -------------------- Image Render -------------------- //

let uploadImageInput = document.querySelector('[type="file"]');
uploadImageInput.addEventListener('change', e =>{
    
    const imageRenderWindow = document.querySelector('.image-preview');
    const tips = imageRenderWindow.parentElement.querySelector('.tips');

    const file = e.target.files[0];
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = (e) => {
        imageRenderWindow.hidden = false;
        imageRenderWindow.src = e.target.result;
        tips.hidden = true;
    }

})


// Import Vue Component

import {createApp} from 'vue';
import CustomAlert from './components/CustomAlert.vue'
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert')

/* ------------------------ detect Cookie ------------------------ */
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
            alertInstance.autoAlert(10);
        }
    });
}
