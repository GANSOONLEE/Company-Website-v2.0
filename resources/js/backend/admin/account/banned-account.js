
// Vue Component

import CustomAlert from '../components/CustomAlert.vue';

const alert = createApp(CustomAlert);
const alertInstance = alert.mount("#alert")

// Function

let gotoButton = document.querySelector('#gotoButton');
gotoButton.addEventListener('click', ()=>{

    // Get Current Url
    let currentUrl = window.location.href;

    // Get Range
    let pageIndexInput = document.querySelector('input[type=number]') 
    const min = parseInt(pageIndexInput.getAttribute('min'));
    const max = parseInt(pageIndexInput.getAttribute('max'));

    let currentPage = parseInt(pageIndexInput.value);
    if(!currentPage){
        window.location.href = currentUrl
        return false;
    }

    // Verify data validation
    if(currentPage == null || currentPage == ''){
        alertInstance.updateMessage('Please input a number!', 'error')
        alertInstance.autoAlert();
        return false;
    }

    if(min > currentPage || currentPage > max){
        alertInstance.updateMessage(`Your page <b>must between</b> ${min} and ${max}!<br>You value ${currentPage}`, 'error')
        alertInstance.autoAlert();
        return false;
    }

    let url = new URL(currentUrl);
    url.searchParams.set('pageIndex', currentPage);
    window.location.href = url.toString();
})


const BannedButtons = document.querySelectorAll('#banned-button');
const UnbannedButtons = document.querySelectorAll('#unbanned-button');

BannedButtons.forEach(button => {
    button.addEventListener('click', (event)=>{

        let email = event.target.getAttribute('data-email');
        const request = new AjaxRequest;
        request.sendData(email, 'banned');

    })
});


UnbannedButtons.forEach(button => {
    button.addEventListener('click', (event)=>{

        let email = event.target.getAttribute('data-email');
        const request = new AjaxRequest;
        request.sendData(email, 'unbanned');

    })
});

class AjaxRequest{

    constructor(){
        
    }

    sendData(email, method){
        $.ajax({
            url: "/admin/account/banned-unbanned-account",
            method: "PUT",
            data: { email: email, method: method },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                location.reload();
            },
            error: function (response) {
                console.error(response);
                console.error("Something error");
            }
        })
    }

}