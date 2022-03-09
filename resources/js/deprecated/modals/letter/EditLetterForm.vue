<template>
    <div class="modal fade" id="editLetterForm">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit letter
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <LetterFormFields ref="letterFields" :letter.sync='letter' :show-role-field="true"/>
                </div>
                <div class="modal-footer">
                    <button id="editLetterFormClose" type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>

                    <button  type="button" class="btn btn-primary"
                            @click="updateLetter">Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import LetterFormFields from './LetterFormFields';
    import {useStore} from 'vuex';
    import {inject, reactive, ref, onBeforeUnmount, computed} from 'vue';

    export default {
        setup() {
            const store = useStore();
            const container = inject('container');
            const emitter = inject("emitter");
            const letterFields = ref(null);
            const emptyLetter = { ...store.getters.getMailModel};
            let companies = computed(() => store.getters.getCompanies);
            let hrs = computed(() => store.getters.getHrs);

            let letter = reactive({...emptyLetter});

            emitter.on('edit-letter-form', setLetter);
            onBeforeUnmount(() => emitter.off('edit-letter-form', setLetter));

            async function updateLetter() {
                try {
                    await letterFields.value.validate();
                    await container.LetterService.update(letter);
                    if(letter.company_id){
                        letter.company = companies.value[letter.company_id];
                    }

                    if(letter.hr_id){
                        letter.hr = hrs.value[letter.hr_id];
                    }

                    store.commit('mail/setLetterById', letter);
                    emitter.emit('notification-success', 'letter was updated');
                    document.getElementById('editLetterFormClose').click();
                } catch (e) {
                    console.log(e)
                    if(e.response.data) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }
            }

            function setLetter(letterData) {
                Object.keys(letterData).forEach(key => letter[key] = letterData[key])
                letter.password = null;
            }

            return {letter, letterFields, updateLetter}
        },

        components: {
            LetterFormFields
        }
    };
</script>

