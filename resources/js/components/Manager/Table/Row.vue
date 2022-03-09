<template>
    <Row>
        <template v-slot:default>
            <td>{{manager.created_at}}</td>
            <td>{{manager.login}}</td>
            <td>{{manager.role}}</td>
        </template>
        <template v-slot:actions>
            <EditButton :model="manager" target="#editManagerForm" event="edit-manager-form"/>
            <DeleteButton
                :model="manager"
                event="delete-manager-"
                dispatch="manager/delete"
                :warning='"You want to delete manager:" + manager.login '/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/Row';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';

export default {
    props: {manager: Object},
    components: {
        Row,
        DeleteButton,
        EditButton
    }
};
</script>
