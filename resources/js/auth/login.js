
// Vue Component Import

import CustomAlert from '../backend/admin/components/CustomAlert.vue'
let alert = createApp(CustomAlert);
let alertInstance = alert.mount('#alert')

function showMessage(message, icon = 'info') {
    alertInstance.updateMessage(message, icon)
    alertInstance.autoAlert(7);
}

/* ------------------------ detect Cookie ------------------------ */
window.onload = () => {
    let cookies = document.cookie.split(';');
    let sessionData;
    cookies.forEach(cookie => {
        console.log(cookie)
        const [name, value] = cookie.trim().split('=');
        if (name === 'sessionData') {
            sessionData = JSON.parse(value);
            console.log(sessionData)
            if (sessionData.status === "successful"){
                showMessage(sessionData.message, 'success');
            }else{
                showMessage(sessionData.message, 'error');
            }
        }
    });
}


/**
 * Before Submit Verify
 */

$("#form").submit(function (event) {
    event.preventDefault();

    const email = $("#email").val();

    // request the email name-list from backend
    $.ajax({
        url: "/auth/register/valid",
        method: "POST",
        data: { email: email },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.emailExists) {
                $("#form").unbind('submit').submit();
            } else {
                showMessage('This email address aren\'t existents !', 'error')
            }
            return;
        },
        error: function () {
            showMessage('Something happened', 'warning')
        }
    });
});
