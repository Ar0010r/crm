<template>
    <table v-if="Object.keys(users).length > 0" class="datatables-demo table table-striped table-bordered col-9">
        <thead>
        <tr class="d-flex">
            <th class="text-left col-3 font-weight-bold">HR</th>
            <th class="text-left col-3 font-weight-bold">All</th>
            <th class="text-left col-3 font-weight-bold">Hired</th>
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
    import Row from './parts/HrStatisticsTableRow'

    export default {
        setup() {
            const store = useStore();
            const profile = computed(() => store.getters.getProfile);

            return {
                users: computed(() => {
                    let hrs = store.getters.getHrs;
                    //if(profile.value.role === 'top hr') hrs[profile.value.id] = profile.value
                    return hrs
                }),
            }
        },
        components: {
            Row
        }
    };
</script>
