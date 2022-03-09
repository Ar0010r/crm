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
                    <EmployeeFormFields ref="employeeFields" :employee.sync='employee'></EmployeeFormFields>
                    <EmployeePickUpField :employee.sync='employee'></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button id="editEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click.prevent="updateEmployee" type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed, reactive, inject, ref, onBeforeUnmount} from 'vue';
    import moment from 'moment';
    import EmployeeFormFields from './fields/EmployeeFormFields';
    import EmployeePickUpField from './fields/EmployeePickUpField';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject("container");
            const employeeModel = {...store.getters.getApplicantModel};
            let companies = computed(() => store.getters.getCompanies);
            const employeeFields = ref(null);
            let employee = reactive({...employeeModel});

            emitter.on('edit-employee-form', setEmployee);
            onBeforeUnmount(() => emitter.off('edit-employee-form', setEmployee));

            async function updateEmployee() {
                try {
                    await employeeFields.value.validate();
                    moment.locale('en-ca');
                    let date = moment().format('L');

                    moment.locale('fr');
                    let time = moment().format('LTS');

                    employee.contacted = date + " " + time;
                    await container.EmployeeService.update(employee);

                    if(employee.company) employee.company = companies.value[employee.company_id];
                    else employee.company = {...employee.company, ...employeeModel.company};

                    store.commit('employee/set', employee)
                    emitter.emit('notification-success', ' applicant was updated');
                    document.getElementById('editEmployeeFormClose').click()
                } catch (e) {
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }
            }

            function setEmployee(employeeData) {
                Object.keys(employeeData).forEach(key => employee[key] = employeeData[key])
            }
            return {employee, employeeFields,  updateEmployee}
        },
        components: {
            EmployeeFormFields,
            EmployeePickUpField,
        }
    };
</script>

