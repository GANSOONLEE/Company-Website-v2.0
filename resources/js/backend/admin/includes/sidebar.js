
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