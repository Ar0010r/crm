<template>
    <StatisticsTableBundle/>
</template>

<script>
    import StatisticsTableBundle from '../components/tables/statistics/StatisticsTableBundle';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let lettersAreUndefined = Object.keys(store.getters.getLetters).length === 0;
            let monthlyStatisticsUndefined = Object.keys(store.getters.getMonthlyStatistics).length === 0;
            let statisticsUndefined = Object.keys(store.getters.getStatistics).length === 0;

            if (lettersAreUndefined) store.dispatch('letter/setLettersToStore');
            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            if (rolesAreUndefined) store.dispatch('user/setRolesToStore');
            if (monthlyStatisticsUndefined) store.dispatch('employee/setStatisticsToStore');
            if (statisticsUndefined) store.dispatch('company/setStatisticsToStore');

        },
        components: {
            StatisticsTableBundle,
        }
    };
</script>
