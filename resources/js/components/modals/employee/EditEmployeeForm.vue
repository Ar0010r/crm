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
                    <button id="editEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click.prevent="updateEmployee(employee)" type="button" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import {useStore} from 'vuex';
    import {computed} from 'vue';
    import EmployeeFormFields from './fields/EmployeeFormFields';
    import EmployeeStatusField from './fields/EmployeeSatusField.vue';
    import EmployeePickUpField from './fields/EmployeePickUpField';
    import axios from 'axios';

    export default {
        setup() {

            return {employee: computed(() => useStore().getters.getEmployee)}
        },

        methods: {
           async updateEmployee(employee) {

                let data = {
                    address: employee.address ?? "",
                    birthday: employee.birthday ?? "",
                    city: employee.city ?? "",
                    company_id: employee.company_id ?? "",
                    email: employee.email ?? null,
                    name: employee.name ?? "",
                    paypal: employee.paypal ?? null,
                    phone_1: employee.phone_1 ?? "",
                    phone_2: employee.phone_2 ?? "",
                    race: employee.race ?? "",
                    state: employee.state ?? "",
                    zip: employee.zip ?? "",
                };

                console.log('beforeupdate', employee);

                let result = await axios.put('api/employees/' + employee.id, data);
                if(result.status === 204){
                    console.log('upadted on server and now commit to store', employee);
                    this.$store.commit('setEmployeeById', employee)
                    document.getElementById('editEmployeeFormClose').click()
                }

            },
        },

        components: {
            EmployeeFormFields,
            EmployeeStatusField,
            EmployeePickUpField,
        }
    };
</script>

