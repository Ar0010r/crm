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
            <input type="password" class="form-control" v-model="user.password" ref="password" :class="{ 'is-invalid': isInvalid}">
        </div>
        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input type="checkbox" class="custom-control-input">
                <span class="custom-control-label">Remember me</span>
            </label>
            <button type="button" class="btn btn-primary" @click.prevent="login">Sign In</button>
        </div>
    </form>
</template>

<script>
    import { useStore } from 'vuex';
    import router from '../../router.js'

    export default {
        data () {
            return {isInvalid: false, dBlock: false}
        },
        setup() {
            const store = useStore();
            //const user = computed(() => store.state.user);

            const user = {login: "", password: "" };

            return {user , store}

        },

        methods: {
            async login(){
                let res = await this.store.dispatch('login', this.user);
                if(res){
                    router.push("/employees");

                } else {
                    console.log(this.isInvalid);

                   this.isInvalid = true;
                   this.dBlock = true;
                }
            }
        },
    };
</script>
