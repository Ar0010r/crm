<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Statistics
        </h4>

        <div class="d-flex mb-3 mt-2">
            <button @click="refresh" class="btn btn-secondary" type="button" title="Refresh">
                <i class="opacity-75 ion ion-md-refresh icon-refresh"></i>
            </button>
            <button @click="initializeLetterStoreForm" class="btn btn-primary btn ml-2" data-toggle="modal"
                    data-target="#addLetterForm">
                Add record
            </button>
        </div>
        <div v-if="Object.keys(letters).length > 0" class=" table-responsive">
            <table class="datatables-demo table table-striped table-bordered col-8">
                <LettersTableHead/>
                <tbody>
                <LettersTableRow v-for="letter in letters" :letter="letter" :key="letter.id + letter.name"/>
                </tbody>
            </table>
        </div>
        <NoRecords v-else />
    </div>
</template>

<script>
    import LettersTableHead from './LettersTableHead.vue';
    import LettersTableRow from './LettersTableRow.vue';
    import CreateLetterForm from '../../modals/letter/CreateLetterForm';
    import EditLetterForm from '../../modals/letter/EditLetterForm';
    import NoRecords from '../../layout/NoRecords';
    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                profile: computed(() => store.getters.getProfile),
                letters: computed(() => store.getters.getLetters),
                initializeLetterStoreForm : () =>  emitter.emit('create-letter-form'),
                refresh: () => store.dispatch('letter/setLettersToStore')
            }
        },

        components: {
            LettersTableHead,
            LettersTableRow,
            CreateLetterForm,
            EditLetterForm,
            NoRecords
        }
    };
</script>
