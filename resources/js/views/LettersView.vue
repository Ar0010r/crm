<template>
    <LettersBundleTable/>
    <StoreLetterForm/>
    <EditLetterForm/>
</template>

<script>
    import LettersBundleTable from '../components/tables/letters/LettersTableBundle';
    import StoreLetterForm from '../components/modals/letter/CreateLetterForm.vue';
    import EditLetterForm from '../components/modals/letter/EditLetterForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let lettersAreUndefined = Object.keys(store.getters.getLetters).length === 0;
            let companiesAreUndefined = Object.keys(store.getters.getCompanies).length === 0;

            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            if (rolesAreUndefined) store.dispatch('user/setRolesToStore');
            if (lettersAreUndefined) store.dispatch('letter/setLettersToStore');
            if (companiesAreUndefined) store.dispatch('company/setCompaniesToStore');
        },
        components: {
            LettersBundleTable,
            StoreLetterForm,
            EditLetterForm,
        }
    };
</script>
<style>
img{
    max-width: 100%;
}
</style>
