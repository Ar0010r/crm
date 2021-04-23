<template>
    <div class="authentication-wrapper authentication-1 px-4 theme-bg-white">
        <div class="authentication-inner py-5">
            <LoginIcon/>
            <LoginForm/>
        </div>
    </div>
</template>

<script>
    import LoginIcon from '../components/auth/LoginIcon.vue';
    import LoginForm from '../components/auth/LoginForm.vue';

    export default {
        mounted() {
            document.getElementById('layout-sidenav').style = 'display: none';
            document.getElementById('layout-navbar').style = 'display: none';
        },

        beforeUnmount(){
            document.getElementById('layout-sidenav').style = 'display: block';
            document.getElementById('layout-navbar').style = 'display: block';
        },

        components: {
            LoginIcon,
            LoginForm
        }
    };
</script>
