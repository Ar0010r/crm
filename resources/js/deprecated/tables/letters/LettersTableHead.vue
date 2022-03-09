<template>
    <HrHead v-if="profileIsHr" />
    <AdminHead v-if="profileIsPersonnel || profileIsAdmin" />
</template>

<script>
    import AdminHead from './layouts/AdminLettersTableHead'
    import HrHead from './layouts/HrLettersTableHead'
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            return {
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
        components: {
            AdminHead,
            HrHead
        }
    };
</script>
