<template>
    <a data-toggle="modal" data-target="#editTestForm">
        <button type="button" class="ion ion-md-cog p-0 bg-transparent border-0"
                data-toggle="tooltip" data-target="#editTestForm"
                data-placement="right" title="Edit"
                @click="showEditTestForm"
        >
        </button>
    </a>
</template>

<script>
import {inject} from 'vue';
import {useStore} from "vuex";

    export default {
        setup(props) {
            const emitter = inject("emitter");
            const store = useStore();

            return {
                showEditTestForm: () => emitter.emit('edit-test-form', props.test),
            }
        },
        props: {
            test: Object
        },
    };
</script>
