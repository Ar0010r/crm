<template>
    <Table :columns="columns">
        <slot>
            <Row v-for="record in records" :record="record" :key="record.id"/>
        </slot>
    </Table>
</template>

<script>
    import Table from '../../../abstract/Table/SimpleWrapper';
    import Head from '../../../abstract/Table/Head';
    import Pagination from '../../../abstract/Table/Control/Pagination';
    import Take from '../../../abstract/Table/Control/Take';
    import Search from '../../../abstract/Table/Control/Search';
    import Row from './StatisticsRow';
    import {useStore} from "vuex";
    import {computed} from "vue";

    export default {
        setup() {

            const store = useStore();
            return {
                records: computed(() => store.getters.getMailStatistics),
                columns: [
                    "Hr",
                    "Google",
                    "Outlook",
                    "Yahoo",
                    "Other",
                    "Total",
                ]
            }
        },
        components: {
            Table,
            Head,
            Pagination,
            Row,
            Take,
            Search,
        }
    };
</script>
