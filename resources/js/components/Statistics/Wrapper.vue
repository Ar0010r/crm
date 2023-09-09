<template>
    <Table :from="meta.from" :to="meta.to" :total="meta.total">
        <template v-slot:take>
            <Take getter="getConversionQueryParams" namespace="conversion" :vmodel="params.take" :values="take"></Take>
        </template>
        <template v-slot:search>
            <Search getter="getConversionQueryParams" namespace="conversion" :vmodel="params.search_term"></Search>
        </template>
        <template v-slot:body>
            <tbody class="p-3">
            <Record v-for="record in records" :record="record"/>
            </tbody>
        </template>
        <template v-slot:pagination>
            <Pagination namespace="conversion" :meta="meta" getter="getConversionQueryParams"/>
        </template>
    </Table>
</template>

<script>
import Table from '../../abstract/Table/Wrapper';
import Pagination from '../../abstract/Table/Control/Pagination';
import Take from '../../abstract/Table/Control/Take';
import Search from '../../abstract/Table/Control/Search';
import Record from './Record';
import {computed} from "vue";
import {useStore} from "vuex";

export default {
    setup() {
        const store = useStore();
        return {
            records: computed(() => store.getters.getConversion),
            meta: computed(() => store.getters.getConversionMeta),
            params: computed(() => store.getters.getConversionQueryParams),
            take: [2, 5, 10],


        }
    },

    components: {
        Table,
        Pagination,
        Take,
        Record,
        Search,
    }
};
</script>
