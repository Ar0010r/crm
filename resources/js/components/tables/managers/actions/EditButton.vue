<template>
    <a data-toggle="modal" data-target="#editManagerForm" @click=showEditManagerForm >
        <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0" title="Edit"
                data-toggle="tooltip"
                data-placement="right">
        </button>
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
