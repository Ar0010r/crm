<template>
    <form class="my-5">
        <div class="form-group d-flex align-items-center justify-content-center">
            <img src="logo.png" class="w-25 h-25">
        </div>
        <div class="form-group">
            <label class="float-right text-danger d-none" :class="{ 'd-block': dBlock}"> Invalid credentials</label>
            <input placeholder="Login" type="text" class="form-control" v-model="user.login" :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="form-group">
            <input placeholder="Pass" type="password" class="form-control" v-model="user.password" :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input style="background-color: black" type="checkbox" class="custom-control-input" >
                <span class="custom-control-label dark-style">Remember me</span>
            </label>
            <button type="button" class="btn btn-dark" @click.prevent=login(user)>Sign In</button>
        </div>
    </form>
</template>

<script>
    import router from '../../router.js'

    import {inject, ref, reactive} from 'vue';

    export default {
        setup() {
            const container = inject('container');
            let user = reactive({login: "", password: ""});
            let isInvalid = ref(false);
            let dBlock = ref(false);

            async function login() {
                try {
                    await container.AuthService.login(user);
                    router.push("/employees");
                } catch (e) {
                    isInvalid.value = true;
                    dBlock.value = true;
                }

            }

            return {user, isInvalid, dBlock, login}
        },
    };
</script>

<style scoped>
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: black !important;
    }

    .custom-checkbox .custom-control-input:checked:focus ~ .custom-control-label::before {
        box-shadow: 0 0 0 0 #fff, 0 0 0 0 black;
        border:1px solid black !important;
    }
    .custom-checkbox .custom-control-input:focus ~ .custom-control-label::before {
        box-shadow: 0 0 0 0 #fff, 0 0 0 0 black;
        border:1px solid black !important;
    }
    .custom-checkbox .custom-control-input:active ~ .custom-control-label::before {
        background-color: black;
    }

    input:focus{
        border:1px solid black !important;
    }

    /*#app{
        background-color: #fff !important;
    }*/
</style>
