<template>
    <tr class="odd gradeX">
        <td class=" pr-0">{{company.created_at}}</td>
        <td  class="">{{company.manager.login}}</td>
        <td class="" >{{company.name}}</td>
        <td class=" d-flex flex-column" >
            <a :href="company.domain">{{company.domain}}</a>
            <div>{{company.email}}</div>
        </td>
        <td>{{company.pseudonym}}</td>
        <td>
           <div class="d-flex justify-content-between align-items-center">
               <EditButton :company="company" />
               <DeleteButton :company="company" />
           </div>
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
