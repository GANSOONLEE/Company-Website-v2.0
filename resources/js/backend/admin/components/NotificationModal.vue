
<style>

    div.notification-modal{
        position: absolute;
        top: 2rem;
        left: 12.5%;
        padding: 0 1rem;
        --sidebar: 18vw;
        margin-left: var(--sidebar);
        width: calc((100vw - var(--sidebar)) / 2);
        border-radius: 6px;
        box-shadow: 0 0 20px #00006630;
    }

    .modal-header p{
        font-size: var(--font-h4);
        margin-bottom: 0;
    }

    .modal-body p{
        margin-bottom: 0;
    }

    .modal-footer{
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .modal-footer button{
        border-radius: 4px;
        padding: .4rem .8rem;
    }

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