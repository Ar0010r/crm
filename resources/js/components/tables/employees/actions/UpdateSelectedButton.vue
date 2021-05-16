<template>
    <div class="btn-group btn-s ml-2">
        <button class="btn btn-white dropdown-toggle " type="button" data-toggle="dropdown">update selected</button>
        <div class="dropdown-menu p-0 m-0 text-center">
            <a class="dropdown-item disabled" href="javascript:void(0)">Select status</a>
            <div class="dropdown-divider m-0"></div>
            <a v-for="(cssClass, status) in statuses" :key="status" @click='updateWarning(status)'
               class="dropdown-item" :class="cssClass"
               href="javascript:void(0)"
            >
                {{status}}
            </a>
        </div>
    </div>
</template>

<script>
    import {inject, computed, onBeforeUnmount} from 'vue';
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
            let availableStatuses = computed(() => {
                    let profile = {...store.getters.getProfile};

                    switch (profile.role) {
                        case "admin":
                            return ['New', 'Waiting agreement', 'Agreement sent', 'Ready']

                        case "hr", "top hr" :
                            return ['New', 'Waiting agreement'];

                        case "personnel":
                            return ['Ready',  'Agreement sent'];

                        default:
                            return [];
                    }
                }
            );

            let statuses = computed(() => {
                let allStatuses = {...store.getters.getStatuses};

                Object.keys(allStatuses).forEach((status) => {
                    if (!availableStatuses.value.includes(status)) delete allStatuses[status];
                });

                return allStatuses;
            });

            emitter.on('add-selected-employee', addSelectedEmployee);
            emitter.on('update-selected-employees', updateSelected);

            onBeforeUnmount(() => {
                emitter.off('add-selected-employee', addSelectedEmployee);
                emitter.off('update-selected-employees', updateSelected);
            });

            async function updateSelected() {
                try {
                    await container.EmployeeService.updateSelected(selectedEmployees, status);
                    selectedEmployees.forEach(employee => employee.status = status);

                    store.dispatch('employee/bulkUpdate', selectedEmployees)
                    emitter.emit('notification-success', selectedEmployees.length + ' applicants were updated');
                    emitter.emit('reset-checkbox');
                    selectedEmployees = [];
                } catch (e) {
                    console.log(e)
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
                updateWarning, availableStatuses, statuses
            }
        }
    }
</script>