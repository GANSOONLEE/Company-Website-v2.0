
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
 * <<API CALL>>
 * Delete Category
 */