<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Statistics
        </h4>

        <StatisticsTableControl/>
        <StatisticsTable v-if="layout === 0"/>
        <MonthlyStatisticsTable v-else/>
    </div>
</template>

<script>
import HrStatisticsTable from './HrStatisticsTable.vue';
import MonthlyStatisticsTable from './MonthlyStatisticsTable.vue';
import StatisticsTable from './StatisticsTable.vue';
import StatisticsTableControl from './control/StatisticsTableControl';
import PersonnelStatisticsTable from './PersonnelStatisticsTable.vue';
import {computed, inject, onBeforeUnmount, ref} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const emitter = inject("emitter");
        const store = useStore();
        let layout = ref(0)

        const setTable = (value) => layout.value = value;

        emitter.on('set-statistics-view', setTable);
        onBeforeUnmount(() => emitter.off('set-statistics-view', setTable));

        return {
            layout,
            records: computed(() => store.getters.getMonthlyStatistics),
            profileIsAdmin: computed(() => {
                return store.getters.getProfile.role === 'admin'
            }),

        }
    },

    components: {
        HrStatisticsTable,
        PersonnelStatisticsTable,
        StatisticsTableControl,
        MonthlyStatisticsTable,
        StatisticsTable,
    }
};
</script>

<style>
p {
    margin: 0;
}
</style>
