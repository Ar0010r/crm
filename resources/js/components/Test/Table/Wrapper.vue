<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getTestQueryParams" namespace="test" :vmodel="params.take"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getTestQueryParams" namespace="test" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:head>
            <Head :columns="columns"></Head>
        </template>
        <template v-slot:body>
            <tbody>
            <Row v-for="test in tests" :test="test" :key="test.id + test.name"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination dispatch="test/get" :meta="meta" getter="getTestQueryParams"/>
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
                tests: computed(() => store.getters.getTests),
                meta: computed(() => store.getters.getTestsMeta),
                params: computed(() => store.getters.getTestQueryParams),
                columns: [
                    "Date",
                    "Tester",
                    "Company",
                    "Env",
                    "Template",
                    "Google",
                    "Outlook",
                    "Yahoo",
                    "Other",
                    "Actions",
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
