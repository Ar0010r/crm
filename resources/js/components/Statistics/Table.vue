<template>
    <Record v-for="record in records" :key="record.head.period" :record="record"/>
</template>

<script>
import Record from './Record.vue';
import {computed} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const store = useStore();

        return {
            records: computed(() => store.getters.getStatistics),
        }
    },
    components : {
        Record
    }
};
</script>
