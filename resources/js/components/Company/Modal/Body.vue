<template>
   <div class="modal-body">
        <Select :options=types
                title="select type"
                label="type"
                :vmodel=object.type
                v-model="object.type"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=managers
                title="select manager"
                label="manager"
                name="login"
                :vmodel=object.manager_id
                v-model="object.manager_id"
                :required="true"
                :reset="reset"
                :validate="validate"
                :disabled="(object.type == null)"
        />
       <Input v-model="object.name"
              :vmodel="object.name"
              :validate="validate"
              :reset="reset"
              label="name"
              regex='^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$'
              :required=true
       />
       <Input v-model="object.domain"
              :vmodel="object.domain"
              :validate="validate"
              :reset="reset"
              label="domain"
              regex='^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$'
              :required=true
       />
       <Input v-model="object.pseudonym"
              :vmodel="object.pseudonym"
              :validate="validate"
              :reset="reset"
              label="pseudonym"
              regex='^[a-zA-Z ]*$'
              :required=true
       />
       <Input v-model="object.email"
              :vmodel="object.email"
              :validate="validate"
              :reset="reset"
              label="email"
              regex='email'
              :required=true
       />
    </div>
</template>

<script>
    import Select from '../../../abstract/Modal/Fields/Select.vue';
    import Input from '../../../abstract/Modal/Fields/Input.vue';
    import {useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {object:Object, reset:String, validate:String},
        setup(props) {
            const store = useStore()
            return {
                types: store.getters.getTypes,
                managers: computed(() => props.object.type == 1 ? store.getters.getHrs : store.getters.getPersonnels),
                results: [{"name" : "inbox", "id" : 1}, {"name" : "spam", "id" : 0}],
            }
        },
        components: {
            Select,
            Input,
        }
    };
</script>
