<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Statistics
        </h4>
        <Table />
    </div>
</template>

<script>
import Table from './Table.vue';
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
        Table,
    }
};
</script>

<style>
p {
    margin: 0;
}
</style>
