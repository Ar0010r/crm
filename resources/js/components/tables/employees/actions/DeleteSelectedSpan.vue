<template>
    <div @click="deleteWarning" class="text-danger ml-2 d-flex align-items-center cursor-pointer">
        <a class="ion ion-ios-close-circle-outline"></a>
        <span class="ml-1"> delete</span>
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
            onBeforeUnmount(() => emitter.off('add-selected-employee', addSelectedEmployee));

            emitter.on('delete-selected-employees', deleteSelected);
            onBeforeUnmount(() => emitter.off('delete-selected-employees', deleteSelected));

            async function deleteSelected() {
                try {
                    await container.EmployeeService.deleteSelected(selectedEmployees);
                    store.dispatch('employee/bulkDelete', selectedEmployees)
                    emitter.emit('notification-success', selectedEmployees.length + ' applicants were deleted');
                    emitter.emit('reset-checkbox');
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