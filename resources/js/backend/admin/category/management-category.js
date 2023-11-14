
// Vue Components Import

import CustomAlert from '../components/CustomAlert.vue';
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert');

// Function

// Document ready
$(document).ready(function(event){

    $('.background-form').click(function(event){
        $('.background-form').hide().animate({
            opacity: '0'
        });
    });

    $('.form').click(function(event){
        event.stopPropagation();
    });

    $('.button').click(function(event){
        event.stopPropagation();
        alert($(this).closest('tr').data('id'))
    });
});

// Bind the edit form trigger
$('tr.category-row-data').click(function(event){

    // Default method blocked
    event.stopPropagation();
    let id = $(this).data('id');
    let name = $(this).find('.editable').text();
    let cover = $(this).find('img').attr('src');

    let data = {
        'id': id,
        'name': name,
        'cover': cover,
    };

    $('.background-form').show().animate({
        opacity: '1'
    }).css(
        'display', 'flex',
    )

    callbackEditForm(data);
});


// Call the edit form
function callbackEditForm(data){
    let editForm = $('edit-category-form');
    $('.category-cover-image').attr('src', data['cover']);
    $('.form-control').attr('value', data['name'])
}

/**
 * Search bar
 */

$('#searchInput').on('input', function() {
    var searchText = $(this).val().toLowerCase();
    
    $('.category-row-data').each(function() {
        var rowText = $(this).find('.editable').text().toLowerCase();
        if (rowText.includes(searchText)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
});

function down(){
    let editForm = $('edit-category-form');
    editForm.hide();
}

/**
 * Build An Async Request
 */

let form = document.querySelector('form');
form.addEventListener('submit', (event)=>{
    event.preventDefault();

    // Build XMLHttpRequest
    let xhr = new XMLHttpRequest();
    xhr.open(
        'POST',
        form.action,
        true
    )

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