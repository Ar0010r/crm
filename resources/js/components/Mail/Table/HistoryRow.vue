<template>
    <Row>
        <template v-slot:default>
            <td class=" pr-0">{{mail.received_at}}</td>
            <td  class="">{{mail.hr.login}}</td>
            <td v-if="mail.company">{{mail.company.name}}</td>
            <td v-else>please add company</td>
            <td class="" >{{mail.google}}</td>
            <td class="" >{{mail.outlook}}</td>
            <td class="" >{{mail.yahoo}}</td>
            <td class="" >{{mail.other}}</td>
            <td class="" >{{total}}</td>
            <td class="d-flex flex-column justify-content-start" >
                <ProgressBar :mail="mail"/>
            </td>
        </template>
        <template v-slot:actions>
            <EditButton :model="mail" target="#editMailForm" event="edit-mail-form"/>
            <DeleteButton
                :model="mail"
                event="delete-mail-"
                dispatch="mail/delete"
                :warning='"You want to delete mail received at:" + mail.received_at'/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/Row';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';
import ProgressBar from './ProgressBar';
import {computed} from "vue";

export default {
    props: {mail: Object},
    setup(props) {
        return {
            total: computed(() =>
                parseInt(props.mail.google) +
                parseInt(props.mail.outlook) +
                parseInt(props.mail.yahoo) +
                parseInt(props.mail.other)
            ),
        }
    },
    components: {
        Row,
        ProgressBar,
        DeleteButton,
        EditButton,

    }
};
</script>
