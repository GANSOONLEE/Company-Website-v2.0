
// Import Vue Components

import PieChart from './components/chart/PieChartComponent.vue'
import CustomAlert from './components/CustomAlert.vue';

const alert = createApp(CustomAlert);
const alertInstance = alert.mount("#alert")

// Request Data

async function getRequest(){

    const parameter  = {
        analysis: {
            total_record: true,
            count_with_category: true,
            count_with_type: false,
        }
    };
    
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `/admin/request/getProductData`,
            data: {parameter : parameter},
            dataType: 'json',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success(response){
                resolve(response)
            },
            error(response){
                reject(response)
            }
        })
    });
}

window.onload = async () =>{

    let data = await getRequest();
    let count = data.count;

    let categoryRecord = [
        count.category_count
    ]
    let typeRecord = [
        count.type_count
    ]
        
    const labels = [];
    const datasetData = [];

    typeRecord[0].forEach(record=>{
        labels.push(record.product_type)
        datasetData.push(record.count)
    })

    const externalData = {labels, datasetData}

    const pieChart = createApp(PieChart, {
        externalData: externalData 
    });

    pieChart.mount("#pie-chart");

}

// refresh chart
let refreshButton = $('#refresh-button');
refreshButton.click((event)=>{

    // Set time delay
    let button = event.target;
    button.disabled = true;
    let counter;

    let requestBlockLimiterSubject = subject.subscribeObserver(RequestBlockLimiter);
    let overLimit = subject.notifyObserver(RequestBlockLimiter, limitCounter())

    const bannerTime = setTimeout(()=>{
        button.disabled = false;
    }, timeLimit * 1000)

    if(overLimit == true){
        alertInstance.updateMessage(`You are over limit !<br> ${timeLimit} can't more then ${requestLimit}`, 'warning');
        alertInstance.showAlert();
        button.disabled = true;
        return;
    }

    const timer = setTimeout(()=>{
        button.disabled = false;
    }, 3300)

    // trigger refresh
    window.externalRefreshChart(alertInstance);

})

// // [Observer]
class Observer{

    /**
     * @param {function} callback
     */

    notify(callback){
        ()=>{
            callback
        };
    }

}

// // [Subscription] 
class Subject{

    observers = [];

    /**
     * @param {Observer} observer
     */

    subscribeObserver(observer){
        this.observers.push(observer);
    }

    unsubscribeObserver(observer){
        let index = this.observers.indexOf(observer);
        if (index > -1) {
           this.observers.splice(index, 1) 
        }
    }

    notifyObserver(observer, callback){
        let index = this.observers.indexOf(observer);
        return callback;
    }

    notifyAllObservers(callback){
        for(let i = 0; i < this.observers ; i++){
            this.observers[i].notify(callback);
        }
    }

}

// [Event]

let i = 1
let timer = null;
let timeLimit = 60; // 60 second
let timeCounter = timeLimit;
let requestLimit = 5; // (requestLimit) at (timeLimit)

function limitCounter(){

    // check timer existent
    if (i >= requestLimit) {
        return true;
    }

    /**
     * @param {number} timeCounter
     * @param {number} requestLimit
     */

    if(timer){
        i++;
        return false;
    }

    timer = setInterval(() => {
        timeCounter--;
        if (0 >= timeCounter) {
            clearInterval(timer);
            i = 1;
            timer = null;
            timeLimit = timeCounter;
        } 
    }, 1000);

}

// create observer instance
let subject = new Subject();
let RequestBlockLimiter = new Observer();





