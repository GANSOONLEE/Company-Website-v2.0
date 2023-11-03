
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

// pusher
let pusher = new Pusher('a5467f403d2b33859816', {
    encrypted: true,
    cluster: 'ap1'
});

let channel = pusher.subscribe('create-order-channel');
channel.bind('App\\Events\\NewOrderEvent', (data) => {
    console.log('pusher');
});