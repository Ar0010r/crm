<template>
    <EmployeesTable/>

    <FileInputForm/>
    <EditEmployeeForm/>
    <StoreEmployeeForm/>

</template>

<script>
    import EmployeesTable from '../tables/employees/EmployeesTable';

    import StoreEmployeeForm from '../modals/employee/StoreEmployeeForm';
    import EditEmployeeForm from '../modals/employee/EditEmployeeForm';
    import FileInputForm from '../../components/Applicant/Modal/ImportForm';

    import {useStore} from 'vuex';
    import {inject} from 'vue';

    export default {
        setup() {
            let store = useStore();

            let statusesAreUndefined = Object.keys(store.getters.getStatuses).length === 0;
            let racesAreUndefined = Object.keys(store.getters.getRaces).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let employeesAreUndefined = Object.keys(store.getters.getApplicants).length === 0;
            let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;

            if (statusesAreUndefined) store.dispatch('applicant/getStatuses');
            if (racesAreUndefined) store.dispatch('applicant/getRaces');
            if (companiesAreUndefined) store.dispatch('company/get');
            if (employeesAreUndefined) store.dispatch('applicant/get');
            if (usersAreUndefined) store.dispatch('manager/get');
        },

        components: {
            EmployeesTable,
            StoreEmployeeForm,
            EditEmployeeForm,
            FileInputForm
        }
    };
</script>
