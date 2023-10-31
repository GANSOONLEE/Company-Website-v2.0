<style scoped>

</style>

<template>

    <component id="pagination">

        <!-- Header -->
        <section id="pagination-header">

        </section>

        <!-- Body -->
        <section id="pagination-body">

            <tr v-for="(item, index) in array" :key="index">
                <td v-for="(object, index) in item.data" :key="index">
                    {{ object }}
                </td>
            </tr>

        </section>

        <!-- Footer -->
        <section id="pagination-footer">

        </section>

    </component>

</template>

<script>
export default {
    // data() {
    //     return {
    //         array: [
    //             { data: ['a', 'b', 'c'] },
    //             { data: ['d', 'e', 'f'] },
    //             { data: ['g', 'h', 'i'] },
    //             { data: ['j', 'k', 'l'] }
    //         ]
    //     };
    // }
    props: {
        array: Array,
    }
}
</script>