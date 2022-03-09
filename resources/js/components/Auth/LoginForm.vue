<template>
    <form class="my-5">
        <div class="form-group">
            <label class="float-right text-danger d-none" :class="{'d-block': dBlock}"> Invalid credentials</label>
            <input placeholder="Login" type="text" class="form-control" v-model="user.login"
                   :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="form-group">
            <input placeholder="Pass" type="password" class="form-control" v-model="user.password"
                   :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input style="background-color: black" type="checkbox" class="custom-control-input">
                <span class="custom-control-label dark-style">Remember me</span>
            </label>
            <button type="button" class="btn btn-primary" @click.prevent=login(user)>Sign In</button>
        </div>
    </form>
</template>

<script>
    import router from '../../router.js'

    import {inject, ref, reactive} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const container = inject('container');
            const store = useStore();

            let user = reactive({login: "", password: ""});
            let isInvalid = ref(false);
            let dBlock = ref(false);

            async function login() {
                try {
                    await container.AuthService.login(user);
                    await store.dispatch('manager/setProfile');
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
