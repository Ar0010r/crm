<template>
    <table class="datatables-demo table table-striped table-bordered col-5">
        <PersonnelStatisticsTableHead/>
        <tbody>
        <PersonnelStatisticsTableRow
            v-for="record in records"
            :record='record'
        />
        </tbody>
    </table>
</template>

<script>
    import PersonnelStatisticsTableHead from './PersonnelStatisticsTableHead.vue';
    import PersonnelStatisticsTableRow from './PersonnelStatisticsTableRow.vue';
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();

            return {
                profile: computed(() => store.getters.getProfile),
                records: computed(() => store.getters.getMonthlyStatistics),
            }
        },

        components: {
            PersonnelStatisticsTableHead,
            PersonnelStatisticsTableRow
        }
    };
</script>
