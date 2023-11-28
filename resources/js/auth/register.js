

import $ from 'jquery';

// Vue Component Import

import CustomAlert from '../backend/admin/components/CustomAlert.vue'
let alert = createApp(CustomAlert);
let alertInstance = alert.mount('#alert')

function showMessage(message, icon = 'info') {
    alertInstance.updateMessage(message, icon)
    alertInstance.autoAlert();
}

/**
 * Multi Step Program Bar
 */

// #region

$('button').click(function(event){
    event.stopPropagation();
});

const circles = document.querySelectorAll(".circle"),
    progressBar = document.querySelector(".indicator"),
    buttons = document.querySelectorAll("button");

let currentStep = 1;

// function that updates the current step and updates the DOM
const updateSteps = (e) => {
    // update current step based on the button clicked
    currentStep = e.target.id === "next" ? ++currentStep : --currentStep;

    // loop through all circles and add/remove "active" class based on their index and current step
    circles.forEach((circle, index) => {
        circle.classList[`${index < currentStep ? "add" : "remove"}`]("active");
    });

    // finalWidth = ((2 * circles.length) + 1);
    // initialWidth = (((circles.length / (2 * circles.length)) + 1));
    // update progress bar width based on current step
    progressBar.style.width = `${(((currentStep - 1) / (circles.length - 1) ) * 100)}%`;

    $('.input-area').removeClass('active');
    $('.input-area').eq(currentStep-1).addClass('active');

    // check if current step is last step or first step and disable corresponding buttons
    if (currentStep === circles.length) {
        // last page
        $("#prev").prop("disabled", false);

        $("#next").hide();

        $("#submit-button").show();
    } else if (currentStep === 1) {
        // first page
        $("#prev").prop("disabled", true);

        $("#next").prop("disabled", false);
        $("#next").show();

        $("#submit-button").hide();
    } else {
        buttons.forEach((button) => (button.disabled = false));
        $("#submit-button").hide();
    }
};

// add click event listeners to all buttons
buttons.forEach((button) => {
    button.addEventListener("click", updateSteps);
});

// #endregion


/**
 * Before Submit Verify
 */

$("#form").submit(function (event) {
    event.preventDefault();

    // get the value from form
    const password = $("#password").val();
    const confirmPassword = $("#confirm_password").val();
    const email = $("#email").val();

    // check the password are same
    if (password !== confirmPassword) {
        alert("");
        showMessage('Password nad confirm Password aren\'t same!', 'error')
        return;
    }

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
                showMessage('This email address are existents.', 'error')
            } else {
                $("#form").unbind('submit').submit();
            }
        },
        error: function () {
            showMessage('Something happened', 'warning')
        }
    });
});

// show / hide input
let input = document.querySelector('#same-phone-number');
input.addEventListener('change', ()=>{

    let inputWhatsappPhone = document.querySelector('#whatsapp_phone');
    let inputContainer = inputWhatsappPhone.parentElement.parentElement;

    if(input.checked){
        inputWhatsappPhone.required = true;
        inputContainer.style.display = 'block';
    }else{
        inputWhatsappPhone.required = false;
        inputContainer.style.display = 'none';
    }
})