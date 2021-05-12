<template>
    <a @click="deleteWarning" type="button" class="ion ion-md-trash danger"></a>
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
                    event_id: deleteEventId
                };
                emitter.emit('notification-warning', warning);
            }

            async function deleteCompany() {
                try {
                    console.log('delete company', props.company)
                    await container.CompanyService.deleteCompany(props.company);
                    store.dispatch('company/deleteCompany', props.company);
                } catch (e) {
                    emitter.emit('notification-error', e.response.data)
                }
            }

            function generateWarningMessage() {
                let message;
                if (props.company.email) message = props.company.email;
                else message = props.company.name;

                return message
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
