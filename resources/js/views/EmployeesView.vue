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
    import {computed} from 'vue';

    export default {
        setup(){
            let statusesAreUndefined = Object.keys(useStore().state.statuses).length === 0;
            let racesAreUndefined = Object.keys(useStore().state.races).length === 0;
            let companiesAreUndefined = Object.keys(useStore().state.companies).length === 0;

            if (statusesAreUndefined) useStore().commit('setStatuses');
            if (racesAreUndefined) useStore().commit('setRaces');
            if (companiesAreUndefined) useStore().commit('setCompanies');

            let employee = computed(() => this.$store.getters.getEmployee);
            //let employee = computed(() => useStore().getters.getEmployee);

            return {employee}

        },
        components: {
            EmployeesTable,
            StoreEmployeeForm,
            EditEmployeeForm,
            FileInputForm
        }
    };
</script>
