<template>
    <HrRow v-if="profileIsHr" :letter="letter" />
    <AdminRow v-if="profileIsTopHr || profileIsAdmin" :letter="letter" />
</template>

<script>
    import AdminRow from './layouts/AdminLettersTableRow';
    import HrRow from './layouts/HrLettersTableRow';
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
                profileIsTopHr: computed(() => {
                    return store.getters.getProfile.role === 'top hr'
                }),
                profileIsHr: computed(() => {
                    return store.getters.getProfile.role === 'hr'
                })
            }
        },
        props: {letter: Object},
        components: {
            AdminRow,
            HrRow
        }
    };
</script>
