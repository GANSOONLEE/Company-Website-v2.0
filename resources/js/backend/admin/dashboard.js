
// Import Vue Components

import PieChart from './components/chart/PieChartComponent.vue'
import CustomAlert from './components/CustomAlert.vue';

const alert = createApp(CustomAlert);
const alertInstance = alert.mount("#alert")

// #region Request Data
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

// #endregion

window.onload = async () =>{

    let refreshButton = document.querySelector('#refresh-button');
    refreshButton.disabled = true;
    setTimeout(()=>{
        refreshButton.disabled = false;
    }, 1200)

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

    let datasetDataOption = 'category';

    switch (datasetDataOption) {

        case 'type':
            typeRecord[0].forEach(record=>{
                labels.push(record.product_type)
                datasetData.push(record.count)
            })

            break;

        case 'category':
            categoryRecord[0].forEach(record=>{
                labels.push(record.product_category)
                datasetData.push(record.count)
            })

            break;
    
        default:
            break;
    }

    const externalData = {labels, datasetData}

    const pieChart = createApp(PieChart, {
        externalData: externalData 
    });

    pieChart.mount("#pie-chart");

}

// refresh chart
let refreshButton = $('#refresh-button');
let count = 0;
refreshButton.click((event)=>{

    let button = event.target;

    // Start the clear timer
    let timeDelay = 60;

    const clearTimer = setTimeout(()=>{
        count = 0;
    }, timeDelay * 1000)

    count++;
    if(count > 2){

        blockRequestEvent.bindFunction(()=>{
            if(bannedTime){
                return false;
            }
            alertInstance.updateMessage('You are over limit!<br>Please try again after 60 second!', 'warning');
            alertInstance.showAlert();
        
            button.disabled = true;
        
            
            let bannedTime = setTimeout(()=>{
                button.disabled = false;
            }, timeDelay * 1000)
            let timeDisplay = setInterval(()=>{
                timeDelay--;
                if(timeDelay <= 0){
                    alertInstance.closeAlert();
                    clearInterval(timeDisplay);
                    count = 0;
                    return false;
                }
                alertInstance.updateMessage(`You are over limit!<br>Please try again after ${timeDelay} second!`, 'warning');
            }, 1000)
            
            return false;
        })

        return refreshDataObserver.trigger(button);
    }

    // trigger refresh
    window.externalRefreshChart(alertInstance);
    button.disabled = true;
    
    setTimeout(() => {
        button.disabled = false;
    }, 3200);

})

// #region [Class] Observer 

class Observer{

    subscribedSubjects = [];

    construct(){
        
    }

    /**
     * Manual trigger observer
     */

    trigger(){
        for (const subject of this.subscribedSubjects) {
            subject.observerAreTriggered();
        }
    }

    /**
     * Subscribe to subject
     */

    subscribeToSubject(subject){
        this.subscribedSubjects.push(subject)
    }

    /**
     * Response to subject
     */
    notify(){
        return true;
    }

}

// #endregion

// #region [Class] Subject

class Subject{

    observers = [];
    events = [];

    /**
     * Subscribe observer
     * @param {Observer} observer
     */

    subscribeObserver(observer){
        this.observers.push(observer);
    }

    /**
     * Unsubscribe observer
     * @param {Observer} observer
     */

    unsubscribeObserver(observer){
        let index = this.observers.indexOf(observer);
        this.observers.splice(index, 1);
    }

    /**
     * Subscribe event
     * @param {Event} event
     */

    subscribeEvent(event){
        this.events.push(event);
    }

    /**
     * Unsubscribe event
     * @param {Event} event
     */

    unsubscribeEvent(event){
        let index = this.events.indexOf(event);
        this.events.splice(index, 1);
    }

    /**
     * Subject test observer still alive
     * @param {Observer} observer
     */

    notifyObserver(observer){

        // Are observer was subscribed by this subject
        if(!this.observers.includes(observer)){
            console.error(`Error, this observer haven't subscribed by this subject!`)
            return false;
        }

        let result = null;
        result = observer.notify();

        result ? console.info('Still alive') : console.error('Missing it');
    }

    /**
     * When observer are triggered
     */

    observerAreTriggered(){
        for (const event of this.events) {
            event.run();
        }
    }

}

// #endregion

// #region [Class] Event

class Event{

    callback = ()=>{};

    /**
     * 
     * @param {Function} callback 
     * @example ()=>{}
     * @example function(){}
     * @example initForm()
     */
    bindFunction(callback){
        this.callback = callback;
    }

    /**
     * @param {Function} callback
     */

    run(){
        this.callback();
    }

}

// #endregion


// #region Define observer

let refreshDataObserver = new Observer;
let requestDataLimiter = new Subject;
let blockRequestEvent = new Event;


requestDataLimiter.subscribeObserver(refreshDataObserver);
refreshDataObserver.subscribeToSubject(requestDataLimiter);
requestDataLimiter.subscribeEvent(blockRequestEvent);

// #endregion