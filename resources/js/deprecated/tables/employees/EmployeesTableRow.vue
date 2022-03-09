<template>
    <tr class="odd gradeX">
        <td style="text-align: center; vertical-align: middle;">
            <Checkbox :employee=employee />
        </td>
        <td class="text-center">
            <p class="m-0">{{employee.created_at}}</p>
            <p class="m-0">HR : {{employee.hr.login}}</p>
        </td>
        <td v-if="employee.company">{{employee.company.name}}</td>
        <td v-else></td>
        <td>
            <p class="m-0 p-0">{{employee.name}}</p>
            <div>
                <i class="mr-1">{{employee.birthday}}</i>
                <i class="mr-1">{{employee.race}}</i>
                <strong class="mr-1 m-0 p-0 text-success" v-if="employee.pickup == 1">P</strong>
            </div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <i class="fas fa-envelope d-block" v-if="employee.email" ></i>
                <p class="m-0 ml-1 p-0">{{employee.email}}</p>
            </div>
            <div class="d-flex align-items-center" v-if="employee.paypal" >
                <i class="fab fa-paypal d-block"></i>
                <p class="m-0 ml-1 p-0">{{employee.paypal}}</p>
            </div>
            <div class="d-flex mt-2 align-items-center" v-if="employee.phone_1 || employee.phone_2" >
                <i class="fas fa-phone-volume d-block"></i>
                <span class="m-0 p-0 ml-1">{{employee.phone_1}}</span>
                <span class="m-0 p-0 ml-1 pl-1" style="border-left: 1px solid gray" >{{employee.phone_2}}</span>
            </div>
        </td>
        <td>
            <span>{{employee.address}}</span> <br>
            <span>{{employee.city}}</span> <span>{{' '}}</span>
            <span>{{employee.state}}</span> <span>{{' '}}</span>
            <span>{{employee.zip}}</span> <span>{{' '}}</span>
        </td>
        <td style="text-align: center; vertical-align: middle;" >
            <StatusSelect v-if="employee.status"
                          :status='employee.status'
                          :id='employee.id'
                          :update-on-select='true'
            />
            <ContactedField :employee="employee"/>


        </td>
        <td style="text-align: center; vertical-align: middle;">
           <div class="d-flex justify-content-between align-items-center">
               <EditButton :employee="employee"></EditButton>
               <ContactedButton :employee="employee"/>
               <ExportButton :employee="employee"></ExportButton>
               <DeleteButton :employee="employee"></DeleteButton>
           </div>

        </td>
    </tr>
</template>

<script>
    import StatusSelect from '../../../components/Applicant/Table/Row/StatusSelect';
    import DeleteButton from './actions/DeleteButton';
    import ContactedButton from '../../../components/Applicant/Table/Row/ContactedButton';
    import ExportButton from './actions/ExportButton';
    import ContactedField from '../../../components/Applicant/Table/Row/ContactedField';
    import EditButton from './actions/EditButton';
    import Checkbox from '../../../components/Applicant/Table/Row/RowCheckbox';
    import {useStore} from 'vuex'

    export default {
        setup(props) {
            const store = useStore();
            const employeeModel = {...store.getters.getApplicantModel};

            if (!props.employee.company) props.employee.company = {...props.employee.company, ...employeeModel.company};
            if (!props.employee.hr) props.employee.hr = {...props.employee.hr, ...employeeModel.hr};
        },
        props: {
            employee: Object
        },
        components: {
            ContactedButton,
            ContactedField,
            StatusSelect,
            DeleteButton,
            ExportButton,
            EditButton,
            Checkbox
        }
    };
</script>
