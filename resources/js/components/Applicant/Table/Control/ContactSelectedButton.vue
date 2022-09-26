<template>
    <div data-toggle="modal" data-target="#deleteForm" @click="actionWarning" class=" d-flex align-items-center cursor-pointer ml-2">
        <div class="bs-bars float-left">
            <button class="btn btn-dark">
                <i class="fas fa-user-clock"></i> Contact
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
            const actionEventId = 'contact-selected-employees'
            let selectedApplicants = [];

            emitter.on('add-selected-applicant', addSelectedEmployee);
            emitter.on(actionEventId, contactSelected);

            onBeforeUnmount(() => {
                emitter.off('add-selected-applicant', addSelectedEmployee)
                emitter.off(actionEventId, contactSelected)
            });


            async function contactSelected() {
                try {
                    await store.dispatch('applicant/bulkUpdate', {
                        applicants: selectedApplicants, status: null
                    })

                    emitter.emit('notification-success', selectedApplicants.length + ' applicants were updated');
                    emitter.emit('reset-checkbox');
                    //await store.dispatch('manager/setProfile')
                    selectedApplicants = [];
                } catch (e) {
                    console.log(e)
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function addSelectedEmployee(employee) {
                selectedApplicants.push(employee)
            }

            async function actionWarning() {
                selectedApplicants = [];
                emitter.emit('collect-selected-applicants');
                setTimeout(() => handleEmitWarning(), 500)
            }

            function handleEmitWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: actionEventId,
                    action: 'contacted'
                }

                emitter.emit('show-delete-modal', warning);
            }

            function generateWarningMessage() {
                return 'You want to update last contact time for ' + '<strong>' +selectedApplicants.length  + '</strong>' + ' applicants'
            }

            return {
                actionWarning
            }
        }
    }
</script>
