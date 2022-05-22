<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getManagerQueryParams" namespace="manager" :vmodel="params.take"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getManagerQueryParams" namespace="manager" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:head>
            <Head :columns="columns"></Head>
        </template>
        <template v-slot:body>
            <tbody>
            <Row v-for="manager in managers" :manager="manager" :key="manager.id"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination namespace="manager" :meta="meta" getter="getManagerQueryParams"/>
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
                managers: computed(() => store.getters.getManagers),
                meta: computed(() => store.getters.getManagerMeta),
                params: computed(() => store.getters.getManagerQueryParams),
                columns: [
                    "Created",
                    "Login",
                    "Role",
                    "Companies",
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
