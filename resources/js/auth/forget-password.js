
// Import Vue Components
import CustomAlert from '../backend/admin/components/CustomAlert.vue';
const alert = createApp(CustomAlert)
const alertInstance = alert.mount('#alert');


// Form Container change
let pageIndex = 0; // init page index
let pageCount = document.querySelectorAll('[data-index]').length; // get total page;

(() => {


    let nextContainerText = document.querySelectorAll('[data-click="next"]');
    nextContainerText.forEach(button => {
        button.addEventListener('click', e => {
            pageIndex++;
            if(pageIndex >= pageCount){
                return false
            }
            changeContainer(pageIndex);
        })
    })

})()

function changeContainer(pageIndex){
    let containers = document.querySelectorAll('[data-index]');
    containers.forEach(container => {
        container.style.display = "none";
    })
    containers[pageIndex].style.display = "block";
}

let sendEmail = document.querySelector('[data-secclick="send email"]')
sendEmail.addEventListener('click', e => {

    let email  = document.querySelector('[name="email"]').value;

    if(email == null || email == undefined || email == ''){
        alertInstance.updateMessage('Please enter your email address', 'warning');
        alertInstance.autoAlert();
        pageIndex = 1;
        changeContainer(pageIndex);
        return false;
    }

    let xhr = new XMLHttpRequest();
    xhr.open(
        'POST',
        '/auth/forget-password/send-email',
        true
    )

    // csrf token
    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            alertInstance.updateMessage(response.message, response.icon);
            alertInstance.autoAlert();
        }else{
            console.error(JSON.parse(xhr.responseText))
        }
    };
    
    let formData = new FormData();
    formData.append("email", email);

    xhr.send(formData);

});