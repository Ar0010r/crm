<template>
    <div class="modal fade" id="editEmployeeForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit applicant
                        <div class="d-flex flex-column mt-1">
                            <small class="text-muted">We advice to use standard address format with 9-digit zip-code
                            </small>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body pb-0">
                    <EmployeeFormFields :employee.sync='employee'></EmployeeFormFields>
                    <EmployeeStatusField v-if="employee.id" :employee.sync='employee'></EmployeeStatusField>
                    <EmployeePickUpField :employee.sync='employee'></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button id="editEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button :disabled='!employee.dataIsValid'  @click.prevent="updateEmployee" type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed, reactive, inject} from 'vue';
    import EmployeeFormFields from './fields/EmployeeFormFields';
    import EmployeeStatusField from './fields/EmployeeSatusField.vue';
    import EmployeePickUpField from './fields/EmployeePickUpField';
    import axios from 'axios';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            const emptyEmployee = {...store.getters.getEmptyEmployee};
            let companies = computed(() => store.getters.getCompanies);

            let employee = reactive({...emptyEmployee});

            emitter.on('edit-employee-form', employeeData => {
                Object.keys(employeeData).forEach(key => employee[key] = employeeData[key])
            });

            async function updateEmployee() {
                try {
                    await axios.put('api/employees/' + employee.id, employee);

                    if(employee.company) employee.company = companies.value[employee.company_id];
                    else employee.company = {...employee.company, ...emptyEmployee.company};

                    store.commit('employee/setEmployeeById', employee)
                    document.getElementById('editEmployeeFormClose').click()
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data)
                }
            }
            return {employee, updateEmployee}
        },
        components: {
            EmployeeFormFields,
            EmployeeStatusField,
            EmployeePickUpField,
        }
    };
</script>

