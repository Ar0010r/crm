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
            const deleteEventId = 'delete-company-' + props.company.id;

            emitter.on(deleteEventId, deleteCompany);
            onBeforeUnmount(() => emitter.off(deleteEventId, deleteCompany));

            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: deleteEventId,
                    action: 'deleted'
                };
                emitter.emit('show-delete-modal', warning);
            }

            async function deleteCompany() {
                try {
                    await container.CompanyService.deleteCompany(props.company);
                    emitter.emit('notification-success', ' company ' + props.company.name +' was deleted');
                    store.dispatch('company/deleteCompany', props.company);
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                return 'You want to delete company: ' + '<strong>' + props.company.name + '</strong>';
            }

            return {
                deleteWarning, deleteEventId
            }
        },
        props: {
            company: Object
        },
    };
</script>
