
// Modal

$('.edit-button').click(function(event){

    // Define variable
    let username = $(this).closest('tr').find('#name').data('name');
    let email = $(this).closest('tr').find('#email').text();
    let role = $(this).closest('tr').find('#role').data('role');

    $('#modal-input-name').val(username);
    $('#modal-input-email').val(email);
    $('#modal-input-role').val(role);
    
    $('.modal-background').addClass('active');
})

// $('.modal-background').click(function(event){
//     $(this).removeClass('active');
// })

$('.custom-modal').click(function(event){
    event.stopPropagation();
})

$('.close-button').click(function(event){
    $('.modal-background').removeClass('active');
})