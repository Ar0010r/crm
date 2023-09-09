<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2 m-0">{{ label }}</label>
            <input class="form-control col-md-10" type="text" :id="label" :placeholder="placeholder ?? label"
                   :value="modelValue"
                   @focus="focus"
                   @input="$emit('update:modelValue', format($event.target.value))"
                   @blur="input.handleBlur"
                   @change="change"
                   :class="{ 'is-invalid': !input.meta.valid && input.meta.touched}"
            >
            <small class=" col-md-12 invalid-feedback text-right p-0">please enter valid {{ label }}</small>
        </div>
    </div>
</template>

<script>
import {useField} from 'vee-validate';
import {inject, onBeforeUnmount, ref} from "vue";
import {string} from "yup";

export default {
    setup(props) {
        const emitter = inject("emitter");
        let rule = props.required ? string().trim().required() : string().trim().nullable();
        rule = rule.matches('^\\d{3}-\\d{3}-\\d{4}$', "")

        let input = useField('modelValue', rule)

        input.setValue(props.modelValue)

        async function validate() {
            if(props.modelValue == null || props.modelValue == "") {
                if(!props.required) {
                    input.resetField()
                    input.setTouched(false)
                    return
                }
            }
            input.setValue(props.modelValue);
            input.setTouched(true);
            await input.validate();

            if (!input.meta.valid) {
                emitter.emit(props.validate + '-invalid')
            }
        }

        function format(input) {
            if(!input){
                return "";
            }
            const onlyNumbers = input.replace(/\D/g, '');
            const areaCode = onlyNumbers.slice(0, 3);
            const prefix = onlyNumbers.slice(3, 6);
            const line = onlyNumbers.slice(6);
            let phone = areaCode ? areaCode : "";
            phone = prefix ? `${phone}-${prefix}`: phone;
            return line ?`${phone}-${line}`: phone;
        }


        emitter.on(props.reset, input.resetField);
        onBeforeUnmount(() => emitter.off(props.reset, input.resetField));

        emitter.on(props.validate, validate);
        onBeforeUnmount(() => emitter.off(props.validate, validate));

        return {
            input, format,
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
            default: 'phone'
        },
        placeholder: {
            default:"xxx-xxx-xxxx"
        },
        reset: String,
        validate: String,
        required: {
            type: Boolean,
            default: false
        },
        modelValue: String,
    },
};
</script>

