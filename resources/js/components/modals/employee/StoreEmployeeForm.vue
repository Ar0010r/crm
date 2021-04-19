<template>
    <div class="modal fade" id="storeEmployeeForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add employee
                        <div class="d-flex flex-column mt-1">
                            <small class="text-muted">We advice to use standard address format with 9-digit zip-code
                            </small>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body pb-0">
                    <EmployeeFormFields :employee='employee'></EmployeeFormFields>
                    <EmployeePickUpField :employee.sync='employee'></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button id="storeEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button :disabled='!employee.dataIsValid'  @click.prevent="storeEmployee()" type="button" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import EmployeeFormFields from './fields/EmployeeFormFields'
    import EmployeePickUpField from './fields/EmployeePickUpField'
    import axios from 'axios';
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {

            const store = useStore();
            const employee = computed(() => store.getters.getEmployee);

            async function storeEmployee() {

                let employeeToStore = store.getters.getEmployee;

                let companies = store.getters.getCompanies;
                let users = store.getters.getUsers;
                const emptyEmployee = store.getters.getEmptyEmployee;

                const data = {...emptyEmployee, ...employeeToStore};

                try{
                    let result = await axios.post('api/employees', data);

                    let savedEmployee = result.data.employee;
                    savedEmployee.company = companies[data.company_id] ?? {};
                    savedEmployee.hr = users[savedEmployee.hr_id];


                    store.commit('formData/setEmployee', emptyEmployee);
                    store.commit('employee/setEmployeeById', savedEmployee);

                    document.getElementById('storeEmployeeFormClose').click()
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data)
                }
            }

            return {storeEmployee, employee,}
        },

        methods : {

        },
        components: {
            EmployeeFormFields,
            EmployeePickUpField
        }
    };
</script>
