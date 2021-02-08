<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Employees
        </h4>
        <EmployeesTableControl></EmployeesTableControl>

        <div class="table-responsive">
            <table v-if="employees" class="datatables-demo table table-striped table-bordered">
                <EmployeesTableHead/>
                <tbody>
                <EmployeesTableRow
                        v-for="employee in employees"
                        :key="employee.id"
                        :employee.sync='employee'
                >
                </EmployeesTableRow>
                <EmptyTableRow></EmptyTableRow>
                <EmptyTableRow></EmptyTableRow>
                <EmptyTableRow></EmptyTableRow>
                <EmptyTableRow></EmptyTableRow>
                <EmptyTableRow></EmptyTableRow>
                <EmptyTableRow></EmptyTableRow>
                <EmptyTableRow></EmptyTableRow>


                </tbody>
            </table>
            <Pagination></Pagination>
        </div>
    </div>
</template>

<script>
    import EmployeesTableControl from './EmployeesTableControl.vue';
    import EmployeesTableRow from './EmployeesTableRow.vue';
    import EmptyTableRow from '../../layout/EmptyEmployeesTableRow';
    import EmployeesTableHead from './EmployeesTableHead.vue';
    import Pagination from '../../layout/Pagination.vue';
    import StoreEmployeeForm from '../../modals/employee/StoreEmployeeForm';
    import EditEmployeeForm from '../../modals/employee/EditEmployeeForm';
    import FileInputForm from '../../modals/employee/FileInputForm';
    import {computed} from 'vue';
    import{useStore} from 'vuex';

    export default {
        setup(){
            return {employees: computed(() => useStore().getters.getEmployees)}
        },

        components: {
            EmployeesTableControl,
            EmployeesTableRow,
            EmployeesTableHead,
            Pagination,
            StoreEmployeeForm,
            EditEmployeeForm,
            FileInputForm,
            EmptyTableRow
        }
    };
</script>
