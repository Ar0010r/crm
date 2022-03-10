<template>
    <Row>
        <template v-slot:default>
            <td>{{ subscription.company.name }}</td>
            <td>{{ subscription.provider }}</td>
            <td>{{ subscription.service }}</td>
            <td>{{ subscription.price }}</td>
            <td>{{ subscription.last_payment }}</td>
            <td>{{ subscription.period }}</td>
        </template>
        <template v-slot:actions>
            <EditButton :model="subscription" target="#editSubscriptionForm" event="edit-subscription-form"/>
            <DeleteButton
                :model="subscription"
                event="delete-subscription-"
                dispatch="subscription/delete"
                :warning='"You want to delete subscription for:" + subscription.company.name '/>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/Row';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';

export default {
    props: {subscription: Object},
    components: {
        Row,
        DeleteButton,
        EditButton
    }
};
</script>
