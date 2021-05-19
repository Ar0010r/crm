<template>
    <ManagersTableBundle/>
    <StoreManagerForm/>
    <EditManagerForm/>
</template>

<script>
    import ManagersTableBundle from '../components/tables/managers/ManagersTableBundle.vue';
    import StoreManagerForm from '../components/modals/manager/CreateManagerForm.vue';
    import EditManagerForm from '../components/modals/manager/EditManagerForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let employeesAreUndefined = Object.keys(store.getters.getEmployees).length === 0;

            if (companiesAreUndefined) store.dispatch('company/setCompaniesToStore');
            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            if (employeesAreUndefined) store.dispatch('employee/setEmployeesToStore');
            if (rolesAreUndefined) store.dispatch('user/setRolesToStore');
        },
        components: {
            ManagersTableBundle,
            StoreManagerForm,
            EditManagerForm,
        }
    };
</script>
