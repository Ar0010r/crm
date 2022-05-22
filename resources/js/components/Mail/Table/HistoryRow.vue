<template>
    <Row>
        <template v-slot:default>
            <td>{{mail.received_at}}</td>
            <td v-if="profileIsAdmin && mail.hr">{{mail.hr.login}}</td>
            <td>{{mail.company.name}}</td>
            <td >{{mail.google}}</td>
            <td >{{mail.outlook}}</td>
            <td >{{mail.yahoo}}</td>
            <td >{{mail.other}}</td>
            <td >{{total}}</td>
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
import {useStore} from "vuex";

export default {
    props: {mail: Object},
    setup(props) {
        const store = useStore();
        return {
            total: computed(() =>
                parseInt(props.mail.google) +
                parseInt(props.mail.outlook) +
                parseInt(props.mail.yahoo) +
                parseInt(props.mail.other)
            ),
            profileIsAdmin: computed(() => {
                let profile = store.getters.getProfile
                return profile.role == 'admin' || profile.role == 'top hr'
            })
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
