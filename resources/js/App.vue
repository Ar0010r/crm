<template>
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <SideBar/>
            <div class="layout-container">
                <NavBar/>
                <div class="layout-content">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
</template>

<script>
    import SideBar from './components/layout/SideBar.vue';
    import NavBar from './components/layout/NavBar.vue';
    export default {
        components: {
            SideBar,
            NavBar,
        }
    };
</script>
