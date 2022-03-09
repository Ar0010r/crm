<template>
<!--    <PersonnelRow v-if="profileIsHr" />-->
    <AdminRow v-if="profileIsAdmin" :record="record" />
</template>

<script>
    import AdminRow from './layouts/AdminPersonnelStatisticsTableRow';
    import PersonnelRow from './layouts/PersonnelStatisticsTableRow';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {record: Object},
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
            PersonnelRow
        }
    };
</script>
