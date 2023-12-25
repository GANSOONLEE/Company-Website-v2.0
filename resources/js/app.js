/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/** 
 | --------------------------------------------------------
 |
 |             Import dependencies 導入依賴項
 | 
 | --------------------------------------------------------
 */

// Third-party 第三方庫
import $ from 'jquery';
import 'flowbite';
import { createApp } from 'vue';

// Local 本地庫
import './bootstrap.js';
import { initThemeSwitch } from './themeSwitch.js';

/** 
 | --------------------------------------------------------
 |
 |                     初始化 Initial
 | 
 | --------------------------------------------------------
 */

window.$ = $;
window.jQuery = window.$ = $

window.createApp = createApp;
const Vue = window.Vue;

window.onload = () => {
    initThemeSwitch();
}

/** 
 | --------------------------------------------------------
 |
 |                           Vue
 | 
 | --------------------------------------------------------
 */

import CartCheckbox from './backend/user/components/CartCheckbox.vue';

const app = createApp(CartCheckbox);
app.component('CartCheckbox', CartCheckbox);
app.mount('#hello-world');