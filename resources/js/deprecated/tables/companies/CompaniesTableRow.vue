<template>
    <HrRow v-if="profileIsHr" :company="company" />
    <AdminRow v-if="profileIsPersonnel || profileIsAdmin" :company="company" />
</template>

<script>
    import AdminRow from './layouts/AdminCompaniesTableRow';
    import HrRow from './layouts/HrCompaniesTableRow';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup(){
            const store = useStore();

            return {
                profile: computed(() => store.getters.getProfile),
                profileIsAdmin: computed(() => {
                    return store.getters.getProfile.role === 'admin'
                }),
                profileIsPersonnel: computed(() => {
                    return store.getters.getProfile.role === 'personnel'
                }),
                profileIsHr: computed(() => {
                    return store.getters.getProfile.role === 'hr' || store.getters.getProfile.role === 'top hr'
                })
            }
        },
        props: {company: Object},
        components: {
            AdminRow,
            HrRow
        }
    };
</script>
