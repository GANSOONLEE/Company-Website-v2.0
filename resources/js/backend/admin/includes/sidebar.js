
import $ from 'jquery';

$(document).ready(function($){

    $('div.link-title').click(function(event){
        event.preventDefault();

        $(this).toggleClass('active');
        $(this).siblings('ul').slideToggle();

        $(this).parent().siblings().find('div.link-title').removeClass('active');
        $(this).parent().siblings().find('ul').slideUp();
    });

});


console.log('in')

// Pusher
let pusher = new Pusher("a018306a14faf67a1d14", {
    cluster: "ap1",
});

let channel = pusher.subscribe("admin-sidebar-channel");
channel.bind("create-order-event", (data) => {
    console.log('middle')
    console.log(data)
    document.querySelector('#notification-total-cart').innerText = data.order;
});

console.log('out')