<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getTestQueryParams" namespace="applicant" :vmodel="params.take"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getTestQueryParams" namespace="applicant" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:head>
            <Head/>
        </template>
        <template v-slot:body>
            <tbody>
            <Row v-for="applicant in applicants" :applicant="applicant" :key="applicant.id + applicant.name"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination namespace="applicant" :meta="meta" getter="getApplicantQueryParams"/>
        </template>
    </Table>
</template>

<script>
    import Table from '../../../abstract/Table/Wrapper';
    import Head from './Head/Head';
    import Pagination from '../../../abstract/Table/Control/Pagination';
    import Take from '../../../abstract/Table/Control/Take';
    import Search from '../../../abstract/Table/Control/Search';
    import Row from './Row/Wrapper';
    import {useStore} from "vuex";
    import {computed} from "vue";

    export default {
        setup() {
            const store = useStore();
            return {
                applicants: computed(() => store.getters.getApplicants),
                meta: computed(() => store.getters.getApplicantsMeta),
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
