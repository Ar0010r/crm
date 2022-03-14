<template>
    <div class="modal fade" :id="id">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <slot :object="model"></slot>
                <div class="modal-footer">
                    <button :id="id + 'Close'" type="button" class="btn btn-default" data-dismiss="modal">close</button>
                    <button @click.prevent="action" :disabled="disabled" type="button" class="btn btn-primary">{{ purpose }}</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {useStore} from 'vuex';
import {computed, inject, reactive, ref, onBeforeUnmount} from 'vue';

export default {
    props: {
        title: String,
        getter: String,
        open: String,
        message: String,
        purpose: String,
        dispatch: String,
        validate: String,
        id: String,
    },
    setup(props) {
        const store = useStore();
        const emitter = inject("emitter");
        let isValid = false;
        let disabled = ref(false)

        let model = reactive({...store.getters[props.getter]});

        function set(data) {
            Object.keys(model).forEach(key => model[key] = data[key])
            if(data.id) model.id = data.id
        }

        function isInvalid() {
            isValid = false
        }

        async function validate() {
            disabled.value = true;
            isValid = true
            await emitter.emit(props.validate)
            await new Promise(r => setTimeout(r, 500));
            disabled.value = false

            return isValid;
        }

        emitter.on(props.open, set);
        onBeforeUnmount(() => emitter.off(props.open, set));

        emitter.on(props.validate + '-invalid', isInvalid);
        onBeforeUnmount(() => emitter.off(props.validate + '-invalid', isInvalid));

        return {
            model, disabled,
            action: async function () {
                try {
                    let formValid = await validate()
                    if (formValid) {
                        await store.dispatch(props.dispatch, model);
                        emitter.emit('notification-success', props.message);
                        document.getElementById(props.id).click()
                    }
                } catch (e) {
                    console.log(e);
                    if (e.response) {
                        emitter.emit('notification-error', e.response.data)
                    }
                }
            }
        }
    }
};
</script>

