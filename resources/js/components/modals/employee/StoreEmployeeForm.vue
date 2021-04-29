<template>
    <div class="modal fade" id="storeEmployeeForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add applicant
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
                    <button id="storeEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button :disabled='!employee.dataIsValid' @click.prevent="storeEmployee()" type="button"
                            class="btn btn-primary">Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import EmployeeFormFields from './fields/EmployeeFormFields'
    import EmployeePickUpField from './fields/EmployeePickUpField'
    import axios from 'axios';
    import {computed, reactive, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            let companies = computed(() => store.getters.getCompanies);
            const emptyEmployee = { ...store.getters.getEmptyEmployee};

            let employee = reactive({...emptyEmployee});

            emitter.on('create-employee-form', () => clearForm());

            async function storeEmployee() {
                try {
                    let result = await axios.post('api/employees', employee);

                    let savedEmployee = result.data.employee;

                    if(savedEmployee.company_id) savedEmployee.company = companies.value[savedEmployee.company_id];
                    else savedEmployee.company = emptyEmployee.company;

                    //store.commit('formData/setEmployee', emptyEmployee);
                    store.commit('employee/setEmployeeById', savedEmployee);

                    clearForm();
                    document.getElementById('storeEmployeeFormClose').click();
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data)
                }
            }

            const clearForm = () => Object.keys(emptyEmployee).forEach(key => employee[key] = emptyEmployee[key]);

            return {storeEmployee, employee}
        },

        components: {
            EmployeeFormFields,
            EmployeePickUpField
        }
    };
</script>
