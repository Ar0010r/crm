<template>
    <nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x"
         id="layout-navbar">

        <!-- Brand demo (see assets/css/demo/demo.css) -->
        <a class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
            <span class="app-brand-logo demo bg-primary">
              <svg viewBox="0 0 148 80" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient
                      id="a" x1="46.49" x2="62.46" y1="53.39" y2="48.2" gradientUnits="userSpaceOnUse"><stop
                      stop-opacity=".25" offset="0"></stop><stop stop-opacity=".1" offset=".3"></stop><stop
                      stop-opacity="0" offset=".9"></stop></linearGradient><linearGradient id="e" x1="76.9" x2="92.64"
                                                                                           y1="26.38" y2="31.49"
                                                                                           xlink:href="#a"></linearGradient><linearGradient
                      id="d" x1="107.12" x2="122.74" y1="53.41" y2="48.33" xlink:href="#a"></linearGradient></defs><path
                      style="fill: #fff;" transform="translate(-.1)"
                      d="M121.36,0,104.42,45.08,88.71,3.28A5.09,5.09,0,0,0,83.93,0H64.27A5.09,5.09,0,0,0,59.5,3.28L43.79,45.08,26.85,0H.1L29.43,76.74A5.09,5.09,0,0,0,34.19,80H53.39a5.09,5.09,0,0,0,4.77-3.26L74.1,35l16,41.74A5.09,5.09,0,0,0,94.82,80h18.95a5.09,5.09,0,0,0,4.76-3.24L148.1,0Z"></path><path
                      transform="translate(-.1)" d="M52.19,22.73l-8.4,22.35L56.51,78.94a5,5,0,0,0,1.64-2.19l7.34-19.2Z"
                      fill="url(#a)"></path><path transform="translate(-.1)"
                                                  d="M95.73,22l-7-18.69a5,5,0,0,0-1.64-2.21L74.1,35l8.33,21.79Z"
                                                  fill="url(#e)"></path><path transform="translate(-.1)"
                                                                              d="M112.73,23l-8.31,22.12,12.66,33.7a5,5,0,0,0,1.45-2l7.3-18.93Z"
                                                                              fill="url(#d)"></path></svg>
            </span>
            <span class="app-brand-text demo font-weight-normal ml-2">Appwork</span>
        </a>

        <!-- Sidenav toggle (see assets/css/demo/demo.css) -->
        <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
            <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:void(0)">
                <i class="ion ion-md-menu text-large align-middle"></i>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#layout-navbar-collapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="layout-navbar-collapse">
            <!-- Divider -->
            <hr class="d-lg-none w-100 my-2">

            <form @submit.prevent="search(keyword)" class="navbar-nav align-items-lg-center">
                <!-- Search -->
                <label class="nav-item navbar-text navbar-search-box p-0 active">
                    <i class="ion ion-ios-search navbar-icon align-middle"></i>
                    <span class="navbar-search-input pl-2">
                  <input v-model="keyword" type="text" class="form-control navbar-text mx-2"
                         placeholder="Search"
                         style="width:200px">
                </span>
                </label>
            </form>

            <div class="navbar-nav align-items-lg-center ml-auto">

                <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">
                    |
                </div>
                <Dropdown/>
            </div>
        </div>
    </nav>
</template>

<script>
    import Dropdown from './NavBarDropdown';
    import {useStore} from 'vuex';
    import {inject, ref} from 'vue';

    export default {
        setup() {
            const container = inject('container');
            const store = useStore();

            async function search(keyword) {
                /*store.dispatch('applicant/get', {
                    "search_term" : keyword
                });*/
            }
            return {keyword: ref(null), search}
        },
        components: {
            Dropdown
        }
    };
</script>
