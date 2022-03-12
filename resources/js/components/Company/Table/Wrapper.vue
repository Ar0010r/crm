<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getCompanyQueryParams" namespace="company" :vmodel="params.take"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getCompanyQueryParams" namespace="company" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:head>
            <Head :columns="columns()"></Head>
        </template>
        <template v-slot:body>
            <tbody>
            <Row v-for="company in companies" :company="company" :key="company.id"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination namespace="company" :meta="meta" getter="getCompanyQueryParams"/>
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
    import {computed, inject} from "vue";

    export default {
        setup() {
            const store = useStore();
            const container = inject('container')
            return {
                companies: computed(() => store.getters.getCompanies),
                meta: computed(() => store.getters.getCompaniesMeta),
                params: computed(() => store.getters.getCompanyQueryParams),
                columns: function () {
                    let profile = store.getters.getProfile
                   if(profile.role == 'admin' || profile.role == 'top hr'){
                       return  ["Created", "Manager", "Name", "Type", "Domain", "Email", "Pseudonym", "Actions"]
                   } else {
                       return  ["Created", "Name", "Type", "Domain", "Email", "Pseudonym", "Actions"]
                   }
                }
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
