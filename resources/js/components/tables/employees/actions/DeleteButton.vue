<template>
    <a @click="deleteWarning" type="button" class="ion ion-md-trash danger"></a>
</template>

<script>
    import {useStore} from 'vuex'
    import {inject} from 'vue';

    export default {
        setup(props) {
            const store = useStore();
            const emitter = inject("emitter");
            const container = inject('container');

            emitter.on('delete-employee-' + props.employee.id, deleteEmployee);

            async function deleteWarning() {
                const warning = {
                    message: generateWarningMessage(),
                    event_id: props.employee.id
                }
                emitter.emit('delete-warning', warning);
            }

            async function deleteEmployee() {
                try {
                    await container.EmployeeService.deleteEmployee(props.employee);
                    store.dispatch('employee/deleteEmployee', props.employee);
                } catch (e) {
                    store.dispatch('notification/activate', e.response.data);
                }
            }

            function generateWarningMessage() {
                let message;
                if (props.employee.email) message = props.employee.email;
                else message = props.employee.name;

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
