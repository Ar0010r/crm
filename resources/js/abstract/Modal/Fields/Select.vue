<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2 m-0">{{ label }}</label>
            <select class="custom-select form-control form-control-sm col-md-10" :name="label"
                    v-model="vmodel"
                    v-bind="{
                       ...$attrs,
                       onChange: ($event) => {$emit('update:vmodel', $event.target.value)}
                    }"
                    @focus="focus"
                    @change=model.handleChange
                    @blur="model.handleBlur"
                    :class="{'is-invalid': !model.meta.valid  && model.meta.touched}"
            >
                <option disabled selected :value=null> -- {{ title }} --</option>
                <option v-for="option in options"
                        :value='option[value]'
                        :selected='option.id === vmodel'>
                    {{ option[name] }}
                </option>
            </select>
            <small class="col-md-12 invalid-feedback text-right p-0">please select {{ label }}</small>
        </div>
    </div>
</template>

<script>
import {useField} from 'vee-validate';
import {inject, onBeforeUnmount} from "vue";

export default {
    setup(props) {
        const emitter = inject("emitter");

        let model = useField('vmodel', function (value) {
            let values = [];

            if (props.options instanceof Array) {
                props.options.forEach((option) => {
                    values.push(option[props.value])
                });
            }

            if (props.options instanceof Object) {
                Object.values(props.options).forEach((option) => {
                    values.push(option[props.value])
                });
            }

            if (!props.required) {
                values.push(null, undefined)
            }

            return values.includes(value)
        });

        async function validate() {
            model.setValue(props.vmodel)
            model.setTouched(true)
            await model.validate()
            if (!model.meta.valid) {
                console.log(props.label, model.errors.value)
                console.log(props.label, model.value.value)
                emitter.emit(props.validate + '-invalid')
            }
        }

        emitter.on(props.reset, model.resetField);
        onBeforeUnmount(() => emitter.off(props.reset, model.resetField));

        emitter.on(props.validate, validate);
        onBeforeUnmount(() => emitter.off(props.reset, validate));

        return {
            model,
            focus: function () {
                validate()
                model.meta.touched = false
            },
        }
    },
    props: {
        options: Object | Array,
        title: String,
        label: String,
        reset: String,
        validate: String,
        vmodel: {
            default: null
        },
        value: {
            type: String,
            default: 'id'
        },
        name: {
            type: String,
            default: 'name'
        },
        required: {
            type: Boolean,
            default: false
        }
    },
};
</script>

