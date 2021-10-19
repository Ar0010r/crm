<template>
    <table class="datatables-demo table table-striped table-bordered col-6">
        <LettersTableHead/>
        <tbody>
        <LettersTableRow v-for="letter in letters" :letter="letter" :key="letter.id + letter.name"/>
        </tbody>
    </table>
</template>

<script>
    import LettersTableHead from './LettersTableHead.vue';
    import LettersTableControl from './control/LettersTableControl'
    import LettersTableRow from './LettersTableRow.vue';
    import CreateLetterForm from '../../modals/letter/CreateLetterForm';
    import EditLetterForm from '../../modals/letter/EditLetterForm';
    import {computed} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();

            return {
                letters: computed(() => store.getters.getLetters),
            }
        },

        components: {
            LettersTableHead,
            LettersTableRow,
            LettersTableControl,
            CreateLetterForm,
            EditLetterForm,
        }
    };
</script>
