
/**
 * [Class] Button
 */

class StatusButton{

    element;

    constructor(element){
        this.element = element;
    }

    initButton(){
        this.element.addEventListener('click', (event)=>{

            let button = event.target;

            let newStatus = button.getAttribute('data-button');
            let orderID = document.querySelector('section[data-order-code]').getAttribute('data-order-code');
            const data = {newStatus: newStatus, orderID: orderID};
            changeOrderStatusRequest(data);

        })
    }

}

function changeOrderStatusRequest(data){

    $.ajax({
        url: '/admin/order/change-order-status',
        data: data,
        type: 'post',
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            // console.log(data)
            location.reload();
        },
        error: function(data) {
            // console.log(data)
        }
    })

}

//
let buttons = document.querySelectorAll('[data-button]');
let buttonArray = [];
buttons.forEach(button=>{
    buttonArray.push(button);
    let buttonInstance = new StatusButton(button);
    buttonInstance.initButton();
})