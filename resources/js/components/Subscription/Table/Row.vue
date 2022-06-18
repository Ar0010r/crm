<template>
    <Row>
        <template v-slot:default>
            <td v-if="subscription.company">
                {{ subscription.company.name }}
                <span class="ion ion-ios-alarm text-danger"></span>
            </td>
            <td v-else></td>
            <td>{{ subscription.provider }}</td>
            <td>{{ subscription.service }}</td>
            <td>{{ subscription.price }}</td>
            <td>{{ subscription.last_payment }}</td>
            <td>{{ subscription.next_payment }}</td>
            <td>{{ subscription.period }}</td>
            <td>
            <span class="badge" :class="subscription.status === 'in use' ? 'badge-outline-success' : 'badge-outline-danger'">
                {{ subscription.status }}
            </span>
            </td>
        </template>
        <template v-slot:actions>
            <EditButton :model="subscription" target="#editSubscriptionForm" event="edit-subscription-form"/>
            <PaidButton :subscription="subscription"></PaidButton>
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
import PaidButton from "./PaidButton";
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';

export default {
    props: {subscription: Object},
    components: {
        Row,
        PaidButton,
        DeleteButton,
        EditButton
    }
};
</script>
