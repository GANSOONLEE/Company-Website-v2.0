
// Vue Component

import CustomAlert from '../components/CustomAlert.vue';

const alert = createApp(CustomAlert);
const alertInstance = alert.mount("#alert")

// Delete Confirm

let buttons = document.querySelectorAll('a[button-event="delete"]');
let deleteConfirmButton = document.querySelector('#deleteButtonConfirm');

window.onload = ()=>{

    buttons.forEach(button=>{

        button.style.display = "table-cell";

        button.addEventListener('click', (event)=>{
            event.preventDefault();
            deleteConfirmButton.setAttribute('data-link', button.href)
        })
    })

}

deleteConfirmButton.addEventListener('click', ()=>{

    window.location.href = deleteConfirmButton.getAttribute('data-link')

});

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

    url.searchParams.set('text', url.searchParams.get('text') || '');
    url.searchParams.set('category', url.searchParams.get('category') || '');
    url.searchParams.set('code', url.searchParams.get('code') || '');

    window.location.href = url.toString();
})


function setCookie(cname, cvalue, exdays)
{
  var d = new Date();
  d.setTime(d.getTime()+(exdays*24*60*60*1000));
  var expires = "expires="+d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname)
{
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) 
  {
    var c = ca[i].trim();
    if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
  return "";
}


// check view mode
let allRadio = document.querySelectorAll('input[type="radio"]');

allRadio.forEach(radio => {
    radio.addEventListener('click', ()=>{
        setCookie('view-mode', radio.id, 30);
        checkProductCover();
    });
});

// display
window.onload = () => { 
    if(getCookie('view-mode')){
        let mode = getCookie('view-mode');
        document.querySelector(`#${mode}`).checked = true;
    }else{
        document.querySelector('#image').checked = true;;
    }

    checkProductCover();
};

function checkProductCover(){
    let mode = getCookie('view-mode');
    let productCoverArray = document.querySelectorAll('.product-cover');
    let table = document.querySelector('table');
    if(mode == 'list'){
        productCoverArray.forEach(productCover => {
            productCover.parentElement.parentElement.style.display = 'none';
        });
        table.setAttribute('data-view-mode', mode);
    }else{
        productCoverArray.forEach(productCover => {
            productCover.parentElement.parentElement.style.display = 'block';
        });
        table.removeAttribute('data-view-mode');
    }
}