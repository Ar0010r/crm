<template>
    <a @click="deleteWarning"  data-toggle="modal" data-target="#deleteForm" type="button" class="fas fa-trash-alt danger"></a>
</template>
<script>
    import {useStore} from 'vuex'
    import {inject, onBeforeUnmount} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');
            const deleteEventId = 'delete-employee-' + props.employee.id;

            emitter.on(deleteEventId, deleteEmployee)
            onBeforeUnmount(() => emitter.off(deleteEventId, deleteEmployee));


            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                }

                emitter.emit('show-delete-modal', warning);
            }

            async function deleteEmployee() {
                try {
                    await container.EmployeeService.deleteEmployee(props.employee);
                    store.dispatch('employee/deleteEmployee', props.employee);
                    emitter.emit('notification-success', ' applicant was deleted');
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                let message = 'You want to delete applicant: ';
                if (props.employee.name) message = message + '<strong>' + props.employee.name + '</strong>';
                else message = props.employee.email;

                return message
            }

            return {
                deleteWarning,
            }
        },
        props: {
            employee: Object
        },
    };
</script>
