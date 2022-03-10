<template>
   <div class="modal-body">
        <Select :options=companies
                title="select company"
                label="company"
                :vmodel=object.company_id
                v-model="object.company_id"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=envs()
                title="select env"
                label="env"
                :vmodel=object.env
                v-model="object.env"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=templates()
                title="select template"
                label="template"
                :vmodel=object.template
                v-model="object.template"
                :required="true"
                :reset="reset"
                :validate="validate"
        />
        <Select :options=results
                title="select result"
                label="google"
                :vmodel=object.google
                v-model="object.google"
                :reset="reset"
                :validate="validate"
        />
        <Select
            :options=results
            title="select result"
            label="yahoo"
            :vmodel=object.yahoo
            v-model="object.yahoo"
            :reset="reset"
            :validate="validate"
        />
        <Select
            :options=results
            title="select result"
            label="outlook"
            :vmodel=object.outlook
            v-model="object.outlook"
            :reset="reset"
            :validate="validate"
        />
        <Select
            :options=results
            title="select result"
            label="other"
            :vmodel=object.other
            v-model="object.other"
            :reset="reset"
            :validate="validate"
        />
       <pre>{{object.date}}</pre>
        <DateInput v-model="object.date" :vmodel="object.date" :reset="reset" :validate="validate"/>
    </div>
</template>

<script>
    import Select from '../../../abstract/Modal/Fields/Select.vue';
    import DateInput from '../../../abstract/Modal/Fields/DateInput.vue';
    import {useStore} from 'vuex';
    import {computed} from 'vue';

    export default {
        props: {object:Object, reset:String, validate:String},
        setup() {
            const store = useStore()
            return {
                companies: computed(() => store.getters.getCompanies),
                envs: function () {
                    return store.getters.getEnvs.map(function (value) {
                        return {
                            "id": value,
                            "name": value
                        }
                    })
                },
                templates: function () {
                    return store.getters.getTemplates.map(function (value) {
                        return {
                            "id": value,
                            "name": value
                        }
                    })
                },
                results: [{"name" : "inbox", "id" : 1}, {"name" : "spam", "id" : 0}],
            }
        },
        components: {
            Select,
            DateInput,
        }
    };
</script>
