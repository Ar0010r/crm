<template>
    <button  data-toggle="modal"
             data-target="#deleteForm"
             @click="deleteWarning"
             type="button"
             class="fas fa-trash-alt border-0 bg-transparent"
    >
    </button>
</template>

<script>
    import {useStore} from 'vuex'
    import {inject, onBeforeUnmount, computed} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');
            const deleteEventId = props.event + props.model.id;

            emitter.on(deleteEventId, remove);
            onBeforeUnmount(() => emitter.off(deleteEventId, remove));

            async function deleteWarning() {
                const warning = {
                    message: props.warning,
                    event_id: deleteEventId,
                    action: 'deleted'
                };
                emitter.emit('show-delete-modal', warning);
            }

            async function remove() {
                try {
                    await store.dispatch(props.dispatch, props.model);
                    emitter.emit('notification-success', ' record was deleted');
                } catch (e) {
                    console.log(e);
                    emitter.emit('notification-error', e.response.data)
                }
            }

            return {
                deleteWarning, deleteEventId,
            }
        },
        props: {
            model: Object,
            event: String,
            warning: String,
            dispatch: String,
        },
    };
</script>
