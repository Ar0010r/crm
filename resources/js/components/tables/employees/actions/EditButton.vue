<template>
    <a data-toggle="modal" data-target="#editEmployeeForm">
        <a type="button" class="fas fa-user-edit p-0 bg-transparent border-0"
                data-toggle="tooltip" data-target="#editEmployeeForm"
                data-placement="right" title="Edit"
                @click="showEditEmployeeForm"
        ></a>
    </a>
</template>

<script>
    import {inject} from 'vue';

    export default {
        setup(props) {
            const emitter = inject("emitter");

            return {
                showEditEmployeeForm: () => emitter.emit('edit-employee-form', props.employee)
            }
        },
        props: {
            employee: Object
        },
    };
</script>
