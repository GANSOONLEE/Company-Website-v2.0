
<template>

    <canvas id="myChart"></canvas>

</template>

<script>
export default{
    data(){
        return{
            categories: [
                {
                    name: 'Original',
                    quantity: '20%'
                },
                {
                    name: 'Not-Original',
                    quantity: '25%'
                },
                {
                    name: 'New Body',
                    quantity: '10%'
                },
                {
                    name: 'Recond',
                    quantity: '45%'
                }
            ]
        }
    },
    computed: {

    }
}
</script>