<template>
    <tr class="odd gradeX">
        <td class= "pr-0">{{letter.received_at}}</td>
        <td class="" >{{letter.google}}</td>
        <td class="" >{{letter.outlook}}</td>
        <td class="" >{{letter.yahoo}}</td>
        <td class="" >{{letter.other}}</td>
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
        components: {
            DeleteButton,
            EditButton
        }
    };
</script>
