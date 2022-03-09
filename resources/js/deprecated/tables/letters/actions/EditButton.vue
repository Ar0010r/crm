<template>
    <a data-toggle="modal" data-target="#editLetterForm">
        <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                data-toggle="tooltip" data-target="#editLetterForm"
                data-placement="right" title="Edit"
                @click="showEditLetterForm"
        >
        </button>
    </a>
</template>

<script>
    import {inject} from 'vue';

    export default {
        setup(props) {
            const emitter = inject("emitter");

            return {
                showEditLetterForm: () => emitter.emit('edit-letter-form', props.letter)
            }
        },
        props: {
            letter: Object
        },
    };
</script>
