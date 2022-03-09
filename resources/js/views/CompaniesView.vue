<template>
    <Content/>
    <CreateForm/>
    <EditForm/>
</template>

<script>
import Content from '../components/Company/Content';
import CreateForm from '../components/Company/Modal/CreateForm.vue';
import EditForm from '../components/Company/Modal/EditForm.vue';

import {useStore} from 'vuex';

export default {
    setup() {
        let store = useStore();
        let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
        let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;
        let employeesAreUndefined = Object.keys(store.getters.getApplicants).length === 0;

        if (companiesAreUndefined) store.dispatch('company/get');
        if (employeesAreUndefined) store.dispatch('applicant/get');
        if (usersAreUndefined) store.dispatch('manager/get');
    },
    components: {
        Content,
        CreateForm,
        EditForm
    }
};
</script>
