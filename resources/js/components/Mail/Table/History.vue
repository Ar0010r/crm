<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getMailQueryParams" namespace="mail" :vmodel="params.take" :values="[50, 100, 200]"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getMailQueryParams" namespace="mail" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:head>
            <Head :columns="columns"></Head>
        </template>
        <template v-slot:body>
            <tbody>
            <Row v-for="mail in mails" :mail="mail" :key="mail.id"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination namespace="mail" :meta="meta" getter="getMailQueryParams"/>
        </template>
    </Table>
</template>

<script>
import Table from '../../../abstract/Table/Wrapper';
import Head from '../../../abstract/Table/Head';
import Pagination from '../../../abstract/Table/Control/Pagination';
import Take from '../../../abstract/Table/Control/Take';
import Search from '../../../abstract/Table/Control/Search';
import Row from './HistoryRow';
import {useStore} from "vuex";
import {computed} from "vue";

export default {
    setup() {

        const store = useStore();
        return {
            mails: computed(() => store.getters.getMails),
            meta: computed(() => store.getters.getMailsMeta),
            params: computed(() => store.getters.getMailQueryParams),
            columns: computed(function () {
                let profile = store.getters.getProfile
                if (profile.role == 'admin' || profile.role == 'top hr') {
                    return ["Received", "Hr", "Company", "Google", "Outlook", "Yahoo", "Other", "Total", "Progress", "Actions",]
                } else {
                    return ["Received", "Company", "Google", "Outlook", "Yahoo", "Other", "Total", "Progress", "Actions",]
                }
            })
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
