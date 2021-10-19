<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Statistics
        </h4>

        <StatisticsTableControl/>
        <div class=" table-responsive d-flex align-items-start">
            <PersonnelStatisticsTable class="col-9"/>
            <div class="col-2 ml-4">
                <HrStatisticsTable v-if="profileIsAdmin" class=" d-flex flex-column"/>
            </div>
        </div>
<!--        <NoRecords v-else />-->
    </div>
</template>

<script>
    import HrStatisticsTable from './HrStatisticsTable.vue';
    import StatisticsTableControl from './control/StatisticsTableControl';
    import PersonnelStatisticsTable from './PersonnelStatisticsTable.vue';
    import NoRecords from '../../layout/NoRecords';
    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();

            return {
                profileIsAdmin: computed(() => {
                    return store.getters.getProfile.role === 'admin'
                }),
            }
        },

        components: {
            HrStatisticsTable,
            PersonnelStatisticsTable,
            StatisticsTableControl,
            NoRecords
        }
    };
</script>
