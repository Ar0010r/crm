<template>
    <tr class="odd gradeX">
        <td>{{employee.created_at}}</td>
        <td>{{employee.hr.login}}</td>
        <td v-if="employee.company">{{employee.company.name}}</td>
        <td class="d-flex flex-column border-0">
            <p class="m-0 p-0">{{employee.name}} <i>{{employee.race}}</i></p>
            <i>{{employee.birthday}}</i>
        </td>
        <td>
            <p class="m-0 p-0">{{employee.email}}</p>
            <p class="m-0 p-0">{{employee.paypal}}</p>
        </td>
        <td>{{employee.address +  employee.city + employee.state + employee.zip}}</td>
        <td>
            <p class="m-0 p-0">{{employee.phone_1}}</p>
            <p class="m-0 p-0">{{employee.phone_2}}</p>
        </td>

        <td>
            <StatusSelect v-if="employee.status"
                    :status='employee.status'
                    :id='employee.id'
                    :update-on-select='true'
            />
        </td>
        <td class="d-flex justify-content-center align-items-center border-0">
            <a data-toggle="modal" data-target="#editEmployeeForm">
                <button type="button" class="ion ion-md-create p-0 bg-transparent border-0"
                        data-toggle="tooltip" data-target="#editEmployeeForm"
                        data-placement="right" title="Edit"
                        @click="putEmployeeInfoToStore(employee)"
                >

                </button>
            </a>

        </td>
    </tr>
</template>

<script>
    //import StatusField from './EmployeesTableStatusField';
    import StatusSelect from '../../layout/EmployeesStatusSelect';
    import { useStore } from 'vuex';
    import { watch } from 'vue';
    export default {

        setup(props){

            console.log('table row', props.employee)
        },
        methods: {
            putEmployeeInfoToStore(employee){
                let object = {
                    id: employee.id,
                    name: employee.name,
                    email: employee.email,
                    paypal: employee.paypal,
                    company: employee.company,
                    company_id: employee.company_id,
                    address: employee.address,
                    city: employee.city,
                    state: employee.state,
                    zip: employee.zip,
                    phone_1: employee.phone_1,
                    phone_2: employee.phone_2,
                    birthday: employee.birthday,
                    race: employee.race,
                    status: employee.status,
                    pickup: employee.pickup,
                }
                console.log(object);
                this.$store.commit('setEmployee', object);
            }
        },
        props: {employee: Object},
        components: {
            StatusSelect
        }
    };
</script>
