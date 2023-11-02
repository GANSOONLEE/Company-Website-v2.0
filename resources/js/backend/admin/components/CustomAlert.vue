
<style>


</style>

<template>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>

    <div :class="['alert', 'alert-' + statusClass, 'alert-dismissible', 'd-flex', 'align-items-center', 'fade', { 'show': show }]" role="alert">
        <svg style="width: 20px;" :class="iconClass" xmlns="http://www.w3.org/2000/svg" :aria-label="iconAriaLabel">
            <use :xlink:href="iconHref" />
        </svg>
        <div v-html="message">
            
        </div>
        <button type="button" class="btn-close" @click="closeAlert"></button>
    </div>

</template>

<script>
export default {
    data() {
        return {
            show: false,
            message: "init",
            status: "info",
        };
    },
    computed: {
        iconHref() {
            if (this.status === 'info-fill' || this.status === 'warning') {
                return '#info-fill';  // 修改为你想要的 Href
            } else if (this.status === 'error') {
                return '#exclamation-triangle-fill';  // 修改为错误状态的 Href
            } else {
                return '#check-circle-fill';  // 修改为默认状态的 Href
            }
        },
        statusClass() {
            // 根据 status 设置样式类
            if (this.status === 'warning') {
                return 'warning';
            } else if (this.status === 'error') {
                return 'danger';
            } else if (this.status === 'success') {
                return 'success';
            } else {
                return 'info';
            }
        },
        iconClass() {
            // 根据 status 设置图标类
            if (this.status === 'warning') {
                return 'bi bi-exclamation-triangle-fill';
            } else if (this.status === 'error') {
                return 'bi bi-x-circle-fill';
            } else {
                return 'bi bi-info-circle-fill';
            }
        },
        iconAriaLabel() {
            // 根据 status 设置图标的 Aria 标签
            if (this.status === 'warning') {
                return 'Warning:';
            } else if (this.status === 'error') {
                return 'Error:';
            } else if (this.status === 'success') {
                return 'Success';
            } else {
                return 'Info:';
            }
        },
    },
    methods: {
        updateMessage(message, status) {
            this.message = message;
            this.status = status;
        },
        showAlert(){
            this.show = true;
        },
        closeAlert(){
            this.show = false;
        },
        autoAlert(){
            this.showAlert();
            setTimeout(()=>{
                this.closeAlert()
            }, 3000)
        }
    },
};
</script>