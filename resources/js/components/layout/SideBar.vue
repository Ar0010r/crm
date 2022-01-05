<template>
    <div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
        <div class="app-brand demo">
            <span class="app-brand-logo demo bg-primary">
                 <img src="idea.png" class="w-100 h-100">
          </span>
            <div class="app-brand-text demo sidenav-text font-weight-normal ml-2">HiringHelper</div>
            <a href="javascript:void(0)" style="color: #fff;" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
                <i class="ion ion-md-menu align-middle"></i>
            </a>
        </div>

        <div class="sidenav-divider mt-0"></div>
        <ul class="sidenav-inner py-1">
            <router-link tag="li" :to="{ name : 'employees-table'}" class="sidenav-item">
                <a class="sidenav-link"><i class="sidenav-icon ion ion-ios-people"></i>
                    <div>Applicants</div>
                </a>
            </router-link>
            <router-link :to="{ name : 'companies-table'}" tag="li" class="sidenav-item">
                <a class="sidenav-link"><i class="sidenav-icon ion ion-md-briefcase"></i>
                    <div>Companies</div>
                </a>
            </router-link>
            <router-link v-if="profile.role !== 'personnel'" :to="{ name : 'mails-table'}"
                         tag="li" class="sidenav-item">
                <a class="sidenav-link"><i class="sidenav-icon ion ion-md-mail"></i>
                    <div>Mails</div>
                </a>
            </router-link>
            <router-link v-if="profile.role === 'admin' || profile.role === 'top hr'"
                         :to="{ name : 'managers-table'}" tag="li" class="sidenav-item">
                <a class="sidenav-link"><i class="sidenav-icon ion ion-md-contacts"></i>
                    <div>Managers</div>
                </a>
            </router-link>
            <router-link tag="li" :to="{ name : 'tests'}" class="sidenav-item">
                <a class="sidenav-link"><i class="sidenav-icon ion ion-ios-checkbox"></i>
                    <div>Tests</div>
                </a>
            </router-link>
            <router-link v-if="profile.role === 'admin'" :to="{ name : 'statistics'}" tag="li" class="sidenav-item">
                <a class="sidenav-link"><i class="sidenav-icon ion ion-md-analytics"></i>
                    <div>Statistics</div>
                </a>
            </router-link>
        </ul>
    </div>
</template>

<script>
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            return {profile: computed(() => store.getters.getProfile)}
        }
    };
</script>
