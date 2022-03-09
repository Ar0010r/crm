<template>
    <div data-toggle="modal" data-target="#deleteForm" @click="deleteWarning" class="text-danger d-flex align-items-center cursor-pointer">
        <div class="bs-bars float-left">
            <button class="btn btn-danger">
                <i class="ion ion-md-close"></i> Delete
            </button>
        </div>
    </div>
</template>

<script>
    import {inject, onBeforeUnmount} from 'vue';
    import {useStore} from 'vuex';

    export default {
        name: "DeleteSelectedSpan",
        setup() {
            const emitter = inject('emitter');
            const container = inject('container');
            const store = useStore()
            const deleteEventId = 'delete-selected-employees'
            let selectedApplicants = [];

            emitter.on('add-selected-applicant', addSelectedEmployee);
            emitter.on('delete-selected-employees', deleteSelected);

            onBeforeUnmount(() => {
                emitter.off('add-selected-applicant', addSelectedEmployee)
                emitter.off('delete-selected-employees', deleteSelected)
            });


            async function deleteSelected() {
                try {
                    /*await container.ApplicantService.bulkDelete(selectedApplicants);
                    store.commit('applicant/bulkDelete', selectedApplicants)*/
                    await store.dispatch('applicant/bulkDelete', selectedApplicants)
                    emitter.emit('notification-success', selectedApplicants.length + ' applicants were deleted');
                    emitter.emit('reset-checkbox');
                    //store.commit('manager/setProfile')
                    selectedApplicants = [];
                } catch (e) {
                    console.log(e)
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function addSelectedEmployee(employee) {
                selectedApplicants.push(employee)
            }

            async function deleteWarning() {
                selectedApplicants = [];
                emitter.emit('collect-selected-applicants');
                setTimeout(() => handleEmitWarning(), 500)
            }

            function handleEmitWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                }

                emitter.emit('show-delete-modal', warning);
            }

            function generateWarningMessage() {
                return 'You want to delete ' + '<strong>' +selectedApplicants.length  + '</strong>' + ' applicants'
            }

            return {
                deleteWarning
            }
        }
    }
</script>
