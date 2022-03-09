<template>
    <a data-toggle="modal" v-bind="attribute">
        <button type="button" class="fas fa-edit p-0 bg-transparent border-0"
                data-toggle="tooltip"
                data-placement="right" title="Edit"
                @click="showEditForm"
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
            showEditForm: () => emitter.emit(props.event, props.model),
            attribute: {
                'data-target': props.target
            }
        }
    },
    props: {
        model: Object,
        target: String,
        event: String,
    },
};
</script>
