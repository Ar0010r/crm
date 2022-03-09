<template>
    <a data-toggle="modal" data-target="#editManagerForm" @click=showEditManagerForm >
        <a type="button" class="fas fa-user-edit p-0 bg-transparent border-0" title="Edit"
                data-toggle="tooltip"
                data-placement="right">
        </a>
    </a>
</template>

<script>
    import {inject} from 'vue';

    export default {
        setup(props) {
            const emitter = inject("emitter");

            return {
                showEditManagerForm: () => emitter.emit('edit-manager-form', props.user)
            }
        },
        props: {
            user: Object
        },
    };
</script>
