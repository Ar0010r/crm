<template>
    <StatisticsTableBundle/>
</template>

<script>
    import StatisticsTableBundle from '../components/Statistics/Wrapper';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let lettersAreUndefined = Object.keys(store.getters.getMails).length === 0;
            let statisticsUndefined = Object.keys(store.getters.getStatistics).length === 0;

            if (lettersAreUndefined) store.dispatch('mail/get');
            if (usersAreUndefined) store.dispatch('manager/get');
            if (rolesAreUndefined) store.dispatch('manager/setRoles');
            if (statisticsUndefined) store.dispatch('company/statistics');

        },
        components: {
            StatisticsTableBundle,
        }
    };
</script>
