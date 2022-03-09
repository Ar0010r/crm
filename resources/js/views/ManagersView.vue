<template>
    <Table/>
    <StoreForm/>
    <EditForm/>
</template>

<script>
    import Table from '../components/Manager/Content';
    import StoreForm from '../components/Manager/Modal/CreateForm.vue';
    import EditForm from '../components/Manager/Modal/EditForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let employeesAreUndefined = Object.keys(store.getters.getApplicants).length === 0;

            if (companiesAreUndefined) store.dispatch('company/get');
            if (usersAreUndefined) store.dispatch('manager/get');
            if (employeesAreUndefined) store.dispatch('applicant/get');
            if (rolesAreUndefined) store.dispatch('manager/setRoles');
        },
        components: {
            Table,
            StoreForm,
            EditForm,
        }
    };
</script>
