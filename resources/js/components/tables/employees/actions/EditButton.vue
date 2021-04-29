<template>
    <a data-toggle="modal" data-target="#editEmployeeForm">
        <button type="button" class="ion ion-md-create p-0 bg-transparent border-0"
                data-toggle="tooltip" data-target="#editEmployeeForm"
                data-placement="right" title="Edit"
                @click="showEditEmployeeForm"
        ></button>
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
