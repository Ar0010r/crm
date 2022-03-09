<template>
    <a  data-toggle="modal" data-target="#deleteForm" @click="deleteWarning" type="button" class="ion ion-md-trash danger"></a>
</template>

<script>
    import {useStore} from 'vuex'
    import {inject, onBeforeUnmount, on} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');
            const deleteEventId = 'delete-letter-' + props.letter.id;

            emitter.on(deleteEventId, deleteLetter);
            onBeforeUnmount(() => emitter.off(deleteEventId, deleteLetter));

            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                };
                emitter.emit('show-delete-modal', warning);
            }

            async function deleteLetter() {
                try {
                    await container.LetterService.delete(props.letter);
                    emitter.emit('notification-success', ' letter received on ' + props.letter.received_at +' was deleted');
                    store.dispatch('mail/deleteLetter', props.letter);
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                return 'You want to delete letter received on: ' + '<strong>' + props.letter.received_at + '</strong>';
            }

            return {
                deleteWarning, deleteEventId
            }
        },
        props: {
            letter: Object
        },
    };
</script>
