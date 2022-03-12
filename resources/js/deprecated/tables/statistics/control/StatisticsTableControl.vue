<template>
    <div class="d-flex mb-3 mt-2">
        <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
            <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
        </button>
        <button class="btn btn-primary ml-2" type="button" @click="total">
            Total
        </button>
        <button class="btn btn-primary ml-2" type="button"  @click="monthly">
            Monthly
        </button>
    </div>
</template>
<script>
    import {useStore} from 'vuex';
    import {computed, watch, inject} from 'vue';

    export default {
        setup() {
            let store = useStore();
            const emitter = inject("emitter");
            let activeFilters = computed(() => store.getters.getEmployeeQueryParams);

            async function getMonthlyStatistics(){
                await store.dispatch('statistics/statistics', {
                    'page': 1,
                    'filter[personnel_id]': activeFilters.value.personnel_id,
                    'take': activeFilters.value.take,
                });
            }

            return {
                total: () =>  emitter.emit('set-statistics-view', 0),
                monthly: () =>  emitter.emit('set-statistics-view', 1),
                refresh: () => {
                    getMonthlyStatistics()
                    store.dispatch('profile/get')
                    //store.dispatch('manager/setProfile')
                }
            }
        }
    };
</script>
