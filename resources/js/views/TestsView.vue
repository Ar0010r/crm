<template>
    <Content/>
    <EditForm/>
    <CreateForm/>
</template>

<script>
    import Content from '../components/Test/Content';
    import CreateForm from '../components/Test/Modal/CreateForm.vue';
    import EditForm from '../components/Test/Modal/EditForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();

            let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let testsAreUndefined = Object.keys(store.getters.getTests).length === 0;

            if (usersAreUndefined) store.dispatch('manager/get');
            if (testsAreUndefined) store.dispatch('test/get');
            if (companiesAreUndefined) store.dispatch('company/get');
        },
        components: {
            Content,
            CreateForm,
            EditForm,
        }
    };
</script>
