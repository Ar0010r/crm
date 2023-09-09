<template>
    <div class="bg-white p-2">
        <Record v-for="record in data" :key="record.head.period" :record="record"/>
    </div>
</template>

<!--<template>
    <Control/>
    <div class="bg-white p-2">
        <Record v-for="record in data" :key="record.head.period" :record="record"/>
    </div>
    <Pagination namespace="conversion" :meta="meta" getter="getConversionQueryParams"/>
</template>-->

<script>
import Control from './Control.vue';
import Record from './Record.vue';
import Pagination from '../../abstract/Table/Control/Pagination';
import {computed} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const store = useStore();
        return {
            data: computed(() => store.getters.getConversion),
            meta: computed(() => store.getters.getConversionMeta),
        }
    },
    components: {
        Record,
        Control,
        Pagination
    }
};
</script>
