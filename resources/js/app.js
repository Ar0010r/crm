import { createApp } from 'vue';
import App from './App.vue';
import Router from './router.js';
import Vuex from 'vuex'
import Store from "./store";
import {container} from './services'
import mitt from 'mitt';

const emitter = mitt();

createApp(App)
    .use(Router)
    .use(Vuex)
    .use(Store)
    .provide('container',container)
    .provide('emitter', emitter)
    .mount("#app");


