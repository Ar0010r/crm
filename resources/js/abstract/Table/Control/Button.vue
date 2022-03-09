<template>
    <div class="col-auto mb-4">
        <label class="form-label d-none d-md-block">&nbsp;</label>
        <button class="btn btn-primary" data-toggle="modal"
                @click="initializeStoreForm"
                v-bind="attribute">
            {{ title }}
        </button>
    </div>
</template>

<script>
import {inject} from "vue";
import {useStore} from "vuex";

export default {
    props: {
        title: String,
        target: String,
        event: String,
        getter: String,
    },
    setup(props) {
        const emitter = inject("emitter");
        const store = useStore();

        return {
            initializeStoreForm: function () {
                if(props.getter) {
                    emitter.emit(props.event, store.getters[props.getter])
                } else {
                    emitter.emit(props.event)
                }
            },
            attribute: {
                'data-target': props.target
            }
        }
    }
};
</script>
