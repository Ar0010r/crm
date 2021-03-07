<template>
    <form class="my-5">
        <div class="form-group">
            <label class="form-label">Login</label>
            <label class="float-right text-danger d-none" :class="{ 'd-block': dBlock}"> Invalid credentials</label>
            <input type="text" class="form-control" v-model="user.login" :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="form-group">
            <label class="form-label d-flex justify-content-between align-items-end">
                <div>Password</div>
            </label>
            <input type="password" class="form-control" v-model="user.password" :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input type="checkbox" class="custom-control-input">
                <span class="custom-control-label">Remember me</span>
            </label>
            <button type="button" class="btn btn-primary" @click.prevent=login(user)>Sign In</button>
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

            const login = async () => {
                try {
                    await container.AuthService.login(user);
                   // router.push("/employees");
                } catch (e) {
                    console.log(e);
                    isInvalid.value = true;
                    dBlock.value = true;
                }

            };

            return {user, isInvalid, dBlock, login}
        },
    };
</script>



<!--const login = async () => {
let res = await container.AuthService.login(user);
if (res) {
router.push("/employees");
} else {
isInvalid.value = true;
dBlock.value = true;
}
};-->
