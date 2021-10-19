<template>
    <div class="modal fade" id="addLetterForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add letters info
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <LetterFormFields ref="letterFields" :letter.sync='letter' />
                </div>
                <div class="modal-footer">
                    <button id="storeLetterFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                    <button @click.prevent="storeLetter" type="button"
                            class="btn btn-primary">Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import LetterFormFields from './LetterFormFields';
    import {useStore} from 'vuex';
    import {ref, inject, reactive, onBeforeUnmount, computed} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const letterFields = ref(null);
            const profile = computed(() => store.getters.getProfile)
            const emptyLetter = {...store.getters.getEmptyLetter};

            emptyLetter.hr_id = null;
            if(profile.value.role === 'hr' || profile.value.role === 'top hr'){
                emptyLetter.hr_id = profile.value.id
            }

            emptyLetter.company_id = null;

            console.log('emptyLetter', emptyLetter)

            let letter = reactive({...emptyLetter});

            async function storeLetter() {
                try {
                    await letterFields.value.validate();
                    let storedLetter = await container.LetterService.store(letter);

                    store.commit('letter/setLetterById', storedLetter.data.model);
                    document.getElementById('storeLetterFormClose').click()
                    emitter.emit('notification-success', 'letter was added');
                    clearForm();
                } catch (e) {
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }
            }

            function clearForm() {
                Object.keys(emptyLetter).forEach(key => letter[key] = emptyLetter[key])
            }

            emitter.on('create-letter-form', clearForm);
            onBeforeUnmount(() => emitter.off('create-letter-form', clearForm));

            return {letter, letterFields, storeLetter}
        },
        components: {
            LetterFormFields
        }
    };
</script>

