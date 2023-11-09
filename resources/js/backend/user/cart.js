
// Search DOM

import CustomAlert from '../admin/components/CustomAlert.vue';
const alert = createApp(CustomAlert);
const alertInstance = alert.mount('#alert');


/**
 *  Helper Function
 *  @function DOMElement - select all filter
 *  @param {String} filterName - filter name you want to select 
 */

function findFilter(filterName){

    let filter = document.querySelector(`[data-select-filter=${filterName}]`);
    
    if(!filter){
        console.error(`Filter ${filterName} not find`)
    }

    return filter;

}

/**
 * Init Filter
 */

import Filter from '../admin/product/class/Filter.js';

let filters = {};

function initFilter(columnId, mode, trigger = "change") {
    let column = findFilter(columnId);
    filters[columnId] = new Filter(column, mode, trigger);
    console.log('初始化成功')

    filters[columnId].setChangeCallback(applyFilters);
}

initFilter('category', 'strict');
initFilter('type', 'strict');

function applyFilters() {
    console.log('調用中')
    let categoryValue = filters['category'].getValue();
    let typeValue = filters['type'].getValue();

    let columns = document.querySelectorAll('[data-search-column]'); // 选择带有 data-search-column 属性的元素
    var categoryMatch, typeMatch;

    columns.forEach(column => {
        let columnName = column.getAttribute('data-search-column');
        let columnContent = column.innerText;

        if(columnName === "category"){
            categoryMatch = categoryValue == "" || (columnMatchesFilter(columnContent, categoryValue, filters['category'].getMode()));
            // console.log(`categoryMatch 結果為：${categoryMatch}，查詢條件為 ${categoryValue}，内容爲${columnContent}` )
            return categoryMatch
        }

        if(columnName === "type"){
            typeMatch = typeValue == "" || (columnMatchesFilter(columnContent, typeValue, filters['type'].getMode()));
            // console.log(`typeMatch 結果為：${typeMatch}，查詢條件為 ${typeValue}，内容爲${columnContent}` )
            return typeMatch
        }

        if (categoryMatch && typeMatch) {
            column.parentElement.style.display = 'table-row';
        } else {
            column.parentElement.style.display = 'none';
        }
    });
}

function columnMatchesFilter(columnContent, filterValue, mode) {
    if (mode === 'contain') {
        return columnContent.toUpperCase().includes(filterValue.toUpperCase());
    } else if (mode === 'strict') {
        return columnContent === filterValue;
    }
}

// Popovers
let popoversTrigger = document.querySelectorAll('.popovers-edit');
let popover = document.querySelector('.popovers');

popoversTrigger.forEach(trigger => {
    trigger.addEventListener('click', (event) => {
        event.stopPropagation();
        
        let number = trigger.querySelector('.number').innerText;
        let skuID = trigger.parentElement.parentElement.querySelector('.sku-id').innerText;
        popover.style.display = 'block';
    
        const triggerRect = trigger.getBoundingClientRect();
        console.log(triggerRect.top)
        console.log(triggerRect.left)
        const target = event.target;
     
        let height = window.pageYOffset + target.getBoundingClientRect().top;
    
        popover.style.top = height - target.offsetHeight + 'px';
        popover.style.left = triggerRect.left - 15 * target.offsetWidth + 'px';

        popover.classList.add('show');
        popover.querySelector('#number').value = number;
        popover.querySelector('#brand_code').value = skuID;

        document.addEventListener('click', closePopover);
    });
})

popover.addEventListener('click', (event) => {
    event.stopPropagation();
});

function closePopover() {
    popover.style.display = 'none';
    document.removeEventListener('click', closePopover);
}

// Refresh effect

let refresh = document.querySelector('#refresh');
refresh.addEventListener('click', (event)=>{
    event.preventDefault();

    let icon = refresh.querySelector('.fa-refresh');
    icon.classList.add('fa-spin')
    setTimeout(function(){
        icon.classList.remove('fa-spin');
        location.reload();
    }, 2500)

    
})

// Ajax Request update number

document.querySelector('#popover-update').addEventListener('click', ()=>{
    
    let brand_code = popover.querySelector('#brand_code').value;
    let number = popover.querySelector('#number').value;

    closePopover();

    if(isNaN(Number(number, 10))){
        alertInstance.updateMessage('Please enter number');
        alertInstance.autoAlert();
        $('#alert').css('display', 'block')
        return false
    }

    if(number < 0 || number >= 100){
        alertInstance.updateMessage('Can\'t less then 0 or more then 100');
        alertInstance.autoAlert();
        $('#alert').css('display', 'block')
        return false;
    }

    let data = {
        'brand_code': brand_code,
        'number': number,
    }

    $.ajax({
        url: "/user/cart/update",
        method: "POST",
        dataType: 'json',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            let row = document.getElementById(brand_code).parentNode;
            row.querySelector('.number').innerText = response['number'];
        },
        error: function () {
            alertInstance.updateMessage("Something error", 'error');
            alertInstance.autoAlert();
        }
    })

})

// Ajax Request Create Order

let createOrderBtn = document.querySelector('#create-order');
createOrderBtn.addEventListener('click', ()=>{

    let items = document.querySelectorAll('input[type="checkbox"]')
    let checkedItems = [];
    let status = true;

    items.forEach(item => {
        if(item.checked){
            let skuId = item.getAttribute('data-sku-id');
            let number = item.getAttribute('data-number');

            if(number == 0){
                alertInstance.updateMessage('The items you select have 0');
                alertInstance.showAlert();
                $('#alert').css('display', 'block')
                status = false;
                return false;
            }
   
            checkedItems.push({
                'sku_id': skuId,
                'number': number,
            })
        }

    })

    if(checkedItems.length === 0){
        alertInstance.updateMessage('Please select 1 or more item');
        alertInstance.showAlert();
        $('#alert').css('display', 'block')
        status = false;
        return false;
    }

    if(!status){
        return false;
    }

    $.ajax({
        url: "/user/order/create-order",
        method: "POST",
        dataType: 'json',
        data: {orderData: checkedItems},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
           console.log(response)
           location.reload()
        },
        error: function (response) {
            console.log(response)
            alertInstance.updateMessage('Unsuccess', 'error');
            alertInstance.autoAlert();
        }
    })

})