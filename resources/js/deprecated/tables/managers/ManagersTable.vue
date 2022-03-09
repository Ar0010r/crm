<template>
    <table class="datatables-demo table table-striped table-bordered col-6">
        <ManagersTableHead/>
        <tbody>
        <ManagersTableRow
                v-for="user in users"
                :key="user.id + user.login"
                :user.sync='user'
        />
        </tbody>
    </table>
</template>

<script>
    import ManagersTableHead from './ManagersTableHead';
    import ManagersTableRow from './parts/ManagersTableRow';

    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();

            return {
                users: computed(() => store.getters.getManagers),
            }
        },

        components: {
            ManagersTableHead,
            ManagersTableRow,
        }
    };
</script>
