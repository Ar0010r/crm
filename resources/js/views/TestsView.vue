<template>
    <TestsTable/>
    <StoreTestForm/>
    <EditTestForm/>
</template>

<script>
    import TestsTable from '../components/tables/tests/TestsTableWrap';
    import StoreTestForm from '../components/modals/test/CreateTestForm.vue';
    import EditTestForm from '../components/modals/test/EditTestForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();

            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let testsAreUndefined = Object.keys(store.getters.getTests).length === 0;

            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            if (testsAreUndefined) store.dispatch('test/setTestsToStore');
            if (companiesAreUndefined) store.dispatch('company/setCompaniesToStore');
        },
        components: {
            TestsTable,
            StoreTestForm,
            EditTestForm,
        }
    };
</script>
