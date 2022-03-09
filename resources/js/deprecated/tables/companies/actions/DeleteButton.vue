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
            const deleteEventId = 'delete-company-' + props.company.id;

            emitter.on(deleteEventId, remove);
            onBeforeUnmount(() => emitter.off(deleteEventId, remove));

            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                };
                emitter.emit('show-delete-modal', warning);
            }

            async function remove() {
                try {
                    await container.CompanyService.delete(props.company);
                    emitter.emit('notification-success', ' company ' + props.company.name +' was deleted');
                    store.dispatch('company/delete', props.company);
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                return 'You want to delete company: ' + '<strong>' + props.company.name + '</strong>';
            }

            return {
                deleteWarning, deleteEventId,
                disabled: function () {
                    console.log('disable ? ' , profile.value.role, props.company.type)
                    if(profile.value.role == 'hr' || profile.value.role == 'top hr') {
                        if(props.company.type == 0) {
                            return true
                        }
                    }
                    return false
                },
            }
        },
        props: {
            company: Object
        },
    };
</script>
