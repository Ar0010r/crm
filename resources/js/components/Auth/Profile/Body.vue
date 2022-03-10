<template>
   <div class="modal-body">
       <Input v-model="object.login" :vmodel="object.login" :reset="reset" :validate="validate" label="login" :required=true />
       <Input v-model="object.password" :vmodel="object.password" :reset="reset" :validate="validate" :required=requirePassword label="password"/>
    </div>
</template>

<script>
    import Select from '../../../abstract/Modal/Fields/Select.vue';
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
            Select,
            Input,
        }
    };
</script>
