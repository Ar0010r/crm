<template>
    <tr class="odd gradeX">
        <td style="text-align: center; vertical-align: middle;">
            <Checkbox :employee=employee />
        </td>
        <td class="text-center">{{employee.created_at}}</td>
        <td v-if="employee.hr">{{employee.hr.login}}</td>
        <td v-else></td>
        <td v-if="employee.company">{{employee.company.name}}</td>
        <td v-else></td>
        <td class="d-flex flex-column">
            <p class="m-0 p-0">{{employee.name}}</p>
            <div>
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
            <StatusSelect v-if="employee.status"
                          :status='employee.status'
                          :id='employee.id'
                          :update-on-select='true'
            />
        </td>
        <!--<td class="d-flex justify-content-between align-items-center">-->
        <td class="">
           <div class="d-flex justify-content-between align-items-center">
               <EditButton :employee="employee"></EditButton>
               <DeleteButton :employee="employee"></DeleteButton>
           </div>
        </td>
    </tr>
</template>

<script>
    import StatusSelect from '../../layout/EmployeesStatusSelect';
    import DeleteButton from './actions/DeleteButton';
    import EditButton from './actions/EditButton';
    import Checkbox from './control/RowCheckbox';
    import {useStore} from 'vuex'

    export default {
        setup(props) {
            const store = useStore();
            const emptyEmployee = {...store.getters.getEmptyEmployee};

            if (!props.employee.company) props.employee.company = {...props.employee.company, ...emptyEmployee.company};
            if (!props.employee.hr) props.employee.hr = {...props.employee.hr, ...emptyEmployee.hr};
        },
        props: {
            employee: Object
        },
        components: {
            StatusSelect,
            DeleteButton,
            EditButton,
            Checkbox
        }
    };
</script>
