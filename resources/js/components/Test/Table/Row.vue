<template>
    <Row>
        <template v-slot:default>
            <td>{{ test.date }}</td>
            <td>{{ test.manager.login }}</td>
            <td>{{ test.company.name }}</td>
            <td>{{ test.env }}</td>
            <td>{{ test.template }}</td>
            <td v-for="result in ['google','outlook', 'yahoo', 'other']">
            <span v-if="test[result] != null" class="badge" :class="test[result] ? 'badge-outline-success' : 'badge-outline-danger'">
                {{ test[result] ? 'inbox' : 'spam' }}
            </span>
            </td>
        </template>
        <template v-slot:actions>
            <EditButton :model="test" target="#editTestForm" event="edit-test-form"/>
            <DeleteButton
                :model="test"
                event="delete-test-"
                dispatch="test/delete"
                :warning='"You want to delete test from:" + test.date '/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/Row';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';

export default {
    props: {test: Object},
    components: {
        Row,
        DeleteButton,
        EditButton
    }
};
</script>
