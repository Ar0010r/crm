<template>
    <HrRow v-if="profileIsHr" />
    <AdminRow v-if="profileIsTopHr || profileIsAdmin" v-for="hr in hrs" :hr="hr" />
</template>

<script>
    import AdminRow from './layouts/AdminTotalLettersTableRow';
    import HrRow from './layouts/HrTotalLettersTableRow';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup(){
            const store = useStore();

            return {
                profile: computed(() => store.getters.getProfile),
                hrs: computed(() => store.getters.getHrs),
                profileIsAdmin: computed(() => {
                    return store.getters.getProfile.role === 'admin'
                }),
                profileIsTopHr: computed(() => {
                    return store.getters.getProfile.role === 'top hr'
                }),
                profileIsHr: computed(() => {
                    return store.getters.getProfile.role === 'hr'
                })
            }
        },
        components: {
            AdminRow,
            HrRow
        }
    };
</script>
