<template>
    <CompaniesTable/>
    <CreateCompanyForm/>
    <EditCompanyForm/>
</template>

<script>
    import CompaniesTable from '../components/tables/companies/CompaniesTable';
    import CreateCompanyForm from '../components/modals/company/CreateCompanyForm';
    import EditCompanyForm from '../components/modals/company/EditCompanyForm';

    import {useStore} from 'vuex';
    import {inject} from 'vue';

    export default {
        setup() {
            let store = useStore();
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let employeesAreUndefined = Object.keys(store.getters.getEmployees).length === 0;

            if (companiesAreUndefined) store.dispatch('company/setCompaniesToStore');
            if (employeesAreUndefined) store.dispatch('employee/setEmployeesToStore');
            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
        },
        components: {
            CompaniesTable,
            CreateCompanyForm,
            EditCompanyForm
        }
    };
</script>
