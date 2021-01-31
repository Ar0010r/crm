<template>
    <div class="modal fade" id="editEmployeeForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit employee
                        <div class="d-flex flex-column mt-1">
                            <small class="text-muted">We advice to use standard address format with 9-digit zip-code
                            </small>
                        </div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body pb-0">
                    <EmployeeFormFields :employee.sync='employee'></EmployeeFormFields>
                    <EmployeeStatusField :employee.sync='employee'></EmployeeStatusField>
                    <EmployeePickUpField :employeePickUp='employee.pickup'></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click.prevent="updateEmployee" type="button" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import EmployeeFormFields from './fields/EmployeeFormFields';
    import EmployeeStatusField from './fields/EmployeeSatusField.vue';
    import EmployeePickUpField from './fields/EmployeePickUpField';
    import {useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        setup(){

            return {employee: computed(() => useStore().getters.getEmployee)}
        },

        methods: {
            updateEmployee(){
               let data = $('#editEmployeeForm').serialize();

               console.log(data);
            }
        },

        components : {
            EmployeeFormFields,
            EmployeeStatusField,
            EmployeePickUpField,
        }
    };
</script>

