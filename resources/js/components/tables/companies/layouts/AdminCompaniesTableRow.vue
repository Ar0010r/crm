<template>
    <tr class="odd gradeX d-flex">
        <td class="col-1 pr-0">{{company.created_at}}</td>
        <td  class="col-1">{{company.personnel.login}}</td>
        <td class="col-2" >{{company.name}}</td>
        <td class="col-4 d-flex flex-column" >
            <a :href="company.domain">{{company.domain}}</a>
            <div>{{company.email}}</div>
        </td>
        <td class="col-2" >{{company.pseudonym}}</td>
        <td class="col-1" >
            <div>
                <i>total:</i> <span>{{company.employees_count}}</span>
            </div>
            <div>
                <i>exported:</i> <span>{{company.exported_employees_count}}</span>
            </div>
            <div v-if="company.exported_employees_count !== 0">
                <span>rate:</span> <span>{{Math.round(company.exported_employees_count/company.employees_count * 100)}}%</span>
            </div>
            <div v-else>rate: 0%</div>
        </td>
        <td class="d-flex col-1 justify-content-between align-items-center ">
            <EditButton :company="company" />
            <DeleteButton :company="company" />
        </td>
    </tr>
</template>

<script>
    import DeleteButton from '../actions/DeleteButton';
    import EditButton from '../actions/EditButton';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {company: Object},
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
