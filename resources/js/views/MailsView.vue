<template>
    <Content/>
    <CreateForm/>
    <EditForm/>
</template>

<script>
    import Content from '../components/Mail/Content';
    import CreateForm from '../components/Mail/Modal/CreateForm.vue';
    import EditForm from '../components/Mail/Modal/EditForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let lettersAreUndefined = Object.keys(store.getters.getMails).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;


            if (usersAreUndefined) store.dispatch('manager/get');
            if (rolesAreUndefined) store.dispatch('manager/setRoles');
            if (lettersAreUndefined) store.dispatch('mail/get');
            if (companiesAreUndefined) store.dispatch('company/get');
        },
        components: {
            Content,
            CreateForm,
            EditForm,
        }
    };
</script>
