<template>
    <Content/>
    <EditForm/>
    <CreateForm/>
    <ImportForm/>
    <UploadForm/>
    <ImageForm/>
</template>

<script>
    import Content from '../components/Applicant/Content';
    import CreateForm from '../components/Applicant/Modal/CreateForm.vue';
    import EditForm from '../components/Applicant/Modal/EditForm.vue';
    import ImportForm from '../components/Applicant/Modal/ImportForm';
    import UploadForm from '../components/Applicant/Modal/UploadForm';
    import ImageForm from '../components/Applicant/Modal/ImageForm';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();

            let statusesAreUndefined = Object.keys(store.getters.getStatuses).length === 0;
            let racesAreUndefined = Object.keys(store.getters.getRaces).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;
            let applicantsAreUndefined = Object.keys(store.getters.getApplicants).length === 0;
            let usersAreUndefined = Object.keys(store.getters.getManagers).length === 0;

            if (statusesAreUndefined) store.dispatch('applicant/getStatuses');
            if (racesAreUndefined) store.dispatch('applicant/getRaces');
            if (companiesAreUndefined) store.dispatch('company/get');
            if (applicantsAreUndefined) store.dispatch('applicant/get');
            if (usersAreUndefined) store.dispatch('manager/get');
        },
        components: {
            Content,
            ImportForm,
            CreateForm,
            EditForm,
            UploadForm,
            ImageForm,
        }
    };
</script>
