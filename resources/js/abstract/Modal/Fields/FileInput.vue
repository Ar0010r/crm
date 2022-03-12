<template>
    <div class="form-row mb-2">
        <div class="form-group col mb-0 d-flex align-items-center justify-content-between flex-wrap">
            <label class="form-label col-md-2 m-0">{{ label }}</label>
            <input class="form-control col-md-10" type="text" placeholder="Click to select an image"
                   @click="selectFile"
                   :class="{ 'is-invalid': !input.meta.valid && input.meta.touched}"
            >
            <small class=" col-md-12 invalid-feedback text-right p-0">please enter valid {{ label }}</small>
            <input type="file" id="avatarInput" accept=".jpg, .png, .jpeg"
                   v-bind="{
                       ...$attrs,
                       onChange: ($event) => {
                           setFile($event)
                           $emit('update:vmodel', 1112345)
                       }
                    }"
                   style="visibility: hidden; position: absolute; width: 1px; height: 1px;">
        </div>
    </div>
</template>

<script>
import {useField} from 'vee-validate';
import {inject, onBeforeUnmount} from "vue";

export default {
    setup(props, context) {
        const emitter = inject("emitter");

        let input = useField('vmodel', function (value) {
            if (!props.required) {
                return true
            }

            if(value == null || value == undefined) {
                return 'please select file'
            }

            return true
        })

        input.setValue(props.vmodel)

        async function validate() {
            //input.setValue(props.vmodel)
            input.setTouched(true)
            await input.validate()

            if (!input.meta.valid) {
                emitter.emit(props.validate + '-invalid')
            }
        }

        emitter.on(props.reset, input.resetField);
        onBeforeUnmount(() => emitter.off(props.reset, input.resetField));

        emitter.on(props.validate, validate);
        onBeforeUnmount(() => emitter.off(props.validate, validate));

        return {
            input,
            selectFile: () => document.getElementById("avatarInput").click(),
            setFile: event => {
                console.log('event.target.files', event.target.files)

                //context.emit('update:vmodel', 12345)
                context.emit('update:vmodel', event.target.files[0])
                input.setValue(event.target.files[0])
            },
            //setFile: event => props.vmodel = event.target.files[0],
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
            default: 'file'
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

