<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Applicants
        </h4>
        <EmployeesTableControl/>

        <div v-if="Object.keys(employees).length > 0" class="table-responsive">
            <table class="datatables-demo table table-striped table-bordered">
                <EmployeesTableHead/>
                <tbody>
                <EmployeesTableRow
                        v-for="employee in employees"
                        :key="employee.id"
                        :employee.sync='employee'
                >
                </EmployeesTableRow>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import EmployeesTableControl from './control/EmployeesTableControl.vue';
    import EmployeesTableRow from './EmployeesTableRow.vue';
    import EmployeesTableHead from './EmployeesTableHead.vue';
    import StoreEmployeeForm from '../../modals/employee/StoreEmployeeForm';
    import EditEmployeeForm from '../../modals/employee/EditEmployeeForm';
    import FileInputForm from '../../../components/Applicant/Modal/FileInputForm';
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore()
            return {
                employees: computed(() => store.getters.getApplicants),
                pagination: computed(() => store.getters.getApplicantsMeta),
            }
        },

        components: {
            EmployeesTableControl,
            EmployeesTableHead,
            StoreEmployeeForm,
            EmployeesTableRow,
            EditEmployeeForm,
            FileInputForm,
        }
    };
</script>
