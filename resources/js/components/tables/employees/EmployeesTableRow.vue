<template>
    <tr class="odd gradeX">
        <td>{{employee.created_at}}</td>
        <td>{{employee.hr.login}}</td>
        <td v-if="employee.company">{{employee.company.name}}</td>
        <td v-else></td>
        <td class="d-flex flex-column border-0">
            <p class="m-0 p-0">{{employee.name}}</p>
            <div class="d-flex">
                <i class="mr-1">{{employee.birthday}}</i>
                <i class="mr-1">{{employee.race}}</i>
                <strong class="mr-1 m-0 p-0 text-success" v-if="employee.pickup == 1">P</strong>
            </div>
        </td>
        <td>
            <p class="m-0 p-0">{{employee.email}}</p>
            <p class="m-0 p-0">{{employee.paypal}}</p>
        </td>
        <td>
            <span>{{employee.address}}</span> <br>
            <span>{{employee.city}}</span> <span>{{' '}}</span>
            <span>{{employee.state}}</span> <span>{{' '}}</span>
            <span>{{employee.zip}}</span> <span>{{' '}}</span>
        </td>
        <td>
            <p class="m-0 p-0">{{employee.phone_1}}</p>
            <p class="m-0 p-0">{{employee.phone_2}}</p>
        </td>

        <td>
          <!--  <span class="badge badge-outline-success">Active</span>-->
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
    import StatusSelect from '../../layout/EmployeesStatusSelect';
    import {useStore} from 'vuex';
    import {watch} from 'vue';

    export default {

        setup(props) {

        },
        methods: {
            putEmployeeInfoToStore(employee) {
                let object = {
                    id: employee.id ?? "",
                    name: employee.name ?? "",
                    email: employee.email ?? "",
                    paypal: employee.paypal ?? "",
                    company: employee.company ?? "",
                    company_id: employee.company_id ?? "",
                    address: employee.address ?? "",
                    city: employee.city ?? "",
                    state: employee.state ?? "",
                    zip: employee.zip ?? "",
                    phone_1: employee.phone_1 ?? "",
                    phone_2: employee.phone_2 ?? "",
                    birthday: employee.birthday ?? null,
                    race: employee.race ?? "",
                    status: employee.status ?? "",
                    pickup: employee.pickup ?? "",
                }
                this.$store.commit('formData/setEmployee', object);
                //this.$store.commit('employee/setEmployee', object);
            }
        },
        props: {employee: Object},
        components: {
            StatusSelect
        }
    };
</script>
