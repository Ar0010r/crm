<template>
    <Content/>
    <EditForm/>
    <CreateForm/>
</template>

<script>
    import Content from '../components/Subscription/Content';
    import CreateForm from '../components/Subscription/Modal/CreateForm.vue';
    import EditForm from '../components/Subscription/Modal/EditForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();

            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let testsAreUndefined = Object.keys(store.getters.getSubscriptions).length === 0;

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
