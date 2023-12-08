
// Init Tab Component

let tabContent = $('.tab-content');
let tabLink = $('.tab-link');

$(document).ready(()=>{
    tabContent.eq(0).show()
})

tabLink.click((event)=>{

    tabContent.hide();
    tabLink.removeClass('active');

    // get index
    let clickedTabIndex = tabLink.index(event.target);
    tabLink.eq(clickedTabIndex).addClass('active');
    tabContent.eq(clickedTabIndex).show()

})

