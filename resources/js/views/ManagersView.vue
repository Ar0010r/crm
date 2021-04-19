<template>
    <ManagersTable/>
    <StoreManagerForm/>
    <EditManagerForm/>
</template>

<script>
    import ManagersTable from '../components/tables/managers/ManagersTable.vue';
    import StoreManagerForm from '../components/modals/manager/CreateManagerForm.vue';
    import EditManagerForm from '../components/modals/manager/EditManagerForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;

            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            if (rolesAreUndefined) store.dispatch('user/setRolesToStore')
        },
        components: {
            ManagersTable,
            StoreManagerForm,
            EditManagerForm,
        }
    };
</script>
