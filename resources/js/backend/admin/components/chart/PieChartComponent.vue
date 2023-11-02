<template>
  <canvas id="myChart"></canvas>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    props: {
        externalData: Object,
    },
    setup(props) {
        const myChart = ref(null);
        let datasetData = ref(null);
        let labels = ref(null);

        const getRequest = async () => {
            if (props.externalData) {
                datasetData = props.externalData.datasetData;
                labels = props.externalData.labels;
            }
        };

        const refreshChart = () => {
            getRequest().then(() => {
                if (myChart.value) {
                    myChart.value.destroy();
                }
                myChart.value = new Chart("myChart", {
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
                                position: "right",
                            },
                        },
                        locale: "zh-CN",
                    },
                });
            });
        };

        onMounted(() => {
            getRequest().then(() => {
                myChart.value = new Chart("myChart", {
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
                                position: "right",
                            },
                        },
                        locale: "zh-CN",
                    },
                });
            });
        });

        const externalRefreshChart = (alertInstance) => {
            refreshChart();
            alertInstance.updateMessage('Success refresh', 'success');
            alertInstance.autoAlert();
        };

        return {
            externalRefreshChart,
        };
    },
    mounted(){
        window.externalRefreshChart = this.externalRefreshChart;
    }
};
</script>
