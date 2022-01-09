<template>
    <tr class="odd gradeX">
        <td>{{ test.date }}</td>
        <td>{{ test.manager.login }}</td>
        <td>{{ test.env }}</td>
        <td>{{ test.template }}</td>
        <td v-for="result in ['google','outlook', 'yahoo']">
            <span v-if="test[result] != null" class="badge" :class="test[result] ? 'badge-outline-success' : 'badge-outline-danger'">
                {{ test[result] ? 'inbox' : 'spam' }}
            </span>
        </td>
        <td>
            <div class="d-flex  justify-content-between align-items-center ">
                <EditButton :test="test"/>
                <DeleteButton :test="test"/>
            </div>
        </td>
    </tr>
</template>

<script>
import DeleteButton from './actions/DeleteButton';
import EditButton from './actions/EditButton';

export default {
    props: {test: Object},
    components: {
        DeleteButton,
        EditButton
    }
};
</script>
