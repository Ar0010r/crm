<template>
    <tr class="odd gradeX d-flex">
        <td class="col-1 pr-0">{{company.created_at}}</td>
        <td class="col-2">{{company.name}}</td>
        <td class="col-5 d-flex flex-column" >
            <a :href="company.domain">{{company.domain}}</a>
            <div>{{company.email}}</div>
        </td>
        <td class="col-2">{{company.pseudonym}}</td>
        <td class="col-1">
            <div>
                <i>total:</i> <span>{{company.employees_count}}</span>
            </div>
            <div>
                <i>hired:</i> <span>{{company.good_employees_count}}</span>
            </div>
        </td>
        <td class="col-1">
            <div v-if="company.good_employees_count !== 0">
                <span>rate:</span> <span>{{(company.good_employees_count/company.employees_count * 100).toFixed(2)}}%</span>
            </div>
            <div v-else>rate: 0%</div>
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
