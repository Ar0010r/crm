<template>
    <a @click="deleteWarning" type="button" class="fas fa-trash-alt danger"></a>
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
                    event_id: deleteEventId
                }
                emitter.emit('notification-warning', warning);
            }

            async function deleteUser() {
                try {
                    await container.UserService.deleteUser(props.user);
                    emitter.emit('notification-success', ' manager ' + props.user.login +' was deleted');
                    store.dispatch('user/deleteUser', props.user);
                } catch (e) {
                    console.log(e);
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                let message;
                if (props.user.login) message = props.user.login;
                else message = props.user.role;

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
