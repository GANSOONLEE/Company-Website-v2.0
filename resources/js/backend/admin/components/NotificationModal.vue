
<style>

    

</style>

<template>
    <div class="notification-modal" v-if="showModal">

        <div class="modal-header">
            <p>{{ modalTitle }}</p>
        </div>

        <div class="modal-body">
            <p>{{ modalContent }}</p>
        </div>

        <div class="modal-footer">
            <button @click="closeModal" class="btn btn-success">{{ modalConfirm }}</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modalTitle: String,
        modalContent: String,
        modalConfirm: String,
    },
    data() {
        return {
            showModal: true,
        };
    },
    methods: {
        closeModal(){
            this.showModal = false;
        }
    }
};
</script>