<template>
    <button :disabled="disabled()"  data-toggle="modal" data-target="#deleteForm" @click="deleteWarning" type="button" class="ion ion-md-trash danger border-0"></button>
</template>

<script>
    import {useStore} from 'vuex'
    import {inject, onBeforeUnmount, computed} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');
            const profile = computed(() => store.getters.getProfile)
            const deleteEventId = 'delete-test-' + props.test.id;

            emitter.on(deleteEventId, deleteTest);
            onBeforeUnmount(() => emitter.off(deleteEventId, deleteTest));

            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                };
                emitter.emit('show-delete-modal', warning);
            }

            async function deleteTest() {
                try {
                    await container.TestService.delete(props.test);
                    emitter.emit('notification-success', ' test ' + props.test.name +' was deleted');
                    store.dispatch('test/deleteTest', props.test);
                } catch (e) {
                    console.log(e);
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                return 'You want to delete test: ' + '<strong>' + props.test.name + '</strong>';
            }

            return {
                deleteWarning, deleteEventId,
                disabled: function () {
                    console.log('disable ? ' , profile.value.role, props.test.type)
                    if(profile.value.role == 'hr' || profile.value.role == 'top hr') {
                        if(props.test.type == 0) {
                            return true
                        }
                    }
                    return false
                },
            }
        },
        props: {
            test: Object
        },
    };
</script>
