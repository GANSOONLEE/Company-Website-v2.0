
// Vue Component

import PaginationComponent from '../components/PaginationComponent.vue'

// const paginationBox = createApp(PaginationComponent);
// const pagination = paginationBox.mount('#paginationBox')
app.component('pagination-component', PaginationComponent);
app.mount('#paginationBox');

// Function

let gotoButton = document.querySelector('#gotoButton');
gotoButton.addEventListener('click', ()=>{

    // Get Current Url
    let currentUrl = window.location.href;

    // Get Range
    let pageIndexInput = document.querySelector('input[type=number]') 
    const min = parseInt(pageIndexInput.getAttribute('min'));
    const max = parseInt(pageIndexInput.getAttribute('max'));

    // Get Current Page
    const currentPage = parseInt(pageIndexInput.value);

    // Verify data validation
    if(currentPage == null || currentPage == ''){
        alert('Please input a number!')
        return false;
    }

    if(min > currentPage || currentPage > max){
        alert(`Your page must between ${min} and ${max}!, you value ${currentPage}`)
        return false;
    }

    let url = new URL(currentUrl);
    url.searchParams.set('pageIndex', currentPage);
    window.location.href = url.toString();
})