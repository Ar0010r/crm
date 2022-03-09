<template>
    <Row>
        <template v-slot:default>
            <td>{{ record.hr.login }}</td>
            <td>{{ record.google_total ?? 0 }}</td>
            <td>{{ record.outlook_total ?? 0 }}</td>
            <td>{{ record.yahoo_total ?? 0 }}</td>
            <td>{{ record.other_total ?? 0 }}</td>
            <td>{{ total }}</td>
        </template>
    </Row>
</template>

<script>
import Row from '../../../abstract/Table/SimpleRow';
import DeleteButton from '../../../abstract/Table/Actions/DeleteButton';
import EditButton from '../../../abstract/Table/Actions/EditButton';
import ProgressBar from './ProgressBar';
import {computed} from "vue";

export default {
    props: {record: Object},
    setup(props) {
        return {
            total: computed(() =>
                parseInt(props.record.google_total) +
                parseInt(props.record.outlook_total) +
                parseInt(props.record.yahoo_total) +
                parseInt(props.record.other_total)
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
