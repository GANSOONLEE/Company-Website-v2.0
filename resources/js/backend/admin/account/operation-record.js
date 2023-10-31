
// Vue Component

import PaginationComponent from '../components/PaginationComponent.vue'

// const paginationBox = createApp(PaginationComponent);
// const pagination = paginationBox.mount('#paginationBox')
app.component('pagination-component', PaginationComponent);
app.mount('#paginationBox');