import { createApp } from 'vue';
import App from './App.vue';
import Router from './router.js';
import Vuex from 'vuex'
import Store from "./store";
createApp(App).use(Router).use(Vuex).use(Store).mount("#app");


