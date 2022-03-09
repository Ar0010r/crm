<template>
    <a  data-toggle="modal" data-target="#deleteForm" @click="deleteWarning" type="button" class="fas fa-trash-alt danger"></a>
</template>

<script>
    import {useStore} from 'vuex'
    import {inject, onBeforeUnmount} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');
            const deleteEventId = 'delete-user-' + props.user.id;

            emitter.on(deleteEventId, deleteUser)
            onBeforeUnmount(() => emitter.off(deleteEventId, deleteUser));

            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                }
                emitter.emit('show-delete-modal', warning);
            }

            async function deleteUser() {
                try {
                    await container.ManagerService.delete(props.user);
                    emitter.emit('notification-success', ' manager ' + props.user.login +' was deleted');
                    store.dispatch('manager/deleteUser', props.user);
                } catch (e) {
                    console.log(e);
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                let message = 'You want to delete manager: ';
                if (props.user.login) message = message + '<strong>' + props.user.login + '</strong>';
                else message = message + '<strong>' + props.user.role + '</strong>';

                return message
            }

            return {
                deleteWarning,
            }
        },
        props: {
            user: Object
        },
    };
</script>
