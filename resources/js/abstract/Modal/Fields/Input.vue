<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2 m-0">{{ label }}</label>
            <input class="form-control col-md-10" type="text" :placeholder="label"
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
            <small class=" col-md-12 invalid-feedback text-right p-0">please enter valid {{ label }}</small>
        </div>
    </div>
</template>

<script>
import {useField} from 'vee-validate';
import {inject, onBeforeUnmount} from "vue";
import {string} from "yup";

export default {
    setup(props) {
        const emitter = inject("emitter");
        let rule = props.required ? string().trim().required() : string().trim().nullable();

        if (props.regex != "") {
            if (props.regex == "email") {
                rule = rule.email()
            } else {
                rule = rule.matches(props.regex, "")
            }
        }
        let input = useField('vmodel', rule)

        input.setValue(props.vmodel)

        async function validate() {
            input.setValue(props.vmodel)
            input.setTouched(true)
            await input.validate()

            if (!input.meta.valid) {
                console.log(props.label, input.errors.value)
                console.log(props.label, input.value.value)
                emitter.emit(props.validate + '-invalid')
            }
        }

        emitter.on(props.reset, input.resetField);
        onBeforeUnmount(() => emitter.off(props.reset, input.resetField));

        emitter.on(props.validate, validate);
        onBeforeUnmount(() => emitter.off(props.reset, validate));

        return {
            input,
            focus: async function () {
                await validate()
                input.setTouched(false)
            },
            change: async function (event) {
                input.handleChange(event)
                await validate()
                input.setTouched(false)
            },
        }
    },
    props: {
        label: {
            type: String,
            default: 'Date'
        },
        regex: {
            type: String,
            default: ""
        },
        reset: String,
        validate: String,
        required: {
            type: Boolean,
            default: false
        },
        vmodel: String,
    },
};
</script>

