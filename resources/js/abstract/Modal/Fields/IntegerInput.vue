<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2 m-0">{{ label }}</label>
            <input class="form-control col-md-10" type="number" :placeholder="label"
                   v-model="vmodel"
                   v-bind="{
                       ...$attrs,
                       onChange: ($event) => {$emit('update:vmodel', $event.target.value)}
                    }"
                   @focus="focus"
                   @input="change"
                   @blur="input.handleBlur"
                   @change="$emit('update:vmodel', $event.target.value)"
                   :class="{ 'is-invalid': !input.meta.valid && input.meta.touched}"
            >
            <small class=" col-md-12 invalid-feedback text-right p-0">please enter valid number</small>
        </div>
    </div>
</template>

<script>
import {useField} from 'vee-validate';
import {inject, onBeforeUnmount} from "vue";

export default {
    setup(props) {
        const emitter = inject("emitter");
        let input = useField('vmodel', function (value) {
            if (!props.required) {
                if (typeof value === 'number' || value === null || value === undefined || value === 0) {
                    return true
                }
            }

            if (typeof value === 'number' || value === 0) {
                return true
            }

            return false
        })

        input.setValue(props.vmodel)

        async function validate() {
            input.setValue(props.vmodel)
            input.setTouched(true)
            await input.validate()

            if (!input.meta.valid) {
                emitter.emit(props.validate + '-invalid')
            }
        }

        emitter.on(props.reset, input.resetField);
        onBeforeUnmount(() => emitter.off(props.reset, input.resetField));

        emitter.on(props.validate, validate);
        onBeforeUnmount(() => emitter.off(props.reset, validate));

        return {
            focus: async function () {
                await validate()
                input.setTouched(false)
            },
            change: async function (event) {
                input.handleChange(event)
                await validate()
                input.setTouched(false)
            },
            input,
        }
    },
    props: {
        label: {
            type: String,
            default: 'Date'
        },
        reset: String,
        validate: String,
        required: {
            type: Boolean,
            default: false
        },
        vmodel: Number,
    },
};
</script>

