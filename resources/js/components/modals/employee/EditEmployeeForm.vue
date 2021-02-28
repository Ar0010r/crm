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
                    <EmployeeStatusField v-if="employee.id" :employee.sync='employee'></EmployeeStatusField>
                    <EmployeePickUpField :employee.sync='employee'></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button id="editEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button :disabled='!employee.dataIsValid'  @click.prevent="updateEmployee(employee)" type="button" class="btn btn-primary">Update</button>
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

            const store = useStore();
            return {
                employee: computed(() => store.getters.getEmployee)
            }
        },

        methods: {
           async updateEmployee(employee) {

               let companies = await this.$store.getters.getCompanies;

               let company = companies[employee.company_id];

               console.log('company' ,company)

                let data = {
                    id:employee.id,
                    address: employee.address ?? "",
                    birthday: employee.birthday ?? "",
                    city: employee.city ?? "",
                    company_id: employee.company_id ?? "",
                    company: company ?? "",
                    email: employee.email ?? null,
                    name: employee.name ?? "",
                    paypal: employee.paypal ?? null,
                    phone_1: employee.phone_1 ?? "",
                    phone_2: employee.phone_2 ?? "",
                    race: employee.race ?? "",
                    state: employee.state ?? "",
                    zip: employee.zip ?? "",
                    pickup: employee.pickup ?? "",
                };

                console.log('beforeupdate', employee);
                console.log('beforeupdate data', data);

                let result = await axios.put('api/employees/' + employee.id, data);
                if(result.status === 204){
                    this.$store.commit('employee/setEmployeeById', data)
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

