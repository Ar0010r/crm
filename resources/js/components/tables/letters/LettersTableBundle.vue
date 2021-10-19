<template>
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Mails
        </h4>

        <LettersTableControl/>
        <div v-if="Object.keys(letters).length > 0" class=" table-responsive d-flex align-items-start">
            <LettersTable class="col-7"/>
            <TotalLettersTable class="col-4 ml-4"/>
        </div>
        <NoRecords v-else />
    </div>
</template>

<script>
    import LettersTable from './LettersTable.vue';
    import LettersTableControl from './control/LettersTableControl';
    import TotalLettersTable from './TotalLettersTable.vue';
    import NoRecords from '../../layout/NoRecords';
    import {computed, inject} from 'vue';
    import {useStore} from 'vuex';

    export default {
        setup() {
            const store = useStore();
            const emitter = inject("emitter");

            return {
                letters: computed(() => store.getters.getLetters),
            }
        },

        components: {
            LettersTable,
            TotalLettersTable,
            LettersTableControl,
            NoRecords
        }
    };
</script>
