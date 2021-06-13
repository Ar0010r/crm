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
                    <EmployeeFormFields ref="employeeFields" :employee='employee'></EmployeeFormFields>
                    <EmployeePickUpField :employee.sync='employee'></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button id="storeEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button @click.prevent="storeEmployee()" type="button"
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
    import {computed, reactive, inject, ref, onBeforeUnmount} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject("container");
            let companies = computed(() => store.getters.getCompanies);
            const emptyEmployee = { ...store.getters.getEmptyEmployee};
            const employeeFields = ref(null);

            let employee = reactive({...emptyEmployee});

            async function storeEmployee() {
                try {
                    await employeeFields.value.validate();
                    let result = await container.EmployeeService.store(employee);

                    let savedEmployee = result.data.employee;

                    if(savedEmployee.company_id) savedEmployee.company = companies.value[savedEmployee.company_id];
                    else savedEmployee.company = emptyEmployee.company;

                    store.commit('employee/setEmployeeById', savedEmployee);
                    clearForm();
                    emitter.emit('notification-success', ' applicant was added');
                    document.getElementById('storeEmployeeFormClose').click();
                } catch (e) {
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }
            }

            const clearForm = () => Object.keys(emptyEmployee).forEach(key => employee[key] = emptyEmployee[key]);
            emitter.on('create-employee-form', clearForm);
            onBeforeUnmount(() => emitter.off('create-employee-form', clearForm));

            return {storeEmployee, employeeFields, employee}
        },

        components: {
            EmployeeFormFields,
            EmployeePickUpField
        }
    };
</script>
