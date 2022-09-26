<template>
    <div class="modal fade" id="deleteForm">
        <div class="modal-dialog">
            <div aria-labelledby="swal2-title" aria-describedby="swal2-content"
                 class="swal2-popup swal2-modal swal2-icon-warning swal2-show modal-content" tabindex="-1" role="dialog" aria-live="assertive"
                 aria-modal="true" style="display: flex;">
                <div class="swal2-header">
                    <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;">
                        <div class="swal2-icon-content">!</div>
                    </div>
                    <h2 class="swal2-title" id="swal2-title" style="display: flex;">Are you sure?</h2>
                </div>
                <div class="swal2-content">
                    <div id="swal2-content" class="swal2-html-container" style="display: block;" v-html="message"></div>
                </div>
                <div class="swal2-actions">
                    <button type="button" class="btn btn-warning btn-lg" @click=confirmAction>
                        Confirm
                    </button>
                    <button id="deleteFormClose" type="button" class="swal2-cancel btn btn-default btn-lg"
                            data-dismiss="modal"
                            @click=clearForm>Cancel
                    </button>
                </div>
            </div>
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
            confirmAction: () => {
                emitter.emit(id)
                document.getElementById('deleteFormClose').click();
            }
        }
    },
};
</script>


