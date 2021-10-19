<template>
    <tr class="odd gradeX">
        <td class=" pr-0">{{letter.received_at}}</td>
        <td  class="">{{letter.hr.login}}</td>
        <td v-if="letter.company">{{letter.company.name}}</td>
        <td v-else>please add company</td>
        <td class="" >{{letter.google}}</td>
        <td class="" >{{letter.outlook}}</td>
        <td class="" >{{letter.yahoo}}</td>
        <td class="" >{{letter.other}}</td>
        <td class="" >{{total}}</td>
        <td class="d-flex  justify-content-between align-items-center ">
            <EditButton :letter="letter" />
            <DeleteButton :letter="letter" />
        </td>
    </tr>
</template>

<script>
    import DeleteButton from '../actions/DeleteButton';
    import EditButton from '../actions/EditButton';
    import{useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {letter: Object},
        setup(props){
            return {
                total: computed(() =>
                    parseInt(props.letter.google) +
                    parseInt(props.letter.outlook) +
                    parseInt(props.letter.yahoo) +
                    parseInt(props.letter.other)
                ),
            }
        },
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
