
// Import Vue Components

import PieChart from './components/chart/PieChartComponent.vue'

const pieChart = createApp(PieChart);
pieChart.mount('#pie-chart')

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
                console.error(response)
                reject(response)
            }
        })
    });
    
}

// Chart.js Setting

const ctx = document.getElementById('myChart');
var myChart;

async function build(){

    let data = await getRequest();

    let count = data.count;
    let totalRecord = count.total;
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

    // categoryRecord[0].forEach(record=>{
    //     labels.push(record.product_category)
    //     datasetData.push(record.count)
    // })

    myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: '# of Items',
                data: datasetData,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(99, 255, 198)',
                    'rgb(163, 82, 255)',
                ],
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: "right"
                }
            },
            locale: "zh-CN"
        }
    });

}

window.onload = ()=>{
    build();
}

// refresh canvas
let refreshButton = document.querySelector('#refresh-button');
refreshButton.addEventListener('click', ()=>{
    myChart ? myChart.destroy() : '';
    build()
    alertInstance.updateMessage('Success update!', 'success');
    alertInstance.autoAlert();
})

