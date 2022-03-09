<template>
        <div class="modal fade" id="deleteForm">
               <div class="modal-dialog">
                   <form class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title">
                               Please confirm action
                           </h5>
                           <button @click="clearForm" type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                       </div>
                       <div class="modal-body text-center">
                           <h4 v-html="message"></h4>
                       </div>
                       <div class="modal-footer">
                           <button @click="clearForm" id="deleteFormClose" type="button" class="btn btn-default" data-dismiss="modal">Cancel
                           </button>
                           <button type="button" @click="confirmDelete"
                                   class="btn btn-danger">Delete
                           </button>
                       </div>
                   </form>
               </div>
           </div>
</template>
<script>
import {ref, inject} from 'vue';

export default {
    setup() {
        const emitter = inject("emitter");
        let message = ref('');
        let id = null;

        emitter.on('show-delete-modal', showWarning);

        function showWarning(msg) {
            message.value = msg.message
            id = msg.event_id
        }

        function clearForm() {
            message.value = '';
            id = null;
        }

        return {
            message, clearForm,
            confirmDelete: () => {
                emitter.emit(id)
                document.getElementById('deleteFormClose').click();
            }
        }
    },
};
</script>


