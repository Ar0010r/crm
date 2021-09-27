<template>
    <LettersTable/>
    <StoreLetterForm/>
    <EditLetterForm/>
</template>

<script>
    import LettersTable from '../components/tables/letters/LettersTable.vue';
    import StoreLetterForm from '../components/modals/letter/CreateLetterForm.vue';
    import EditLetterForm from '../components/modals/letter/EditLetterForm.vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            let store = useStore();
            let usersAreUndefined = Object.keys(store.getters.getUsers).length === 0;
            let rolesAreUndefined = Object.keys(store.getters.getRoles).length === 0;
            let lettersAreUndefined = Object.keys(store.getters.getLetters).length === 0;

            console.log('store', store);

            if (usersAreUndefined) store.dispatch('user/setUsersToStore');
            if (rolesAreUndefined) store.dispatch('user/setRolesToStore');
            if (lettersAreUndefined) store.dispatch('letter/setLettersToStore');
        },
        components: {
            LettersTable,
            StoreLetterForm,
            EditLetterForm,
        }
    };
</script>
