<template>
    <div class="layout-wrapper layout-2" style="background-color: #f5f5f5!important;">
        <div class="layout-inner">
            <SideBar/>
            <div class="layout-container">
                <NavBar/>
                <div class="layout-content">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <ProfileForm/>
        <Notification/>
        <DeleteForm/>
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
</template>

<script>
    import SideBar from './components/layout/SideBar.vue';
    import NavBar from './components/layout/NavBar.vue';
    import ProfileForm from './components/modals/profile/ProfileForm';
    import Notification from './components/modals/notification/Notification';
    import DeleteForm from './components/modals/notification/DeleteForm';

    export default {
        components: {
            SideBar,
            NavBar,
            ProfileForm,
            Notification,
            DeleteForm
        }
    };
</script>

<style lang="scss">
    html,
    body,
    #app {
        width: 100%;
        height: 100%;
        font-family: Arial, Helvetica, sans-serif;
        background: #e3e4e5;
    }

    .flex {
        display: flex;
        height: 100%;
        width: 100%;

        &--column {
            flex-direction: column;
        }

        &--align-center {
            align-items: center;
        }

        &--justify-center {
            justify-content: center;
        }
    }

    .logos {
        padding-top: 16px;
        display: grid;
        grid-template-columns: auto auto;
        grid-gap: 32px;
    }

    .title {
        display: grid;
        grid-template-columns: auto auto auto;
        grid-gap: 16px;
        padding: 32px;

        .laravel {
            color: #ff291a
        }

        .vue {
            color: #41b883;
        }

        .plus {
            color: #35495e
        }

    }

    /*td, th {
        padding-left: .25rem !important;
        padding-right: .25rem !important;
    }*/
</style>
