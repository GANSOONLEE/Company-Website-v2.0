
import { createApp } from 'vue';
import PromotionControlsButton from '../components/PromotionControlsButton.vue';
 
const app = createApp({});

app.component('promotion-controls-button', PromotionControlsButton);
app.mount('#promotionControls');