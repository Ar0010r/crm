<template>
    <tr class="odd gradeX">
        <td class= "pr-0">{{letter.received_at}}</td>
        <td v-if="letter.company">{{letter.company.name}}</td>
        <td v-else>please add company</td>
        <td class="" >{{letter.google}}</td>
        <td class="" >{{letter.outlook}}</td>
        <td class="" >{{letter.yahoo}}</td>
        <td class="" >{{letter.other}}</td>
        <td class="" >{{total}}</td>
        <td class="d-flex flex-column justify-content-start" >
            <ProgressBar :letter="letter"/>
        </td>
        <td>
            <div class="d-flex  justify-content-between align-items-center ">
                <EditButton :letter="letter" />
                <DeleteButton :letter="letter" />
            </div>
        </td>
    </tr>
</template>

<script>
    import DeleteButton from '../actions/DeleteButton';
    import EditButton from '../actions/EditButton';
    import ProgressBar from '../../../../components/Mail/Table/ProgressBar';
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
            EditButton,
            ProgressBar
        }
    };
</script>
