<template>
    <tr class="odd gradeX">
        <td>{{employee.created_at}}</td>
        <td>{{employee.hr.login}}</td>
        <td>{{employee.company.name}}</td>
        <td class="d-flex flex-column border-0">
            <p class="m-0 p-0">{{employee.name}} <i>{{employee.race}}</i></p>
            <i>{{employee.birthday}}</i>
        </td>
        <td>
            <p class="m-0 p-0">{{employee.email}}</p>
            <p class="m-0 p-0">{{employee.paypal}}</p>
        </td>
        <td>{{employee.address + employee.state + employee.zip}}</td>
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
                        @click="putEmployeeInfoToStore"
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
    export default {
        mounted(){

        },
        setup(){



        },
        methods: {
            putEmployeeInfoToStore(){
                this.$store.commit('setEmployee', this.employee);
            }
        },
        props: {employee: Object},
        components: {
            StatusSelect
        }
    };
</script>
