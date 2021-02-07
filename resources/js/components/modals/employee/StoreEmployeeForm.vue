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
                    <EmployeeFormFields :employee='emptyEmployee'></EmployeeFormFields>
                    <EmployeePickUpField></EmployeePickUpField>
                </div>
                <div class="modal-footer">
                    <button id="storeEmployeeFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button @click.prevent="storeEmployee()" type="button" class="btn btn-primary">Add</button>
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
            return {emptyEmployee: computed(() => useStore().getters.getEmployee)}
        },

        methods : {
            async storeEmployee() {

                let employee = this.$store.getters.getEmployee;

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

                console.log('before store', employee);

                let result = await axios.post('api/employees', data);
                if(result.status === 200){
                    console.log('upadted on server and now commit to store', employee);
                    console.log(result.data.employee);
                    this.$store.commit('setEmployee', this.emptyEmployee);
                    this.$store.commit('setEmployeeById', result.data.employee);
                    document.getElementById('storeEmployeeFormClose').click()
                }

            }
        },
        components: {
            EmployeeFormFields,
            EmployeePickUpField
        }
    };
</script>
