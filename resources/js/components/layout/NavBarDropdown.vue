<template>
    <div class="demo-navbar-user nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                    <img :src="'images/' + profile.avatar"  alt class="d-block ui-w-30 rounded-circle">
                    <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{profile.login}}</span>
                  </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a @click="showProfileForm" data-toggle="modal" data-target="#profileForm" href="javascript:void(0)"
               class="dropdown-item">
                <i class="ion ion-ios-person text-lightest"></i>
                My profile
            </a>

            <div class="dropdown-divider"></div>

            <a @click="logout" href="javascript:void(0)" class="dropdown-item">
                <i class="ion ion-ios-log-out text-danger"></i>
                Log Out
            </a>
        </div>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed, inject} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject("container");
            let profile = computed(() => store.getters.getProfile);

            async function logout() {
                await container.AuthService.logout();
            }

            return {
                logout,
                profile,
                showProfileForm: () => emitter.emit('open-profile-form', profile)
            }
        }
    };
</script>
