<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Applicants
        </h4>
        <EmployeesTableControl/>

        <div class="table-responsive">
            <table v-if="employees !== {}" class="datatables-demo table table-striped table-bordered">
                <EmployeesTableHead/>
                <tbody>
                <EmployeesTableRow
                        v-for="employee in employees"
                        :key="employee.id"
                        :employee.sync='employee'
                >
                </EmployeesTableRow>
                <EmptyTableRow
                        v-if="8 - Object.keys(employees).length > 0"
                        v-for="n in (8 - Object.keys(employees).length)"/>
                </tbody>
            </table>
            <Pagination :data="pagination"/>
        </div>
    </div>
</template>

<script>
    import EmployeesTableControl from './actions/EmployeesTableControl.vue';
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
            return {
                employees: computed(() => useStore().getters.getEmployees),
                pagination: computed(() => useStore().getters.getEmployeesPagination),
            }
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