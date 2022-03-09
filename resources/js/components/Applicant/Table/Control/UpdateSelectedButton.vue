<template>
    <div class="btn-group btn-s ml-2">
        <button class="btn btn-secondary dropdown-toggle " type="button" data-toggle="dropdown">
            <i class="ion ion-md-create"></i>
            Mark as
        </button>
        <div class="dropdown-menu p-0 m-0 text-center">
            <a class="dropdown-item disabled" href="javascript:void(0)">Select status</a>
            <div class="dropdown-divider m-0"></div>
            <a v-for="(cssClass, status) in availableStatuses" :key="status" @click='updateWarning(status)'
               class="dropdown-item" :class="cssClass"
               href="javascript:void(0)"
            >
                {{ status }}
            </a>
        </div>
    </div>
</template>

<script>
import {inject, computed, onBeforeUnmount} from 'vue';
import {useStore} from 'vuex';

export default {
    setup() {
        const emitter = inject('emitter');
        const container = inject('container');
        const store = useStore();
        const updateEventId = 'update-selected-employees';
        let selectedApplicants = [];
        let status;

        emitter.on('add-selected-applicant', addSelectedEmployee);
        emitter.on('update-selected-employees', updateSelected);

        onBeforeUnmount(() => {
            emitter.off('add-selected-applicant', addSelectedEmployee);
            emitter.off('update-selected-employees', updateSelected);
        });

        async function updateSelected() {
            try {
                await store.dispatch('applicant/bulkUpdate', {
                    applicants: selectedApplicants, status: status
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

        async function updateWarning(statusValue) {
            status = statusValue;
            selectedApplicants = [];
            emitter.emit('collect-selected-applicants');
            setTimeout(() => handleEmitWarning(), 500)
        }

        function handleEmitWarning() {
            const warning = {
                message: generateWarningMessage(),
                event_id: updateEventId,
                action: 'updated to : ' + status
            }

            emitter.emit('notification-warning', warning);
        }

        function generateWarningMessage() {
            return 'statuses of ' + selectedApplicants.length + ' applicants';
        }

        return {
            updateWarning, availableStatuses: computed(() => store.getters.getAvailableStatuses)
        }
    }
}
</script>
