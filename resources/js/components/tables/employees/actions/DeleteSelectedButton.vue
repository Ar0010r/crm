<template>
    <div @click="deleteWarning" class="text-danger d-flex align-items-center cursor-pointer">
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
            let selectedEmployees = [];

            emitter.on('add-selected-employee', addSelectedEmployee);
            emitter.on('delete-selected-employees', deleteSelected);

            onBeforeUnmount(() => {
                emitter.off('add-selected-employee', addSelectedEmployee)
                emitter.off('delete-selected-employees', deleteSelected)
            });


            async function deleteSelected() {
                try {
                    await container.EmployeeService.deleteSelected(selectedEmployees);
                    store.dispatch('employee/bulkDelete', selectedEmployees)
                    emitter.emit('notification-success', selectedEmployees.length + ' applicants were deleted');
                    emitter.emit('reset-checkbox');
                    store.dispatch('user/setProfileToStore')
                    selectedEmployees = [];
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function addSelectedEmployee(employee) {
                selectedEmployees.push(employee)
            }

            async function deleteWarning() {
                selectedEmployees = [];
                emitter.emit('collect-selected-employees');
                setTimeout(() => handleEmitWarning(), 500)
            }

            function handleEmitWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                }

                emitter.emit('notification-warning', warning);
            }

            function generateWarningMessage() {
                return selectedEmployees.length + ' applicants'
            }

            return {
                deleteWarning
            }
        }
    }
</script>

<style scoped>

</style>