<template>
    <EmployeesTable/>

    <StoreEmployeeForm/>
    <FileInputForm/>
    <EditEmployeeForm/>

</template>

<script>
    import EmployeesTable from '../components/tables/employees/EmployeesTable';

    import StoreEmployeeForm from '../components/modals/employee/StoreEmployeeForm';
    import EditEmployeeForm from '../components/modals/employee/EditEmployeeForm';
    import FileInputForm from '../components/modals/employee/FileInputForm';

    import {useStore} from 'vuex';
    import {inject} from 'vue';

    export default {
        setup() {
            const container = inject('container');
            let store = useStore();

            let statusesAreUndefined = Object.keys(store.getters.getStatuses).length === 0;
            let racesAreUndefined = Object.keys(store.getters.getRaces).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let employeesAreUndefined = Object.keys(store.getters.getEmployees).length === 0;
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;

            if (statusesAreUndefined) store.dispatch('employee/setStatusesToStore');
            //if (statusesAreUndefined) container.EmployeeService.setStatusesToStore();

            if (racesAreUndefined) store.dispatch('employee/setRacesToStore');
            //if (racesAreUndefined) container.EmployeeService.setRacesToStore();

            if (companiesAreUndefined) store.dispatch('company/setCompaniesToStore');
            //if (companiesAreUndefined) container.CompanyService.setCompaniesToStore();

            if (employeesAreUndefined) store.dispatch('employee/setEmployeesToStore');
            //if (employeesAreUndefined) container.EmployeeService.setEmployeesToStore();

            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            //if (usersAreUndefined) container.UserService.setUsersToStore();
        },

        components: {
            EmployeesTable,
            StoreEmployeeForm,
            EditEmployeeForm,
            FileInputForm
        }
    };
</script>
