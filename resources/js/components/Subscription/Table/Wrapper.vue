<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getSubscriptionQueryParams" namespace="subscription" :vmodel="params.take"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getSubscriptionQueryParams" namespace="subscription" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:head>
            <Head :columns="columns"></Head>
        </template>
        <template v-slot:body>
            <tbody>
            <Row v-for="subscription in subscriptions" :subscription="subscription" :key="subscription.id + subscription.name"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination namespace="subscription" :meta="meta" getter="getSubscriptionQueryParams"/>
        </template>
    </Table>
</template>

<script>
    import Table from '../../../abstract/Table/Wrapper';
    import Head from '../../../abstract/Table/Head';
    import Pagination from '../../../abstract/Table/Control/Pagination';
    import Take from '../../../abstract/Table/Control/Take';
    import Search from '../../../abstract/Table/Control/Search';
    import Row from './Row';
    import {useStore} from "vuex";
    import {computed} from "vue";

    export default {
        setup() {
            const store = useStore();
            return {
                subscriptions: computed(() => store.getters.getSubscriptions),
                meta: computed(() => store.getters.getSubscriptionsMeta),
                params: computed(() => store.getters.getSubscriptionQueryParams),
                columns: [
                    "Company",
                    "Provider",
                    'Service',
                    'Price',
                    'Last payment',
                    'Period',
                    'Actions'
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
