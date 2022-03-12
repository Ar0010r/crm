<template>
   <div class="modal-body">
       <FileInput v-model="object.file" :vmodel="object.file" :reset="reset" :validate="validate" label="avatar"/>
       <Input v-model="object.login" :vmodel="object.login" :reset="reset" :validate="validate" label="login" />
       <Input v-model="object.password" :vmodel="object.password" :reset="reset" :validate="validate" label="password"/>
    </div>
</template>

<script>
    import FileInput from '../../../abstract/Modal/Fields/FileInput';
    import Input from '../../../abstract/Modal/Fields/Input.vue';
    import {useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {
            object:Object,
            reset:String,
            validate:String,
            requirePassword: {
                type:Boolean,
                default: false
            }},
        setup() {
            const store = useStore()

            return {
                companies: computed(() => store.getters.getCompanies),
                roles: computed(() => store.getters.getRoles.map(function (value) {
                    return {
                        "id": value,
                        "name": value
                    }
                })),
            }
        },
        components: {
            FileInput,
            Input,
        }
    };
</script>
