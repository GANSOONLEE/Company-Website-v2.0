
import { createApp } from 'vue';
import PromotionButton from '../components/PromotionButton.vue';
 
const app = createApp({});

app.component('promotion-button', PromotionButton);
app.mount('#promotionControls');