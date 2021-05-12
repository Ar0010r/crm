<template>
    <div class="ml-2 d-flex align-items-center cursor-pointer">
        <a class="ion ion-ios-create"></a>
        <span>set status :</span>
        <span @click="updateWarning('New')" class="ml-1 hover">new</span>
        <span class="ml-1"> / </span>
        <span @click="updateWarning('Waiting agreement')" class="ml-1 hover">waiting agreement</span>
    </div>
</template>

<script>
    import {inject, onBeforeUnmount} from 'vue';
    import {useStore} from 'vuex';

    export default {
        name: "UpdateSelectedSpan",
        setup() {
            const emitter = inject('emitter');
            const container = inject('container');
            const store = useStore();
            const updateEventId = 'update-selected-employees';
            let selectedEmployees = [];
            let status;

            emitter.on('add-selected-employee', addSelectedEmployee);
            onBeforeUnmount(() => emitter.off('add-selected-employee', addSelectedEmployee));

            emitter.on('update-selected-employees', updateSelected);
            onBeforeUnmount(() => emitter.off('update-selected-employees', updateSelected));

            async function updateSelected() {
                try {
                    await container.EmployeeService.updateSelected(selectedEmployees);
                    store.dispatch('employee/bulkDelete', selectedEmployees)
                    emitter.emit('notification-success', selectedEmployees.length + ' applicants were updated');
                    emitter.emit('reset-checkbox');
                    selectedEmployees = [];
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function addSelectedEmployee(employee) {
                selectedEmployees.push(employee)
            }

            async function updateWarning(statusValue) {
                status = statusValue;
                selectedEmployees = [];
                emitter.emit('collect-selected-employees');
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
                return 'statuses of ' + selectedEmployees.length + ' applicants';
            }

            return {
                updateWarning
            }
        }
    }
</script>