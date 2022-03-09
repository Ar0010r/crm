<template>
    <StatisticsRecord v-for="record in records" :key="record.head.period" :record="record"/>
</template>

<script>
import StatisticsRecord from './StatisticsRecord.vue';
import {computed, inject} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const store = useStore();

        return {
            records: computed(() => store.getters.getStatistics),
        }
    },
    components : {
        StatisticsRecord
    }
};
</script>

<style>
p {
    margin: 0;
}
</style>
