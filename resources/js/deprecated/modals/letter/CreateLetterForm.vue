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
            const emptyLetter = {...store.getters.getMailModel};
            let companies = computed(() => store.getters.getCompanies);
            let hrs = computed(() => store.getters.getHrs);

            emptyLetter.hr_id = null;
            if(profile.value.role === 'hr' || profile.value.role === 'top hr'){
                emptyLetter.hr_id = profile.value.id
            }

            emptyLetter.company_id = null;

            let letter = reactive({...emptyLetter});

            async function storeLetter() {
                try {
                    await letterFields.value.validate();
                    let storedLetter = await container.LetterService.store(letter);
                    let mails = storedLetter.data.model;

                    if(mails.company_id){
                        mails.company = companies.value[mails.company_id];
                    }

                    if(mails.hr_id){
                        mails.hr = hrs.value[mails.hr_id];
                    }

                    store.commit('mail/setLetterById', mails);
                    document.getElementById('storeLetterFormClose').click()
                    emitter.emit('notification-success', 'letter was added');
                    clearForm();
                } catch (e) {
                    console.log(e);
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

