<template>
    <button
        v-if="profileIsHr"
        data-target="#uploadForm"
        data-toggle="modal"
        class="fas fa-paperclip border-0 bg-transparent"
        data-placement="right" title="Attach file"
        @click="showUploadForm"/>
</template>
<script>
import {useStore} from 'vuex'
import {inject, computed} from 'vue';

export default {
    setup(props) {
        const store = useStore();
        const emitter = inject("emitter");

        return {
            profileIsHr: computed(() => {
                return store.getters.getProfile.role === 'hr' || store.getters.getProfile.role === 'top hr' || store.getters.getProfile.role === 'admin'
            }),

            showUploadForm: () => emitter.emit('show-upload-form', props.applicant),

        }
    },
    props: {
        applicant: Object
    },
};
</script>
