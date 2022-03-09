<template>
    <div class="modal fade show" id="imageForm" aria-modal="true">
        <div class="modal-dialog modal-md">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-if="media">
                        {{applicant.name}} {{collection}}
                        <br>
                        <small class="text-muted">Please make sure that {{applicant.name}} document complies with the requirements</small>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <div v-if="media" class="form-row" style="max-width: 100%; max-height: 100%">
                        <img style="width: 100%; height: 100%" :src=media.url>
                    </div>
                    <div v-else class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="deleteMedia">Delete</button>
                    <button type="button" id="imageFormClose" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {ref, inject, onBeforeUnmount} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {

        const container = inject('container');
        const emitter = inject('emitter');
        const store = useStore();

        let media = ref(null);
        let applicant = ref(null);
        let collection = ref(null);

        async function deleteMedia() {
            await container.ApplicantService.deleteMedia(media.value)
            applicant.value[collection.value + '_exists'] = false;
            store.commit('applicant/set', applicant.value);
            document.getElementById('imageFormClose').click();
            emitter.emit('notification-success', applicant.value.name + ' ' + collection.value + ' was deleted');
        }

        async function init(data) {
            media.value = null

            applicant.value = data.applicant;
            collection.value = data.collection;
            let response = await container.ApplicantService.getMedia(data.applicant.id, data.collection)
            media.value = response.data.model;
        }

        emitter.on('show-image-form', init);
        onBeforeUnmount(() => emitter.off('show-image-form', init));

        return { applicant, collection, media, deleteMedia }
    }
};
</script>
