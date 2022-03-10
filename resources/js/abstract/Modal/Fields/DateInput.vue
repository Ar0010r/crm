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
                   @blur="date.handleBlur"
                   @change="$emit('update:vmodel', $event.target.value)"
                   :class="{ 'is-invalid': !date.meta.valid && date.meta.touched}"
            >
            <small class=" col-md-12 invalid-feedback text-right">please enter valid date</small>
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
        let rule = string().trim().nullable().matches("^((?:19|20)[0-9][0-9])-(0[1-9]|1[012])-([12][0-9]|3[01]|0[1-9])$", 'valid date format is yyyy-mm-dd');
        rule = props.required ? rule.required() : rule;
        let date = useField('vmodel', rule )

        date.setValue(props.vmodel)

        async function validate() {
            console.log('props.vmodel',props.vmodel)

            date.setValue(props.vmodel)
            date.setTouched(true)
            await date.validate()

            if (!date.meta.valid) {
                console.log('input.meta.valid' + props.label, props.vmodel )
                emitter.emit(props.validate + '-invalid')
            }
        }

        emitter.on(props.reset, date.resetField);
        onBeforeUnmount(() => emitter.off(props.reset, date.resetField));

        emitter.on(props.validate, validate);
        onBeforeUnmount(() => emitter.off(props.reset, validate));

        return {
            date,
            focus: async function () {
                await validate()
                date.setTouched(false)
            },
            change: async function (event) {
                date.handleChange(event)
                await validate()
                date.setTouched(false)
            },
        }
    },
    props: {
        label: {
            type: String,
            default: 'date'
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

