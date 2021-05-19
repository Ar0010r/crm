<template>
    <table v-if="Object.keys(users).length > 0" class="datatables-demo table table-striped table-bordered col-9">
        <thead>
        <tr class="d-flex">
            <th class="text-left col-3 font-weight-bold">Personnel</th>
            <th class="text-left col-3 font-weight-bold">All</th>
            <th class="text-left col-3 font-weight-bold">Exported</th>
            <th class="text-left col-3 font-weight-bold">Conversion</th>
        </tr>
        </thead>
        <tbody>
        <Row
                v-for="user in users"
                :key="user.id"
                :user.sync='user'
        />
        </tbody>
    </table>
</template>

<script>
    import {computed} from 'vue';
    import {useStore} from 'vuex';
    import Row from './parts/PersonnelStatisticsTableRow'

    export default {
        setup() {
            const store = useStore();

            return {
                users: computed(() => store.getters.getPersonnels),
            }
        },

        components: {
            Row
        }
    };
</script>
